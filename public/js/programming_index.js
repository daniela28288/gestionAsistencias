document.addEventListener('DOMContentLoaded', function () {
    const programFilter = document.getElementById('program-filter');
    const statusFilter = document.getElementById('status-filter');
    const resetBtn = document.getElementById('reset-filters');
    const rows = document.querySelectorAll('#programming-table tbody tr');
    const noResults = document.getElementById('no-results');

    function applyFilters() {
        const selectedProgram = programFilter.value.toLowerCase();
        const selectedStatus = statusFilter.value.toLowerCase();
        let visibleRows = 0;

        rows.forEach(row => {
            const program = row.getAttribute('data-program').toLowerCase();
            const status = row.getAttribute('data-status').toLowerCase();
            const disponible = row.getAttribute('data-disponible');

            const programMatch = selectedProgram === '' || program.includes(selectedProgram);
            let statusMatch = selectedStatus === '' || status === selectedStatus;

            // Caso especial para filtrar por "disponible"
            if (selectedStatus === 'disponible') {
                statusMatch = disponible === 'true';
            }

            if (programMatch && statusMatch) {
                row.style.display = '';
                visibleRows++;
            } else {
                row.style.display = 'none';
            }
        });

        // Mostrar mensaje si no hay resultados
        if (visibleRows === 0) {
            noResults.style.display = 'block';
        } else {
            noResults.style.display = 'none';
        }
    }

    // Event listeners
    programFilter.addEventListener('change', applyFilters);
    statusFilter.addEventListener('change', applyFilters);

    resetBtn.addEventListener('click', function () {
        programFilter.value = '';
        statusFilter.value = '';
        applyFilters();
    });

    document.getElementById('export-excel').addEventListener('click', function () {
        // Obtener la tabla
        const table = document.getElementById('programming-table');

        // Obtener todas las filas visibles (considerando los filtros)
        const visibleRows = Array.from(table.querySelectorAll('tbody tr')).filter(row =>
            row.style.display !== 'none'
        );

        // Preparar los datos
        const data = [];

        // Obtener encabezados (excluyendo la columna Acción)
        const headers = [];
        const headerCells = table.querySelectorAll('thead tr th');
        headerCells.forEach((cell, index) => {
            // Excluir la columna "Acción" (última columna)
            if (index < headerCells.length - 1) {
                headers.push(cell.textContent.trim());
            }
        });
        data.push(headers);

        // Obtener datos de cada fila visible
        visibleRows.forEach(row => {
            const rowData = [];
            const cells = row.querySelectorAll('td');

            cells.forEach((cell, index) => {
                // Excluir la columna "Acción" (última columna)
                if (index < cells.length - 1) {
                    let cellValue;

                    // Caso especial para estado (columna 10)
                    if (index === 9) {
                        const statusBadge = cell.querySelector('.status-badge');
                        if (statusBadge) {
                            // Obtener solo el texto, eliminando iconos y espacios extra
                            cellValue = statusBadge.textContent.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ()\s]/g, '').trim();
                        } else {
                            cellValue = cell.textContent.trim();
                        }
                    }
                    // Caso especial para duración (columna 5)
                    else if (index === 5) {
                        cellValue = cell.textContent.trim().replace('hrs', '').trim();
                    }
                    // Para las demás columnas
                    else {
                        cellValue = cell.textContent.trim();
                    }

                    rowData.push(cellValue);
                }
            });

            data.push(rowData);
        });

        // Crear libro de trabajo
        const wb = XLSX.utils.book_new();
        const ws = XLSX.utils.aoa_to_sheet(data);

        // Aplicar estilos a las celdas
        if (!ws['!cols']) ws['!cols'] = [];

        // Definir anchos de columnas
        const colWidths = [
            { wch: 5 },   // #
            { wch: 25 },  // Programa
            { wch: 10 },  // Ficha
            { wch: 25 },  // Instructor
            { wch: 30 },  // Competencia
            { wch: 10 },  // Duración
            { wch: 15 },  // Ambiente
            { wch: 12 },  // Fecha Inicio
            { wch: 12 },  // Fecha Fin
            { wch: 20 },  // Horario
            { wch: 25 }   // Estado
        ];

        ws['!cols'] = colWidths;

        // Estilo para los encabezados
        const headerStyle = {
            font: { bold: true, color: { rgb: "FFFFFF" } },
            fill: { fgColor: { rgb: "4472C4" } }, // Azul corporativo
            alignment: { horizontal: "center" },
            border: {
                top: { style: "thin", color: { rgb: "000000" } },
                bottom: { style: "thin", color: { rgb: "000000" } },
                left: { style: "thin", color: { rgb: "000000" } },
                right: { style: "thin", color: { rgb: "000000" } }
            }
        };

        // Aplicar estilo a los encabezados
        for (let col = 0; col < headers.length; col++) {
            const cellAddress = XLSX.utils.encode_cell({ r: 0, c: col });
            if (!ws[cellAddress]) continue;

            ws[cellAddress].s = headerStyle;
        }

        // Estilo para las celdas de datos
        const dataStyle = {
            font: { name: "Calibri", sz: 11 },
            alignment: { vertical: "center" },
            border: {
                top: { style: "thin", color: { rgb: "D9D9D9" } },
                bottom: { style: "thin", color: { rgb: "D9D9D9" } },
                left: { style: "thin", color: { rgb: "D9D9D9" } },
                right: { style: "thin", color: { rgb: "D9D9D9" } }
            }
        };

        // Aplicar estilo a los datos
        for (let row = 1; row < data.length; row++) {
            for (let col = 0; col < headers.length; col++) {
                const cellAddress = XLSX.utils.encode_cell({ r: row, c: col });
                if (!ws[cellAddress]) continue;

                // Si es la columna de duración, alinear a la derecha
                if (col === 5) {
                    ws[cellAddress].s = { ...dataStyle, alignment: { ...dataStyle.alignment, horizontal: "right" } };
                }
                // Si es la columna de estado, aplicar formato según estado
                else if (col === 10) {
                    const estado = ws[cellAddress].v;
                    let fillColor;

                    if (estado.includes("Pendiente")) fillColor = { rgb: "D0E3FF" };
                    else if (estado.includes("ejecución")) fillColor = { rgb: "FFF3BF" };
                    else if (estado.includes("Evaluada")) fillColor = { rgb: "D4EDDA" };
                    else if (estado.includes("Pendiente evaluación")) fillColor = { rgb: "F8D7DA" };
                    else fillColor = { rgb: "FFFFFF" };

                    ws[cellAddress].s = {
                        ...dataStyle,
                        fill: { fgColor: fillColor },
                        font: { ...dataStyle.font, bold: true }
                    };
                }
                // Para las demás celdas
                else {
                    ws[cellAddress].s = dataStyle;
                }
            }
        }

        // Añadir hoja al libro
        XLSX.utils.book_append_sheet(wb, ws, "Programaciones");

        // Generar archivo y descargar
        const fileName = `Programaciones_${new Date().toISOString().slice(0, 10)}.xlsx`;
        XLSX.writeFile(wb, fileName);
    });

    // Aplicar filtros iniciales si hay valores en la URL
    const urlParams = new URLSearchParams(window.location.search);
    const initialProgram = urlParams.get('program');
    const initialStatus = urlParams.get('status');

    if (initialProgram) {
        programFilter.value = initialProgram;
    }
    if (initialStatus) {
        statusFilter.value = initialStatus;
    }

    if (initialProgram || initialStatus) {
        applyFilters();
    }
});