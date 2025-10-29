<x-layout>
    <x-slot:title>Listado de programaciones</x-slot:title>

    <link rel="stylesheet" href="{{ asset('css/pages/programming_dashboard.css') }}">
        <link rel="stylesheet" href="{{ asset('css/pages/programming_index.css') }}">

    <div class="main-layout">
        <div class="content">
            <div class="container">
                <h3 class="page-title">Programaciones</h3>

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Filtros -->
                <div class="filters-container">
                    <div class="filter-group">
                        <label for="program-filter">Filtrar por programa:</label>
                        <select id="program-filter">
                            <option value="">Todos los programas</option>
                            @foreach ($programaciones->pluck('cohort.program.name')->unique()->filter() as $programName)
                                <option value="{{ $programName }}">{{ $programName }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="filter-group">
                        <label for="status-filter">Filtrar por estado:</label>
                        <select id="status-filter">
                            <option value="">Todos los estados</option>
                            <option value="pendiente">Pendiente</option>
                            <option value="en_ejecucion">En ejecución</option>

                            <option value="finalizada_no_evaluada">Finalizada (Pendiente evaluación)</option>

                        </select>
                    </div>


                    <button class="reset-btn" id="reset-filters">Restablecer filtros</button>
                </div>

                <div class="no-results" id="no-results">
                    No se encontraron programaciones con los filtros aplicados.
                </div>


                <!-- Botón de descarga Excel -->
                <button id="export-excel" class="btn-excel">
                    <i class="fas fa-file-excel"></i> Descargar Excel
                </button>
                <button class="btn-programar">
                    <a style="text-decoration: none;color: white;"
                        href="{{ route('programming.register_programming_instructor_index') }}">Registrar
                        Programación</a>
                </button>


                <div class="table-responsive" style="max-height: 500px; overflow-y: auto; overflow-x: auto;">

                    <table id="programming-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Programa</th>
                                <th>Ficha</th>
                                <th>Instructor</th>
                                <th>Competencia</th>
                                <th>Duracion</th>
                                <th>Ambiente</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Horario</th>
                                <th>Estado</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($programaciones as $programacion)
                                <tr data-program="{{ $programacion->cohort->program->name ?? '' }}"
                                    data-status="{{ $programacion->status }}"
                                    @if ($programacion->status === 'finalizada_evaluada') data-disponible="true" @endif>
                                    <td>{{ $programacion->id }}</td>

                                    <td>{{ $programacion->cohort->program->name ?? 'N/A' }}</td>
                                    <td>{{ $programacion->cohort->number_cohort ?? 'N/A' }}</td>
                                    <td>{{ $programacion->instructor->person->name ?? 'N/A' }}</td>
                                    <td>
                                        {{ $programacion->competencie->name ?? 'N/A' }}
                                        {{-- @if ($programacion->status === 'finalizada_evaluada')
                                    <span class="disponible-badge" title="Esta competencia está disponible para reprogramación">
                                        (Disponible)
                                    </span>
                                @endif --}}
                                    </td>
                                    <td>{{ $programacion->hours_duration }} hrs </td>
                                    <td>{{ $programacion->classroom->name ?? 'N/A' }}</td>
                                    <td>{{ $programacion->start_date }}</td>
                                    <td>{{ $programacion->end_date }}</td>
                                    <td>
                                        {{ $programacion->start_time }} -
                                        {{ $programacion->end_time }}
                                    </td>
                                    <td>
                                        <div class="status-container">
                                            @php
                                                $estados = [
                                                    'pendiente' => [
                                                        'class' => 'status-pendiente',
                                                        'text' => 'Pendiente',
                                                        'icon' => '⏱️',
                                                    ],
                                                    'en_ejecucion' => [
                                                        'class' => 'status-en_ejecucion',
                                                        'text' => 'En ejecución',
                                                        'icon' => '🔄',
                                                    ],
                                                    'finalizada_evaluada' => [
                                                        'class' => 'status-finalizada_evaluada',
                                                        'text' => 'Finalizada (Evaluada)',
                                                        'icon' => '✅',
                                                    ],
                                                    'finalizada_no_evaluada' => [
                                                        'class' => 'status-finalizada_no_evaluada',
                                                        'text' => 'Finalizada (Pendiente evaluación)',
                                                        'icon' => '⚠️',
                                                    ],
                                                ];

                                                $estado = $estados[$programacion->status] ?? [
                                                    'class' => 'status-desconocido',
                                                    'text' => 'Desconocido',
                                                    'icon' => '❓',
                                                ];
                                            @endphp

                                            <span class="status-badge {{ $estado['class'] }}">
                                                <span class="status-icon">{{ $estado['icon'] }}</span>
                                                {{ $estado['text'] }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="action-cell">
                                        @if ($programacion->status === 'finalizada_no_evaluada')
                                            {{-- Botón para Evaluar --}}
                                            <form action="{{ route('programmig.evaluate', $programacion->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('¿Está seguro que desea evaluar esta programación?')">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn-evaluar" style="cursor: pointer">
                                                    <i class="fas fa-check-circle"></i> Evaluar
                                                </button>
                                            </form>

                                            {{-- {{-- @elseif ($programacion->status === 'finalizada_evaluada')
                                    @if (in_array($programacion->id, $ultimasProgramaciones))
                                        {{-- ✅ Solo la última programación de la competencia puede reprogramarse
                                        <form action="{{ route('programmig.programming_update_index', $programacion->id) }}" method="GET" onsubmit="return confirm('¿Está seguro que desea reprogramar?')">
                                            @csrf
                                            <button type="submit" class="btn-reprogramar" style="cursor: pointer">
                                                <i class="fas fa-calendar-alt"></i> Reprogramar
                                            </button>
                                        </form>
                                    @else

                                        <span class="text-muted">Reprogramado</span>
                                    @endif --}}
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" style="text-align: center;">No hay programaciones registradas
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Incluir SheetJS -->
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

    <!-- Incluir Font Awesome para el ícono de Excel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <script src="{{ asset('js/programming_index.js') }}"></script>
</x-layout>
