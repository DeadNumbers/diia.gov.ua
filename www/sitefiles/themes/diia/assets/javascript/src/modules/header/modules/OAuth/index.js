const axios = require('axios');

export default class OAuth {
    constructor() {
        this.settings();
        this.CheckEnv();
        this.bindEvents();
    }
    settings() {
        this.clientId = 'diia-portal';
        this.clientSecret = 'Uh7xIfASuG5rA940aBEJ33LK2MgjtsJFQVTXQhlCjDrV6ttUI7RAmj7umY5CufJZ';
        this.redirectUri = window.location.origin;
        this.code = '';
        this.access_token = '';
        this.sign_cabinet = document.getElementById('header_sign');
        this.sign_cabinet_auth = document.getElementById('header_sign-auth');
        this.sign_cabinet_mob = document.getElementById('header_sign-mob');
        this.sign_cabinet_auth_mob = document.getElementById('header_sign-mob-auth');
        this.authUrl = `authorise?redirect_uri=${this.redirectUri}/&client_id=${this.clientId}`;
        this.urlCabinet = 'https://id.diia.gov.ua';
        this.envStatus = 'prod';
        this.envProdRedirect = 'https://my.diia.gov.ua/';
    }
    sendRequestToken() {
        axios.post(`${this.urlCabinet}/oauth/token`,
            `grant_type=authorization_code&code=${this.code}&client_id=${this.clientId}&client_secret=${this.clientSecret}`, { headers: { 'Content-Type': 'application/x-www-form-urlencoded' } })
            .then((response) => {
                // console.log(response);
                const data = response.data ? response.data : '';
                if (data && data.access_token && data.refresh_token) {
                    localStorage.setItem('AT', data.access_token);
                    this.access_token = localStorage.getItem('AT');
                    console.log(this.access_token);
                    this.sendRequestUserInfo();
                }
            })
            .catch((error) => {
                console.log(error);
            });
    }
    CheckEnv() {
        const { href } = window.location;
        if (href.includes('kitsoft.kiev.ua')) {
            this.envStatus = 'stage';
            this.clientId = 'october';
            this.clientSecret = '6qdwlY6i3KqUa7f73hhYGShvL4XFcvz5LoHe2r5Bk2HVtXJUZZgtKhSeBMZJzS40';
            this.urlCabinet = 'https://id-dpss.kitsoft.kiev.ua';
        } else if (href.includes('diia.test')) {
            this.envStatus = 'local';
        }
    }
    parseCodeFromUrl() {
        if ((/\?code=/i).test(window.location.search)) {
            [, this.code] = window.location.search.split('=');
            window.history.replaceState(null, '', this.redirectUri);
            if (this.code.length) {
                this.sendRequestToken();
                return true;
            }
        }
        return false;
    }
    bindEvents() {
        this.updateLinkUrls();
        const hasUrl = this.parseCodeFromUrl();
        this.access_token = localStorage.getItem('AT') ? localStorage.getItem('AT') : '';
        if (this.access_token && !hasUrl) {
            // console.log(this.access_token);
            this.sendRequestUserInfo();
            if (this.envStatus === 'prod') window.location.href = `${this.envProdRedirect}`;
        }
        if (!this.access_token && !hasUrl) {
            this.sign_cabinet.style.display = 'flex';
            this.sign_cabinet_mob.style.display = 'block';
        }
    }
    sendRequestUserInfo() {
        axios.get(`${this.urlCabinet}/user/info?access_token=${this.access_token}`)
            .then((response) => {
                // console.log(response);
                this.renderUserInfo(response);
            })
            .catch((error) => {
                console.log(error);
                this.notValidToken();
            });
    }
    renderUserInfo(response) {
        const data = response.data ? response.data : '';
        if (data) {
            const name = data.first_name ? data.first_name : '';
            const middleName = data.middle_name ? data.middle_name : '';
            const lastName = data.last_name ? ` ${data.last_name}` : ''; // Призвіще
            console.log(name, lastName, middleName);

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
    }
    notValidToken() {
        this.sign_cabinet.style.display = 'flex';
        this.sign_cabinet_mob.style.display = 'block';
        this.sign_cabinet_auth.classList.remove('auth');
        this.sign_cabinet_auth_mob.classList.remove('auth');
        const btnShowUser = document.querySelectorAll('.js-btn_sign-auth');
        if (btnShowUser.length) {
            btnShowUser.forEach((item) => {
                const btn = item;
                btn.innerHTML = '';
            });
        }
    }
    updateLinkUrls() {
        const btnRegisters = document.querySelectorAll('.btn_register');
        const btnSigns = document.querySelectorAll('.btn_sign');
        if (btnRegisters.length) {
            btnRegisters.forEach((item) => {
                item.setAttribute('href', `${item.getAttribute('href')}${this.authUrl}`);
            });
        }
        if (btnSigns.length) {
            btnSigns.forEach((item) => {
                item.setAttribute('href', `${item.getAttribute('href')}${this.authUrl}`);
            });
        }
    }
}
