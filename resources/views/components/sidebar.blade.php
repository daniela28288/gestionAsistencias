<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title ?? 'Sistema SENA' }}</title>
    <link rel="stylesheet" href="{{ asset('css/components/buttons.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    {{-- llamada de icoconos para el menu --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/components/sidebar.css') }}">
</head>

<body>

    <!-- Sidebar -->
    <nav class="sidebar" aria-label="Menú lateral" id="sidebar">
        <div class="sidebar-toggle" id="sidebar-toggle">
            <img src="{{ asset('icons/flecha-left.png')}}" alt="">
        </div>
        <ul class="sidebar-menu">

            <div class="logo">
                <div class="contenedor-verde-logo">
                    <img src="{{ asset('../img/logosena.png') }}" alt="Logo Sena" class="logo-header" />
                </div>
                <p class="texto-header">Centro Agroempresarial y Acuícola</p>
            </div>

            <!-- INICIO -->
            <li
                class="{{ Route::is('programing.admin_inicio', 'programing.competencies_program_index') ? 'open' : '' }}">
                <a
                    class="menu-toggle {{ Route::is('programing.admin_inicio', 'programing.competencies_program_index') ? 'active' : '' }}">
                    <div class="left">
                        <i class="fas fa-home menu-icon"></i>
                        <span class="menu-text">Inicio</span>
                    </div>
                    <div class="icon">
                        <img src="{{asset('icons/flecha-abajo.png')}}" alt="" class="icon-sidebar">
                        <!-- <img src="../icons/flecharriba.png" alt="" class="hidden" style="display: none;"> -->
                    </div>
                </a>
                <ul
                    class="{{ Route::is('programing.admin_inicio', 'programing.competencies_program_index') ? 'show' : '' }}">
                    <li><a href="{{ route('programing.admin_inicio') }}"
                            class="{{ Route::is('programing.admin_inicio') ? 'active-link' : '' }}"><i
                                class="fas fa-chart-line menu-icon"></i> <span class="submenu-text">Dashboard -
                                Sistema SENA</span></a></li>
                    <li><a href="{{ route('programing.competencies_program_index') }}"
                            class="{{ Route::is('programing.competencies_program_index') ? 'active-link' : '' }}"><i
                                class="fas fa-clipboard-list menu-icon"></i> <span class="submenu-text">Gestión de
                                Programas</span></a></li>
                </ul>
            </li>
            <!-- FICHAS -->
            <li
                class="{{ Route::is('programing.cohort_index', 'programing.list_apprentices', 'programing.add_apprentices_cohorts') ? 'open' : '' }}">
                <a
                    class="menu-toggle {{ Route::is('programing.cohort_index', 'programing.list_apprentices', 'programing.add_apprentices_cohorts') ? 'active' : '' }}">
                    <div class="left">
                        <i class="fas fa-folder-open menu-icon"></i>
                        <span class="menu-text">Fichas</span>
                    </div>
                    <div class="icon">
                        <img src="{{asset('icons/flecha-abajo.png')}}" alt="" class="icon-sidebar">
                    </div>
                </a>
                <ul
                    class="{{ Route::is('programing.cohort_index', 'programing.list_apprentices', 'programing.add_apprentices_cohorts') ? 'show' : '' }}">
                    <li>
                        <a href="{{ route('programing.cohort_index') }}"
                            class="{{ Route::is('programing.cohort_index') ? 'active-link' : '' }}">
                            <i class="fas fa-file-alt menu-icon"></i>
                            <span class="submenu-text">Gestión de Fichas</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('programing.list_apprentices') }}"
                            class="{{ Route::is('programing.list_apprentices') ? 'active-link' : '' }}">
                            <i class="fas fa-address-card menu-icon"></i>
                            <span class="submenu-text">Gestión de Aprendices</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('programing.add_apprentices_cohorts') }}"
                            class="{{ Route::is('programing.add_apprentices_cohorts') ? 'active-link' : '' }}">
                            <i class="fas fa-user-check menu-icon"></i>
                            <span class="submenu-text">Agregar Aprendiz</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- PROGRAMACIÓN ACADÉMICA -->
            <li
                class="{{ Route::is('programming.programming_index_states', 'programmig.*', 'programming.register_programming_instructor_index', 'programming.programming_update_index', 'programing.unrecorded_days_index') ? 'open' : '' }}">
                <a
                    class="menu-toggle {{ Route::is('programming.programming_index_states', 'programmig.*', 'programming.register_programming_instructor_index', 'programming.programming_update_index', 'programing.unrecorded_days_index') ? 'active' : '' }}">
                    <div class="left">
                        <i class="fas fa-calendar-alt menu-icon"></i>
                        <span class="menu-text">Programación</span>
                    </div>
                    <div class="icon">
                        <img src="{{asset('icons/flecha-abajo.png')}}" alt="" class="icon-sidebar">
                    </div>
                </a>
                <ul
                    class="{{ Route::is('programming.*', 'programmig.*', 'programing.unrecorded_days_index') ? 'show' : '' }}">
                    <li><a href="{{ route('programming.register_programming_instructor_index') }}"
                            class="{{ Route::is('programming.register_programming_instructor_index') ? 'active-link' : '' }}"><i
                                class="fas fa-calendar-plus menu-icon"></i> <span class="submenu-text">Programar
                                Curso</span></a></li>
                    <li><a href="{{ route('programmig.programaciones_index') }}"
                            class="{{ Route::is('programmig.programaciones_index') ? 'active-link' : '' }}"><i
                                class="fas fa-list-ul menu-icon"></i> <span class="submenu-text">Ver
                                Programaciones</span></a></li>
                    <li><a href="{{ route('programming.programming_index_states') }}"
                            class="{{ Route::is('programming.programming_index_states') ? 'active-link' : '' }}"><i
                                class="fas fa-tasks menu-icon"></i> <span class="submenu-text">Estado de
                                Competencias</span></a></li>
                    <li>
                        <a href="{{ route('programming.programming_update_index') }}"
                            class="{{ Route::is('programming.programming_update_index') ? 'active-link' : '' }}">
                            <i class="fas fa-check-circle menu-icon"></i>
                            <span class="submenu-text">Marcar como registrada</span>
                        </a>
                    </li>

                    <li><a href="{{ route('programing.unrecorded_days_index') }}"
                            class="{{ Route::is('programing.unrecorded_days_index') ? 'active-link' : '' }}"><i
                                class="fas fa-calendar-times menu-icon"></i> <span class="submenu-text">Días No
                                Programados</span></a></li>
                </ul>
            </li>

            {{-- <!-- COMPETENCIAS -->
            <li
                class="{{ Route::is('programing.competencies_index', 'programing.competencies_index_program') ? 'open' : '' }}">
                <a
                    class="menu-toggle {{ Route::is('programing.competencies_index', 'programing.competencies_index_program') ? 'active' : '' }}">
                    <i class="fas fa-cubes menu-icon"></i>
                    <span class="menu-text">Competencias</span>
                </a>
                <ul
                    class="{{ Route::is('programing.competencies_index', 'programing.competencies_index_program') ? 'show' : '' }}">
                    <li><a href="{{ route('programing.competencies_index') }}"
                            class="{{ Route::is('programing.competencies_index') ? 'active-link' : '' }}"><i
                                class="fas fa-check-square menu-icon"></i> <span class="submenu-text">Gestión de
                                Competencias</span></a></li>
                </ul>
            </li> --}}

            <!-- INSTRUCTORES -->
            <li
                class="{{ Route::is('programing.instructor_programan_index', 'programming.programming_instructors_profiles') ? 'open' : '' }}">
                <a
                    class="menu-toggle {{ Route::is('programing.instructor_programan_index', 'programming.programming_instructors_profiles') ? 'active' : '' }}">
                    <div class="left">
                        <i class="fas fa-chalkboard-teacher menu-icon"></i>
                        <span class="menu-text">Instructores</span>
                    </div>
                    <div class="icon">
                        <img src="{{asset('icons/flecha-abajo.png')}}" alt="" class="icon-sidebar">
                    </div>
                </a>
                <ul
                    class="{{ Route::is('programing.instructor_programan_index', 'programming.programming_instructors_profiles') ? 'show' : '' }}">
                    <li><a href="{{ route('programing.instructor_programan_index') }}"
                            class="{{ Route::is('programing.instructor_programan_index') ? 'active-link' : '' }}"><i
                                class="fas fa-user-cog menu-icon"></i> <span class="submenu-text">Gestión de
                                Instructores</span></a></li>
                    <li><a href="{{ route('programing.programming_instructors_profiles') }}"
                            class="{{ Route::is('programming.programing_instructors_profiles') ? 'active-link' : '' }}"><i
                                class="fas fa-user-tag menu-icon"></i> <span class="submenu-text">Vincular
                                Competencias</span></a></li>
                </ul>
            </li>

            <!-- AMBIENTES -->
            <li class="{{ Route::is('ambientes_index') ? 'open' : '' }}">
                <a class="menu-toggle {{ Route::is('ambientes_index') ? 'active' : '' }}">
                    <div class="left">
                        <i class="fas fa-door-open menu-icon"></i>
                        <span class="menu-text">Ambientes</span>
                    </div>
                    <div class="icon">
                        <img src="{{asset('icons/flecha-abajo.png')}}" alt="" class="icon-sidebar">
                    </div>
                </a>
                <ul class="{{ Route::is('ambientes_index') ? 'show' : '' }}">
                    <li><a href="{{ route('ambientes_index') }}"
                            class="{{ Route::is('ambientes_index') ? 'active-link' : '' }}"><i
                                class="fas fa-warehouse menu-icon"></i> <span class="submenu-text">Gestión de
                                Ambientes</span></a></li>
                </ul>
            </li>

            <!-- GESTIÓN DE PERSONAS -->
            <li class="{{ Route::is('entrance.people.index', 'entrance.people.create') ? 'open' : '' }}">
                <a
                    class="menu-toggle {{ Route::is('entrance.people.index', 'entrance.people.create') ? 'active' : '' }}">
                    <div class="left">
                        <i class="fas fa-users menu-icon"></i>
                        <span class="menu-text">Gestión de Personas</span>
                    </div>
                    <div class="icon">
                        <img src="{{asset('icons/flecha-abajo.png')}}" alt="" class="icon-sidebar">
                    </div>
                </a>
                <ul class="{{ Route::is('entrance.people.index', 'entrance.people.create') ? 'show' : '' }}">
                    <li><a href="{{ route('entrance.people.index') }}"
                            class="{{ Route::is('entrance.people.index') ? 'active-link' : '' }}"><i
                                class="fas fa-id-card menu-icon"></i> <span class="submenu-text">Personas</span></a>
                    </li>
                    <li><a href="{{ route('entrance.people.create') }}"
                            class="{{ Route::is('entrance.people.create') ? 'active-link' : '' }}"><i
                                class="fas fa-user-plus menu-icon"></i> <span class="submenu-text">Registro de
                                Personas</span></a></li>
                </ul>
            </li>

            <!-- ASISTENCIA -->
            <li class="{{ Route::is('entrance.assistance.index') ? 'open' : '' }}">
                <a class="menu-toggle {{ Route::is('entrance.assistance.index') ? 'active' : '' }}">
                    <div class="left">
                        <i class="fas fa-calendar-check menu-icon"></i>
                        <span class="menu-text">Asistencia</span>
                    </div>
                    <div class="icon">
                        <img src="{{asset('icons/flecha-abajo.png')}}" alt="" class="icon-sidebar">
                    </div>
                </a>
                <ul class="{{ Route::is('entrance.assistance.index') ? 'show' : '' }}">
                    <li><a href="{{ route('entrance.assistance.index') }}"
                            class="{{ Route::is('entrance.assistance.index') ? 'active-link' : '' }}"><i
                                class="fas fa-check-circle menu-icon"></i> <span class="submenu-text">Control de
                                Asistencia</span></a></li>
                </ul>
            </li>

        </ul>

        @auth
            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="logout-button" title="Cerrar sesión"
                    onclick="return confirm('¿Está seguro que quiere cerrar Sesión?')">
                    <img src="{{ asset('icons/logoutblanco.png')}}" alt="">
                    <span class="lgout">Cerrar sesión</span>
                </button>
            </form>
        @endauth

    </nav>

    <script src="{{ asset('js/sidebar_efectos.js') }}"></script>
</body>

</html>