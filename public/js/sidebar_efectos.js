
document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebarMenu = document.querySelector('.sidebar-menu');
    const arrow = document.querySelector('.icon-sidebar');
    const arrowTop = document.querySelector('.hidden');
    const mainContent = document.getElementById('main-content');
    const notificationBell = document.getElementById('notificationBell');
    const notificationsPanel = document.getElementById('notificationsPanel');
    const markAllRead = document.getElementById('markAllRead');

    // Función para alternar el menú lateral
    sidebarToggle.addEventListener('click', function () {
        if (window.innerWidth > 768) {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');

        } else {
            sidebar.classList.toggle('active');
        }
    });

    // Cerrar submenús al hacer clic fuera en móviles
    document.addEventListener('click', function (event) {
        if (window.innerWidth <= 768 &&
            sidebar.classList.contains('active') &&
            !sidebar.contains(event.target) &&
            !sidebarToggle.contains(event.target)) {
            sidebar.classList.remove('active');
        }
    });

    // Manejo de submenús
    document.querySelectorAll('.menu-toggle').forEach(menu => {
        const handler = function (e) {
            const isCollapsed = sidebar.classList.contains('collapsed');

            if ((e.type === 'mouseenter' && !isCollapsed) ||
                (e.type === 'click' && isCollapsed)) {
                sidebarMenu.style.maxHeight = 'none';
                return
            }



            if (window.innerWidth <= 768) {
                e.stopPropagation();
            }

            const submenu = this.nextElementSibling;

            document.querySelectorAll('.sidebar-menu ul').forEach(ul => {
                if (ul !== submenu) {
                    ul.classList.remove('show');
                    if (ul.previousElementSibling) {
                        ul.previousElementSibling.classList.remove('active');
                    }

                }
            });

            submenu.classList.toggle('show');
            this.classList.toggle('active');
        }

        menu.addEventListener('click', handler);
        menu.addEventListener('mouseenter', handler);
    });


    // Notificaciones
    notificationBell.addEventListener('click', function (e) {
        e.stopPropagation();
        notificationsPanel.classList.toggle('show');
        notificationBell.classList.remove('alert');
    });

    document.addEventListener('click', function () {
        notificationsPanel.classList.remove('show');
    });

    notificationsPanel.addEventListener('click', function (e) {
        e.stopPropagation();
    });

    markAllRead.addEventListener('click', function () {
        notificationBell.querySelector('.notification-counter')?.remove();
        notificationsPanel.classList.remove('show');
        alert('Todas las notificaciones han sido marcadas como leídas');
    });

    // Animación de alerta si hay notificaciones urgentes
    const urgentNotifications = document.querySelectorAll('.notification-item.urgent');
    if (urgentNotifications.length > 0) {
        notificationBell.classList.add('alert');
    }

    // Ajustar layout inicial
    function adjustLayout() {
        if (window.innerWidth <= 768) {
            sidebar.classList.remove('collapsed');
            mainContent.classList.remove('expanded');
        }
    }

    window.addEventListener('resize', adjustLayout);
    adjustLayout();
});
