<?php

namespace Database\Seeders;

use App\Models\Form;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $forms = [
            [
                'form_type' => 'contact',
                'name' => 'Juan Pérez',
                'email' => 'juan@ejemplo.com',
                'phone' => '+57 300 123 4567',
                'message' => 'Hola, me interesa conocer más sobre sus servicios contables. ¿Podrían enviarme información sobre sus planes y tarifas?',
                'company' => 'Empresa ABC',
                'status' => 'unread',
                'additional_fields' => [
                    'source' => 'Footer Contact Form',
                    'accepts_policy' => true
                ],
                'ip_address' => '192.168.1.10',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'source' => 'Footer Contact Form',
                'created_at' => Carbon::now()->subHours(2),
            ],
            [
                'form_type' => 'lead_converter',
                'name' => 'María González',
                'email' => 'maria@ejemplo.com',
                'phone' => '+57 310 987 6543',
                'message' => 'Necesito asesoría tributaria urgente para mi empresa.',
                'status' => 'read',
                'additional_fields' => [
                    'situation' => 'Empresa establecida',
                    'urgency' => 'En los próximos 15 días',
                    'source' => 'Lead Converter Block',
                    'country_code' => '+57'
                ],
                'ip_address' => '192.168.1.11',
                'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36',
                'source' => 'Lead Converter Block',
                'created_at' => Carbon::now()->subHours(5),
            ],
            [
                'form_type' => 'contact',
                'name' => 'Carlos Rodríguez',
                'email' => 'carlos@ejemplo.com',
                'phone' => '+57 320 456 7890',
                'message' => 'Me gustaría agendar una cita para revisar la contabilidad de mi negocio.',
                'status' => 'replied',
                'additional_fields' => [
                    'source' => 'Footer Contact Form',
                    'accepts_policy' => true
                ],
                'ip_address' => '192.168.1.12',
                'user_agent' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 15_0 like Mac OS X) AppleWebKit/605.1.15',
                'source' => 'Footer Contact Form',
                'created_at' => Carbon::now()->subDay(),
            ],
            [
                'form_type' => 'lead_converter',
                'name' => 'Ana Silva',
                'email' => 'ana@ejemplo.com',
                'phone' => '+57 315 789 0123',
                'message' => 'Quiero información sobre servicios de auditoría para mi startup.',
                'status' => 'unread',
                'additional_fields' => [
                    'situation' => 'Startup/Empresa nueva',
                    'urgency' => 'En los próximos 30 días',
                    'source' => 'Lead Converter Block',
                    'country_code' => '+57'
                ],
                'ip_address' => '192.168.1.13',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:91.0) Gecko/20100101 Firefox/91.0',
                'source' => 'Lead Converter Block',
                'created_at' => Carbon::now()->subMinutes(30),
            ],
        ];

        foreach ($forms as $form) {
            Form::create($form);
        }
    }
}
