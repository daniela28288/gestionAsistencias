<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Header</title>

    <link rel="stylesheet" href="{{ asset('css/components/header.css') }}">
</head>

<body>
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
</body>

</html>
