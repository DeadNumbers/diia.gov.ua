// const bodyScrollLock = require('body-scroll-lock');
// const disableBodyScroll = bodyScrollLock.disableBodyScroll;
// const enableBodyScroll = bodyScrollLock.enableBodyScroll;

export default function menuAnimPc() {
    const links = document.querySelectorAll('.menu_list-link-sub');
    const subMenu = document.querySelectorAll('.menu-sub');
    const overlay = document.querySelector('.overlay-full-screen');
    const Body = document.querySelector('body');
    const bgHeader = document.querySelector('.header_fixed-inner');
    links.forEach((elem) => {
        elem.addEventListener('click', () => {
            const windowWidth = window.innerWidth;
            const windowWidthWithScroll = $(window).width();
            const diffWidth = windowWidth - windowWidthWithScroll;
            console.log(diffWidth);
            if (elem.className.includes('active')) {
                if (bgHeader) {
                    if (bgHeader.className.includes('active')) bgHeader.classList.remove('active');
                }
                elem.classList.remove('active');
                subMenu.forEach((submenu) => {
                    if (submenu.className.includes('active')) submenu.classList.remove('active');
                    // $(submenu.firstElementChild).fadeOut(300);
                });
                $(overlay).fadeOut(400, () => {
                    console.log('Animation complete');
                    Body.style.paddingRight = 0;
                    if (Body.className.includes('menu-opened')) Body.classList.remove('menu-opened');
                });
                return;
            }
            if (!Body.className.includes('menu-opened')) Body.classList.add('menu-opened');
            Body.style.paddingRight = `${diffWidth}px`;
            links.forEach((item) => {
                if (item.className.includes('active')) item.classList.remove('active');
                $(item.firstElementChild).fadeOut(300);
            });
            subMenu.forEach((submenu) => {
                if (submenu.className.includes('active')) submenu.classList.remove('active');
            });
            const getMenuItem = document.getElementById(elem.getAttribute('data-menu-target'));
            getMenuItem.classList.add('active');
            $(getMenuItem.firstElementChild).fadeIn(600);
            elem.classList.add('active');
            $(overlay).fadeIn(400);
            if (bgHeader) {
                if (!bgHeader.className.includes('active')) {
                    setTimeout(() => {
                        bgHeader.classList.add('active');
                    }, 400);
                }
            }
        });
    });
    if (overlay) {
        overlay.addEventListener('click', () => {
            links.forEach((item) => {
                if (item.className.includes('active')) item.classList.remove('active');
            });
            subMenu.forEach((submenu) => {
                if (submenu.className.includes('active')) submenu.classList.remove('active');
                // $(submenu.firstElementChild).fadeOut(300);
                $(overlay).fadeOut(400, () => {
                    console.log('Animation complete');
                    Body.style.paddingRight = 0;
                    if (Body.className.includes('menu-opened')) Body.classList.remove('menu-opened');
                });
            });
            if (bgHeader) {
                if (bgHeader.className.includes('active')) bgHeader.classList.remove('active');
            }
        });
    }
}
