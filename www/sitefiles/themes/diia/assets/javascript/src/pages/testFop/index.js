import Swiper from 'swiper';
import validateSendToEmail from '../../modules/validateSendToEmail';

/** testFop page * */
class TestFop {
    /** testFop page constructor * */
    constructor() {
        this.settings();
        this.bindEvents();
        validateSendToEmail('onPdfTaxSystemSendToMail');
    }
    /** Method for init plugins * */
    settings() {
        this.form = document.getElementById('form-t-fop');
        this.formCheckbox = (this.form ? this.form.querySelectorAll('input[type="checkbox"]') : '');
        this.formRadio = (this.form ? this.form.querySelectorAll('input[type="radio"]') : '');
        this.sliderContainer = (this.form ? this.form.querySelector('.swiper-container') : '');
        this.slides = (this.form ? this.form.querySelectorAll('.swiper-slide') : '');
        this.btnStart = (this.form ? this.form.querySelector('.btn-start') : '');
        this.btnPrev = (this.form ? this.form.querySelectorAll('.btn-prev') : '');
        this.btnNext = (this.form ? this.form.querySelectorAll('.btn-next') : '');
        this.btnNextNotRequired = (this.form ? this.form.querySelectorAll('.btn-next-not-required') : '');
        this.btnEnd = (this.form ? this.form.querySelector('.btn-end') : '');
        this.Slider = '';
        this.SliderItemsLengthAfterInsertSlide = '';
        this.preloader = (this.form ? this.form.querySelector('.form-t-fop_preloader') : '');
    }
    resetNextButtons() {
        const btn = this.form.querySelectorAll('.btn-next');
        [...btn].forEach((btnItem) => {
            if (!btnItem.className.includes('disabled')) btnItem.classList.add('disabled');
        });
    }
    countCheckedInputs() {
        const activeSlider = this.form.querySelector('.swiper-slide.swiper-slide-active');
        const inputChecked = activeSlider.querySelectorAll('input:checked').length;
        const btnNext = activeSlider.querySelector('.btn-next');
        const btnSkip = activeSlider.querySelector('.btn-next-not-required');
        if (!inputChecked) {
            if (btnNext && !btnNext.className.includes('disabled')) btnNext.classList.add('disabled');
            if (btnSkip && btnSkip.className.includes('disabled')) btnSkip.classList.remove('disabled');
        } else {
            if (btnNext && btnNext.className.includes('disabled')) btnNext.classList.remove('disabled');
            if (btnSkip && !btnSkip.className.includes('disabled')) btnSkip.classList.add('disabled');
        }
    }
    slideMoveStart() {
        this.slideMoveStartStatus = true;
        console.log('slideMoveStart');
        this.preloader.style.display = 'flex';
    }
    slideMoveEnd() {
        this.slideMoveStartStatus = false;
        setTimeout(() => {
            this.preloader.style.display = 'none';
        }, 500);
    }
    scrollTop() {
        document.documentElement.scrollTop = 0;
    }
    sendRequest() {
        console.log('onChoiseTaxSystem');
        $('form').request('onChoiseTaxSystem', {
            success(data, status, jqXHR) {
                console.log(data, jqXHR);
                if (data.X_OCTOBER_REDIRECT && data.X_OCTOBER_REDIRECT.length) {
                    window.location.href = data.X_OCTOBER_REDIRECT;
                }
            },
            error(jqXHR) {
                console.log(jqXHR.status);
                if (jqXHR.status === 406) {
                    $('#ModalError').modal('show');
                    setTimeout(() => {
                        $('#ModalError').modal('hide');
                    }, 2000);
                }
            }
        });
    }
    bindNextSlide() {
        this.slideMoveStart();
        this.scrollTop();
        this.Slider.slideNext();
        if (this.reachEnd) {
            this.sendRequest();
        }
    }
    bindEvents() {
        this.bindNextSlide = this.bindNextSlide.bind(this);
        if (this.slides.length && this.sliderContainer) {
            this.Slider = new Swiper(this.sliderContainer, {
                speed: 300,
                spaceBetween: 50,
                keyboard: false,
                mousewheel: false,
                simulateTouch: false,
                allowTouchMove: false,
                effect: 'slide',
                autoHeight: true
            });
            this.slidesCount = this.Slider.slides.length;
            this.Slider.on('slideNextTransitionEnd', () => {
                console.log('slideNextTransitionEnd');
                this.checkTypeNextSlide();
            });
            this.Slider.on('slidePrevTransitionEnd', () => {
                console.log('slidePrevTransitionEnd');
                this.checkTypePrevSlide();
            });
        }
        if (this.btnStart) {
            this.btnStart.onclick = () => {
                this.form.reset();
                this.reachEnd = false;
                this.resetNextButtons();
                this.bindNextSlide();
            };
        }
        if (this.btnPrev.length) {
            this.btnPrev.forEach((item) => {
                item.addEventListener('click', () => {
                    this.slideMoveStart();
                    this.scrollTop();
                    this.Slider.slidePrev();
                });
            });
        }
        if (this.btnNext.length) {
            this.btnNext.forEach((item) => {
                item.addEventListener('click', this.bindNextSlide);
            });
        }
        if (this.btnNextNotRequired) {
            this.btnNextNotRequired.forEach((item) => {
                item.addEventListener('click', this.bindNextSlide);
            });
        }
        if (this.formRadio.length) {
            this.formRadio.forEach((item) => {
                item.addEventListener('change', () => {
                    this.countCheckedInputs();
                });
            });
        }
        if (this.formCheckbox.length) {
            this.formCheckbox.forEach((item) => {
                item.addEventListener('change', () => {
                    this.countCheckedInputs();
                });
            });
        }
    }
    checkTypePrevSlide() {
        window.console.clear();
        const checkedFormValues = [];
        const checkedItemsForm = Array.from($('#form-t-fop').find('input:checked'));
        const currentSlide = this.form.querySelector('.swiper-slide.swiper-slide-active');
        [...new Set(checkedItemsForm)].forEach((elem) => {
            checkedFormValues.push(elem.value);
        });
        console.log(checkedFormValues);
        if (currentSlide.getAttribute('data-depends-on-option')) {
            console.log('currentSlide.getAttribute("data-depends-on-option")');
            if (checkedFormValues.includes(currentSlide.getAttribute('data-depends-on-option'))) {
                this.slideMoveEnd();
            } else {
                this.slideMoveStart();
                this.Slider.slidePrev();
            }
        } else {
            console.log('false currentSlide.getAttribute("data-depends-on-option")');
            this.slideMoveEnd();
        }
        this.reachEnd = false;
        /* if (!currentSlide.previousElementSibling) {
            console.log('this.reachStart = true');
            this.reachStart = true;
        } else {
            console.log('this.reachStart = false');
            this.reachStart = false;
        } */
    }
    checkTypeNextSlide() {
        window.console.clear();
        const checkedFormValues = [];
        const checkedItemsForm = Array.from($('#form-t-fop').find('input:checked'));
        const currentSlide = this.form.querySelector('.swiper-slide.swiper-slide-active');
        [...new Set(checkedItemsForm)].forEach((elem) => {
            checkedFormValues.push(elem.value);
        });
        console.log(checkedFormValues);
        if (currentSlide.getAttribute('data-depends-on-option')) {
            if (checkedFormValues.includes(currentSlide.getAttribute('data-depends-on-option'))) {
                this.slideMoveEnd();
            } else {
                this.slideMoveStart();
                this.Slider.slideNext();
            }
        } else {
            console.log('false currentSlide.getAttribute("data-depends-on-option")');
            this.slideMoveEnd();
        }
        if (!currentSlide.nextElementSibling) {
            console.log('this.reachEnd = true');
            this.reachEnd = true;
            if (this.slideMoveStartStatus) {
                this.sendRequest();
            }
        } else {
            console.log('this.reachEnd = false');
            this.reachEnd = false;
        }
    }
}
new TestFop();
