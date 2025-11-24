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

            <div class="container recuadro">
                <div class="container-titulos">
                    <div class="titulo">
                        <img src="{{ asset('icons/icon-title-book.png') }}" alt="">
                        <h3>Datos del programa</h3>
                    </div>
                </div>

                <div class="row">

                    <div class="campo">
                        <label for="ficha">Ficha y Programa</label>
                        <select id="ficha" name="id_program" required class="large-input select2-custom">
                            <option value="" disabled selected>Seleccione</option>
                            @foreach ($cohorts as $ficha)
                                <option value="{{ $ficha->id }}">
                                    {{ $ficha->number_cohort }} - {{ $ficha->program->name }}
                                </option>
                            @endforeach
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
                        <select id="instructores" name="instructor_id" required class="medium-input">
                            <option value="" disabled selected>Seleccione un instructor</option>
                            @foreach ($instructors as $instructor)
                                <option value="{{ $instructor->id }}"> {{ $instructor->person->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="campo">
                        <label for="">Nivel</label>
                        <select name="level_id" class="select-nivel" required>
                            <option value="" disabled selected>Nivel del programa</option>
                            @foreach ($level_program as $level)
                                <option value="{{ $level->id }}">
                                    {{ $level->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="campo">
                        <label for="ficha">Municipio</label>
                        <select id="towns" name="municipio_id" class="municipio" required>
                            <option value="" disabled selected>Seleccione un municipio</option>
                            @foreach ($towns as $town)
                                <option value="{{ $town->id }}">
                                    {{ $town->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="campo">
                        <label>Jornada</label>
                        <select name="jornada_id" class="jornada" required>
                            <option value="" disabled selected>Seleccione jornada</option>
                            @foreach ($cohortimes as $tms)
                                <option value="{{ $tms->id }}" @if (old('id_time') == $tms->id) selected @endif>
                                    {{ $tms->name }}
                                </option>
                            @endforeach
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

            <div class="container recuadro">

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
                            <select id="classRoom" name="ambiente_id" class="ambiente" required>
                                <option value="" disabled selected>Seleccione un Ambiente</option>
                                @foreach ($ambientes as $ambiente)
                                    <option value="{{ $ambiente->id }}">
                                        {{ $ambiente->Block->name}} - {{ $ambiente->name }} - {{ $ambiente->towns->name }}
                                    </option>
                                @endforeach
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

                    <div class="contenedor-gris filas centrado">

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
                            <p>Guardar programación</p>
                        </button>
                    </div>
                </div>
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
            boton.addEventListener('click', function (e) {

                // Si se clickea el checkbox directamente, ignoramos
                if (e.target.tagName === 'INPUT') return;

                const checkbox = boton.querySelector('.check'); // solo el check de este botón
                checkbox.checked = !checkbox.checked; // alterna

                // Cambiar color y mostrar nombre del día
                if (checkbox.checked) {
                    const dia = boton.textContent;
                    boton.style.backgroundColor = '#236b15c4';
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

        document.addEventListener('DOMContentLoaded', function () {
            // Inicializa Select2 solo en el select de ficha y programas
            $('#ficha').select2({
                placeholder: 'Seleccione o busque un programa',
                allowClear: true,
                width: 'resolve'
            });

            $('#instructores').select2({
                placeholder: 'Seleccione o busque un instructor',
                allowClear: true,
                width: 'resolve'
            });

            $('#towns').select2({
                placeholder: "Seleccione o busque un municipio",
                allowClear: true,
                with: 'resolve'
            });

            $('#classRoom').select2({
                placeholder: 'Seleccione o busque un ambiente',
                allowClear: true,
                width: 'resolve'
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

        window.onclick = function (event) {
            const modal = document.getElementById('programModal');
            if (event.target === modal) closeModal();
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') closeModal();
        });
    </script>

</x-layout>