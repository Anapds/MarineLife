document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.querySelector('#menu-toggle');
    const siteNav = document.querySelector('#site-nav');

    if (!menuToggle || !siteNav) {
        return;
    }

    menuToggle.addEventListener('click', () => {
        const menuAberto = siteNav.classList.toggle('is-open');

        menuToggle.setAttribute('aria-expanded', String(menuAberto));
        menuToggle.setAttribute(
            'aria-label',
            menuAberto ? 'Fechar menu' : 'Abrir menu'
        );
    });

    siteNav.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => {
            siteNav.classList.remove('is-open');
            menuToggle.setAttribute('aria-expanded', 'false');
            menuToggle.setAttribute('aria-label', 'Abrir menu');
        });
    });
});
