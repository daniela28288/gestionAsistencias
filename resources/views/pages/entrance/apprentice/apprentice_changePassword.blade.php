<x-layout_aprendiz>
    <x-slot:page_style>css/pages/start_page.css</x-slot:page_style>
    <x-slot:page_style>css\pages\apprentice\change_password.css</x-slot:page_style>
    <x-slot:title>Cambiar Contraseña</x-slot:title>


    <div class="password-container">
        <div class="password-header">
            <h2 class="password-title">Cambiar Contraseña</h2>
            <p class="password-subtitle">Actualiza tu contraseña para mantener tu cuenta segura</p>
        </div>

        <!-- Mensaje de éxito -->
        @if(session('success'))
            <div class="success-message">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Mostrar errores si existen -->
        @if ($errors->any())
            <div class="error-list">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario de cambio de contraseña -->
        <form action="{{ route('password.update') }}" method="POST" class="password-form" id="passwordForm">
            @csrf

            <!-- Contraseña actual -->
            <div class="form-group">
                <label for="current_password">Contraseña Actual</label>
                <input type="password" id="current_password" name="current_password" required>
                <span class="password-toggle" onclick="togglePassword('current_password', 'toggleCurrent')">
                    <i class="fas fa-eye" id="toggleCurrent"></i>
                </span>
                @error('current_password')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <!-- Nueva contraseña -->
            <div class="form-group">
                <label for="new_password">Nueva Contraseña</label>
                <input type="password" id="new_password" name="new_password" required oninput="checkPasswordStrength(this.value)">
                <span class="password-toggle" onclick="togglePassword('new_password', 'toggleNew')">
                    <i class="fas fa-eye" id="toggleNew"></i>
                </span>
                <div class="password-strength">
                    <div class="strength-meter" id="strengthMeter"></div>
                </div>
                <div class="strength-text" id="strengthText">Seguridad de la contraseña</div>
                @error('new_password')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <!-- Confirmar nueva contraseña -->
            <div class="form-group">
                <label for="new_password_confirmation">Confirmar Nueva Contraseña</label>
                <input type="password" id="new_password_confirmation" name="new_password_confirmation" required>
                <span class="password-toggle" onclick="togglePassword('new_password_confirmation', 'toggleConfirm')">
                    <i class="fas fa-eye" id="toggleConfirm"></i>
                </span>
                @error('new_password_confirmation')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <button type="submit" class="submit-btn">
                <i class="fas fa-key"></i>
                Cambiar Contraseña
            </button>
        </form>

        <div class="password-requirements">
            <h3 class="requirements-title">
                <i class="fas fa-info-circle"></i>
                Requisitos de la contraseña
            </h3>
            <ul class="requirements-list">
                <li><i class="fas fa-check"></i> Mínimo 8 caracteres</li>
                <li><i class="fas fa-check"></i> Al menos una letra mayúscula</li>
                <li><i class="fas fa-check"></i> Al menos una letra minúscula</li>
                <li><i class="fas fa-check"></i> Al menos un número</li>
                <li><i class="fas fa-check"></i> Al menos un carácter especial</li>
            </ul>
        </div>
    </div>

    <script>
        // Función para mostrar/ocultar contraseña
        function togglePassword(inputId, toggleId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = document.getElementById(toggleId);

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Función para verificar la fortaleza de la contraseña
        function checkPasswordStrength(password) {
            const meter = document.getElementById('strengthMeter');
            const text = document.getElementById('strengthText');

            // Reiniciar
            meter.className = 'strength-meter';
            text.textContent = 'Seguridad de la contraseña';

            if (password.length === 0) {
                return;
            }

            // Verificar fortaleza
            let strength = 0;

            // Longitud
            if (password.length >= 8) strength++;

            // Letras mayúsculas y minúsculas
            if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength++;

            // Números
            if (password.match(/([0-9])/)) strength++;

            // Caracteres especiales
            if (password.match(/([!,@,#,$,%,^,&,*,?,_,~])/)) strength++;

            // Actualizar visualización
            if (password.length < 8) {
                meter.className = 'strength-meter strength-weak';
                text.textContent = 'Débil';
                text.style.color = '#e74c3c';
            } else if (strength <= 2) {
                meter.className = 'strength-meter strength-weak';
                text.textContent = 'Débil';
                text.style.color = '#e74c3c';
            } else if (strength === 3) {                                                      
                12
                meter.className = 'strength-meter strength-medium';
                text.textContent = 'Media';
                text.style.color = '#f39c12';
            } else {
                meter.className = 'strength-meter strength-strong';
                text.textContent = 'Fuerte';
                text.style.color = '#27ae60';
            }
        }

        // Validación del formulario
        document.getElementById('passwordForm').addEventListener('submit', function(e) {
            const newPassword = document.getElementById('new_password').value;
            const confirmPassword = document.getElementById('new_password_confirmation').value;

            if (newPassword !== confirmPassword) {
                e.preventDefault();
                alert('Las contraseñas no coinciden. Por favor, verifica.');
            }
        });
         </script>
</x-layout_aprendiz>
