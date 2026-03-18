document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const menuButton = document.querySelector('.menu-button');
    const closeButton = document.getElementById('sidebarClose');

    function openSidebar () {
        sidebar.classList.add('is-open');
        overlay.classList.add('is-visible');
    }

    function closeSidebar () {
        sidebar.classList.remove('is-open');
        overlay.classList.remove('is-visible');
    }

    if (menuButton) menuButton.addEventListener('click', openSidebar);
    if (closeButton) closeButton.addEventListener('click', closeSidebar);
    if (overlay) overlay.addEventListener('click', closeSidebar);
});