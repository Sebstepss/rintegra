R-Integra - {{ $reply->subject }}

Hola {{ $form->name }},

{{ $reply->message }}

Gracias por contactarnos. Si tienes alguna pregunta adicional, no dudes en responder a este correo.

Saludos cordiales,
Equipo R-Integra

---

Mensaje original:
De: {{ $form->name }} ({{ $form->email }})
Tipo: {{ $form->form_type_label }}
Fecha: {{ $form->created_at->format('d/m/Y H:i') }}
@if($form->message)
Mensaje: {{ $form->message }}
@endif

---
R-Integra - Servicios Contables y Tributarios
Cali, Valle del Cauca, Colombia
contacto@r-integra.com | +57 320 899 4424