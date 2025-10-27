<x-layout>
    <x-slot:page_style></x-slot:page_style>
    <x-slot:title>Asignar Aprendices</x-slot:title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11">
        // incluir libreria 
    </script>
    <link rel="stylesheet" href="{{ asset('css/programming_asignarApprendices.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/competencies_program_index.css') }}">
       <link rel="stylesheet" href="{{ asset('css/pages/programming_dashboard.css') }}">


    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Acción exitosa!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#28a745'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
                confirmButtonColor: '#d33'
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Errores de validación',
                html: '{!! implode('<br>', $errors->all()) !!}',
                confirmButtonColor: '#d33'
            });
        </script>
    @endif

    <div class="main-layout">
        <div class="content">
            <div class="container">

                <div class="dashboard-header">
                    <h1>Asignación de Aprendices</h1>
                    <p> En esta sección puede vincular aprendices a programas de formación y fichas específicas.
                        Seleccione la ficha deseada y marque los aprendices que desea asignar.
                        Esta acción asociará los aprendices seleccionados con el programa de formación elegido.
                    </p>
                </div>
                <div class="search-wrapper">
                    <form action="" method="GET">

                        <input class="search-input" type="text" value="{{ request('search') }}" name="search"
                            placeholder="documento o nombre">
                        <button class="btn-search">Buscar</button>
                    </form>

                    <a href="{{ route('programing.add_apprentices_cohorts') }}" class="btn-reset">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M3 12l2-2 4 4 8-8 4 4"></path>
                        </svg>
                        Restablecer
                    </a>
                </div>


                <form action="{{ route('programing.add_apprentices_store') }}" method="POST" id="asignarForm">
                    @csrf

                    <div class="form-section">
                        <label for="ficha">Seleccione Ficha y Programa de Formación</label>
                        <select id="ficha" name="ficha_id" required>
                            <option value="">-- Seleccione una ficha --</option>
                            @foreach ($cohorts as $cohort)
                                <option value="{{ $cohort->id }}">
                                    {{ $cohort->number_cohort }} -
                                    {{ $cohort->program->name ?? 'Programa no asignado' }}
                                </option>
                            @endforeach
                        </select>

                    </div>

                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 50px; text-align: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                    </th>
                                    <th>
                                        Documento</th>
                                    <th>Nombre Completo</th>
                                    <th>Correo Electrónico</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($aprentices as $aprendiz)
                                    <tr>
                                        <td class="checkbox-container">
                                            <input type="checkbox" name="aprendices[]" value="{{ $aprendiz->id }}">
                                        </td>
                                        <td>{{ $aprendiz->person->document_number }}</td>
                                        <td>{{ $aprendiz->person->name }}</td>
                                        <td>{{ $aprendiz->person->email }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">
                                            <div class="empty-state">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <line x1="12" y1="8" x2="12" y2="12">
                                                    </line>
                                                    <line x1="12" y1="16" x2="12.01" y2="16">
                                                    </line>
                                                </svg>
                                                <p>No hay aprendices disponibles para asignar</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="form-buttons">
                        <button type="submit" class="btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                <polyline points="7 3 7 8 15 8"></polyline>
                            </svg>
                            Vincular Aprendices Seleccionados
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</x-layout>
