<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Celebrity\CelebrityRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CelebrityController extends Controller
{
    private CelebrityRepositoryInterface $celebrities;

    public function __construct(CelebrityRepositoryInterface $celebrities)
    {
        $this->celebrities = $celebrities;
    }

    public function index()
    {
        $celebrities = $this->celebrities->paginate(15);
        return view('admin.celebrities.index', compact('celebrities'));
    }

    public function show($id)
    {
        $celebrity = $this->celebrities->findById($id);
        return view('admin.celebrities.show', compact('celebrity'));
    }

    public function create()
    {
        return view('admin.celebrities.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[A-Za-zÁÉÍÓÚÜÑáéíóúüñ\s]+$/u'
            ],
            'surnames' => [
                'required',
                'string',
                'max:255',
                'regex:/^[A-Za-zÁÉÍÓÚÜÑáéíóúüñ\s]+$/u'
            ],
            'email' => 'required|email|max:255|unique:celebrities,email',
            'biography' => 'required|string|max:1000',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'category' => 'required|string',
            'website' => 'nullable|url|max:255',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.regex' => 'El nombre solo puede contener letras y espacios.',
            'surnames.required' => 'Los apellidos son obligatorios.',
            'surnames.regex' => 'Los apellidos solo pueden contener letras y espacios.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'El email debe ser una dirección de correo electrónico válida.',
            'email.unique' => 'El email ya está en uso.',
            'biography.required' => 'La biografía es obligatoria.',
            'biography.max' => 'La biografía no puede exceder los 1000 caracteres.',
            'photo.regex' => 'La fotografía debe ser un archivo tipo imagen.',
            'category.required' => 'La categoría es obligatoria.',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $hash = md5_file($file->getRealPath());
            $extension = $file->getClientOriginalExtension();
            $filename = $hash . '.' . $extension;

            $path = 'img/celebrities/' . $filename;

            if (!Storage::disk('public')->exists($path)) {
                Storage::disk('public')->putFileAs('img/celebrities', $file, $filename);
            }

            $data['photo'] = $filename;
        }

        $this->celebrities->create($data);

        return redirect()->route('admin.celebrities.index')->with('success', 'Celebrity creada correctamente.');
    }

    public function edit($id)
    {
        $celebrity = $this->celebrities->findById($id);
        return view('admin.celebrities.edit', compact('celebrity'));
    }

    public function update(Request $request, $id)
    {
        $celebrity = $this->celebrities->findById($id);

        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[A-Za-zÁÉÍÓÚÜÑáéíóúüñ\s]+$/u'
            ],
            'surnames' => [
                'required',
                'string',
                'max:255',
                'regex:/^[A-Za-zÁÉÍÓÚÜÑáéíóúüñ\s]+$/u'
            ],
            'email' => 'required|email|max:255|unique:celebrities,email,' . $celebrity->id,
            'biography' => 'required|string|max:1000',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'category' => 'required|string',
            'website' => 'nullable|url|max:255',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.regex' => 'El nombre solo puede contener letras y espacios.',
            'surnames.required' => 'Los apellidos son obligatorios.',
            'surnames.regex' => 'Los apellidos solo pueden contener letras y espacios.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'El email debe ser una dirección de correo electrónico válida.',
            'email.unique' => 'El email ya está en uso.',
            'biography.required' => 'La biografía es obligatoria.',
            'biography.max' => 'La biografía no puede exceder los 1000 caracteres.',
            'photo.regex' => 'La fotografía debe ser un archivo tipo imagen.',
            'category.required' => 'La categoría es obligatoria.',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $hash = md5_file($file->getRealPath());
            $extension = $file->getClientOriginalExtension();
            $filename = $hash . '.' . $extension;

            $path = 'img/celebrities/' . $filename;

            if (!Storage::disk('public')->exists($path)) {
                Storage::disk('public')->putFileAs('img/celebrities', $file, $filename);
            }

            $data['photo'] = $filename;
        }

        $this->celebrities->update($celebrity, $data);

        return redirect()->route('admin.celebrities.index')->with('success', 'Celebrity actualizada correctamente.');
    }

    public function destroy($id)
    {
        $celebrity = $this->celebrities->findById($id);

        $photo = $celebrity->photo;

        $this->celebrities->delete($celebrity);

        // Solo eliminar si no es imagen por defecto y nadie más la usa
        if ($photo && $photo !== 'imagen_perfil.png') {
            $usedByOthers = $this->celebrities->countByPhoto($photo);

            if ($usedByOthers === 0) {
                Storage::disk('public')->delete('img/celebrities/' . $photo);
            }
        }

        return redirect()->route('admin.celebrities.index')->with('success', 'Celebrity eliminada correctamente.');
    }
}
