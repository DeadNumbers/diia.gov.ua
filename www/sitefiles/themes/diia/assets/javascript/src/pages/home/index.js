import header from '../../modules/header';
import AccordionParent from '../../modules/AccordionParent';
import initSliderServices from './modules/initSliderServices';
import animateGradient from './modules/animateGradient';

/**
 * Home page
 */
class Home {
    /**
	 * Home page constructor
	 */
    constructor() {
        this.initModules();
    }
    /**
	 *  Method for init plugins
	 */
    initModules() {
        header();
        initSliderServices('.js-swiper_services');
        new AccordionParent('.js-question_item-category').showAll();

        window.addEventListener('DOMContentLoaded', () => {
            animateGradient();
        });
    }
}

new Home();
