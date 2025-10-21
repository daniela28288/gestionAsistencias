<x-layout>
    <x-slot:page_style>css/pages/programming_dashboard.css</x-slot:page_style>
    <x-slot:title>Gestión de Programas</x-slot:title>
    <link rel="stylesheet" href="{{ asset('css/pages/programming_dashboard.css')}}">
    <link rel="stylesheet" href="{{ asset('css/components/sidebar.css')}}">
    <link rel="stylesheet" href="{{ asset('css/components/header.css')}}">

    <div class="content">
        <div class="container">

            <div class="dashboard-header">
                <h1>Gestión de Programas de Formación</h1>
                <p> En esta sección puede administrar todos los programas de formación disponibles en el centro.
                    Registre nuevos programas, consulte la información existente y gestione la asignación de
                    instructores responsables para cada programa formativo.
                </p>
            </div>

            <button class="btn-primary" onclick="openModal()">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Registrar Nuevo Programa
            </button>

            <!-- Alertas -->
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

            @if (session('error'))
                <div class="alert-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="15" y1="9" x2="9" y2="15"></line>
                        <line x1="9" y1="9" x2="15" y2="15"></line>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert-danger">
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

            <!-- Tabla de programas -->
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Código del Programa</th>
                            <th>Nombre del Programa</th>
                            <th>Versión</th>
                            <th>Nivel</th>
                            <th>Instructor Responsable</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($programs as $program)
                            <tr>
                                <td><strong>{{ $program->program_code }}</strong></td>
                                <td>{{ $program->name }}</td>
                                <td>{{ $program->program_version }}</td>
                                <td>
                                    <span
                                        class="badge {{ $program->id_level == 1 ? 'badge-technical' : 'badge-technologist' }}">
                                        {{ $program->id_level == 1 ? 'Técnico' : 'Tecnólogo' }}
                                    </span>
                                </td>
                                <td>{{ $program->instructor->person->name }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="12" y1="8" x2="12" y2="12"></line>
                                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                        </svg>
                                        <p>No hay programas registrados</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Modal de registro -->
            <div id="programModal" class="modal-overlay">
                <div class="modal-content">
                    <button class="close-btn" onclick="closeModal()">&times;</button>
                    <h2>Registrar Nuevo Programa</h2>

                    <form method="POST" action="{{ route('programing.programan_store_add') }}" class="program-form">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nombre del Programa</label>
                            <input type="text" name="name" id="name" required
                                placeholder="Ingrese el nombre del programa">
                        </div>

                        <div class="form-group">
                            <label for="program_code">Código del Programa</label>
                            <input type="text" name="program_code" id="program_code" required
                                placeholder="Ej: PROG-001">
                        </div>

                        <div class="form-group">
                            <label for="program_version">Versión del Programa</label>
                            <input type="text" name="program_version" id="program_version" required
                                placeholder="Ej: 1.0">
                        </div>

                        <div class="form-group">
                            <label for="id_level">Nivel del Programa</label>
                            <select name="id_level" id="id_level" required>
                                <option value="">Seleccione el nivel</option>
                                @foreach ($programan_level as $level)
                                    <option value="{{ $level->id }}">{{ $level->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="instructor_id">Instructor Responsable</label>
                            <select name="instructor_id" id="instructor_id" required>
                                <option value="">Seleccione el instructor</option>
                                @foreach ($instructors as $instru)
                                    <option value="{{ $instru->id }}">{{ $instru->person->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn-submit" style="background-color: #6c757d;"
                                onclick="closeModal()">Cancelar</button>
                            <button type="submit" class="btn-submit">Registrar Programa</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('programModal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('programModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('programModal');
            if (event.target === modal) {
                closeModal();
            }
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });

        // Auto-focus en el primer campo al abrir el modal
        document.getElementById('programModal').addEventListener('shown', function() {
            document.getElementById('name').focus();
        });
    </script>
</x-layout>
