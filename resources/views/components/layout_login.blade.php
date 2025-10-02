<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title ?? 'Sistema SENA' }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/layout_login.css') }}">
</head>

<body>
    <div class="banner">
        <div class="texto">
            <h1 class="light">Sistema de registro de </h1>
            <h1 class="green">asistencias</h1>

            <p>Uso exclusivo institucional</p>

            <button>
                <img src="../img/entradaButton.png" alt="">
                <p>Gestion de entrada</p>
            </button>
        </div>
    </div>


    <!-- Main Content -->
    <main class="main-content">

        <div class="form-container">

            <!-- FORMULARIO PROGRAMACIÓN -->
            <form class="login-form" action="{{ route('programming-login') }}" method="POST">
                @csrf
                <h1>BIENVENIDO</h1>
                <h3>Acceder al Portal de Gestión</h3>

                <!-- Mostrar errores de login -->
                @if ($errors->has('login_error'))
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i> {{ $errors->first('login_error') }}
                    </div>
                @endif
                <div class="input-group">
                    <label for="user_name_program">Usuario</label>
                    <input type="text" id="user_name_program" name="user_name" placeholder="Ingresa tu usuario" required>
                </div>

                <div class="input-group">
                    <label for="password_program">Contraseña</label>
                    <div class="password-container">
                        <input type="password" id="password_program" name="password" placeholder="Ingresa tu contraseña"
                            required>

                    </div>
                </div>

                <div class="input-group">
                    <label for="module">Seleccione rol</label>
                    <select name="module" id="module" required>
                        <option value="" disabled selected>Seleccione rol</option>
                        <option value="Coordinador" {{ old('module') == 'Coordinador' ? 'selected' : '' }}>Coordinador
                        </option>
                        <option value="Aprendiz" {{ old('module') == 'Aprendiz' ? 'selected' : '' }}>Aprendiz</option>
                    </select>
                </div>

                <button type="submit" class="submit-btn">Ingresar</button>
            </form>
        </div>

        
    <!-- Footer -->
    {{-- <footer class="footer">
        <img src="{{ asset('logoSena.png') }}" alt="Logo Sena" class="logo-footer" />
        <p>&copy; {{ date('Y') }} Centro Agroempresarial y Acuícola. Todos los derechos reservados.</p>
    </footer> --}}
    </main>


    <script>
        const eyeIcon = document.getElementById('eyeIcon');
        const passwordInput = document.getElementById('password_program');

        eyeIcon.addEventListener('click', function() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = '<i class="fas fa-eye"></i>';
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = '<i class="fas fa-eye-slash"></i>';
            }
        });
    </script>
</body>

</html>
