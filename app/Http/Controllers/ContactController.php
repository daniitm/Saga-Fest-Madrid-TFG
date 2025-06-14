<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255','regex:/^[A-Za-zÁÉÍÓÚÜÑáéíóúüñ\s]+$/u'],
            'surnames' => ['required', 'string', 'max:255','regex:/^[A-Za-zÁÉÍÓÚÜÑáéíóúüñ\s]+$/u'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable','string','digits:9','regex:/^[6-9]\d{8}$/'],
            'message' => ['required', 'string', 'max:2000', 'min:25'],
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.regex' => 'El nombre solo puede contener letras y espacios.',
            'surnames.required' => 'Los apellidos son obligatorios.',
            'surnames.regex' => 'Los apellidos solo pueden contener letras y espacios.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser válido.',
            'phone.digits' => 'El teléfono debe tener 9 dígitos.',
            'phone.regex' => 'El teléfono debe comenzar con 6, 7, 8 o 9.',
            'message.required' => 'El mensaje es obligatorio.',
            'message.min' => 'El mensaje debe tener al menos 25 caracteres.',
        ]);

        // Aquí podrías enviar un correo, guardar en base de datos, etc.
        // Enviar correo al mail_from address
        Mail::to(config('mail.from.address'))->send(new ContactMessage($validated));

        Session::flash('toast', [
            'type' => 'success',
            'message' => '¡Tu mensaje ha sido enviado correctamente!'
        ]);

        return redirect()->back();
    }
}
