<x-layout>
    <x-slot:page_style>css/pages/programming_dashboard.css</x-slot:page_style>
    <x-slot:title>Gestión de Programas</x-slot:title>
    <link rel="stylesheet" href="{{ asset('css/pages/programming_dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/competencies_program_index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/programming_cohort.css') }}">
    <!-- CSS de Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- JS de jQuery y Select2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <div class="content">
        <div class="container">

            <div class="container">
                <div class="titulo">
                    <img src="{{ asset('icons/icon-title-book.png') }}" alt="">
                    <h3>Datos del programa</h3>
                </div>

                <form action="">
                    <div class="row">

                        <div class="campo">
                            <label for="ficha">Ficha y Programa</label>
                            <select id="ficha" name="ficha_id" required class="large-input">
                                <option value="">Seleccione</option>
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="campo">
                            <label for="ficha">Cod. Programa</label>
                            <input type="text" placeholder="Ej: 234567">
                        </div>

                        <div class="campo">
                            <label for="ficha">Matricula</label>
                            <input type="text" placeholder="24">
                        </div>

                        <div class="campo">
                            <label for="ficha">Versión</label>
                            <input type="text" placeholder="24">
                        </div>
                    </div>

                    <div class="row">
                        <div class="campo">
                            <label for="">Instructor</label>
                            <select id="" name="" required class="medium-input">
                                <option value="">Buscar instructor</option>
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="campo">
                            <label for="">Nivel</label>
                            <select name="" id="" class="select-nivel">
                                <option value="">Tecnologo</option>
                                <option value="">Tecnico</option>
                            </select>
                        </div>

                        <div class="campo">
                            <label for="ficha">Municipio</label>
                            <select name="" id="" class="municipio">
                                <option value="">Seleccione el municipio</option>
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="campo">
                            <label for="ficha">Jornada</label>
                            <select name="" id="" class="jornada">
                                <option value="">Diurna</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">

                        <div class="campo">
                            <label for="ficha">Fecha inicio</label>
                            <input type="date">
                        </div>

                        <div class="campo">
                            <label for="ficha">Fecha fin</label>
                            <input type="date">
                        </div>

                        <div class="campo">
                            <label for="ficha">Número de ficha</label>
                            <input type="text" placeholder="Ingrese número de ficha">
                        </div>

                        <div class="campo">
                            <label for="ficha">Lugar</label>
                            <input type="text" placeholder="Ingrese lugar">
                        </div>

                    </div>
            </div>

            <br>

            <div class="container">

                <div class="container-titulos">
                    <div class="titulo">
                        <img src="{{ asset('icons/hora.png') }}" alt="">
                        <h3>Horario</h3>
                    </div>
                </div>

                <div class="contenedor-gris">
                    <div class="labels">
                        <label for="">Días de la semana</label>
                        <label for="" id="contador"></label>
                    </div>

                    <div class="week">
                        <button class="dia">
                            <input type="checkbox" name="" class="check" style="display: none;">
                            Lunes

                        </button>
                        <button class="dia">
                            <input type="checkbox" name="" class="check" style="display: none;">
                            Martes

                        </button>
                        <button class="dia">
                            <input type="checkbox" name="" class="check" style="display: none;">
                            Miercoles

                        </button>
                        <button class="dia">
                            <input type="checkbox" name="" class="check" style="display: none;">
                            Jueves

                        </button>
                        <button class="dia">
                            <input type="checkbox" name="" class="check" style="display: none;">
                            Viernes

                        </button>
                        <button class="dia">
                            <input type="checkbox" name="" class="check" style="display: none;">
                            Sábado

                        </button>
                        <button class="dia">
                            <input type="checkbox" name="" class="check" style="display: none;">
                            Domingo

                        </button>
                    </div>
                </div>

                <div class="contenedor-separado">
                    <div class="contenedor-gris filas">
                        <div class="campo">
                            <label for="ficha">Ambiente</label>
                            <select name="" id="" class="ambiente">
                                <option value="">Buscar ambiente</option>
                            </select>
                        </div>

                        <div class="campo">
                            <label for="ficha">Horario</label>

                            <div class="rango-horas">
                                <input type="time">
                                <p>a</p>
                                <input type="time">
                            </div>
                        </div>

                        <div class="campo">
                            <label for="ficha">Horas diarias</label>
                            <input type="text">
                        </div>

                        <div class="campo">
                            <label for="ficha">Total de horas</label>
                            <input type="text">
                        </div>

                    </div>

                    <div class="contenedor-gris filas botones">

                        <button class="result">
                            <p>Actualizar</p>
                        </button>

                        <button class="result">
                            <p>Eliminar</p>
                        </button>

                        <button class="result">
                            <p>Asignar ficha</p>
                        </button>

                        <button class="result">
                            <p>Guardar</p>
                        </button>
                    </div>
                </div>
                </form>
            </div>




            <!-- Abre el modal para registrar un nuevo programa -->
            {{-- <button class="btn-primary" onclick="openModal()">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Nuevo Programa
            </button> --}}

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

            <br>
            <div class="container">
                <div class="row">
                    <div class="campo">
                        <label for="">Buscar programa</label>
                        <select name="" id="" class="programa">
                            <option value="">Seleccione o busque un programa</option>
                        </select>
                    </div>

                    <div class="campo">
                        <label for="">Filtrar por estado</label>
                        <select name="" id="" class="programa">
                            <option value="">Todos los estados</option>
                        </select>
                    </div>


                    <div class="campo">
                        <label for="">Filtrar por número de ficha</label>
                        <select name="" id="" class="programa">
                            <option value="">Número de ficha</option>
                        </select>
                    </div>
                </div>


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
                            <input type="text" name="program_code" id="program_code" required placeholder="Ej: 001209">
                        </div>

                        <!-- CAMPO 3: Versión del Programa - Número de versión (ej: 1.0, 2.0) -->
                        <div class="form-group">
                            <label for="program_version">Versión del Programa</label>
                            <input type="text" name="program_version" id="program_version" required placeholder="Ej: 1">
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
    </div>
    <!--
        ========================================
        JAVASCRIPT - FUNCIONALIDAD DEL MODAL
        ========================================
    -->
    <script>
        const botones = document.querySelectorAll('.dia');
        const label = document.getElementById('contador');
        let cantDay = 0;

        if (cantDay == 0) {
            label.textContent = 'Ningun dia seleccionado';
        }


        botones.forEach(boton => {
            boton.addEventListener('click', function(e) {

                // Si se clickea el checkbox directamente, ignoramos
                if (e.target.tagName === 'INPUT') return;

                const checkbox = boton.querySelector('.check'); // solo el check de este botón
                checkbox.checked = !checkbox.checked; // alterna

                // Cambiar color y mostrar nombre del día
                if (checkbox.checked) {
                    const dia = boton.textContent;
                    boton.style.backgroundColor = '#2c851aa1';
                    boton.style.color = '#ffff';
                    cantDay++;

                    if (cantDay > 1) {
                        label.textContent = cantDay + ' dias seleccionados';
                    } else {
                        label.textContent = cantDay + ' dia seleccionado';
                    }

                    if (cantDay == 0) {
                        label.textContent = 'Ningun dia seleccionado';
                    }


                } else {
                    boton.style.backgroundColor = '';
                    boton.style.color = 'gray';
                    cantDay--;

                    if (cantDay > 1) {
                        label.textContent = cantDay + ' dias seleccionados';
                    } else {
                        label.textContent = cantDay + ' dia seleccionado';
                    }

                    if (cantDay == 0) {
                        label.textContent = 'Ningun dia seleccionado';
                    }

                }

            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Inicializa Select2 solo en el select de instructores
            $('#instructor_id').select2({
                placeholder: 'Seleccione o busque un instructor',
                allowClear: true,
                width: '100%',
                dropdownParent: $('#programModal') // asegura que se muestre bien dentro del modal
            });
        });

        // Reabrir correctamente Select2 cuando el modal se abre
        function openModal() {
            document.getElementById('programModal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
            $('#instructor_id').select2({
                placeholder: 'Seleccione o busque un instructor',
                allowClear: true,
                width: '100%',
                dropdownParent: $('#programModal')
            });
        }

        function closeModal() {
            document.getElementById('programModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('programModal');
            if (event.target === modal) closeModal();
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') closeModal();
        });
    </script>

</x-layout>