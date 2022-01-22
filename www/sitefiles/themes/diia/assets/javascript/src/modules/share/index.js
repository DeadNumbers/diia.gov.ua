// import { fixPosition } from './modules/fixPosition';
import 'classlist-polyfill';
import 'nodelist-foreach-polyfill';

export default class InitShare {
    constructor() {
        // fixPosition();
        this.settings();
        this.bindEvents();

        /**
         * timeout because must wait likely.js updating share counters
         */

        /* setTimeout( () => {
            this.countShared();
            setTimeout( () => {
                this.countShared();
                setTimeout( () => {
                    this.countShared();
                    setTimeout( () => {
                        this.countShared();
                    },this.timeoutShareCheck);
                },this.timeoutShareCheck);
            },this.timeoutShareCheck);
        },this.timeoutShareCheck); */
    }
    settings() {
        this.href = window.location.href;
        this.shareCountAll = 0;
        this.counters = '';
        this.btnSelector = document.querySelectorAll('.btn-action');
        this.totalCounterWrapper = document.querySelector('.share__count');
        this.totalCounter = document.querySelector('.js-share-count');
        this.timeoutShareCheck = 500;
        this.dependencies = {
            facebook: 'https://www.facebook.com/share.php?u=',
            twitter: 'https://twitter.com/intent/tweet?url=',
            googleplus: 'https://plus.google.com/share?url=',
            link: 'https://www.linkedin.com/shareArticle?mini=true&url=',
            viber: 'https://3p3x.adj.st/?adjust_t=u783g1_kw9yml&adjust_fallback=https%3A%2F%2Fwww.viber.com%2F%3Futm_source%3DPartner%26utm_medium%3DSharebutton%26utm_campaign%3DDefualt&adjust_campaign=Sharebutton&adjust_deeplink=',
            whatsapp: 'whatsapp://send?text='
        };
    }
    openShareWindow(link) {
        window.open(link, 'connectWindow', 'width=800,height=600,scrollbars=yes');
    }
    createLink(type) {
        let link;
        Object.keys(this.dependencies).forEach((key) => {
            if ({}.hasOwnProperty.call(this.dependencies, key) && type === key) {
                link = this.dependencies[key] + encodeURIComponent(this.href);
                if (key === 'viber') {
                    link = this.dependencies[key] + encodeURIComponent(`viber://forward?text=${encodeURIComponent(`${this.href}`)}`);
                }
            }
        });
        this.openShareWindow(link);
    }
    bindEvents() {
        for (let i = 0; i < this.btnSelector.length; i++) {
            this.btnSelector[i].addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                let type;
                type = (e.target.hasAttribute('data-type') ? e.target.getAttribute('data-type') : '');
                type = (e.target.parentElement.hasAttribute('data-type') ? e.target.parentElement.getAttribute('data-type') : type);
                this.createLink(type);
            });
        }
    }
    countShared() {
        this.shareCountAll = 0;
        this.counters = document.querySelectorAll('.likely__counter');
        this.counters.forEach((element) => {
            this.shareCountAll += Number(element.innerHTML);
        });
        if (this.shareCountAll > 0 && !this.totalCounterWrapper.classList.contains('active')) {
            this.totalCounterWrapper.classList.add('active');
        }
        if (this.totalCounter) {
            this.totalCounter.innerText = this.shareCountAll;
        }
    }
}
