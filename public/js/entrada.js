// =========================
// RELOJ Y FECHA AUTOMÁTICOS
// =========================

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

// Actualizar cada segundo
setInterval(updateDateTime, 1000);
updateDateTime();


// =========================
// FUNCIONALIDAD PRINCIPAL
// =========================
$(document).ready(function () {

    // Inicializar el badge de acción
    $('#action').text('ESPERANDO REGISTRO').removeClass('entrada salida');

    // Función para enviar el número de documento
    function sendDocumentNumber(documentNumber) {
        // Obtener el token CSRF desde una meta tag
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: storeUrl, // 🔹 viene del script Blade que inyectó la URL
            type: 'POST',
            data: {
                document_number: documentNumber,
                _token: csrfToken
            },

            beforeSend: function () {
                $('#status').text('Verificando...').css('color', '#FF9800');
            },

            success: function (response) {
                if (response.error) {
                    $('#error_message').text(response.error).show();
                    $('#document_number').val('').focus();
                    $('#status').text('Error').css('color', '#C62828');

                    // Animación de error
                    $('#error_message').css('animation', 'none');
                    setTimeout(function () {
                        $('#error_message').css('animation', 'shake 0.5s ease');
                    }, 10);
                } else {
                    const actionText = response.action.toUpperCase();
                    const $action = $('#action');

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
                    setTimeout(function () {
                        $action.css('animation', 'pulse 0.6s ease');
                    }, 10);
                }
            },

            error: function (xhr, status, error) {
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

                $('#error_message').css('animation', 'none');
                setTimeout(function () {
                    $('#error_message').css('animation', 'shake 0.5s ease');
                }, 10);
            }
        });
    }

    // Solo números en el campo de documento
    $('#document_number').on('input', function () {
        this.value = this.value.replace(/\D/g, '');
    });

    // Enviar al presionar Enter
    $('#document_number').on('keypress', function (e) {
        if (e.which === 13) {
            e.preventDefault();
            const documentNumber = $(this).val().trim();
            if (documentNumber) {
                sendDocumentNumber(documentNumber);
            }
        }
    });
});
