<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exposición aceptada</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
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
            font-size: 26px;
            letter-spacing: 1px;
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
            border-left: 4px solid #1B2CC1;
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
        <!-- Encabezado -->
        <div class="header">
            <h1>¡Gracias por tu compra!</h1>
        </div>
        <!-- Contenido -->
        <div class="content">
            <p>Hola <strong>{{ $contactPerson }}</strong>, 
            su exposición con la empresa <strong>{{ $companyName }}</strong> ha sido aceptada por el equipo de Saga-Fest Madrid. Nuestro equipo administrativo ya se ha encargado de crear y asignarte tu exposición. Aquí tienes un pequeño resumen de tu exposición:</p>
            <div class="summary">
                <ul>
                    <li><strong>Fecha:</strong> {{ $date }}</li>
                    <li><strong>Turno:</strong> {{ $turn }}</li>
                    <li><strong>Hora de inicio:</strong> {{ $startTime }}</li>
                    <li><strong>Hora de fin:</strong> {{ $endTime }}</li>
                </ul>
            </div>
            <p>¡Te esperamos ese día junto a nosotros!</p>
            <p>Si tienes cualquier duda, contacta con nuestro equipo de soporte a través de este "<a href="{{ url('/contact') }}">enlace</a>".</p>
        </div>
        <!-- Pie de página -->
        <div class="footer">
            <p>© {{ date('Y') }} Saga-Fest Madrid</p>
            <p>Este mensaje es una confirmación automática.
                <a href="{{ url('/') }}">Visita nuestra web</a>
            </p>
        </div>
    </div>
</body>
</html>