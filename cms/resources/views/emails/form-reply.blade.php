<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $reply->subject }}</title>
    <style>
        body {
            font-family: 'Lato', Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #0c6444, #0a5a39);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }
        .content {
            padding: 30px;
        }
        .greeting {
            font-size: 18px;
            margin-bottom: 20px;
            color: #2c3e50;
        }
        .message-content {
            background: #f8f9fa;
            border-left: 4px solid #0c6444;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .footer {
            background: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 14px;
        }
        .footer a {
            color: #d1ae6a;
            text-decoration: none;
        }
        .original-message {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
        }
        .original-message h3 {
            color: #6c757d;
            font-size: 16px;
            margin-bottom: 10px;
        }
        .original-message .details {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 4px;
            font-size: 14px;
            color: #495057;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>R-Integra</h1>
            <p>Solidez contable, proyección empresarial</p>
        </div>
        
        <div class="content">
            <div class="greeting">
                Hola {{ $form->name }},
            </div>
            
            <div class="message-content">
                {!! nl2br(e($reply->message)) !!}
            </div>
            
            <p>
                Gracias por contactarnos. Si tienes alguna pregunta adicional, no dudes en responder a este correo.
            </p>
            
            <p>
                Saludos cordiales,<br>
                <strong>Equipo R-Integra</strong>
            </p>
            
            <div class="original-message">
                <h3>Mensaje original:</h3>
                <div class="details">
                    <p><strong>De:</strong> {{ $form->name }} ({{ $form->email }})</p>
                    <p><strong>Tipo:</strong> {{ $form->form_type_label }}</p>
                    <p><strong>Fecha:</strong> {{ $form->created_at->format('d/m/Y H:i') }}</p>
                    @if($form->message)
                    <p><strong>Mensaje:</strong></p>
                    <p>{{ $form->message }}</p>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="footer">
            <p>
                R-Integra - Servicios Contables y Tributarios<br>
                Cali, Valle del Cauca, Colombia<br>
                <a href="mailto:contacto@r-integra.com">contacto@r-integra.com</a> | 
                <a href="tel:+573208994424">+57 320 899 4424</a>
            </p>
        </div>
    </div>
</body>
</html>