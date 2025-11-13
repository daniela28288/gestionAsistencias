<x-layout>
    <x-slot:page_style></x-slot:page_style>
    <x-slot:title>Gestión de Fichas</x-slot:title>
    <link rel="stylesheet" href="{{ asset('css/pages/programming_dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/programming_cohort.css') }}">

    <!-- CSS de Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <!-- JS de jQuery y Select2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <div class="main-layout">
        <div class="content">
            <div class="container">

                <!-- Encabezado de la página -->
                <div class="dashboard-header">
                    <h3 class="page-title">Gestión de Fichas de Formación</h3>
                    <p>En esta sección puede administrar todas las fichas de formación del centro.
                        Registre nuevas fichas, consulte el estado de cada una y gestione
                        la información relacionada con programas, jornadas y municipios.
                    </p>
                </div>

                <!-- Mensaje de éxito cuando se realiza la acción correctamente -->
                @if (session('success'))
                    <div class="alert-success">
                        <!-- Icono de verificación -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Mensaje de error cuando hay validaciones fallidas -->
                @if ($errors->any())
                    <div class="alert-danger">
                        <!-- Icono de advertencia -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                        <div>
                            <strong>Por favor, corrige los siguientes errores:</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <!-- Botón para abrir el modal de registro de nueva ficha -->
                <button class="btn-primary" onclick="openModal()">
                    <!-- Icono de signo "+" -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Registrar Nueva Ficha
                </button>

                <!-- Contenedor de filtros para buscar o filtrar fichas -->
                <div class="filters-container">
                    <form action="" method="GET" class="filters-form">
                        @csrf

                        <!-- Filtro por estado de la ficha -->
                        <div class="filter-group">
                            <label for="statusFilter">Estado de la ficha:</label>
                            <select id="statusFilter" name="status" onchange="filterTable()">
                                <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Todas</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Activas
                                </option>
                                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>
                                    Inactivas
                                </option>
                            </select>
                        </div>


                        <!-- Búsqueda por número de ficha -->
                        <div class="filter-group">
                            <label for="search">Número de ficha:</label>
                            <input
                                type="number"
                                id="search"
                                name="search"
                                class="search-input"
                                placeholder="Buscar por número de ficha"
                                value="{{ request('search') }}"
                                step="1"
                                min="0"
                                onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                autocomplete="off"
                            >
                        </div>

                        <!-- Botones de acción para buscar o restablecer -->
                        <div class="filter-actions">
                            <button type="submit" class="btn-search">
                                <!-- Icono de lupa -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                                Buscar
                            </button>

                            <!-- Botón para restablecer los filtros -->
                            <a href="{{ route('programing.cohort_index') }}" class="btn-reset">
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

                <!-- Contenedor de la tabla con las fichas -->
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Ficha</th>
                                <th>Programa</th>
                                <th>Jornada</th>
                                <th>Municipio</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Estado</th>
                                <th>Matriculados</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Itera sobre todas las fichas (cohorts) -->
                            @forelse($cohorts as $cohort)
                                @php
    $isActive = $cohort->end_date > now();
    $statusClass = $isActive ? 'status-active' : 'status-inactive';
    $statusText = $isActive ? 'Activa' : 'Inactiva';
                                @endphp

                                <!-- Fila de la tabla con datos de cada ficha -->
                                <tr class="ficha-row" data-status="{{ $isActive ? 'active' : 'inactive' }}">
                                    <td><strong>{{ $cohort->number_cohort }}</strong></td>
                                    <td>{{ $cohort->program->name ?? 'N/A' }}</td>
                                    <td>{{ $cohort->cohortime->name ?? 'N/A' }}</td>
                                    <td>{{ $cohort->town->name ?? 'N/A' }}</td>
                                    <td>{{ $cohort->start_date }}</td>
                                    <td>{{ $cohort->end_date }}</td>
                                    <td>
                                        <span class="status-badge {{ $statusClass }}">
                                            {{ $statusText }}
                                        </span>
                                    </td>
                                    <td>{{ $cohort->enrolled_quantity }}</td>
                                    <td>

                                        <!-- Botón para administrar la ficha -->
                                        <a href="{{ route('programing.competencies_index_administrar', $cohort->id) }}"
                                            class="btn-admin">
                                            <i class="fas fa-cog"></i> Administrar
                                        </a>

                                        <!-- Botón de eliminar solo visible si la ficha está inactiva -->
                                        @if (!$isActive)
                                            <form action="{{ route('programming.cohort.delete', $cohort->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-delete"
                                                    onclick="return confirm('¿Está seguro de que desea eliminar la ficha {{ $cohort->number_cohort }}? Esta acción no se puede deshacer.')">
                                                    <i class="fas fa-trash"></i> Eliminar
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>

                            <!-- Mensaje mostrado cuando no hay fichas -->
                            @empty
                                <tr>
                                    <td colspan="9">
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
                                            <p>No hay fichas registradas</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Modal para registrar una nueva ficha -->
                <div id="modal" class="modal">
                    <div class="modal-content">
                        <button class="close" onclick="closeModal()">&times;</button>
                        <h3>Registrar Nueva Ficha</h3>

                        <!-- Formulario de registro -->
                        <form method="POST" action="{{ route('programming.Register') }}">
                            @csrf

                            <!-- Campos del formulario organizados en grid -->
                            <div class="form-grid">

                                <!-- Campo: número de ficha -->
                                <div class="form-group">
                                    <label>Número de ficha</label>
                                    <input type="number" name="number_cohort" required min="1"
                                        placeholder="Ej: 123456">
                                </div>

                                <!-- Campo: programa -->
                                <div class="form-group">
                                    <label>Programa</label>
                                    <select name="id_program" required>
                                        <option value="">Seleccione programa</option>
                                        @foreach ($programs as $pro)
                                            <option value="{{ $pro->id }}"
                                                @if (old('id_program') == $pro->id) selected @endif>
                                                {{ $pro->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Campo: jornada -->
                                <div class="form-group">
                                    <label>Jornada</label>
                                    <select name="id_time" required>
                                        <option value="">Seleccione jornada</option>
                                        @foreach ($cohortimes as $tms)
                                            <option value="{{ $tms->id }}"
                                                @if (old('id_time') == $tms->id) selected @endif>
                                                {{ $tms->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                 <!-- Campo: municipio -->
                                <div class="form-group">
                                    <label>Municipio</label>
                                    <select name="id_town" id="municipio" required>
                                        <option value="">Seleccione municipio</option>
                                        @foreach ($towns as $tn)
                                            <option value="{{ $tn->id }}"
                                                @if (old('id_town') == $tn->id) selected @endif>
                                                {{ $tn->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Campo: fecha de inicio -->
                                <div class="form-group">
                                    <label>Fecha Inicio</label>
                                    <input type="date" name="start_date" required
                                        value="{{ old('start_date') }}">
                                </div>

                                <!-- Campo: fecha de finalización -->
                                <div class="form-group">
                                    <label>Fecha Finalización</label>
                                    <input type="date" name="end_date" required value="{{ old('end_date') }}">
                                </div>

                                <!-- Campo: cantidad de matriculados -->
                                <div class="form-group">
                                    <label>Cantidad Matriculados</label>
                                    <input type="number" name="enrolled_quantity" required min="1"
                                        value="{{ old('enrolled_quantity') }}" placeholder="Número de aprendices">
                                </div>
                            </div>

                             <!-- Botones del formulario -->
                            <div class="form-actions">
                                <button type="button" class="btn-cancel" onclick="closeModal()">Cancelar</button>
                                <button type="submit" class="btn-submit">Guardar Ficha</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('js/programming_cohort.js')}}"></script>
</x-layout>
