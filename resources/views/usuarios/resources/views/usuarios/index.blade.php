<!-- resources/views/usuarios/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Usuarios</title>
</head>
<body>
    <h1>Listado de Usuarios</h1>

    @foreach ($usuarios as $usuario)
        <p>{{ $usuario->nombre }} - {{ $usuario->correo }} - {{ $usuario->fecha_nacimiento }}</p>
    @endforeach

    <a href="{{ route('usuarios.create') }}">Crear Nuevo Usuario</a>
</body>
</html>
