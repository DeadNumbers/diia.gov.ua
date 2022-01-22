import header from '../../modules/header';
import InitShare from '../../modules/share';
import initContentSlider from './modules/initContentSlider';

/**
 * Home page
 */
class PostItem {
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
        initContentSlider();
        new InitShare();
    }
}
new PostItem();
