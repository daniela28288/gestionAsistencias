/**
 * Limpia todos los filtros aplicados y reenvía el formulario
 * - Resetea el combo de fichas
 * - Limpia el campo de búsqueda
 * - Hace submit para actualizar la lista
 */
function clearFilters() {
    document.getElementById('combo_ficha').value = '';
    document.getElementById('buscar').value = '';
    document.querySelector('form').submit();
}

/**
 * Inicialización cuando el DOM está listo
 * - Configura la paginación si hay datos
 * - Maneja el autofocus del buscador
 */
document.addEventListener('DOMContentLoaded', function () {
    const table = document.getElementById('apprenticesTable');
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    const totalItems = rows.length;

    // Solo inicializar paginación si hay registros y no está en estado vacío
    if (totalItems > 0 && !tbody.querySelector('.empty-state')) {
        initPagination();
    }

    // Autofocus en el buscador si está vacío para UX
    const searchInput = document.getElementById('buscar');
    if (searchInput && !searchInput.value) {
        searchInput.focus();
    }
});

/**
 * Inicializa el sistema de paginación
 * - Configura variables de control
 * - Calcula páginas totales
 * - Genera controles de navegación
 * - Muestra la primera página
 */
function initPagination() {
    // Obtener referencias y calcular totales
    const table = document.getElementById('apprenticesTable');
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    const totalItems = rows.length;
    const itemsPerPage = 10; // Número de registros por página
    let currentPage = 1;
    const totalPages = Math.ceil(totalItems / itemsPerPage);

    // Actualizar contador total (variable global desde PHP)
    document.getElementById('totalItems').textContent = totalItemsCount;

    // Inicializar información de paginación
    updatePaginationInfo();

// Generar controles de paginación
generatePaginationControls(totalPages);

// Mostrar primera página
showPage(currentPage);

function showPage(page) {
    currentPage = page;
    const startIndex = (page - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;

    // Ocultar todas las filas
    rows.forEach(row => row.style.display = 'none');

    // Mostrar solo las filas de la página actual
    for (let i = startIndex; i < endIndex && i < totalItems; i++) {
        rows[i].style.display = '';
    }

    // Actualizar información de paginación
    updatePaginationInfo();

    // Actualizar controles de paginación
    updatePaginationControls();
}

function updatePaginationInfo() {
    const startIndex = (currentPage - 1) * itemsPerPage + 1;
    const endIndex = Math.min(currentPage * itemsPerPage, totalItems);
    document.getElementById('currentItems').textContent = `${startIndex}-${endIndex}`;
}

function generatePaginationControls(totalPages) {
    const paginationContainer = document.getElementById('pagination');
    paginationContainer.innerHTML = '';

    // Información de página
    const pageInfo = document.createElement('span');
    pageInfo.className = 'page-info';
    pageInfo.textContent = `Página ${currentPage} de ${totalPages}`;
    paginationContainer.appendChild(pageInfo);

    // Botón Anterior
    const prevButton = document.createElement('a');
    prevButton.href = '#';
    prevButton.innerHTML = '&laquo; Anterior';
    prevButton.addEventListener('click', (e) => {
        e.preventDefault();
        if (currentPage > 1) showPage(currentPage - 1);
    });
    paginationContainer.appendChild(prevButton);

    // Botón Siguiente
    const nextButton = document.createElement('a');
    nextButton.href = '#';
    nextButton.innerHTML = 'Siguiente &raquo;';
    nextButton.addEventListener('click', (e) => {
        e.preventDefault();
        if (currentPage < totalPages) showPage(currentPage + 1);
    });
    paginationContainer.appendChild(nextButton);
}

function updatePaginationControls() {
    const paginationLinks = document.querySelectorAll('#pagination a');
    paginationLinks.forEach(link => link.classList.remove('disabled'));

    // Deshabilitar botones anterior/siguiente si es necesario
    if (currentPage === 1) {
        paginationLinks[0].classList.add('disabled');
    }

    if (currentPage === totalPages) {
        paginationLinks[1].classList.add('disabled');
    }

    // Actualizar el texto de la página actual
    const pageInfo = document.querySelector('#pagination .page-info');
    if (pageInfo) {
        pageInfo.textContent = `Página ${currentPage} de ${totalPages}`;
    }
}
        }