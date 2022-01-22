export default function searchPortalSubmit() {
    // const html = document.querySelector('html');
    // const localisationName = html.getAttribute('lang');
    // let searchMessage = '';

    const searchPortalForm = document.getElementById('form-search-site');
    const searchPortalToggler = document.querySelectorAll('.js-header_sign-search');
    // const searchError = document.getElementById('form-search-site-error');

    const searchPortalSmForm = document.getElementById('form-search-site-sm');
    const searchPortalSmFormClose = document.querySelector('.form-search-sm_close');

    const searchMobileOpen = document.querySelector('.menu-m_search');
    const searchMobileForm = document.getElementById('form-search-mobile');
    const searchMobileContainer = document.querySelector('.header_find');
    const searchMobileClose = document.querySelector('.form-search-m_close');
    // const searchMobileError = document.getElementById('form-search-mobile-error');
    const menuHeaderSm = document.querySelector('.menu');

    // (localisationName === 'en' ? (searchMessage = 'Fill in the field (at least 3 characters)') : '');
    // (localisationName === 'ua' ? (searchMessage = 'Заповніть поле ( мінімум 3 символи )') : '');

    if (searchPortalForm) {
        searchPortalForm.onsubmit = function(e) {
            e.preventDefault();
            e.stopPropagation();
            const inputSearchLength = (this.elements.key.value.trim().length >= 1);
            if (inputSearchLength) {
                // searchError.innerHTML = '';
                // searchError.style.display = 'none';
                this.submit();
            } else {
                // searchError.innerHTML = searchMessage;
                // searchError.style.display = 'block';
                return;
            }
            localStorage.setItem('searchPortalKey', this.elements.key.value.trim());
        };
        /* searchPortalForm.elements.key.addEventListener('keyup', function () {
            let val = this.value.trim().length;
            if ( val >= 1 ) {
                searchError.innerHTML = '';
                searchError.style.display = 'none';
            }
        }); */
    }

    if (searchPortalSmForm) {
        searchPortalSmForm.onsubmit = function(e) {
            e.preventDefault();
            e.stopPropagation();
            const inputSearchLength = (this.elements.key.value.trim().length >= 1);
            if (inputSearchLength) {
                // searchError.innerHTML = '';
                // searchError.style.display = 'none';
                this.submit();
            } else {
                // searchError.innerHTML = searchMessage;
                // searchError.style.display = 'block';
                return;
            }
            localStorage.setItem('searchPortalKey', this.elements.key.value.trim());
        };
        /* searchPortalSmForm.elements.key.addEventListener('keyup', function () {
            let val = this.value.trim().length;
            if ( val >= 3 ) {
                searchError.innerHTML = '';
                searchError.style.display = 'none';
            }
        }); */
    }
    if (searchMobileForm) {
        searchMobileForm.onsubmit = function(e) {
            e.preventDefault();
            e.stopPropagation();
            const inputSearchLength = (this.elements.key.value.trim().length >= 1);
            if (inputSearchLength) {
                // searchMobileError.innerHTML = '';
                // searchMobileError.style.display = 'none';
                this.submit();
            } else {
                // searchMobileError.innerHTML = searchMessage;
                // searchMobileError.style.display = 'block';
                return;
            }
            localStorage.setItem('searchPortalKey', this.elements.key.value.trim());
        };
        /* searchMobileForm.elements.key.addEventListener('keyup', function () {
            let val = this.value.trim().length;
            if ( val >= 3 ) {
                searchMobileError.innerHTML = '';
                searchMobileError.style.display = 'none';
            }
        }); */
    }

    if (searchMobileOpen) {
        searchMobileOpen.addEventListener('click', () => {
            if (!searchMobileContainer.className.includes('open')) searchMobileContainer.classList.add('open');
        });
    }
    if (searchMobileClose) {
        searchMobileClose.addEventListener('click', () => {
            if (searchMobileContainer.className.includes('open')) searchMobileContainer.classList.remove('open');
        });
    }
    if (searchPortalToggler.length) {
        searchPortalToggler.forEach((item) => {
            item.addEventListener('click', () => {
                $(menuHeaderSm).fadeOut();
                $(searchPortalToggler).fadeOut();
                if (!searchPortalSmForm.className.includes('open')) searchPortalSmForm.classList.add('open');
            });
        });
    }
    if (searchPortalSmForm) {
        searchPortalSmFormClose.addEventListener('click', () => {
            $(menuHeaderSm).fadeIn();
            $(searchPortalToggler).fadeIn();
            if (searchPortalSmForm.className.includes('open')) searchPortalSmForm.classList.remove('open');
        });
    }
}
