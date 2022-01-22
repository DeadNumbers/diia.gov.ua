import Swiper from 'swiper';

export default function initContentSlider() {
    $(document).ready(() => {
        const thumbsSwiperItem = document.querySelector('.js-swiper_news-thumbs');
        const sliderNews = document.querySelector('.js-swiper_news');
        if (sliderNews && thumbsSwiperItem) {
            const thumbsSwiper = new Swiper(thumbsSwiperItem, {
                slidesPerView: 'auto',
                spaceBetween: 15,
                freeMode: true,
                watchSlidesVisibility: true,
                watchSlidesProgress: true
            });
            new Swiper(sliderNews, {
                // Optional parameters
                spaceBetween: 30,
                // Navigation arrows
                navigation: {
                    nextEl: '.swiper_news-btn-next',
                    prevEl: '.swiper_news-btn-prev',
                    disabledClass: 'disabled'
                },
                thumbs: {
                    swiper: thumbsSwiper,
                    slideThumbActiveClass: 'swiper_news-thumbs-slide-active'
                }
            });
        }
    });
}
