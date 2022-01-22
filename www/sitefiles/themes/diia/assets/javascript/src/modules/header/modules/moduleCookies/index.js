export default class ModuleCookies {
    constructor() {
        this.settings();
        // this.texts();
        this.bindEvents();
    }
    settings() {
        this.container = document.querySelector('.js-cookies');
        /* block 1 */
        this.firstScreen = this.container ? this.container.querySelector('.js-cookies-1') : '';
        this.firstScreenClose = this.firstScreen ? this.firstScreen.querySelector('.cookies-1_close') : '';
        this.firstScreenBtn1 = this.firstScreen ? this.firstScreen.querySelector('.cookies-1_btn-1') : '';
        this.firstScreenBtn2 = this.firstScreen ? this.firstScreen.querySelector('.cookies-1_btn-2') : '';
        /* block 2 */
        this.secondScreen = this.container ? this.container.querySelector('.js-cookies-2') : '';
        this.secondScreenClose = this.secondScreen ? this.secondScreen.querySelector('.cookies-2_close') : '';
        this.secondScreenBtn1 = this.secondScreen ? this.secondScreen.querySelector('.js-cookies-2_btn-1') : '';
        /* collapse buttons */
        this.accButtons = this.container.querySelectorAll('.js-cookies-2-acc_i-btn');
    }
    // texts() {}
    bindEvents() {
        if (!this.container || !this.firstScreen) return;

        if (this.firstScreenClose) {
            this.firstScreenClose.addEventListener('click', () => {
                $(this.container).fadeOut(300);
            });
        }

        if (this.firstScreenBtn1) {
            this.firstScreenBtn1.addEventListener('click', () => {
                this.setCookie('front_site', true);
                $(this.container).fadeOut(300);
            });
        }

        if (this.firstScreenBtn2) {
            this.firstScreenBtn2.addEventListener('click', () => {
                this.showScreenSecond();
            });
        }

        if (this.secondScreenClose) {
            this.secondScreenClose.addEventListener('click', () => {
                $(this.container).fadeOut(300);
                setTimeout(() => {
                    $(this.secondScreen).fadeOut();
                }, 500);
            });
        }

        if (this.secondScreenBtn1) {
            this.secondScreenBtn1.addEventListener('click', () => {
                this.setCookie('front_site', true);
                $(this.container).fadeOut(300);
            });
        }

        if (this.accButtons.length) {
            this.accButtons.forEach((item) => {
                item.addEventListener('click', () => {
                    item.classList.toggle('active');
                    $(item.parentElement.nextElementSibling).collapse('toggle');
                });
            });
        }

        if (!this.getCookie('front_site')) $(this.container).fadeIn();
    }
    showScreenSecond() {
        this.firstScreen.style.display = 'none';
        $(this.secondScreen).fadeIn();
    }
    getCookie(name) {
        const matches = document.cookie.match(new RegExp(
            `(?:^|; )${name.replace(/([.$?*|{}()[]\\\/+^])/g, '\\$1')}=([^;]*)`
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }
    setCookie(name, value, options = {}) {
        const newOptions = {
            path: '/',
            'max-age': 2592000,
            // при необходимости добавьте другие значения по умолчанию
            ...options
        };

        if (newOptions.expires instanceof Date) {
            newOptions.expires = newOptions.expires.toUTCString();
        }

        let updatedCookie = `${encodeURIComponent(name)}=${encodeURIComponent(value)}`;

        Object.keys(newOptions).forEach((optionKey) => {
            updatedCookie += `; ${optionKey}`;
            const optionValue = newOptions[optionKey];
            if (optionValue !== true) {
                updatedCookie += `=${optionValue}`;
            }
        });

        document.cookie = updatedCookie;
    }
    deleteCookie(name) {
        this.setCookie(name, '', {
            'max-age': -1
        });
    }
}
