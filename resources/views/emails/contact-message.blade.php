<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo mensaje de contacto</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background: #f4f4f9; 
            color: #232323; 
        }
        .container { 
            max-width: 600px; 
            margin: 30px auto; 
            background: #fff; 
            border-radius: 12px; 
            box-shadow: 0 4px 16px rgba(27,44,193,0.10), 0 1.5px 4px rgba(118,146,255,0.10); 
            overflow: hidden; 
        }
        .header { 
            background: linear-gradient(90deg, #1B2CC1 0%, #7692FF 100%); 
            color: #fff; 
            padding: 28px 20px 20px 20px; 
            text-align: center; 
        }
        .header h1 { 
            margin: 0; 
            font-size: 24px; 
        }
        .content { 
            padding: 28px 24px 18px 24px; 
        }
        .content p { 
            margin: 12px 0; 
            font-size: 16px; 
            line-height: 1.6; 
        }
        .summary { 
            background: #f6f8ff; 
            border-radius: 8px; 
            padding: 18px 16px; 
            margin: 18px 0 24px 0; 
        }
        .summary ul { 
            list-style: none; 
            padding: 0; 
            margin: 0; 
        }
        .summary li { 
            font-size: 16px; 
            margin-bottom: 8px; 
            color: #1B2CC1; 
        }
        .summary li strong { 
            color: #232323; 
        }
        .footer { 
            background-color: #232323; 
            text-align: center; 
            padding: 16px 10px; 
            font-size: 13px; 
            color: #bfc9e6; 
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Nuevo mensaje de contacto</h1>
        </div>
        <div class="content">
            <p><strong>Nombre:</strong> {{ $data['name'] }}</p>
            <p><strong>Apellidos:</strong> {{ $data['surnames'] }}</p>
            <p><strong>Email:</strong> {{ $data['email'] }}</p>
            @if(!empty($data['phone']))
                <p><strong>Teléfono:</strong> {{ $data['phone'] }}</p>
            @endif
            <p><strong>Mensaje:</strong> {{ $data['message'] }}</p>
        </div>
        <!-- Pie de página -->
        <div class="footer">
            <p>© {{ date('Y') }} Saga-Fest Madrid</p>
            <p>Este mensaje fue enviado desde el formulario de contacto.
                <a href="{{ url('/') }}">Visita nuestra web</a>
            </p>
        </div>
    </div>
</body>
</html>
