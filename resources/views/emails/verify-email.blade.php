<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifica tu correo electrónico</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f9; color: #232323; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 30px auto; background: #fff; border-radius: 12px; box-shadow: 0 4px 16px rgba(27,44,193,0.10), 0 1.5px 4px rgba(118,146,255,0.10); overflow: hidden; }
        .header { background: linear-gradient(90deg, #1B2CC1 0%, #7692FF 100%); color: #fff; padding: 28px 20px 20px 20px; text-align: center; }
        .header h1 { margin: 0; font-size: 24px; }
        .content { padding: 28px 24px 18px 24px; }
        .content p { margin: 12px 0; font-size: 16px; line-height: 1.6; }
        .button { display: inline-block; margin: 24px 0; padding: 12px 32px; background: #7692FF; color: #fff; border-radius: 6px; text-decoration: none; font-weight: bold; font-size: 16px; }
        .footer { background-color: #232323; text-align: center; padding: 16px 10px; font-size: 13px; color: #bfc9e6; }
        .footer a { color: #7692FF; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Verifica tu correo electrónico</h1>
        </div>
        <div class="content">
            <p>¡Gracias por registrarte en Saga-Fest Madrid!</p>
            <p>Para completar tu registro y poder acceder a tu cuenta, por favor haz clic en el siguiente botón para verificar tu correo electrónico:</p>
            <p style="text-align:center;">
                <a href="{{ $verificationUrl }}" class="button">Verificar correo</a>
            </p>
            <p>Si no creaste una cuenta, puedes ignorar este correo.</p>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} Saga-Fest Madrid</p>
            <p>Este mensaje fue enviado automáticamente.<br>
                <a href="{{ url('/') }}">Visita nuestra web</a>
            </p>
        </div>
    </div>
</body>
</html>
