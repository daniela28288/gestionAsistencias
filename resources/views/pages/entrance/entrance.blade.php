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
        <a href="{{asset('../views/components/layout_login.blade.php')}}" class="flecha" title="Regresar al login">
            <img src="{{asset('../icons/flecharriba.png')}}" alt="">
        </a>

        <div class="tabla">
            <div class="columna head">
                <div class="card-title">
                    <img src="{{asset('../img/logoSena.png')}}" alt="" class="logo">
                    <div class="info">
                        <h1>Control de Acceso</h1>
                        <p>Centro de Formación Agroempresarial y Acuícola</p>
                    </div>
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
                            <p class="hint">Presione la tecla Enter ⏎ o Intro para continuar</p>
                        </div>
                    </div>

                    <div class="action-section">
                        <div class="action">
                            <div class="icon">
                                <img src="../icons/cargando.gif" alt="">
                            </div>

                            <div class="info-entrada">
                                <span class="action-label">ACCIÓN REGISTRADA</span>
                                <h3 class="action-badge" id="action">Esperando documento...</h3>
                            </div>
                            <!-- 
                            <div class="info-entrada">
                                <div class="anuncio">
                                    <p></p>
                                </div>
                            </div> -->
                        </div>
                    </div>

                    <div id="error_message"></div>
                </div>

                <div class="user-info-card">
                    <div class="title">
                        <img src="{{asset('../icons/iconuser.png')}}" alt="">
                        <h3>Información del usuario</h3>
                    </div>

                    <div class="info-item">
                        <div class="icon-item orange">
                            <img src="{{ asset('../icons/name.png') }}" alt="">
                        </div>

                        <div class="text-item">
                            <div class="info-label">Nombre Completo</div>
                            <div class="info-value" id="name">-</div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="icon-item green">
                            <img src="{{ asset('../icons/rol.png') }}" alt="">
                        </div>

                        <div class="text-item">
                            <div class="info-label">Cargo</div>
                            <div class="info-value" id="position">-</div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="icon-item blue">
                            <img src="{{ asset('../icons/reloj.png') }}" alt="">
                        </div>

                        <div class="text-item">
                            <div class="info-label">Hora de registro</div>
                            <div class="info-value" id="register-time">-</div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="icon-item purple">
                            <img src="{{ asset('../icons/estado.png') }}" alt="">
                        </div>

                        <div class="text-item">
                            <div class="info-label">Estado</div>
                            <div class="info-value" id="status">Pendiente</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>


    <script>
        document.addEventListener("DOMContentLoaded", () => {

            // VARIABLES GLOBALES
            const temporizadores = {}; // { documento: { restante, intervalo } }
            let documentoActualMostrado = null;

            // ELEMENTO IMG
            const iconImg = document.querySelector('.action .icon img');

            // ACTUALIZAR FECHA Y HORA
            function updateDateTime() {
                const now = new Date();
                const hour = now.getHours().toString().padStart(2, '0');
                const minutes = now.getMinutes().toString().padStart(2, '0');
                const seconds = now.getSeconds().toString().padStart(2, '0');
                document.getElementById('full_hour').textContent = `${hour}:${minutes}:${seconds}`;

                const options = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };
                document.getElementById('full_date').textContent = now.toLocaleDateString('es-ES', options);
            }
            setInterval(updateDateTime, 1000);
            updateDateTime();

            // ELEMENTOS DEL DOM
            const actionBadge = document.getElementById('action');
            const statusText = document.getElementById('status');
            const errorMsg = document.getElementById('error_message');
            const docInput = document.getElementById('document_number');
            const nameField = document.getElementById('name');
            const positionField = document.getElementById('position');
            const timeField = document.getElementById('register-time');
            const infoEntrada = document.querySelector('.action');

            // ESTADO INICIAL
            infoEntrada.classList.remove('entrada', 'salida');
            iconImg.src = '../icons/cargando.gif';
            statusText.textContent = 'Esperando documento...';

            // ENVIAR DOCUMENTO AL SERVIDOR
            async function sendDocumentNumber(documentNumber) {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                documentoActualMostrado = documentNumber;

                if (temporizadores[documentNumber] && temporizadores[documentNumber].restante > 0) {
                    const tiempo = temporizadores[documentNumber].restante;
                    showError(`Ya registró esta acción recientemente. Espere ${tiempo} segundos`, '#FF9800');
                    return;
                }

                statusText.textContent = 'Verificando...';
                statusText.style.color = '#FF9800';

                try {
                    const response = await fetch("{{ route('entrance.store') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            document_number: documentNumber
                        })
                    });

                    if (!response.ok) {
                        handleHttpError(response.status, documentNumber);
                        return;
                    }

                    const data = await response.json();

                    if (data.error) {
                        showError(data.error, '#C62828');
                        resetDisplayFields();
                        shake(errorMsg);
                        resetForm();
                        return;
                    }

                    // ÉXITO
                    const actionText = data.action.toUpperCase();
                    actionBadge.textContent = actionText;

                    // Cambiar color del contenedor según acción
                    infoEntrada.classList.remove('entrada', 'salida');
                    infoEntrada.classList.add(data.action.toLowerCase());

                    // Cambiar imagen según acción
                    if (data.action.toLowerCase() === 'entrada') {
                        iconImg.src = '../icons/entrada.gif';
                    } else if (data.action.toLowerCase() === 'salida') {
                        iconImg.src = '../icons/salida.gif';
                    }

                    // Animación de pulso en el texto
                    pulse(actionBadge);

                    // Actualizar datos
                    nameField.textContent = data.name;
                    positionField.textContent = data.position;
                    timeField.textContent = document.getElementById('full_hour').textContent;

                    statusText.textContent = 'Exitoso';
                    statusText.style.color = '#2E7D32';
                    errorMsg.style.display = 'none';
                    resetForm();

                    // Después de 3 segundos, volver a estado inicial
                    setTimeout(() => {
                        infoEntrada.classList.remove('entrada', 'salida');
                        iconImg.src = '../icons/cargando.gif';
                        actionBadge.textContent = '';
                        statusText.textContent = 'Esperando documento...';
                        statusText.style.color = '#000';
                    }, 3000);

                } catch (error) {
                    showError('Error de conexión. Intente nuevamente.', '#C62828');
                    resetDisplayFields();
                    shake(errorMsg);
                    resetForm();
                }
            }

            // MANEJO DE ERRORES HTTP
            function handleHttpError(status, documentoActual) {
                let message = '';
                switch (status) {
                    case 429:
                        startRateLimitCounter(documentoActual);
                        return;
                    case 422:
                        message = 'Documento inválido. Verifique el número ingresado.';
                        break;
                    case 404:
                        message = 'Documento no registrado en el sistema.';
                        break;
                    case 500:
                        message = 'Error interno del servidor. Contacte al administrador.';
                        break;
                    default:
                        message = 'Error de conexión. Intente nuevamente.';
                }
                showError(message, '#C62828');
                resetDisplayFields();
                shake(errorMsg);
                resetForm();
            }

            // CONTADOR DE BLOQUEO POR USUARIO (429)
            function startRateLimitCounter(documentoActual) {
                const waitTime = 30;
                if (temporizadores[documentoActual]) return;
                let tiempoRestante = waitTime;
                temporizadores[documentoActual] = {
                    restante: tiempoRestante
                };

                if (docInput.value.trim() === documentoActual) {
                    showError(`Ya registró esta acción recientemente. Espere ${tiempoRestante} segundos`, '#FF9800');
                }

                const intervalo = setInterval(() => {
                    tiempoRestante--;
                    temporizadores[documentoActual].restante = tiempoRestante;

                    if (documentoActualMostrado === documentoActual &&
                        docInput.value.trim() === documentoActual &&
                        tiempoRestante > 0) {
                        showError(`Ya registró esta acción recientemente. Espere ${tiempoRestante} segundos`, '#FF9800');
                    }

                    if (tiempoRestante <= 0) {
                        clearInterval(intervalo);
                        delete temporizadores[documentoActual];

                        if (docInput.value.trim() === documentoActual) {
                            errorMsg.style.display = 'none';
                            statusText.textContent = 'Esperando documento';
                            statusText.style.color = '#000';
                        }
                    }
                }, 1000);

                temporizadores[documentoActual].intervalo = intervalo;
            }

            // FUNCIONES AUXILIARES
            function showError(msg, color) {
                errorMsg.textContent = msg;
                errorMsg.style.display = 'block';
                statusText.textContent = 'Fallido';
                statusText.style.color = color;
            }

            function resetDisplayFields() {
                nameField.textContent = '-';
                positionField.textContent = '-';
                timeField.textContent = '-';
            }

            function resetForm() {
                docInput.value = '';
                docInput.focus();
            }

            function shake(el) {
                el.style.animation = 'none';
                setTimeout(() => {
                    el.style.animation = 'shake 0.5s ease';
                }, 10);
            }

            function pulse(el) {
                el.style.animation = 'none';
                setTimeout(() => {
                    el.style.animation = 'pulse 0.6s ease';
                }, 10);
            }

            // EVENTOS DE INPUT
            docInput.addEventListener('input', (e) => {
                e.target.value = e.target.value.replace(/\D/g, '');
                const val = e.target.value.trim();
                documentoActualMostrado = val;

                if (temporizadores[val] && temporizadores[val].restante > 0) {
                    showError(`Ya registró esta acción recientemente. Espere ${temporizadores[val].restante} segundos`, '#FF9800');
                } else if (errorMsg.textContent.includes('Espere') && !temporizadores[val]) {
                    errorMsg.style.display = 'none';
                }
            });

            docInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    const documentNumber = docInput.value.trim();
                    if (documentNumber) {
                        sendDocumentNumber(documentNumber);
                    }
                }
            });
        });
    </script>

</body>

</html>