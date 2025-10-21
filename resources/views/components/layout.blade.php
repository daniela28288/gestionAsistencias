<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title ?? 'Sistema SENA' }}</title>
    <link rel="stylesheet" href="{{asset('css/components/header.css')}}">
    <link rel="stylesheet" href="{{asset('css/components/sidebar.css')}}">
</head>

<body>

    <!-- Contenedor principal del layout -->
    <div class="main-layout">

        {{-- Sidebar: menú lateral --}}
        @include('components.sidebar')
        <!-- Incluye la vista del sidebar -->

        {{-- Header: barra superior con acciones y título --}}
        @include('components.header')
        <!-- Incluye la vista del header -->

        <!-- Aquí va el contenido específico de la vista competencies_program_index.blade.php -->
        {{ $slot }}
    </div>
</body>

</html>
