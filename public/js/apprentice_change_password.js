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