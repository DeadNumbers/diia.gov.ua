import header from '../../modules/header';
import InitShare from '../../modules/share';

/**
 * Static page
 */

class StaticPage {
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
    }
}

new StaticPage();
