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
    <div class="login-container">
        <div class="banner">
            <div class="texto">
                <h1 class="light">Sistema de registro de </h1>
                <h1 class="green">asistencias</h1>

                <p>Uso exclusivo institucional</p>

                <a href="{{ route('gestion_entrada') }}" class="btn-banner">
                    <img src="../img/entradaButton.png" alt="">
                    <p>Gestion de entrada</p>
                </a>
            </div>
        </div>

        <div class="form-container">
            {{-- <div class="logo">
                <h2>Centro Agroempresarial <br> y Acuicola</h2>
                <img src="../img/Line.png" alt="">
                <img class="logo-sena" src="../img/sena.png" alt="">
            </div> --}}

            <div class="logo">
                <img class="logo-sena" src="../img/sena.png" alt="">
                <img src="../img/Line.png" alt="">
                <h2>Centro Agroempresarial <br> y Acuicola</h2>
            </div>



            <form class="login-form" action="{{ route('programming-login') }}" method="POST">
                @csrf

                <h1>BIENVENIDO</h1>
                <h3>Acceder al Portal de Gestión</h3>

                @if ($errors->has('login_error'))
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i> {{ $errors->first('login_error') }}
                </div>
                @endif
                <div class="input-group">
                    <label for="user_name_program" class="font-small">Usuario</label>
                    <div class="content">
                        <i class="icon"><img src="../icons/user.png" alt=""></i>
                        <input type="text" id="user_name_program" name="user_name" placeholder="Ingresa tu usuario"
                            required>
                    </div>
                </div>

                <div class="input-group">
                    <label for="password_program" class="font-small">Contraseña</label>
                    <div class="content">
                        <i class="icon pass"><img src="../icons/pass.png" alt=""></i>
                        <input type="password" id="password_program" name="password" placeholder="Ingresa tu contraseña"
                            required>
                    </div>
                </div>

                <!-- <div class="input-group">
                    <label for="module" class="font-small">Seleccione rol</label>
                    <div class="content">
                        <i><img src="../icons/role.png" alt=""></i>
                        <select name="module" id="module" required>
                            <option value="" disabled selected>Seleccione rol</option>
                            <option value="Coordinador" {{ old('module') == 'Coordinador' ? 'selected' : '' }}>
                                Coordinador
                            </option>
                            <option value="Aprendiz" {{ old('module') == 'Aprendiz' ? 'selected' : '' }}>Aprendiz
                            </option>
                        </select>
                    </div>
                </div> -->

                <div class="password-config">
                    <div class="remember">
                        <input type="checkbox">
                        <p class="font-small">Recordar</p>
                    </div>

                    <a href="" class="font-small color-green">¿Olvidaste tu contraseña?</a>
                </div>

                <button type="submit" class="submit-btn">Ingresar</button>

                <hr>

                <p class="font-small">¿No tienes una cuenta? <a href="" class="color-green">Registrate aquí</a>
                </p>
            </form>
        </div>
    </div>
</body>

</html>