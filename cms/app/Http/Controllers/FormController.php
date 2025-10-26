<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormReply;
use App\Mail\FormReplyMail;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

class FormController extends Controller
{
    /**
     * Envío de formulario desde el frontend (público)
     */
    public function submit(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'form_type' => 'required|in:contact,lead_converter',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'nullable|string',
            'company' => 'nullable|string|max:255',
            'additional_fields' => 'nullable|array'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Datos inválidos',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $form = Form::create([
                'form_type' => $request->form_type,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'message' => $request->message,
                'company' => $request->company,
                'additional_fields' => $request->additional_fields,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'source' => $request->additional_fields['source'] ?? null,
                'status' => 'unread'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Formulario enviado exitosamente',
                'data' => $form
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al procesar el formulario'
            ], 500);
        }
    }

    /**
     * Obtener lista de formularios (requiere autenticación)
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $query = Form::with('replies.user');

            // Filtros
            if ($request->has('status') && $request->status !== 'all') {
                $query->byStatus($request->status);
            }

            if ($request->has('form_type') && $request->form_type !== 'all') {
                $query->byType($request->form_type);
            }

            if ($request->has('date')) {
                $query->byDate($request->date);
            }

            // Ordenar por más reciente
            $forms = $query->latest()->paginate(10);

            // Agregar campos calculados
            $forms->getCollection()->transform(function ($form) {
                return [
                    'id' => $form->id,
                    'form_type' => $form->form_type,
                    'name' => $form->name,
                    'email' => $form->email,
                    'phone' => $form->phone,
                    'message' => $form->message,
                    'company' => $form->company,
                    'status' => $form->status,
                    'additional_fields' => $form->additional_fields,
                    'ip_address' => $form->ip_address,
                    'user_agent' => $form->user_agent,
                    'source' => $form->source,
                    'created_at' => $form->created_at->toISOString(),
                    'updated_at' => $form->updated_at->toISOString(),
                    'history' => $form->replies->map(function ($reply) {
                        return [
                            'id' => $reply->id,
                            'action' => "Respuesta enviada: {$reply->subject}",
                            'user' => $reply->user->name ?? 'Admin',
                            'created_at' => $reply->sent_at->toISOString()
                        ];
                    })
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $forms->items(),
                'pagination' => [
                    'current_page' => $forms->currentPage(),
                    'last_page' => $forms->lastPage(),
                    'per_page' => $forms->perPage(),
                    'total' => $forms->total()
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener formularios'
            ], 500);
        }
    }

    /**
     * Obtener formulario específico
     */
    public function show(string $id): JsonResponse
    {
        try {
            $form = Form::with('replies.user')->findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => $form
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Formulario no encontrado'
            ], 404);
        }
    }

    /**
     * Actualizar estado del formulario
     */
    public function updateStatus(Request $request, string $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:unread,read,replied,archived'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Estado inválido',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $form = Form::findOrFail($id);
            $form->update(['status' => $request->status]);

            return response()->json([
                'success' => true,
                'message' => 'Estado actualizado exitosamente',
                'data' => $form
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar estado'
            ], 500);
        }
    }

    /**
     * Responder a un formulario
     */
    public function reply(Request $request, string $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Datos inválidos',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $form = Form::findOrFail($id);
            
            // Crear registro de respuesta
            $reply = FormReply::create([
                'form_id' => $form->id,
                'user_id' => Auth::id(),
                'subject' => $request->subject,
                'message' => $request->message,
                'sent_at' => now()
            ]);

            // Actualizar estado del formulario
            $form->update(['status' => 'replied']);

            // Enviar email de respuesta
            try {
                Mail::to($form->email)->send(new FormReplyMail($reply, $form));
            } catch (\Exception $mailException) {
                // Log del error pero no fallar la respuesta
                \Log::error('Error sending email reply: ' . $mailException->getMessage());
            }

            return response()->json([
                'success' => true,
                'message' => 'Respuesta enviada exitosamente',
                'data' => $reply
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al enviar respuesta'
            ], 500);
        }
    }

    /**
     * Marcar todos como leídos
     */
    public function markAllAsRead(): JsonResponse
    {
        try {
            Form::where('status', 'unread')->update(['status' => 'read']);

            return response()->json([
                'success' => true,
                'message' => 'Todos los formularios marcados como leídos'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al marcar como leídos'
            ], 500);
        }
    }

    /**
     * Exportar a CSV
     */
    public function export(Request $request)
    {
        try {
            $query = Form::query();

            // Aplicar filtros
            if ($request->has('status') && $request->status !== 'all') {
                $query->byStatus($request->status);
            }

            if ($request->has('form_type') && $request->form_type !== 'all') {
                $query->byType($request->form_type);
            }

            if ($request->has('date')) {
                $query->byDate($request->date);
            }

            $forms = $query->latest()->get();

            $csv = "ID,Tipo,Nombre,Email,Teléfono,Empresa,Estado,Mensaje,Fecha,IP,Origen\n";

            foreach ($forms as $form) {
                $csv .= sprintf(
                    "%d,%s,%s,%s,%s,%s,%s,\"%s\",%s,%s,%s\n",
                    $form->id,
                    $form->form_type_label,
                    $form->name,
                    $form->email,
                    $form->phone ?? '',
                    $form->company ?? '',
                    $form->status_label,
                    str_replace('"', '""', $form->message ?? ''),
                    $form->created_at->format('d/m/Y H:i'),
                    $form->ip_address ?? '',
                    $form->source ?? ''
                );
            }

            return Response::make($csv, 200, [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="formularios_crm_' . date('Y-m-d') . '.csv"',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al exportar datos'
            ], 500);
        }
    }

    /**
     * Eliminar formulario
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $form = Form::findOrFail($id);
            $form->delete();

            return response()->json([
                'success' => true,
                'message' => 'Formulario eliminado exitosamente'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar formulario'
            ], 500);
        }
    }
}
