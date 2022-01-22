import { Swiper, Navigation, Pagination } from 'swiper/js/swiper.esm.js';

Swiper.use([Navigation, Pagination]);

export default function sliderLifeSituationsService() {
    const sliderContainer = document.querySelector('.js-swiper_part');
    const mySwiperOpt = {
        // Optional parameters
        // width: 290,
        spaceBetween: 30,
        autoHeight: true,
        setWrapperSize: true,
        // If we need pagination
        pagination: {
            el: '.swiper_part-pagination',
            clickable: true
        },
        // Navigation arrows
        navigation: {
            nextEl: '.swiper_part-btn-next',
            prevEl: '.swiper_part-btn-prev',
            disabledClass: 'disabled'
        }
        // And if we need scrollbar
        /* scrollbar: {
        	el: '.swiper_part-scrollbar',
        } */
    };
    if (sliderContainer) {
        const mySwiper = new Swiper(sliderContainer, mySwiperOpt);
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                mySwiper.updateAutoHeight();
            }, 200);
        });
    }
}
