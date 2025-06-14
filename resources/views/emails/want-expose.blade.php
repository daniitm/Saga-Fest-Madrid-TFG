<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva solicitud de exposición</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background: #f4f4f9; 
            color: #232323; 
            margin: 0; 
            padding: 0; 
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
        .footer a { 
            color: #7692FF; 
            text-decoration: none; 
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Nueva solicitud de exposición</h1>
        </div>
        <div class="content">
            <p><strong>Empresa:</strong> {{ $data['company'] }}</p>
            <p><strong>Persona de contacto:</strong> {{ $data['contact_person'] }}</p>
            <p><strong>Email:</strong> {{ $data['email'] }}</p>
            <p><strong>Teléfono:</strong> {{ $data['phone'] }}</p>
            @if(!empty($data['website']))
                <p><strong>Web / Redes:</strong> {{ $data['website'] }}</p>
            @endif
            <p><strong>Categoría de stand:</strong> {{ $data['stand_category'] }}</p>
            <p><strong>Tamaño de stand:</strong> {{ $data['stand_size'] }}</p>
            <p><strong>Internet cableado:</strong> {{ $data['wired_internet'] == 'si' ? 'Sí' : 'No' }}</p>
            <p><strong>Configuración de sonido:</strong> {{ $data['sound_setup'] == 'si' ? 'Sí' : 'No' }}</p>
            <p><strong>Descripción corta:</strong> {{ $data['short_description'] }}</p>
            @if(!empty($data['additional_information']))
                <p><strong>Información adicional:</strong> {{ $data['additional_information'] }}</p>
            @endif
            @if(!empty($data['special_requirements']))
                <p><strong>Requerimientos especiales:</strong> {{ $data['special_requirements'] }}</p>
            @endif
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} Saga-Fest Madrid</p>
            <p>Este mensaje fue enviado desde el formulario de exposición.
                <a href="{{ url('/') }}">Visita nuestra web</a>
            </p>
        </div>
    </div>
</body>
</html>
