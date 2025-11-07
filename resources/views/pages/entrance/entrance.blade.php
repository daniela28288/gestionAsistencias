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
        document.addEventListener('DOMContentLoaded', () => {

            // Referencias a los elementos del DOM
            const documentInput = document.getElementById('document_number');
            const statusText = document.getElementById('status');
            const errorMessage = document.getElementById('error_message');
            const actionBadge = document.getElementById('action');
            const positionField = document.getElementById('position');
            const nameField = document.getElementById('name');
            const registerTime = document.getElementById('register-time');

            // Token CSRF de Laravel
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Función para enviar documento
            async function sendDocumentNumber(documentNumber) {
                try {
                    statusText.textContent = 'Verificando...';
                    statusText.style.color = '#FF9800';

                    const response = await fetch("{{ route('entrance.store') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": csrfToken
                        },
                        body: JSON.stringify({ document_number: documentNumber })
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        // Manejo de errores HTTP
                        let message = data.error || 'Error de conexión. Intente nuevamente.';
                        if (response.status === 429) message = 'Ya registró esta acción recientemente. Espere 30 segundos.';
                        if (response.status === 404) message = 'Documento no registrado en el sistema.';
                        if (response.status === 422) message = 'Documento inválido. Verifique el número ingresado.';

                        showError(message);
                        return;
                    }

                    // Si hay error lógico (no HTTP)
                    if (data.error) {
                        showError(data.error);
                        return;
                    }

                    // Mostrar acción exitosa
                    updateSuccess(data);

                } catch (error) {
                    showError('Error de conexión. Intente nuevamente.');
                }
            }

            // Función para mostrar errores
            function showError(message) {
                errorMessage.textContent = message;
                errorMessage.style.display = 'block';
                statusText.textContent = 'Fallido';
                statusText.style.color = '#C62828';
            }

            // Función para mostrar éxito
            function updateSuccess(data) {
                const now = new Date();
                const currentTime = now.toLocaleTimeString('es-ES');

                actionBadge.textContent = data.action.toUpperCase();
                actionBadge.className = `action-badge ${data.action.toLowerCase()}`;

                positionField.textContent = data.position || '-';
                nameField.textContent = data.name || '-';
                registerTime.textContent = currentTime;
                statusText.textContent = 'Exitoso';
                statusText.style.color = '#2E7D32';
                errorMessage.style.display = 'none';
                documentInput.value = '';
            }

            // Validar solo números
            documentInput.addEventListener('input', () => {
                documentInput.value = documentInput.value.replace(/\D/g, '');
            });

            // Enviar al presionar Enter
            documentInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    const docNum = documentInput.value.trim();
                    if (docNum) sendDocumentNumber(docNum);
                }
            });
        });

    </script>

</body>

</html>