$(document).ready(function () {
    /* ======================
       SELECT2
    ======================= */
    $('#ficha').select2({ placeholder: 'Seleccione o busque un programa', allowClear: true });
    $('#instructores').select2({ placeholder: 'Seleccione un instructor', allowClear: true });
    $('#towns').select2({ placeholder: 'Seleccione un municipio', allowClear: true });
    $('#classRoom').select2({ placeholder: 'Seleccione un ambiente', allowClear: true });

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

            if (checkbox.checked) {
                boton.classList.add('selected');
                cantDay++;
            } else {
                boton.classList.remove('selected');
                cantDay--;
            }

            label.textContent =
                cantDay === 0
                    ? 'Ningún día seleccionado'
                    : cantDay === 1
                        ? '1 día seleccionado'
                        : `${cantDay} días seleccionados`;
        });
    });
});