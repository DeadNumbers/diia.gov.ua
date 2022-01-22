export default function countMenuWidth() {
    class ReplaceMenu {
        constructor() {
            this.handleResize();
            window.addEventListener('resize', () => {
                this.handleResize();
            });
        }
        settings() {
            this.menu = document.getElementById('menuDesktop');
            this.show_more = document.getElementById('show_more');
            this.menuWidth = (this.menu ? $(this.menu).width() : '');
            if (!this.menu.children.length) return;
            this.header = document.getElementById('layout-header');
            this.menuItems = this.menu.children[0].children;
        }
        bindEvents() {
            this.desctop = window.innerWidth >= 992;
            if (this.desctop) this.checkMenuWidth();
        }
        checkMenuWidth() {
            let width = '';
            if (this.menuItems) {
                for (let i = 0; i < this.menuItems.length; i++) {
                    if (this.menuItems[i]) {
                        width = Number(width) + Math.ceil($(this.menuItems[i]).outerWidth(true));
                        if (width > this.menuWidth) {
                            $(this.menu).addClass('more-items');
                            this.show_more.classList.remove('d-none');
                            this.toggleEvent();
                        } else {
                            this.show_more.classList.add('d-none');
                            $(this.menu).removeClass('more-items');
                        }
                    }
                }
            }
        }
        toggleEvent() {
            if (this.show_more) {
                this.show_more.onclick = () => {
                    $(this.show_more).toggleClass('active');
                    $(this.menu).toggleClass('show-items');
                };
            }
        }
        handleResize() {
            this.settings();
            this.bindEvents();
        }
    }

    return new ReplaceMenu();
}
