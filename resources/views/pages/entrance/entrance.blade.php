<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Sistema SENA' }}</title>
    <link rel="stylesheet" href="{{ asset('css/components/buttons.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/pages/entrance/apprentice_entrance.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Contenido Principal -->
    <main class="main-content">

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
    </main>

    <script>
        const storeUrl = "{{ route('entrance.store') }}";
    </script>
    <script src="{{ asset('js/entrada.js') }}"></script>
</body>

</html>
