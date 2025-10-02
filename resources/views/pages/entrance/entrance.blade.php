<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title ?? 'Sistema SENA' }}</title>
    <link rel="stylesheet" href="{{ asset('css/components/buttons.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/pages/entrance/apprentice_entrance.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-container">
            <img src="{{ asset('logoSena.png') }}" alt="Logo Sena" class="logo-header" />
            <h1 class="texto-header">Centro Agroempresarial y Acuícola</h1>
        </div>
    </header>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Contenido Principal -->
    <main class="main-content">
        <!-- Elementos decorativos -->
        <i class="fas fa-calendar-check decoration decoration-1"></i>
        <i class="fas fa-clock decoration decoration-2"></i>

        <div class="content-card">
            <div class="card-title">
                <h1>REGISTRO DE ENTRADA Y SALIDA</h1>
                <p>Centro de Formación Agroempresarial y Acuícola</p>
            </div>

            <div class="time-display">
                <div id="full_hour"></div>
                <div class="date-display" id="full_date"></div>
            </div>

            <div class="input-section">
                <div class="input-container">
                    <label for="document_number" class="input-label">INGRESE SU NÚMERO DE DOCUMENTO</label>
                    <input type="text" id="document_number" class="input-field" placeholder="Ej: 123456789" autofocus>
                    <i class="fas fa-id-card input-icon"></i>
                </div>
            </div>

            <div class="action-section">
                <span class="action-label">ACCIÓN REGISTRADA</span>
                <div class="action-badge" id="action">ESPERANDO REGISTRO</div>
            </div>

            <div class="user-info-card">
                <div class="info-item">
                    <div class="info-label">Nombre</div>
                    <div class="info-value" id="name">-</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Cargo</div>
                    <div class="info-value" id="position">-</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Hora de registro</div>
                    <div class="info-value" id="register-time">-</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Estado</div>
                    <div class="info-value" id="status">Pendiente</div>
                </div>
            </div>

            <div id="error_message"></div>
        </div>
    </main>

    <script>
        // Actualiza la hora y fecha en tiempo real
        function updateDateTime() {
            const now = new Date();

            // Formatear hora
            const hour = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');
            const seconds = now.getSeconds().toString().padStart(2, '0');
            document.getElementById('full_hour').textContent = `${hour}:${minutes}:${seconds}`;

            // Formatear fecha
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById('full_date').textContent = now.toLocaleDateString('es-ES', options);

            // Actualizar hora de registro si está visible
            const registerTime = document.getElementById('register-time');
            if (registerTime.textContent !== '-') {
                registerTime.textContent = `${hour}:${minutes}:${seconds}`;
            }
        }

        setInterval(updateDateTime, 1000);
        updateDateTime();

        $(document).ready(function() {
            // Inicializar el badge de acción
            $('#action').text('ESPERANDO REGISTRO').removeClass('entrada salida');

            function sendDocumentNumber(documentNumber) {
                let csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: "{{ route('entrance.store') }}",
                    type: 'POST',
                    data: {
                        document_number: documentNumber,
                        _token: csrfToken
                    },
                    beforeSend: function() {
                        $('#status').text('Verificando...').css('color', '#FF9800');
                    },
                    success: function(response) {
                        if (response.error) {
                            $('#error_message').text(response.error).show();
                            $('#document_number').val('').focus();
                            $('#status').text('Error').css('color', '#C62828');

                            // Animación de error
                            $('#error_message').css('animation', 'none');
                            setTimeout(function() {
                                $('#error_message').css('animation', 'shake 0.5s ease');
                            }, 10);
                        } else {
                            const actionText = response.action.toUpperCase();
                            const $action = $('#action');

                            // Actualizar la interfaz con los datos recibidos
                            $action.text(actionText)
                                .removeClass('entrada salida')
                                .addClass(response.action.toLowerCase());

                            $('#position').text(response.position);
                            $('#name').text(response.name);
                            $('#register-time').text($('#full_hour').text());
                            $('#status').text('Registro exitoso').css('color', '#2E7D32');
                            $('#error_message').hide();
                            $('#document_number').val('').focus();

                            // Animación de confirmación
                            $action.css('animation', 'none');
                            setTimeout(function() {
                                $action.css('animation', 'pulse 0.6s ease');
                            }, 10);
                        }
                    },
                    error: function() {
                        $('#error_message').text('Error de conexión. Intente nuevamente.').show();
                        $('#status').text('Error').css('color', '#C62828');
                    }
                });
            }

            // Validar que solo se ingresen números
            $('#document_number').on('input', function() {
                this.value = this.value.replace(/\D/g, '');
            });

            // Enviar el formulario al presionar Enter
            $('#document_number').on('keypress', function(e) {
                if (e.which === 13) {
                    e.preventDefault();
                    let documentNumber = $(this).val().trim();
                    if (documentNumber) {
                        sendDocumentNumber(documentNumber);
                    }
                }
            });
        });
    </script>

    <!-- Footer -->
    <footer class="footer">
        <img src="{{ asset('logoSena.png') }}" alt="Logo Sena" class="logo-footer" />
        <p>&copy; {{ date('Y') }} Centro Agroempresarial y Acuícola. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
