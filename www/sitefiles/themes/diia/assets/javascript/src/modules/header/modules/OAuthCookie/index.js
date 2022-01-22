// const axios = require('axios');

export default class OAuthCookie {
    constructor() {
        this.settings();
        this.bindEvents();
    }
    settings() {
        this.sign_cabinet = document.getElementById('header_sign');
        this.sign_cabinet_auth = document.getElementById('header_sign-auth');
        this.sign_cabinet_mob = document.getElementById('header_sign-mob');
        this.sign_cabinet_auth_mob = document.getElementById('header_sign-mob-auth');
        this.btnSign = document.querySelectorAll('.js-btn_sign');
        this.btnSignAuth = document.querySelectorAll('.js-btn_sign-auth');
        /* for clear cache then 301 error */
        // fetch('https://my.diia.gov.ua', { method: 'post' }).then((e) => { console.log(e); });
        /* for clear cache then 301 error */
        /*
		axios({
			method: 'post',
			url: 'https://my.diia.gov.ua',
			data: {}
		})
			.then((response) => {
				console.log(response);
			})
			.catch((error) => {
				console.log(error);
			});
		*/
        /*
		if (this.btnSign.length) {
			this.btnSign.forEach((item) => {
				item.addEventListener('click', (e) => {
					console.log(e);
					e.preventDefault();
					// document.forms[0].submit();
					// window.location.assign(' https://my.diia.gov.ua/');
				});
			});
		}
		if (this.btnSignAuth.length) {
			this.btnSignAuth.forEach((item) => {
				item.addEventListener('click', (e) => {
					console.log(e);
					e.preventDefault();
					// document.forms[0].submit();
					// window.location.assign(' https://my.diia.gov.ua/');
				});
			});
		}
		*/
    }
    bindEvents() {
        const Cookie = this.getCookie('jwt');

        if (!Cookie && this.sign_cabinet && this.sign_cabinet_mob) {
            this.sign_cabinet.style.display = 'flex';
            this.sign_cabinet_mob.style.display = 'block';
            return;
        }
        this.renderUserInfo(Cookie);
    }
    renderUserInfo(response) {
        const parseStr = response ? JSON.parse(response) : '';
        const name = parseStr.first_name ? parseStr.first_name : '';
        const lastName = parseStr.last_name ? ` ${parseStr.last_name}` : ''; // Призвіще
        // const middleName = response.middle_name ? response.middle_name : '';

        if (this.sign_cabinet_auth) {
            if (!this.sign_cabinet_auth.classList.contains('auth')) {
                this.sign_cabinet_auth.classList.add('auth');
                const btnShowUser = this.sign_cabinet_auth.querySelector('.js-btn_sign-auth');
                btnShowUser.innerHTML = '';
                btnShowUser.innerHTML += name;
                btnShowUser.innerHTML += lastName;
            }
        }

        if (this.sign_cabinet_auth_mob) {
            if (!this.sign_cabinet_auth_mob.classList.contains('auth')) {
                this.sign_cabinet_auth_mob.classList.add('auth');
                const btnShowUser = this.sign_cabinet_auth_mob.querySelector('.js-btn_sign-auth');
                btnShowUser.innerHTML = '';
                btnShowUser.innerHTML += name;
                btnShowUser.innerHTML += lastName;
            }
        }
    }
    getCookie(name) {
        const reg = `(?:^|; )${name.replace(/([.$?*|{}()[]\\\/\+^])/g, '\\$1')}=([^;]*)`;
        const matches = document.cookie.match(new RegExp(reg));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }
}
