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

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Contenido Principal -->
    <main class="main-content">

        <div class="columna head">
            <div class="card-title">
                <div class="title-volver">
                    <img src="{{ asset('../icons/') }}" alt="">
                    <h1>Control de Acceso</h1>
                </div>
                <p>Centro de Formación Agroempresarial y Acuícola</p>
            </div>
            <div class="time-display">
                <div id="full_hour"></div>
                <div class="date-display" id="full_date"></div>
            </div>
        </div>

        <div class="columna">
            <div class="content-card">
                <div class="input-section">
                    <div class="input-container">
                        <label for="document_number" class="input-label">INGRESE SU NÚMERO DE DOCUMENTO</label>
                        <input type="text" id="document_number" class="input-field" placeholder="Ej: 123456789"
                            autofocus>
                        <i class="fas fa-id-card input-icon"></i>
                    </div>
                </div>

                <div class="action-section">
                    <span class="action-label">ACCIÓN REGISTRADA</span>
                    <div class="action-badge" id="action">ESPERANDO REGISTRO</div>
                </div>
            </div>

            <div class="user-info-card">
                <div class="title">
                    <img src="{{asset('../icons/iconuser.png')}}" alt="">
                    <h3>Información del usuario</h3>
                </div>
                <div class="info-item">
                    <div class="info-label">Nombre Completo</div>
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
        // VARIABLES GLOBALES PARA EL CONTADOR 
        let temporizador = null;
        let tiempoRestante = 0;
        let temporizadores = {};
        let ultimoDocumentoConError429 = null;
        let mostrarContador = true;

        function updateDateTime() {
            // CREA UN OBJECTO "DATE" CON LA FECHA Y HORA ACTUALES DEL SISTEMA
            const now = new Date();

            // OBTENEMOS LA HORA, LOS MINUTOS Y LOS SEGUNDOS
            // "toString().padStart(2, '0')" GARANTIZA QUE TENGA DOS DIGITOS EJ:(08 EN VEZ DE 8)
            const hour = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');
            const seconds = now.getSeconds().toString().padStart(2, '0');

            document.getElementById('full_hour').textContent = `${hour}:${minutes}:${seconds}`;

            // options DEFINE EL FORMATO DE FECHA
            const options = {
                weekday: 'long', // "LONG" ES EL FORMATO COMPLETO (LUNES, MARTES, ETC..)
                year: 'numeric',
                month: 'long', // (MARZO, ABRIL, ETC...)
                day: 'numeric'
            };

            // CONVIERTE LA FECHA  A FORMATO LOCAL EN ESPAÑOL(ESPAÑA) Y LA MUESTRA EN "#full_date"
            document.getElementById('full_date').textContent = now.toLocaleDateString('es-ES', options);
        }
        // LLAMA A updateDateTime() CADA SEGUNDO PARA ACTUALIZAR LA FECHA Y LA HORA
        setInterval(updateDateTime, 1000);
        updateDateTime();

        // FUNCIONALIDAD CON jQUERY (INTERACCION CON EL USUARIO)
        // ESPERA A QUE TODO EL DOCUMENTO ESTÉ CARGADO ANTES DE EJECUTAR EL CÓDIGO
        $(document).ready(function() {

            // Inicializar el badge de acción
            $('#action').text('ESPERANDO REGISTRO').removeClass('entrada salida');

            // ESTA FUNCION SE ENCARGA DE ENVIAR EL NÚMERO DE DOCUMENTO AL SERVIDOR PARA REGISTRAR LA ENTRADA/SALIDA
            function sendDocumentNumber(documentNumber) {
                // OBTIENE EL TOKEN CSRF DESDE UNA ETIQUETA META DEL HTML
                // ESTE TOKEN ES NECESARIO PARA PROTEGER CONTRA ATAQUES CSRF EN FORMULARIOS AJAX
                let csrfToken = $('meta[name="csrf-token"]').attr('content');

                // HACE UNA PETICION POST A LA RUTA DE LARAVEL
                $.ajax({
                    url: "{{ route('entrance.store') }}",
                    type: 'POST',
                    data: {
                        document_number: documentNumber,
                        _token: csrfToken
                    },
                    // PERO ANTES DE ENVIAR CAMBIA EL ESTADO (#status) Y EL COLOR
                    beforeSend: function() {
                        $('#status').text('Verificando...').css('color', '#FF9800');
                    },
                    success: function(response) {
                        // SI EL SERVIDOR RESPONDE CON UN CAMPO ERROR, SIGNIFICA QUE HUBO UN PROBLEMA
                        if (response.error) {
                            $('#error_message').text(response.error).show();
                            $('#document_number').val('').focus();
                            $('#status').text('Fallido').css('color', '#C62828');

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
                            $('#status').text('Exitoso').css('color', '#2E7D32');
                            $('#error_message').hide();
                            $('#document_number').val('').focus();

                            // Animación de confirmación
                            $action.css('animation', 'none');
                            setTimeout(function() {
                                $action.css('animation', 'pulse 0.6s ease');
                            }, 10);
                        }
                    },

                    // CONTROL DE ERRORES
                    error: function(xhr, status, error) {
                        const documentoActual = $('#document_number').val(); // Documento actual

                        // ERROR 429 - DEMASIADAS SOLICITUDES
                        if (xhr.status === 429) {
                            const waitTime = 30; // SEGUNDOS
                            ultimoDocumentoConError429 = documentoActual; // Guardamos el documento bloqueado
                            mostrarContador = true; // Permitimos que el contador se muestre

                            // Si ya hay un contador activo, solo refrescamos el mensaje
                            if (temporizadores[documentoActual]) {
                                if (mostrarContador) {
                                    $('#error_message')
                                        .text(
                                            `Ya registró esta acción recientemente. Espere ${temporizadores[documentoActual].restante} segundos`
                                        )
                                        .show();
                                    $('#status').css('color', '#FF9800');
                                }
                                return;
                            }

                            let tiempoRestante = waitTime;

                            $('#error_message')
                                .show()
                                .text(`Ya registró esta acción recientemente. Espere ${tiempoRestante} segundos`);
                            $('#status').css('color', '#FF9800');

                            // CREAR EL INTERVALO Y GUARDARLO EN EL OBJETO
                            const intervalo = setInterval(() => {
                                tiempoRestante--;
                                temporizadores[documentoActual].restante = tiempoRestante;

                                const documentoVisible = $('#document_number').val().trim();

                                // Si el campo está vacío, no mostrar nada
                                if (!documentoVisible) {
                                    $('#error_message').hide();
                                    return;
                                }

                                // Solo mostrar si el documento visible coincide y está permitido
                                if (
                                    mostrarContador &&
                                    ultimoDocumentoConError429 === documentoActual &&
                                    documentoVisible === documentoActual
                                ) {
                                    $('#error_message').text(
                                        `Ya registró esta acción recientemente. Espere ${tiempoRestante} segundos`
                                    );
                                }

                                if (tiempoRestante <= 0) {
                                    clearInterval(intervalo);
                                    delete temporizadores[documentoActual];

                                    if (ultimoDocumentoConError429 === documentoActual) {
                                        $('#status').text('Pendiente').css('color', '#000');
                                        $('#error_message').hide();
                                        ultimoDocumentoConError429 = null;
                                    }
                                }
                            }, 1000);

                            temporizadores[documentoActual] = {
                                intervalo: intervalo,
                                restante: tiempoRestante,
                            };

                            return; // No ejecutar el resto
                        }

                        mostrarContador = false;

                        let message = 'Error de conexión. Intente nuevamente.';

                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            message = xhr.responseJSON.error;
                        } else if (xhr.status === 422) {
                            message = 'Documento inválido. Verifique el número ingresado.';
                        } else if (xhr.status === 404) {
                            message = 'Documento no registrado en el sistema.';
                        } else if (xhr.status === 500) {
                            message = 'Error interno del servidor. Contacte al administrador.';
                        }

                        $('#error_message').text(message).show();
                        $('#status').text('Fallido').css('color', '#C62828');
                        $('#name').text('-');
                        $('#position').text('-');
                        $('#register-time').text('-');

                        $('#error_message').css('animation', 'none');
                        setTimeout(() => {
                            $('#error_message').css('animation', 'shake 0.5s ease');
                        }, 10);

                        // Después de un breve tiempo, volver a permitir que el contador se muestre
                        // (por ejemplo, si el usuario intenta registrar de nuevo)
                        setTimeout(() => {
                            mostrarContador = true;
                        }, 1500);
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
</body>

</html>