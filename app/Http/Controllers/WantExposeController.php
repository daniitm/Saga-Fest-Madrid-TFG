<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Mail\WantExposeMessage;

class WantExposeController extends Controller
{
    public function show()
    {
        return view('want-expose');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'company' => ['required', 'string', 'max:255'],
            'contact_person' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required','string','digits:9','regex:/^[6-9]\d{8}$/'],
            'website' => ['nullable', 'url', 'max:255'],
            'stand_category' => ['required', 'string'],
            'stand_size' => ['required', 'string'],
            'wired_internet' => ['required', 'in:si,no'],
            'sound_setup' => ['required', 'string', 'max:255'],
            'short_description' => ['required', 'string', 'min:100', 'max:255'],
            'additional_information' => ['nullable', 'string', 'min:10', 'max:255'],
            'special_requirements' => ['nullable', 'string', 'min:10', 'max:255'],
        ], [
            'company.required' => 'El nombre de la empresa es obligatorio.',
            'contact_person.required' => 'La persona de contacto es obligatoria.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser válido.',
            'phone.required' => 'El teléfono es obligatorio.',
            'phone.digits' => 'El teléfono debe tener 9 dígitos.',
            'phone.regex' => 'El teléfono debe comenzar con un 6, 7, 8 o 9 y contener solo números.',
            'website.url' => 'La web debe ser una URL válida.',
            'stand_category.required' => 'La categoría de stand es obligatoria.',
            'stand_size.required' => 'El tamaño de stand es obligatorio.',
            'wired_internet.required' => 'Debes indicar si necesitas internet cableado.',
            'wired_internet.in' => 'La opción de internet cableado no es válida.',
            'sound_setup.required' => 'La configuración de sonido es obligatoria.',
            'short_description.required' => 'La descripción corta es obligatoria.',
            'short_description.min' => 'La descripción debe tener al menos 100 caracteres.',
            'short_description.max' => 'La descripción no puede superar los 255 caracteres.',
            'additional_information.min' => 'La información adicional debe tener al menos 10 caracteres.',
            'additional_information.max' => 'La información adicional no puede superar los 255 caracteres.',
            'special_requirements.min' => 'Los requisitos especiales deben tener al menos 10 caracteres.',
            'special_requirements.max' => 'Los requisitos especiales no pueden superar los 255 caracteres.',
        ]);

        // Guardar archivo si se sube
        if ($request->hasFile('portfolio')) {
            $file = $request->file('portfolio');
            $filename = 'portfolio_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('portfolios', $filename, 'public');
            $validated['portfolio_path'] = $path;
        }

        // Enviar correo al MAIL_FROM_ADDRESS
        Mail::to(config('mail.from.address'))->send(new WantExposeMessage($validated));

        // Toast de éxito
        Session::flash('toast', [
            'type' => 'success',
            'message' => '¡Tu solicitud ha sido enviada correctamente!'
        ]);

        return redirect()->back();
    }
}
