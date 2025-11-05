<x-layout>
    <x-slot:page_style>css/pages/programming_dashboard.css</x-slot:page_style>
    <x-slot:title>Gestión de Programas</x-slot:title>
    <link rel="stylesheet" href="{{ asset('css/pages/programming_dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/competencies_program_index.css') }}">

    <div class="content">
        <div class="container">

            <!-- Título y descripción del módulo -->
            <div class="dashboard-header">
                <h3 class="page-title">Gestión de Programas de Formación</h3>
                <p class="page-description"> En esta sección puede administrar todos los programas de formación
                    disponibles en el centro.
                    Registre nuevos programas, consulte la información existente y gestione la asignación de
                    instructores responsables para cada programa formativo.
                </p>
            </div>

            <!-- Abre el modal para registrar un nuevo programa -->
            <button class="btn-primary" onclick="openModal()">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Nuevo Programa
            </button>

            <!-- Muestra mensajes de éxito, error o validación -->

            <!-- Alerta de éxito (operación completada correctamente) -->
            @if (session('success'))
                <div class="alert-success">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Alerta de error (operación fallida) -->
            @if (session('error'))
                <div class="alert-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="15" y1="9" x2="9" y2="15"></line>
                        <line x1="9" y1="9" x2="15" y2="15"></line>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            <!-- Alerta de errores de validación de formulario -->
            @if ($errors->any())
                <div class="alert-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <div>
                        <strong>Por favor, corrige los siguientes errores:</strong>
                        <ul>
                            <!-- Lista todos los errores de validación -->
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- Tabla de programas - Muestra todos los programas de formación con su información -->
            <div class="table-container">
                <table>

                    <!-- Encabezados de la tabla -->
                    <thead>
                        <tr>
                            <th>Código del Programa</th>
                            <th>Nombre del Programa</th>
                            <th>Versión</th>
                            <th>Nivel</th>
                            <th>Instructor Responsable</th>
                        </tr>
                    </thead>

                    <!-- Cuerpo de la tabla con datos dinámicos -->
                    <tbody>
                        <!-- Directiva forelse: itera sobre los programas
                            Si no hay programas, muestra el bloque empty
                        -->
                        @forelse($programs as $program)
                            <tr>
                                <td><strong>{{ $program->program_code }}</strong></td>
                                <td>{{ $program->name }}</td>
                                <td>{{ $program->program_version }}</td>

                                <!--
                                        Nivel del programa con badge de color
                                        - id_level 1 = Técnico (verde)
                                        - id_level 2 = Tecnólogo (azul)
                                    -->
                                <td>
                                    <span
                                        class="badge {{ $program->id_level == 1 ? 'badge-technical' : 'badge-technologist' }}">
                                        {{ $program->id_level == 1 ? 'Técnico' : 'Tecnólogo' }}
                                    </span>
                                </td>
                                <td>{{ $program->instructor->person->name }}</td>
                            </tr>
                        @empty
                            <!-- Estado vacío cuando no hay programas registrados -->
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="12" y1="8" x2="12" y2="12"></line>
                                            <line x1="12" y1="16" x2="12.01" y2="16">
                                            </line>
                                        </svg>
                                        <p>No hay programas registrados</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- MODAL DE REGISTRO DE PROGRAMA
                Ventana emergente para crear un nuevo programa
                Inicialmente oculto, se muestra con openModal()
            -->
            <div id="programModal" class="modal-overlay">
                <div class="modal-content">

                    <!-- Botón para cerrar el modal (X) -->
                    <button class="close-btn" onclick="closeModal()">&times;</button>
                    <h2>Registrar Nuevo Programa</h2>


                    <!--
                        FORMULARIO DE REGISTRO
                        Envía datos al controlador para crear un nuevo programa
                    -->
                    <form method="POST" action="{{ route('programing.programan_store_add') }}" class="program-form">
                        @csrf

                        <!-- CAMPO 1: Nombre del Programa - Campo de texto requerido -->
                        <div class="form-group">
                            <label for="name">Nombre del Programa</label>
                            <input type="text" name="name" id="name" required
                                placeholder="Ingrese el nombre del programa">
                        </div>

                        <!-- CAMPO 2: Código del Programa - Identificador único del programa (ej: PROG-001) -->
                        <div class="form-group">
                            <label for="program_code">Código del Programa</label>
                            <input type="text" name="program_code" id="program_code" required
                                placeholder="Ej: PROG-001">
                        </div>

                        <!-- CAMPO 3: Versión del Programa - Número de versión (ej: 1.0, 2.0) -->
                        <div class="form-group">
                            <label for="program_version">Versión del Programa</label>
                            <input type="text" name="program_version" id="program_version" required
                                placeholder="Ej: 1.0">
                        </div>

                        <!-- CAMPO 4: Nivel del Programa
                            Select con opciones de nivel (Técnico/Tecnólogo)
                            Datos dinámicos desde $programan_level -->
                        <div class="form-group">
                            <label for="id_level">Nivel del Programa</label>
                            <select name="id_level" id="id_level" required>
                                <option value="">Seleccione el nivel</option>
                                @foreach ($programan_level as $level)
                                    <option value="{{ $level->id }}">{{ $level->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- CAMPO 5: Instructor Responsable
                            Select con lista de instructores disponibles
                            Datos dinámicos desde $instructors
                            Muestra el nombre mediante relación instructor->person->name -->
                        <div class="form-group">
                            <label for="instructor_id">Instructor Responsable</label>
                            <select name="instructor_id" id="instructor_id" required>
                                <option value="">Seleccione el instructor</option>
                                @foreach ($instructors as $instru)
                                    <option value="{{ $instru->id }}">{{ $instru->person->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!--  BOTONES DE ACCIÓN DEL FORMULARIO
                            - Cancelar: cierra el modal sin guardar
                            - Registrar: envía el formulario
                        -->
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

    <!--
        ========================================
        JAVASCRIPT - FUNCIONALIDAD DEL MODAL
        ========================================
    -->
    <script>
        /**
         * Abre el modal de registro de programa
         * - Muestra el modal con display: flex
         * - Previene scroll del body mientras el modal está abierto
        */
        function openModal() {
            document.getElementById('programModal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        /**
         * Cierra el modal de registro
         * - Oculta el modal
         * - Restaura el scroll del body
        */
        function closeModal() {
            document.getElementById('programModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        /**
         * Cierra el modal al hacer clic fuera de él
         * Escucha clics en toda la ventana
         * Si el clic es en el overlay (fondo oscuro), cierra el modal
        */
        window.onclick = function (event) {
            const modal = document.getElementById('programModal');
            if (event.target === modal) {
                closeModal();
            }
        }

        /**
         * Cierra el modal con la tecla Escape
         * Mejora la experiencia del usuario
         */
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });

        // Auto-focus en el primer campo al abrir el modal NO FUNCIONA!!!!!!!!!
        document.getElementById('programModal').addEventListener('shown', function () {
            document.getElementById('name').focus();
        });
    </script>
</x-layout>