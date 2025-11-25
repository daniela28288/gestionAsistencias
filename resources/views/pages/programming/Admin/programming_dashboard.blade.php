<x-layout>
    <x-slot:page_style>css/pages/programming_dashboard.css</x-slot:page_style>
    <x-slot:title>Gestión de Programas</x-slot:title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/pages/programming_dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/competencies_program_index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/programming_cohort.css') }}">
    <!-- SELECT2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <div class="content">
        <div class="container">

            <div class="container recuadro">
                <div class="container-titulos">
                    <div class="titulo">
                        <!-- <img src="{{ asset('icons/icon-title-book.png') }}" alt=""> -->
                        <h3>🗂️ Datos del programa</h3>
                    </div>
                </div>

                <form action="">
                    <div class="contenedor-padding">
                        <div class="row">

                    <!-- Ficha -->
                    <div class="campo">
                        <label>Ficha y Programa</label>
                        <select id="ficha" name="id_program" required class="large-input select2-custom">
                            <option value="" disabled selected>Seleccione</option>
                            @foreach ($cohorts as $ficha)
                                <option value="{{ $ficha->id }}">
                                    {{ $ficha->number_cohort }} - {{ $ficha->program->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Código programa -->
                    <div class="campo">
                        <label>Código Programa</label>
                        <input type="text" placeholder="Ej: 234567">
                    </div>

                    <!-- Matrícula -->
                    <div class="campo">
                        <label>Matricula</label>
                        <input type="text" placeholder="24" oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                    </div>

                    <!-- Versión -->
                    <div class="campo">
                        <label>Versión</label>
                        <input type="text" placeholder="1" oninput="this.value = this.value.replace(/[^0-9]/g,'')">
                    </div>

                </div>

                <div class="row">

                    <!-- Instructor -->
                    <div class="campo">
                        <label>Instructor</label>
                        <select id="instructores" name="instructor_id" required class="medium-input">
                            <option value="" disabled selected>Seleccione un instructor</option>
                            @foreach ($instructors as $instructor)
                                <option value="{{ $instructor->id }}">{{ $instructor->person->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Nivel -->
                    <div class="campo">
                        <label>Nivel</label>
                        <select name="level_id" class="select-nivel" required>
                            <option value="" disabled selected>Nivel del programa</option>
                            @foreach ($level_program as $level)
                                <option value="{{ $level->id }}">{{ $level->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Municipio -->
                    <div class="campo">
                        <label>Municipio</label>
                        <select id="towns" name="municipio_id" class="municipio" required>
                            <option value="" disabled selected>Seleccione un municipio</option>
                            @foreach ($towns as $town)
                                <option value="{{ $town->id }}">{{ $town->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Jornada -->
                    <div class="campo">
                        <label>Jornada</label>
                        <select name="jornada_id" class="jornada" required>
                            <option value="" disabled selected>Seleccione jornada</option>
                            @foreach ($cohortimes as $tms)
                                <option value="{{ $tms->id }}">{{ $tms->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                        <div class="row">

                    <div class="campo">
                        <label>Fecha inicio</label>
                        <input type="date">
                    </div>

                    <div class="campo">
                        <label>Fecha fin</label>
                        <input type="date">
                    </div>

                    <div class="campo">
                        <label>Número de ficha</label>
                        <input type="text" placeholder="Ingrese número de ficha"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    </div>

                    <div class="campo">
                        <label>Lugar</label>
                        <input type="text" placeholder="Ingrese lugar">
                    </div>

                        </div>
                    </div>
            </div>

            <br>

            <!-- ===========================
                 HORARIO
            ============================ -->
            <div class="container recuadro">

                <div class="container-titulos">
                    <div class="titulo">
                        <!-- <img src="{{ asset('icons/hora.png') }}" alt=""> -->
                        <h3>📅 Horario y fechas</h3>
                    </div>
                </div>

                <div class="contenedor-padding">
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
                            <button class="dia" type="button">
                                <input type="checkbox" name="" class="check" style="display: none;">
                                Martes

                            </button>
                            <button class="dia" type="button">
                                <input type="checkbox" name="" class="check" style="display: none;">
                                Miercoles

                            </button>
                            <button class="dia" type="button">
                                <input type="checkbox" name="" class="check" style="display: none;">
                                Jueves

                            </button>
                            <button class="dia" type="button">
                                <input type="checkbox" name="" class="check" style="display: none;">
                                Viernes

                            </button>
                            <button class="dia" type="button">
                                <input type="checkbox" name="" class="check" style="display: none;">
                                Sábado

                            </button>
                            <button class="dia" type="button">
                                <input type="checkbox" name="" class="check" style="display: none;">
                                Domingo

                            </button>
                        </div>
                    </div>

                <div class="contenedor-separado">

                    <div class="contenedor-gris filas">

                        <div class="campo">
                            <label>Ambiente</label>
                            <select id="classRoom" name="ambiente_id" class="ambiente" required>
                                <option value="" disabled selected>Seleccione un Ambiente</option>
                                @foreach ($ambientes as $ambiente)
                                    <option value="{{ $ambiente->id }}">
                                        {{ $ambiente->Block->name }} - {{ $ambiente->name }} - {{ $ambiente->towns->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="campo">
                            <label>Horario</label>
                            <div class="rango-horas">
                                <input type="time">
                                <p>a</p>
                                <input type="time">
                            </div>
                        </div>

                        <div class="campo">
                            <label>Horas diarias</label>
                            <input type="text" disabled>
                        </div>

                        <div class="campo">
                            <label>Total de horas</label>
                            <input type="text" disabled>
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
                </div>
                </form>
            </div>

            <!-- ===========================
                 ALERTAS
            ============================ -->
            @if (session('success'))
                <div class="alert-success">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if (session('error'))
                <div class="alert-danger">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert-danger">
                    <strong>Por favor, corrige los siguientes errores:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
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


            <!-- ===========================
                 TABLA DE PROGRAMAS
            ============================ -->
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
                                <td colspan="5" class="empty-state">
                                    <p>No hay programas registrados</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- ===========================
         JAVASCRIPT
    ============================ -->
    <script src="{{ asset('js/programing/programmingLogic.js') }}"></script>

</x-layout>