import header from '../../modules/header';
import NewsPagination from './modules/newsPagination';

/**
 * Home page
 */
class News {
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
        new NewsPagination();
    }
}
new News();
