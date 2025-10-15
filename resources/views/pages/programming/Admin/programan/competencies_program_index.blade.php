<x-layout>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Dashboard - Sistema SENA</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
        <link rel="stylesheet" href="{{ asset('css/pages/competencies_program_index.css') }}">
    </head>

    <body>
        <!-- Contenido principal - DASHBOARD -->
        <main class="content flex" id="main-content">

            <div class="left-content">
                <div class="dashboard">
                    <div class="contenedor-cards">
                        <div class="texto">
                            <p>📑Resumen General</p>
                            <p class="small-text">Indicadores clave sobre personas, programaciones e instructores
                                activosv
                            </p>
                        </div>
                        <!-- Estadísticas -->
                        <div class="stats-grid">

                            <div class="stat-card">
                                <div class="card-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="stat-value">{{ $personas->count() }}</div>
                                    <div class="stat-label">Total de Personas</div>
                                    <span class="stat-trend">
                                        <i class="fas fa-plus"></i>
                                        12 este mes
                                    </span>
                                    <div class="card-wave"></div>
                                </div>
                            </div>

                            <div class="stat-card border-orange">
                                <div class="card-icon orange-icon-container">
                                    <i class="fas fa-calendar-check orange-icon"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="stat-value">{{ $programaciones->count() }}</div>
                                    <div class="stat-label">Programaciones Activas</div>
                                    <span class="stat-trend orange-trend">
                                        <i class="fa-solid fa-plus"></i>
                                        3 esta semana
                                    </span>
                                    <div class="card-wave orange"></div>
                                </div>
                            </div>

                            <div class="stat-card border-green">
                                <div class="card-icon green-icon-container">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="stat-value">{{ $instructores->count() }}</div>
                                    <div class="stat-label">Instructores Activos</div>
                                    <span class="stat-trend green-trend">
                                        <i class="fa-solid fa-plus"></i>
                                        2 este mes
                                    </span>
                                    <div class="card-wave green-wave"></div>
                                </div>
                            </div>

                            <div class="stat-card red-border">
                                <div class="card-icon red-icon-container">
                                    <i class="fas fa-tasks"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="stat-value">{{ $programacionesSinRegistrar ?? 0 }}</div>
                                    <div class="stat-label">Pendientes por Registrar</div>
                                    <span class="stat-trend red-trend">
                                        <i class="fa-solid fa-triangle-exclamation"></i>
                                        Urgente
                                    </span>
                                    <div class="card-wave red"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Gráficos y programaciones recientes -->
                    {{-- <div class="dashboard-grid">
                <div class="chart-container">
                    <div class="chart-header">
                        <h2>Programaciones por Estado</h2>
                        <a href="#" class="view-all">Ver reporte completo</a>
                    </div>
                    <div class="chart-placeholder">
                        <i class="fas fa-chart-pie" style="font-size: 24px; margin-right: 10px;"></i>
                        Gráfico de programaciones por estado
                    </div>
                </div>

                <div class="recent-container">
                    <div class="recent-header">
                        <h2>Programaciones Recientes</h2>
                        <a href="#" class="view-all">Ver todas</a>
                    </div>
                    <table class="recent-table">
                        <thead>
                            <tr>
                                <th>Programación</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>ADSO-2023-01</td>
                                <td>15/08/2023</td>
                                <td><span class="status-badge status-completed">Completada</span></td>
                            </tr>
                            <tr>
                                <td>ADSI-2023-02</td>
                                <td>18/08/2023</td>
                                <td><span class="status-badge status-pending">Pendiente</span></td>
                            </tr>
                            <tr>
                                <td>ADSO-2023-03</td>
                                <td>20/08/2023</td>
                                <td><span class="status-badge status-completed">Completada</span></td>
                            </tr>
                            <tr>
                                <td>ADSI-2023-04</td>
                                <td>22/08/2023</td>
                                <td><span class="status-badge status-delayed">Atrasada</span></td>
                            </tr>
                            <tr>
                                <td>ADSO-2023-05</td>
                                <td>25/08/2023</td>
                                <td><span class="status-badge status-pending">Pendiente</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div> --}}

                    <!-- Acciones rápidas -->
                    <div class="quick-actions">
                        <div class="texto">
                            <p>⚡Acciones Rápidas</p>
                            <p class="small-text">Monitorea el avance de registros, programaciones e instructores este
                                mes</p>
                        </div>
                        <div class="action-grid">
                            <a href="{{ route('programming.register_programming_instructor_index') }}"
                                class="action-btn">
                                <div class="action-icon">
                                    <i class="fas fa-calendar-plus"></i>
                                </div>
                                <div class="action-label">Nueva Programación</div>
                            </a>

                            <a href="{{ route('entrance.people.create') }}" class="action-btn">
                                <div class="action-icon">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <div class="action-label">Registrar Aprendiz</div>
                            </a>

                            <a href="{{ route('programing.instructor_programan_index') }}        " class="action-btn">
                                <div class="action-icon">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                </div>
                                <div class="action-label">Gestionar Instructor</div>
                            </a>

                            <a href="#" class="action-btn">
                                <div class="action-icon">
                                    <i class="fas fa-clipboard-list"></i>
                                </div>
                                <div class="action-label">Reportes</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="right-content">
                <div class="task-list">
                    <div class="banner-new">
                        
                    </div>
                </div>

            </div>
        </main>

    </body>

    </html>
</x-layout>
