import header from '../../modules/header';
import MedVlasn from './modules/medVlasn';
import MedValidate from './modules/medValidate';
import SearchApi from './modules/searchApi';

/**
 * Static page
 */

class MedvPage {
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
        new MedVlasn();
        new MedValidate();
        SearchApi();
    }
}

new MedvPage();
