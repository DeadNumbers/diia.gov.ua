import chatbot from './modules/chatbot';
// import OAuth from './modules/OAuth';
import OAuthCookie from './modules/OAuthCookie';
import menuAnimMob from './modules/menuAnimMob';
import menuAnimPc from './modules/menuAnimPc';
import imageAltTags from './modules/imageAltTags';
import CrossBrowser from './modules/cross-browser';
import adaptiveTable from './modules/adaptiveTable';
import searchPortalSubmit from './modules/search';
import Accordion from '../Accordion';
import initAccordionBootstrap from '../initAccordionBootstrap';
import ModuleCookies from './modules/moduleCookies';
// import { initScrollToTop } from './modules/scrolltotop';
// import { initScrollBar } from './modules/scrollbar/';
// import { countMenuWidth } from './modules/countMenuWidth';

export default function header() {
    // new OAuth();
    new OAuthCookie();
    CrossBrowser();
    chatbot();
    menuAnimMob();
    menuAnimPc();
    adaptiveTable();
    searchPortalSubmit();
    new Accordion('.js-services-short_item-title').showOneCheckActive();
    imageAltTags();
    initAccordionBootstrap('.js-service-acc_item-quest');
    initAccordionBootstrap('.js-life-sit-acc_item-quest');
    initAccordionBootstrap('.js-life-sit_repiter-title', true);

    document.addEventListener('DOMContentLoaded', () => {
        new ModuleCookies();
    });

    /* $('.js_datepicker_single-header, .js_datepicker_range, .js_datepicker_single').datepicker({
        format: 'dd.mm.yyyy',
        language: 'uk',
        autoclose : true
    }); */
    // countMenuWidth();
    // scrollToTop();
    // initScrollBar('.chosen-drop');
}
