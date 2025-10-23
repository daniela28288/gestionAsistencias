// Abre el modal y bloquea el scroll del body
function openModal() {
    document.getElementById('modal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

// Cierra el modal y restablece el scroll del body
function closeModal() {
    document.getElementById('modal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Filtra las filas de la tabla según el estado seleccionado
function filterTable() {
    const filter = document.getElementById('statusFilter').value;
    const rows = document.querySelectorAll('.ficha-row');

    rows.forEach(row => {
        const status = row.getAttribute('data-status');
        if (filter === 'all' || filter === status) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

// Validación y eventos al cargar la página
document.addEventListener('DOMContentLoaded', function () {
    const startDateInput = document.querySelector('input[name="start_date"]');
    const endDateInput = document.querySelector('input[name="end_date"]');


    // Asegura que la fecha de finalización no sea anterior al inicio
    startDateInput.addEventListener('change', function () {
        if (this.value) {
            endDateInput.min = this.value;
        }
    });

    // Permite cerrar el modal al hacer clic fuera del contenido
    window.addEventListener('click', function (event) {
        if (event.target === document.getElementById('modal')) {
            closeModal();
        }
    });

    // Cierra el modal con la tecla ESC
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeModal();
        }
    });
});