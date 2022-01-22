// import printIframe from './modules/printIframe';
import header from '../../modules/header';
import validateSendToEmail from '../../modules/validateSendToEmail';

/**
 * ServiceItem page
 */

class ServiceItem {
    /* ServiceItem page constructor */
    constructor() {
        this.initModules();
    }
    /* Method for init plugins */
    initModules() {
        header();
        // printIframe();
        validateSendToEmail('onInfoServiceSendToMail');
    }
}

new ServiceItem();
