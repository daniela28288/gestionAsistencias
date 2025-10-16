<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title ?? 'Sistema SENA' }}</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/components/buttons.css') }}" /> --}}
    {{-- llamada de icoconos para el menu --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/pages/competencies_program_index.css') }}">
</head>

<body>

    <!-- Layout -->
    <div class="main-layout">
        <!-- Sidebar -->
        <nav class="sidebar" aria-label="Menú lateral" id="sidebar">
            <div class="sidebar-toggle" id="sidebar-toggle">
                <img src="../icons/flecha-left.png" alt="">
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
                            <img src="../icons/flecha-abajo.png" alt="" class="icon-sidebar">
                            <img src="../icons/flecharriba.png" alt="" class="hidden" style="display: none;">
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
                            <img src="../icons/flecha-abajo.png" alt="" class="icon-sidebar">
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
                            <img src="../icons/flecha-abajo.png" alt="" class="icon-sidebar">
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
            <li class="{{ Route::is('programing.competencies_index', 'programing.competencies_index_program') ? 'open' : '' }}">
                <a class="menu-toggle {{ Route::is('programing.competencies_index', 'programing.competencies_index_program') ? 'active' : '' }}">
                    <i class="fas fa-cubes menu-icon"></i>
                    <span class="menu-text">Competencias</span>
                </a>
                <ul class="{{ Route::is('programing.competencies_index', 'programing.competencies_index_program') ? 'show' : '' }}">
                    <li><a href="{{ route('programing.competencies_index') }}" class="{{ Route::is('programing.competencies_index') ? 'active-link' : '' }}"><i class="fas fa-check-square menu-icon"></i> <span class="submenu-text">Gestión de Competencias</span></a></li>
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
                            <img src="../icons/flecha-abajo.png" alt="" class="icon-sidebar">
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
                            <img src="../icons/flecha-abajo.png" alt="" class="icon-sidebar">
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
                            <img src="../icons/flecha-abajo.png" alt="" class="icon-sidebar">
                        </div>
                    </a>
                    <ul class="{{ Route::is('entrance.people.index', 'entrance.people.create') ? 'show' : '' }}">
                        <li><a href="{{ route('entrance.people.index') }}"
                                class="{{ Route::is('entrance.people.index') ? 'active-link' : '' }}"><i
                                    class="fas fa-id-card menu-icon"></i> <span
                                    class="submenu-text">Personas</span></a></li>
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
                            <img src="../icons/flecha-abajo.png" alt="" class="icon-sidebar">
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
                        <img src="../icons/logoutblanco.png" alt="">
                        <span class="lgout">Cerrar sesión</span>
                    </button>
                </form>
            @endauth

        </nav>

        <!-- Contenido principal -->
        <main class="content" id="main-content">
            <header class="header">

                <div class="dashboard-header">
                    <h1 class="title-dash">Panel de Control</h1>
                    <p>Bienvenido al sistema de gestión del Centro Agroempresarial y Acuícola</p>
                </div>

                <div class="header-actions">

                    <!-- Notificaciones -->
                    <div class="notifications-container">
                        <div class="notifications-dropdown">
                            <button class="notification-bell" id="notificationBell">
                                <i class="fa-solid fa-bell"></i>
                                @if ($totalNotificaciones > 0)
                                    <span class="notification-counter">{{ $totalNotificaciones }}</span>
                                @endif
                            </button>

                            <div class="notifications-panel" id="notificationsPanel">
                                <div class="notifications-header">
                                    <h3>Notificaciones</h3>
                                    <button class="mark-all-read" id="markAllRead">Marcar todo como leído</button>
                                </div>

                                <div class="notifications-list">
                                    @if ($programacionesSinRegistrar > 0)
                                        <div class="notification-item urgent">
                                            <div class="notification-icon">
                                                <a href="{{ route('programming.programming_update_index') }}"><i
                                                        class="fa-solid fa-calendar-xmark"></i></a>
                                            </div>
                                            <div class="notification-content">
                                                <p class="notification-title">Pendientes sin Registrar</p>
                                                <p class="notification-message">
                                                    Tienes <strong>{{ $programacionesSinRegistrar }}</strong>
                                                    programación(es) sin registrar
                                                </p>
                                                <span class="notification-time">Acción requerida</span>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- NUEVA CATEGORÍA: Programaciones que YA deberían haber finalizado hoy -->
                                    @if ($programacionesPendientesHoy > 0)
                                        <div class="notification-item urgent">
                                            <div class="notification-icon">
                                                <a href="#"><i class="fa-solid fa-exclamation-triangle"></i></a>
                                            </div>
                                            <div class="notification-content">
                                                <p class="notification-title">Finalizaciones pendientes</p>
                                                <p class="notification-message">
                                                    <strong>{{ $programacionesPendientesHoy }}</strong>
                                                    programación(es) deberían haber finalizado hoy
                                                </p>
                                                <span class="notification-time">Revisión urgente</span>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($programacionesFinalizanHoy > 0)
                                        <div class="notification-item warning">
                                            <div class="notification-icon">
                                                <i class="fa-solid fa-clock"></i>
                                            </div>
                                            <div class="notification-content">
                                                <p class="notification-title">Finalizan hoy</p>
                                                <p class="notification-message">
                                                    <strong>{{ $programacionesFinalizanHoy }}</strong> programación(es)
                                                    finalizan hoy
                                                </p>
                                                <span class="notification-time">Por finalizar</span>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- NUEVA CATEGORÍA: Programaciones en curso -->
                                    @if ($programacionesEnCurso > 0)
                                        <div class="notification-item info">
                                            <div class="notification-icon">
                                                <i class="fa-solid fa-play-circle"></i>
                                            </div>
                                            <div class="notification-content">
                                                <p class="notification-title">En curso</p>
                                                <p class="notification-message">
                                                    <strong>{{ $programacionesEnCurso }}</strong> programación(es)
                                                    activas actualmente
                                                </p>
                                                <span class="notification-time">En progreso</span>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($programacionesProximas > 0)
                                        <div class="notification-item info">
                                            <div class="notification-icon">
                                                <i class="fa-solid fa-hourglass-half"></i>
                                            </div>
                                            <div class="notification-content">
                                                <p class="notification-title">Próximas a finalizar</p>
                                                <p class="notification-message">
                                                    <strong>{{ $programacionesProximas }}</strong> programación(es)
                                                    finalizan en los próximos 3 días
                                                </p>
                                                <span class="notification-time">Próximamente</span>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($programacionesFinalizadas > 0)
                                        <div class="notification-item success">
                                            <div class="notification-icon">
                                                <i class="fa-solid fa-calendar-check"></i>
                                            </div>
                                            <div class="notification-content">
                                                <p class="notification-title">Programaciones finalizadas</p>
                                                <p class="notification-message">
                                                    <strong>{{ $programacionesFinalizadas }}</strong> programación(es)
                                                    finalizada(s) recientemente
                                                </p>
                                                <span class="notification-time">Últimos 7 días</span>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($totalNotificaciones === 0)
                                        <div class="notification-empty">
                                            <i class="fa-solid fa-bell-slash"></i>
                                            <p>No hay notificaciones nuevas</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Apartado de usuario -->
                    <div class="usuario-info" title="{{ Auth::user()->user_name ?? 'Invitado' }}">
                        <span>
                            <p>{{ Auth::user()->user_name ?? 'Invitado' }}</p>
                        </span>
                        <i class="fa-solid fa-user-circle user"></i>
                    </div>
                </div>

            </header>

            {{ $slot }}
        </main>
    </div>

    <!-- JS: Menú toggle mejorado -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const arrow = document.querySelector('.icon-sidebar');
            const arrowTop = document.querySelector('.hidden');
            const mainContent = document.getElementById('main-content');
            const notificationBell = document.getElementById('notificationBell');
            const notificationsPanel = document.getElementById('notificationsPanel');
            const markAllRead = document.getElementById('markAllRead');

            // Función para alternar el menú lateral
            sidebarToggle.addEventListener('click', function() {
                if (window.innerWidth > 768) {
                    sidebar.classList.toggle('collapsed');
                    mainContent.classList.toggle('expanded');

                } else {
                    sidebar.classList.toggle('active');
                }
            });

            // Cerrar submenús al hacer clic fuera en móviles
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 768 &&
                    sidebar.classList.contains('active') &&
                    !sidebar.contains(event.target) &&
                    !sidebarToggle.contains(event.target)) {
                    sidebar.classList.remove('active');
                }
            });

            // Manejo de submenús
            document.querySelectorAll('.menu-toggle').forEach(menu => {
                menu.addEventListener('click', function(e) {
                    if (window.innerWidth <= 768) {
                        e.stopPropagation();
                    }

                    const submenu = this.nextElementSibling;

                    document.querySelectorAll('.sidebar-menu ul').forEach(ul => {
                        if (ul !== submenu) {
                            ul.classList.remove('show');
                            if (ul.previousElementSibling) {
                                ul.previousElementSibling.classList.remove('active');
                            }
                        }
                    });

                    submenu.classList.toggle('show');
                    this.classList.toggle('active');
                });

            });


            // Notificaciones
            notificationBell.addEventListener('click', function(e) {
                e.stopPropagation();
                notificationsPanel.classList.toggle('show');
                notificationBell.classList.remove('alert');
            });

            document.addEventListener('click', function() {
                notificationsPanel.classList.remove('show');
            });

            notificationsPanel.addEventListener('click', function(e) {
                e.stopPropagation();
            });

            markAllRead.addEventListener('click', function() {
                notificationBell.querySelector('.notification-counter')?.remove();
                notificationsPanel.classList.remove('show');
                alert('Todas las notificaciones han sido marcadas como leídas');
            });

            // Animación de alerta si hay notificaciones urgentes
            const urgentNotifications = document.querySelectorAll('.notification-item.urgent');
            if (urgentNotifications.length > 0) {
                notificationBell.classList.add('alert');
            }

            // Ajustar layout inicial
            function adjustLayout() {
                if (window.innerWidth <= 768) {
                    sidebar.classList.remove('collapsed');
                    mainContent.classList.remove('expanded');
                }
            }

            window.addEventListener('resize', adjustLayout);
            adjustLayout();
        });
    </script>


</body>

</html>
