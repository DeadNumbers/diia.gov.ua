import header from '../../modules/header';
import SearchApi from './modules/searchApi';

/**
 * Home page
 */
class SearchPage {
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
        SearchApi();
    }
}
new SearchPage();
