import header from '../../modules/header';
import InitShare from '../../modules/share';
import inputToggler from './modules/inputToggler';

/**
 * Poll page
 */

class Poll {
    /**
     * Poll page constructor
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
        // inputToggler('smartReguestForm');
        window.inputToggler = inputToggler;
    }
}

new Poll();
