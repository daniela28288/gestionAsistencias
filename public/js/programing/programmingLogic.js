$(document).ready(function () {
    /* ======================
       SELECT2
    ======================= */
    $('#ficha').select2({ placeholder: 'Seleccione o busque un programa', allowClear: true });
    $('#instructores').select2({ placeholder: 'Seleccione un instructor', allowClear: true });
    $('#towns').select2({ placeholder: 'Seleccione un municipio', allowClear: true });
    $('#classRoom').select2({ placeholder: 'Seleccione un ambiente', allowClear: true });
    $('#ficha_programa').select2({ placeholder: 'Seleccione o busque un programa', allowClear: true });

    // ========================================
    // 1. Filtrar tabla al seleccionar un valor
    // ========================================
    $('#ficha_programa').on('change', function () {

        let valor = $(this).val();

        if (!valor) {
            $('#tabla_programas tbody tr').show();
            return;
        }

        $('#tabla_programas tbody tr').each(function () {
            let idFila = $(this).data('id');
            $(this).toggle(idFila == valor);
        });

    });


    // ================================
    //  Solo permitir letras en Select2
    // ================================
    $('#ficha_programa').on('select2:open', function () {

        let searchField = $('.select2-search__field');

        searchField.off('input').on('input', function () {

            let texto = $(this).val();

            // Reemplaza todo lo que NO sea letra o espacio
            texto = texto.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ ]/g, '');

            $(this).val(texto);
        });

    });

    /* ======================
           BOTONES DE DÍAS
       ======================= */
    const botones = document.querySelectorAll('.dia');
    const label = document.getElementById('contador');
    let cantDay = 0;

    label.textContent = 'Ningún día seleccionado';

    botones.forEach(boton => {
        boton.addEventListener('click', () => {
            const checkbox = boton.querySelector('.check');
            checkbox.checked = !checkbox.checked;

            boton.style.backgroundColor = checkbox.checked ? '#236b15c4' : '';
            boton.style.color = checkbox.checked ? '#fff' : 'gray';

            cantDay += checkbox.checked ? 1 : -1;
            label.textContent =
                cantDay === 0
                    ? 'Ningún día seleccionado'
                    : cantDay === 1
                        ? '1 día seleccionado'
                        : `${cantDay} días seleccionados`;
        });
    });
});