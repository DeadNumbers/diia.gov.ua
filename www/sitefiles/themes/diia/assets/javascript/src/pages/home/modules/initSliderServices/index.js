/* Import Swiper and modules */
// Swiper - core library
// Virtual - Virtual Slides module
// Keyboard - Keyboard Control module
// Mousewheel - Mousewheel Control module
// Navigation - Navigation module
// Pagination - Pagination module
// Scrollbar - Scrollbar module
// Parallax - Parallax module
// Zoom - Zoom module
// Lazy - Lazy module
// Controller - Controller module
// A11y - Accessibility module
// History - History Navigation module
// HashNavigation - Hash Navigation module
// Autoplay - Autoplay module
// EffectFade - Fade Effect module
// EffectCube - Cube Effect module
// EffectFlip - Flip Effect module
// EffectCoverflow - Coverflow Effect module
import { Swiper, Navigation, Pagination, Scrollbar } from 'swiper/js/swiper.esm.js';

Swiper.use([Navigation, Pagination, Scrollbar]);
export default function initSliderServices(elems) {
    const sliders = document.querySelectorAll(`${elems}`);
    const mySwiperOptions = {
        // Optional parameters
        // width: 290,
        slidesPerView: 'auto',
        spaceBetween: 15,
        // If we need pagination
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        },
        // Navigation arrows
        navigation: {
            nextEl: '.swiper_services-btn-next',
            prevEl: '.swiper_services-btn-prev',
            disabledClass: 'disabled'
        },
        // And if we need scrollbar
        scrollbar: {
            el: '.swiper-scrollbar'
        },
        // Responsive breakpoints
        breakpoints: {
            // when window width is >= 992px
            992: {
                spaceBetween: 30
            }
        }
    };
    sliders.forEach((elem) => {
        new Swiper(elem, mySwiperOptions);
    });
}
