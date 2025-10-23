<x-layout>
    <x-slot:title>Listado de Aprendices por Ficha</x-slot:title>
    <link rel="stylesheet" href="{{asset('css/pages/apprentice/apprentice_list.css')}}">
        <link rel="stylesheet" href="{{ asset('css/pages/competencies_program_index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/programming_dashboard.css') }}">
    

    <div class="main-layout">
        <div class="content">
            <div class="container">
                <div class="dashboard-header">
                    <h3 class="page-title">Gestión de Aprendices por Ficha</h3>
                    <p>En esta sección puede visualizar y gestionar los aprendices asignados a cada ficha de formación.
                        Utilice los filtros para buscar por ficha específica, programa de formación o etapa
                        (lectiva/práctica).
                        También puede buscar aprendices por nombre o número de documento.
                    </p>
                </div>

                @if (session('success'))
                    <div class="alert-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Filtros mejorados -->
                <div class="filters-container">
                    <form method="GET" action="" class="filters-form">
                        <div class="filter-group">
                            <label for="combo_ficha">Ficha y Programa:</label>
                            <select name="combo_ficha" id="combo_ficha" onchange="this.form.submit()">
                                <option value="">-- Todas las fichas --</option>
                                @foreach ($fichas as $ficha)
                                    <option value="{{ $ficha['id'] }}"
                                        {{ request('combo_ficha') == $ficha['id'] ? 'selected' : '' }}>
                                        {{ $ficha['ficha'] }} - {{ $ficha['programa'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="filter-group search-group">
                            <label for="buscar">Buscar aprendiz:</label>
                            <div class="search-container">
                                <input type="text" name="buscar" id="buscar" class="search-input"
                                    placeholder="Nombre o documento..." value="{{ request('buscar') }}">
                                <button type="submit" class="btn-search">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg>
                                    Buscar
                                </button>

                            </div>

                        </div>

                        <div class="filter-group">

                            <a href="{{ route('programing.list_apprentices') }}" class="btn-reset">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 12l2-2 4 4 8-8 4 4"></path>
                                </svg>
                                Restablecer
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Tabla con paginación -->
                <div class="table-container">
                    <table id="apprenticesTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Documento</th>
                                <th>Aprendiz</th>
                                <th>Correo</th>
                                <th>Ficha</th>
                                <th>Programa</th>
                                <th>Inicio</th>
                                <th>Finalización</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($apprentices as $index => $apprentice)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $apprentice['document_number'] }}</td>
                                    <td>{{ $apprentice['name'] }}</td>
                                    <td>{{ $apprentice['email'] }}</td>
                                    <td>{{ $apprentice['cohort_name'] }}</td>
                                    <td>{{ $apprentice['nombre_programa'] }}</td>
                                    <td>{{ $apprentice['start_date'] }}</td>
                                    <td>{{ $apprentice['end_date'] }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">
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
                                            <p>No se encontraron aprendices con los filtros seleccionados</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginación JavaScript -->
                @if (count($apprentices) > 0)
                    <div class="pagination-container" id="paginationContainer">
                        <div class="pagination-info" id="paginationInfo">
                            Mostrando <span id="currentItems">0</span> de <span
                                id="totalItems">{{ count($apprentices) }}</span> aprendices
                        </div>
                        <div class="pagination" id="pagination">
                            <!-- La paginación se generará con JavaScript -->
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        const totalItemsCount = {{ count($apprentices) }};
    </script>
    <script src="{{ asset('js/apprentice_list.js') }}"></script>
</x-layout>
