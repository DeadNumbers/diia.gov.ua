import header from '../../modules/header';
import InitShare from '../../modules/share';
import sliderLifeSituationsService from '../../modules/sliderLifeSituationsService';

/**
 * Static page
 */

class ServiceSubCategoryPage {
    /**
     * Static page constructor
     */
    constructor() {
        this.initModules();
    }
    /**
     *  Method for init plugins
     */
    initModules() {
        header();
        new InitShare();
        sliderLifeSituationsService();
    }
}

new ServiceSubCategoryPage();
