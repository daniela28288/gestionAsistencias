<x-layout>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard - Sistema SENA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/pages/competencies_program_index.blade.css')}}">
</head>
<body>

    <!-- Contenido principal - DASHBOARD -->
    <main class="content" id="main-content">
        <div class="dashboard">
            <div class="dashboard-header">
                <h1>Panel de Control</h1>
                <p>Bienvenido al sistema de gestión del Centro Agroempresarial y Acuícola</p>
            </div>

            <!-- Estadísticas -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value">{{$personas->count()}}</div>
                        <div class="stat-label">Total de Personas</div>
                        <span class="stat-trend">+12 este mes</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value">{{$programaciones->count()}}</div>
                        <div class="stat-label">Programaciones Activas</div>
                        <span class="stat-trend">+3 esta semana</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value">{{$instructores->count()}}</div>
                        <div class="stat-label">Instructores Activos</div>
                        <span class="stat-trend">+2 este mes</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value">{{ $programacionesSinRegistrar ?? 0 }}</div>
                        <div class="stat-label">Pendientes por Registrar</div>
                        <span class="stat-trend" style="background: rgba(220, 53, 69, 0.15); color: #dc3545;">Urgente</span>
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
                <h2>Acciones Rápidas</h2>
                <div class="action-grid">
                    <a href="{{ route('programming.register_programming_instructor_index') }}" class="action-btn">
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
    </main>
</div>


</body>
</html>
</x-layout>
