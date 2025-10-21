<x-layout>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Dashboard - Sistema SENA</title>
        
        <!-- Biblioteca de íconos Font Awesome 6.5.0 -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
        <!-- Estilos css -->
        <link rel="stylesheet" href="{{ asset('css/pages/competencies_program_index.css') }}">
    </head>

    <body>
        <!-- CONTENIDO PRINCIPAL DEL DASHBOARD -->
        <main class="content flex" id="main-content">
            
            <!-- COLUMNA IZQUIERDA -->
            <div class="left-content">
                <div class="dashboard">
                    
                    <!-- SECCIÓN 1: TARJETAS DE ESTADÍSTICAS -->
                    <div class="contenedor-cards">
                        
                        <!-- Título y descripción de la sección -->
                        <div class="texto">
                            <p>📑 Resumen General</p>
                            <p class="small-text">
                                Indicadores clave sobre personas, programaciones e instructores activos
                            </p>
                        </div>

                        <!-- Grid de 4 tarjetas estadísticas -->
                        <div class="stats-grid">
                            
                            <!-- TARJETA 1: Total de Personas -->
                            <div class="stat-card">
                                
                                <!-- Icono -->
                                <div class="card-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                
                                <!-- Contenido principal -->
                                <div class="stat-content">

                                    <!-- Valor dinámico -->
                                    <div class="stat-value">{{ $personas->count() }}</div>
                                    <div class="stat-label">Total de Personas</div>
                                    
                                    <!-- Indicador de tendencia/cambio reciente -->
                                    <span class="stat-trend">
                                        <i class="fas fa-plus"></i>
                                        12 este mes
                                    </span>
                                </div>
                                
                                <!-- Efecto decorativo de onda en la parte inferior -->
                                <div class="card-wave"></div>
                            </div>

                            <!-- 
                                TARJETA 2: Programaciones Activas
                                Variante con clases border-orange y orange
                            -->
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

                            <!--TARJETA 3: Instructores Activos-->
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

                            <!-- 
                                TARJETA 4: Pendientes por Registrar
                                Indicador de alerta urgente
                                Operador ?? 0 para valor por defecto si variable no existe
                            -->
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
                            
                        </div> <!-- Fin stats-grid -->
                    </div> <!-- Fin contenedor-cards -->

                    <!-- SECCIÓN 2: ACCIONES RÁPIDAS
                        ========================================
                        Botones de acceso directo a funciones principales
                        Cada botón es un enlace a una ruta específica de Laravel
                    -->
                    <div class="quick-actions">
                        
                        <!-- Título y descripción de la sección -->
                        <div class="texto">
                            <p>⚡ Acciones Rápidas</p>
                            <p class="small-text">
                                Monitorea el avance de registros, programaciones e instructores este mes
                            </p>
                        </div>

                        <!-- Grid de botones de acción (4 columnas responsivas) -->
                        <div class="action-grid">
                            
                            <!-- BOTÓN 1: Nueva Programación -->
                            <a href="{{ route('programming.register_programming_instructor_index') }}"
                                class="action-btn">
                                <div class="action-icon">
                                    <i class="fas fa-calendar-plus"></i>
                                </div>
                                <div class="action-label">Nueva Programación</div>
                            </a>

                            <!-- BOTÓN 2: Registrar Aprendiz -->
                            <a href="{{ route('entrance.people.create') }}" class="action-btn">
                                <div class="action-icon">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <div class="action-label">Registrar Aprendiz</div>
                            </a>

                            <!-- BOTÓN 3: Gestionar Instructor -->
                            <a href="{{ route('programing.instructor_programan_index') }}" class="action-btn">
                                <div class="action-icon">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                </div>
                                <div class="action-label">Gestionar Instructor</div>
                            </a>

                            <!-- BOTÓN 4: Reportes -->
                            <a href="#" class="action-btn">
                                <div class="action-icon">
                                    <i class="fas fa-clipboard-list"></i>
                                </div>
                                <div class="action-label">Reportes</div>
                            </a>
                            
                        </div> <!-- Fin action-grid -->
                    </div> <!-- Fin quick-actions -->
                    
                </div> <!-- Fin dashboard -->
            </div> <!-- Fin left-content -->


            <!-- COLUMNA DERECHA 
                SECCIÓN 3: PANEL DE NOTICIAS -->
            <div class="right-content">
                <div class="banner-noticias">
                    
                    <!-- Título del panel de noticias -->
                    <div class="texto">
                        <p>📢Novedades</p>
                        <p class="small-text">
                            Alertas y eventos relevantes del entorno institucional
                        </p>
                    </div>

                    <a href="https://www.elheraldo.co/la-guajira/2025/10/09/aprendiz-del-sena-la-guajira-representara-a-colombia-en-worldskills-shanghai-2026/"
                        target="_blank" 
                        class="noticia">

                        <!-- Imagen miniatura de la noticia -->
                        <img src="../img/noticiaWorldSkills2025.png" 
                             class="imagen-noticia" 
                             alt="WorldSkills 2026">

                        <!-- Texto descriptivo -->
                        <p>Aprendiz del Sena La Guajira representará a Colombia en WorldSkills Shanghái 2026</p>
                    </a>

                    <a href="https://www.sena.edu.co/es-co/Noticias/Paginas/noticia.aspx?IdNoticia=8700" 
                        target="_blank"
                        class="noticia">
                        <img src="../img/noticiaExpoOaxaca.png" 
                             class="imagen-noticia" 
                             alt="Colaboración Japón">
                        <p>El SENA abre caminos de colaboración con Japón y organismos globales</p>
                    </a>

                    <a href="https://www.sena.edu.co/es-co/Noticias/Paginas/noticia.aspx?IdNoticia=8692" 
                        target="_blank"
                        class="noticia">
                        <img src="../img/economiaCampo.png" 
                             class="imagen-noticia" 
                             alt="Economía del campo">
                        <p>La experiencia del campo y la economía popular se certifica con el SENA</p>
                    </a>

                    <a href="https://www.sena.edu.co/es-co/Noticias/Paginas/noticia.aspx?IdNoticia=8687" 
                        target="_blank"
                        class="noticia">
                        <img src="../img/saboresFestival.png" 
                             class="imagen-noticia" 
                             alt="SENA Cocina 2025">
                        <p>El SENA Cocina 2025 encenderá los fogones en Riohacha: sabores, saberes y tradición en un
                            mismo festival</p>
                    </a>
                    
                </div> <!-- Fin banner-noticias -->
            </div> <!-- Fin right-content -->
            
        </main> <!-- Fin main-content -->

    </body>

    </html>
</x-layout>