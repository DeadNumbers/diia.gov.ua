// const bodyScrollLock = require('body-scroll-lock');
// const disableBodyScroll = bodyScrollLock.disableBodyScroll;
// const enableBodyScroll = bodyScrollLock.enableBodyScroll;

export default function menuAnimMob() {
    // let enableScrollMenuMobile = document.querySelector('.menu-m');
    // let enableScrollSubMenuMobile = document.querySelectorAll('.menu-m-sub_wrap');
    function scrollTop() {
        (function smoothscroll() {
            const currentScroll = document.documentElement.scrollTop || document.body.scrollTop;
            if (currentScroll > 0) {
                window.requestAnimationFrame(smoothscroll);
                window.scrollTo(0, currentScroll - (currentScroll / 5));
            }
        }());
    }
    const openMenuMobile = document.querySelector('.js-header_toggle-icon');
    const closeMenuMobile = document.querySelector('.menu-m_close');
    const subCloseMenuMobile = document.querySelectorAll('.menu-m-sub-sub_close');
    const menuMobile = document.querySelector('.header_menu');
    const subMenuItems = document.querySelectorAll('.menu-m_link-childs');
    const subSubMenuItems = document.querySelectorAll('.menu-m-sub_link-childs');
    const subSubMenuItemsBack = document.querySelectorAll('.menu-m-sub-sub_back');

    const subSubMenus = document.querySelectorAll('.menu-m-sub-sub');
    const subMenusWrap = document.querySelectorAll('.menu-m-sub_wrap');
    const overlay = document.querySelector('.overlay-full-screen');
    const menuContent = document.querySelector('.menu-m');

    if (openMenuMobile && menuMobile) {
        openMenuMobile.addEventListener('click', () => {
            $(overlay).fadeIn(600);
            menuMobile.classList.add('open');
            document.body.classList.add('menu-opened');
            document.documentElement.classList.add('menu-opened');
            scrollTop();
            /* disableBodyScroll(enableScrollMenuMobile);
            if ( enableScrollSubMenuMobile.length ) {
                enableScrollSubMenuMobile.forEach( elem => {
                    disableBodyScroll(elem);
                });
            } */
        });
    }
    if (closeMenuMobile) {
        closeMenuMobile.addEventListener('click', () => {
            if (menuMobile.className.includes('open')) menuMobile.classList.remove('open');
            if (document.body.className.includes('menu-opened')) document.body.classList.remove('menu-opened');
            if (document.documentElement.className.includes('menu-opened')) {
                document.documentElement.classList.remove('menu-opened');
                $(overlay).fadeOut(600);
            }
            // bodyScrollLock.clearAllBodyScrollLocks();
        });
    }
    if (subMenuItems.length) {
        subMenuItems.forEach((elem) => {
            elem.addEventListener('click', function() {
                if (this.className.includes('open')) {
                    this.classList.remove('open');
                } else {
                    this.classList.add('open');
                }
                if (this.nextElementSibling) {
                    if (this.nextElementSibling.className.includes('open')) {
                        this.nextElementSibling.classList.remove('open');
                    } else {
                        this.nextElementSibling.classList.add('open');
                    }
                }
            });
        });
    }
    if (subSubMenuItems.length) {
        subSubMenuItems.forEach((elem) => {
            elem.addEventListener('click', function() {
                if (menuContent) {
                    menuContent.scrollTop = 0;
                    if (!menuContent.classList.contains('childs-open')) menuContent.classList.add('childs-open');
                }
                $('.header_sign-wrap').fadeOut(50);
                if (this.nextElementSibling) {
                    if (this.nextElementSibling.className.includes('open')) {
                        this.nextElementSibling.classList.remove('open');
                    } else {
                        this.nextElementSibling.classList.add('open');
                    }
                }
            });
        });
    }
    if (subSubMenuItemsBack.length) {
        subSubMenuItemsBack.forEach((elem) => {
            elem.addEventListener('click', function() {
                if (menuContent) {
                    menuContent.scrollTop = 0;
                    if (menuContent.classList.contains('childs-open')) menuContent.classList.remove('childs-open');
                }
                $('.header_sign-wrap').fadeIn(100);
                const parent = this.parentElement.parentElement;
                if (parent) {
                    if (parent.className.includes('open')) {
                        parent.classList.remove('open');
                    } else {
                        parent.classList.add('open');
                    }
                }
            });
        });
    }
    if (subCloseMenuMobile.length) {
        subCloseMenuMobile.forEach((elem) => {
            elem.addEventListener('click', () => {
                if (menuContent) {
                    menuContent.scrollTop = 0;
                    if (menuContent.classList.contains('childs-open')) menuContent.classList.remove('childs-open');
                }
                $(overlay).fadeOut(600);
                if (subSubMenus.length) {
                    subSubMenus.forEach((item) => {
                        if (item.className.includes('open')) item.classList.remove('open');
                    });
                }
                if (subMenusWrap.length) {
                    subMenusWrap.forEach((item) => {
                        if (item.className.includes('open')) item.classList.remove('open');
                    });
                }
                if (menuMobile.className.includes('open')) menuMobile.classList.remove('open');
                if (document.body.className.includes('menu-opened')) document.body.classList.remove('menu-opened');
                if (document.documentElement.className.includes('menu-opened')) {
                    document.documentElement.classList.remove('menu-opened');
                }
                subMenuItems.forEach((item) => {
                    item.classList.remove('open');
                });
                $('.header_sign-wrap').fadeIn(100);
                // bodyScrollLock.clearAllBodyScrollLocks();
            });
        });
    }
}
