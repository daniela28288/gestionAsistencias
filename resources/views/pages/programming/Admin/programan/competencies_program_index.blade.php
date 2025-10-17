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
                            <p>📑 Resumen General</p>
                            <p class="small-text">Indicadores clave sobre personas, programaciones e instructores
                                activos</p>
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
                                </div>
                                <div class="card-wave"></div>
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
                                </div>
                                <div class="card-wave orange"></div>
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
                                </div>
                                <div class="card-wave green-wave"></div>
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
                                </div>
                                <div class="card-wave red"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Acciones rápidas -->
                    <div class="quick-actions">
                        <div class="texto">
                            <p>⚡ Acciones Rápidas</p>
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

                            <a href="{{ route('programing.instructor_programan_index') }}" class="action-btn">
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
                <div class="banner-noticias">
                    <div class="texto">
                        <p>📢Novedades</p>
                        <p class="small-text">Alertas y eventos relevantes del entorno institucional</p>
                    </div>
                    <a href="https://www.elheraldo.co/la-guajira/2025/10/09/aprendiz-del-sena-la-guajira-representara-a-colombia-en-worldskills-shanghai-2026/"
                        target="_blank" class="noticia">
                        <img src="../img/noticiaWorldSkills2025.png" class="imagen-noticia" alt="">
                        <p>Aprendiz del Sena La Guajira representará a Colombia en WorldSkills Shanghái 2026</p>
                    </a>
                    <a href="https://www.sena.edu.co/es-co/Noticias/Paginas/noticia.aspx?IdNoticia=8700" target="_blank"
                        class="noticia">
                        <img src="../img/noticiaExpoOaxaca.png" class="imagen-noticia" alt="">
                        <p>El SENA abre caminos de colaboración con Japón y organismos globales</p>
                    </a>
                    <a href="https://www.sena.edu.co/es-co/Noticias/Paginas/noticia.aspx?IdNoticia=8692" target="_blank"
                        class="noticia">
                        <img src="../img/economiaCampo.png" class="imagen-noticia" alt="">
                        <p>La experiencia del campo y la economía popular se certifica con el SENA</p>
                    </a>
                    <a href="https://www.sena.edu.co/es-co/Noticias/Paginas/noticia.aspx?IdNoticia=8687" target="_blank"
                        class="noticia">
                        <img src="../img/saboresFestival.png" class="imagen-noticia" alt="">
                        <p>El SENA Cocina 2025 encenderá los fogones en Riohacha: sabores, saberes y tradición en un
                            mismo festival</p>
                    </a>
                </div>
            </div>
        </main>

    </body>

    </html>
</x-layout>
