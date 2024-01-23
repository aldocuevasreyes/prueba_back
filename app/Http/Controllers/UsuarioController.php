<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Validator; // Asegúrate de importar Validator

class UsuarioController extends Controller
{
    // ...

    // Función para almacenar un nuevo usuario en la base de datos
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:usuarios',
            'fecha_nacimiento' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->route('usuarios.create')
                ->withErrors($validator)
                ->withInput();
        }

        Usuario::create($request->all());

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado exitosamente.');
    }

    // Función para actualizar la información de un usuario
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:usuarios,correo,' . $id,
            'fecha_nacimiento' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->route('usuarios.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $usuario = Usuario::findOrFail($id);
        $usuario->update($request->all());

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    // Función para eliminar un usuario
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente.');
    }

    // Función para buscar usuarios por nombre
    public function buscarPorNombre($nombre)
    {
        $usuarios = Usuario::where('nombre', 'like', '%' . $nombre . '%')->get();

        return view('usuarios.index', compact('usuarios'));
    }

    // Función para filtrar usuarios por rango de fechas de nacimiento
    public function filtrarPorFecha($fechaInicio, $fechaFin)
    {
        $usuarios = Usuario::whereBetween('fecha_nacimiento', [$fechaInicio, $fechaFin])->get();

        return view('usuarios.index', compact('usuarios'));
    }
}
