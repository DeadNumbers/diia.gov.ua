import dompurify from 'dompurify';

const axios = require('axios');
const scroll = require('window-scroll');

export default class RenderSearch {
    constructor() {
        this.settings();
        this.texts();
        this.getLocalisation();
        this.getSearchKeyWord();
        this.bindEvents();
        localStorage.removeItem('searchPortalKey');
    }
    settings() {
        this.resultKeys = ['npa', 'news', 'events', 'mediagalleries', 'persons', 'meetings', 'services', 'pages', 'faq', 'lifesituations'];
        this.searchKey = localStorage.getItem('searchPortalKey') !== null ? dompurify.sanitize(decodeURIComponent(localStorage.getItem('searchPortalKey'))) : '';
        this.loadMore = document.getElementById('loadMore');
        this.searchResultsContainer = document.getElementById('searchResultsContainer');
        this.searchSideBarFilters = document.getElementById('searchSideBarFilters');
        this.modalBtn = document.getElementById('modalBtn');
        this.sideBarFiltersList = document.querySelector('#searchSideBarFilters .search_tags-list');
        this.searchFoundItem = document.getElementById('search_request-text');
        this.searchPageInput = document.getElementById('form_search-page-input');
        this.searchPageForm = document.getElementById('form_search-page');
        this.searchEmptyInfo = document.getElementById('search_empty');
        this.searchEmptyInfoMsg = document.getElementById('search_empty-msg');
        this.search_tags_title = document.querySelector('.search_tags-title');
        this.findParam = window.location.search;
        this.blockUpdatingSearchUntilPending = true;
        this.lastPageGotted = false;
        this.blockRequestThenScroll = false;
        this.paginationPageNextURL = 2;
        this.paginationPageNextURLByTheme = 1;
        this.countThemes = 0;
        this.lastPageCount = 0;
        this.currentPageCount = 1;
        this.localisation = '';
        this.localisationName = '';
        this.chosenTheme = '';
        this.listCount = 1;
    }
    texts() {
        this.personsText = (this.localisationName === 'en' ? 'Persons' : 'Персони');
        this.newsText = (this.localisationName === 'en' ? 'News' : 'Новини');
        this.eventsText = (this.localisationName === 'en' ? 'Events' : 'Події');
        this.actsText = (this.localisationName === 'en' ? 'Acts' : 'НПА');
        this.galleriesText = (this.localisationName === 'en' ? 'Megiagalleries' : 'Медіагалереї');
        this.meetingsText = (this.localisationName === 'en' ? 'Meetings' : 'Засідання');
        this.servicesText = (this.localisationName === 'en' ? 'Services' : 'Послуги');
        this.lifesituationsText = (this.localisationName === 'en' ? 'Life situations' : 'Життєві ситуації');
        this.pagesText = (this.localisationName === 'en' ? 'Pages' : 'Сторінки');
        this.faqText = (this.localisationName === 'en' ? 'Питання та відповіді' : 'Питання та відповіді');
        this.moreText = (this.localisationName === 'en' ? 'more on the topic' : 'Більше за темою');
        this.searchText = (this.localisationName === 'en' ? 'You searched' : 'Ви шукали');
        this.foundText = (this.localisationName === 'en' ? 'Found' : 'Знайдено');
        this.materialsText = (this.localisationName === 'en' ? 'materials' : 'матеріалів');
        this.leftSidebarText = (this.localisationName === 'en' ? 'BY TYPE OF MATERIAL' : 'ЗА ТИПОМ МАТЕРІАЛУ');
        this.exeption = (this.localisationName === 'en' ? 'Something went wrong' : 'Щось пішло не так');
        this.shortRequest = (this.localisationName === 'en' ? 'Too short request' : 'Закороткий пошуковий запит');
    }
    getLocalisation() {
        const html = document.querySelector('html');
        this.localisationName = html.getAttribute('lang') || '';
        this.localisation = this.localisationName.length === 0 ? '' : `&lang=${this.localisationName}`;
        if (this.localisationName === 'en') moment.locale('en');
        else moment.locale('uk');
    }
    showShortMessage(short, display, clearContainerBlock) {
        const text = short ? `${this.shortRequest}` : 'За вашим запитом не знайдено матеріалів';
        this.searchEmptyInfoMsg.innerHTML = text;
        this.searchEmptyInfo.style.display = `${display}`;
        if (clearContainerBlock) {
            this.searchResultsContainer.innerHTML = '';
            this.searchFoundItem.innerHTML = '';
            this.searchFoundItem.style.display = 'none';
            this.sideBarFiltersList.innerHTML = '';
            this.searchSideBarFilters.style.display = 'none';
        } else {
            this.searchFoundItem.innerHTML = `За вашим запитом знайдено матеріалів: ${this.totalCountMaterials}`;
            this.searchFoundItem.style.display = 'block';
        }
    }
    getSearchKeyWord() {
        if (this.searchKey.length === 0 && this.findParam.length !== 0 && this.findParam.indexOf('key=')) {
            const paramsUrl = this.findParam.split('=');
            const searchKeyFromUrl = paramsUrl[1];
            this.searchKey = dompurify.sanitize(decodeURIComponent(searchKeyFromUrl).replace(/\+/gi, ' '));
            this.updateSearchUrlParams(this.searchKey);
        }
    }
    bindEvents() {
        if (this.searchKey.length >= 1) {
            this.showShortMessage(false, 'none', true);
            this.loadMore.style.display = 'block';
            this.updateSearchUrlParams(this.searchKey);
            axios.get(`/api/search?key=${this.searchKey}${this.localisation}`)
                .then((response) => {
                    this.renderHtmlMain(response.data);
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {});
        } else {
            this.showShortMessage(true, 'block', true);
        }
        this.searchPageForm.addEventListener('submit', (e) => {
            e.preventDefault();
            e.stopPropagation();
            this.searchKey = (this.searchPageInput.value.trim().length ? this.searchPageInput.value.trim() : '');
            this.searchKey = dompurify.sanitize(decodeURIComponent(this.searchKey));
            // localStorage.setItem('searchPortalKey', this.searchKey); 27.01.2020
            this.updateSearchUrlParams(this.searchKey);
            if (this.searchKey.length >= 1) {
                this.updateSearchUrlParams(this.searchKey);
                this.showShortMessage(false, 'none', true);
                this.loadMore.style.display = 'block';
                axios.get(`/api/search?key=${this.searchKey}${this.localisation}`)
                    .then((response) => {
                        this.renderHtmlMain(response.data);
                    })
                    .catch((error) => {
                        console.log(error);
                    })
                    .finally(() => {});
            } else {
                this.updateSearchUrlParams(this.searchKey);
                this.showShortMessage(true, 'block', true);
            }
        });
        if (this.search_tags_title && this.search_tags_title.parentElement) {
            this.search_tags_title.addEventListener('click', function() {
                this.parentElement.classList.toggle('active');
            });
        }
    }
    renderHtmlMain(resultJson) {
        this.countThemes = 0;
        if (resultJson === 400 || resultJson === 404 || resultJson === 500) {
            this.lastPageGotted = true;
            this.printException(this.exeption);
        } else {
            this.totalCountMaterials = 0;
            this.loadMore.style.display = 'none';
            for (let j = 0; j < this.resultKeys.length; j++) {
                const key = this.resultKeys[j];
                if (resultJson[key] !== undefined) {
                    this.totalCountMaterials += resultJson[key].total;
                    if (resultJson[key].total !== 0) {
                        this.countThemes += 1;
                    }
                    let innerTypeText;
                    switch (key) {
                    case 'persons':
                        innerTypeText = this.personsText;
                        break;
                    case 'news':
                        innerTypeText = this.newsText;
                        break;
                    case 'events':
                        innerTypeText = this.eventsText;
                        break;
                    case 'npa':
                        innerTypeText = this.actsText;
                        break;
                    case 'mediagalleries':
                        innerTypeText = this.galleriesText;
                        break;
                    case 'meetings':
                        innerTypeText = this.meetingsText;
                        break;
                    case 'services':
                        innerTypeText = this.servicesText;
                        break;
                    case 'pages':
                        innerTypeText = this.pagesText;
                        break;
                    case 'lifesituations':
                        innerTypeText = this.lifesituationsText;
                        break;
                    case 'faq':
                        innerTypeText = this.faqText;
                        break;
                    default:
                        break;
                    }

                    if (resultJson[key].data && resultJson[key].data.length !== 0) {
                        this.searchSideBarFilters.style.display = 'block';
                        this.lastPageCount += resultJson[key].last_page;
                        const leftSidebarFilterListItem = document.createElement('div');
                        leftSidebarFilterListItem.className = 'search_tags-list-item';
                        leftSidebarFilterListItem.setAttribute('data-theme', `${key}`);
                        leftSidebarFilterListItem.innerHTML = `
									<div class="search_tags-theme">${innerTypeText}</div>
									 <div class="search_tags-theme-count">${resultJson[key].total}</div>`;
                        this.sideBarFiltersList.appendChild(leftSidebarFilterListItem);

                        const mainResultsBlock = document.createElement('div');
                        mainResultsBlock.className = 'search-res_box';
                        mainResultsBlock.setAttribute('id', key);
                        mainResultsBlock.setAttribute('data-theme', key);

                        const mainResultsBlockTitle = document.createElement('div');
                        mainResultsBlockTitle.className = 'search-res_box-type';
                        mainResultsBlockTitle.innerHTML = `<div class="search-results_box-type">${innerTypeText}</div>`;
                        mainResultsBlock.appendChild(mainResultsBlockTitle);

                        this.searchResultsContainer.appendChild(mainResultsBlock);
                        this.renderSearchItem(mainResultsBlock, key, resultJson[key].data);
                    }
                }
            }
            if (this.totalCountMaterials) {
                this.showShortMessage(false, 'none', false);
            } else {
                this.showShortMessage(false, 'block', true);
            }
            this.searchPageInput.value = this.searchKey;
            this.bindUpdateEventsByName(this.countThemes);
        }
    }
    bindUpdateEventsByName(countThemes) {
        if (countThemes === 1) {
            window.addEventListener('scroll', () => {
                this.blockRequestThenScroll = true;
                this.updateSearchIfOneTheme(this.paginationPageNextURL);
            });
        } else {
            const showThemeBtn = document.querySelectorAll('.search_tags-list-item');
            for (let i = 0; i < showThemeBtn.length; i++) {
                showThemeBtn[i].addEventListener('click', () => {
                    this.listCount = 1;
                    this.searchResultsContainer.innerHTML = '';
                    this.updateSearchByTheme(showThemeBtn[i].getAttribute('data-theme'));
                }, false);
            }
        }
    }
    updateSearchIfOneTheme(updatedPage) {
        const mainResultsItem = document.querySelector('.search-res_box');
        this.chosenTheme = mainResultsItem.getAttribute('data-theme');
        if (scroll.getScrollY() > this.searchResultsContainer.clientHeight - window.innerHeight / 3
            && this.blockUpdatingSearchUntilPending && this.elementInViewport(this.searchResultsContainer)) {
            if (this.lastPageCount > 1 && !this.lastPageGotted && this.blockRequestThenScroll) {
                this.blockUpdatingSearchUntilPending = false;
                this.loadMore.style.display = 'block';
                axios.get(`/api/search?key=${this.searchKey}&type=${this.chosenTheme}&page=${updatedPage}${this.localisation}`)
                    .then((response) => {
                        this.renderHtmlIfOnlyOneTheme(response.data);
                        this.blockRequestThenScroll = true;
                        // (result === 406 ? this.checkMaxPagination() : this.renderHtmlIfOnlyOneTheme(result));
                    })
                    .catch((error) => {
                        this.blockUpdatingSearchUntilPending = true;
                        this.blockRequestThenScroll = false;
                        console.log(error);
                    })
                    .finally(() => {});
            }
        }
    }
    renderHtmlIfOnlyOneTheme(result) {
        if (result === 400 || result === 404 || result === 500) {
            this.lastPageGotted = true;
            this.printException(this.exeption);
        } else {
            this.lastPageCount = result.last_page;
            this.paginationPageNextURL = result.current_page + 1;
            this.blockUpdatingSearchUntilPending = true;
            this.loadMore.style.display = 'none';

            if (Number(this.lastPageCount) === Number(this.paginationPageNextURL - 1)) {
                this.lastPageGotted = true;
            }
            this.renderSearchItem(document.getElementById(this.chosenTheme), this.chosenTheme, result.data);
        }
    }
    updateSearchByTheme(theme) {
        // this.hideFilters();
        this.chosenTheme = theme;
        this.lastPageGotted = false;
        this.paginationPageNextURLByTheme = 1;
        this.searchResultsContainer.innerHTML = '';
        // let mainResultsBlockByTheme = document.createElement('div');
        // mainResultsBlockByTheme.className = 'search-res_box';
        // this.searchResultsContainer.appendChild(mainResultsBlockByTheme);

        this.updateSearchResultsByName();
        window.addEventListener('scroll', () => {
            if (scroll.getScrollY() > this.searchResultsContainer.clientHeight - window.innerHeight / 3
                && this.blockUpdatingSearchUntilPending && this.elementInViewport(this.searchResultsContainer)) {
                if (this.lastPageCount > 1 && !this.lastPageGotted && this.blockRequestThenScroll) {
                    this.updateSearchResultsByName();
                }
            }
        });
    }
    updateSearchResultsByName() {
        this.blockUpdatingSearchUntilPending = false;
        this.loadMore.style.display = 'block';
        axios.get(`/api/search?key=${this.searchKey}&type=${this.chosenTheme}&page=${this.paginationPageNextURLByTheme}${this.localisation}`)
            .then((response) => {
                this.renderHtmlByName(response.data);
                // (result === 406 ? this.checkMaxPagination() : this.renderHtmlIfOnlyOneTheme(result));
            })
            .catch((error) => {
                this.blockUpdatingSearchUntilPending = true;
                this.blockRequestThenScroll = false;
                console.log(error);
            })
            .finally(() => {});
    }
    renderHtmlByName(result) {
        if (result === 400 || result === 404 || result === 500) {
            this.lastPageGotted = true;
            this.printException(this.exeption);
        } else {
            this.lastPageCount = result.last_page;
            this.currentPageCount = result.current_page;
            this.blockUpdatingSearchUntilPending = true;
            this.blockRequestThenScroll = true;
            this.loadMore.style.display = 'none';
            this.paginationPageNextURLByTheme = result.current_page + 1;
            if (Number(this.lastPageCount) === Number(this.currentPageCount)) {
                this.lastPageGotted = true;
            }

            let innerTypeText = '';
            switch (this.chosenTheme) {
            case 'persons':
                innerTypeText = this.personsText;
                break;
            case 'news':
                innerTypeText = this.newsText;
                break;
            case 'events':
                innerTypeText = this.eventsText;
                break;
            case 'npa':
                innerTypeText = this.actsText;
                break;
            case 'mediagalleries':
                innerTypeText = this.galleriesText;
                break;
            case 'meetings':
                innerTypeText = this.meetingsText;
                break;
            case 'services':
                innerTypeText = this.servicesText;
                break;
            case 'pages':
                innerTypeText = this.pagesText;
                break;
            case 'lifesituations':
                innerTypeText = this.lifesituationsText;
                break;
            case 'faq':
                innerTypeText = this.faqText;
                break;
            default:
                break;
            }
            const checkMainResultsBlock = document.getElementById(this.chosenTheme);
            if (checkMainResultsBlock) {
                this.renderSearchItem(checkMainResultsBlock, this.chosenTheme, result.data);
            } else {
                const mainResultsBlock = document.createElement('div');
                mainResultsBlock.className = 'search-res_box';
                mainResultsBlock.setAttribute('id', this.chosenTheme);
                mainResultsBlock.setAttribute('data-theme', this.chosenTheme);
                const mainResultsBlockTitle = document.createElement('div');
                mainResultsBlockTitle.className = 'search-res_box-type';
                mainResultsBlockTitle.innerHTML = `<div class="search-results_box-type">${innerTypeText}</div>`;
                mainResultsBlock.appendChild(mainResultsBlockTitle);
                this.searchResultsContainer.appendChild(mainResultsBlock);
                this.renderSearchItem(mainResultsBlock, this.chosenTheme, result.data);
            }
            this.searchPageInput.value = this.searchKey;
        }
    }
    renderSearchItem(mainResultsBlock, key, result) {
        let renderContainer = mainResultsBlock.querySelector('.search-res_list');
        if (renderContainer) {
            for (let i = 0; i < result.length; i++) {
                const date = result[i].published_at ? moment(result[i].published_at).format('LL') : '';
                const dateString = date ? `<div class="search-res_list-item-date">${date}</div>` : '';
                const searchResultsPreviewItem = document.createElement('div');
                searchResultsPreviewItem.className = 'search-res_list-item';

                if (key === 'news') {
                    searchResultsPreviewItem.innerHTML = `${dateString}<a href="${result[i].url}" class="search-res_list-item-title">${result[i].title}</a>`;
                } else {
                    searchResultsPreviewItem.innerHTML = `<a href="${result[i].url}" class="search-res_list-item-title">${result[i].title}</a>`;
                }

                renderContainer.appendChild(searchResultsPreviewItem);
            }
        } else {
            renderContainer = document.createElement('div');
            renderContainer.className = 'search-res_list';
            for (let i = 0; i < result.length; i++) {
                const date = result[i].published_at ? moment(result[i].published_at).format('LL') : '';
                const dateString = date ? `<div class="search-res_list-item-date">${date}</div>` : '';
                const searchResultsPreviewItem = document.createElement('div');
                searchResultsPreviewItem.className = 'search-res_list-item';

                if (key === 'news') {
                    searchResultsPreviewItem.innerHTML = `${dateString}<a href="${result[i].url}" class="search-res_list-item-title">${result[i].title}</a>`;
                } else {
                    searchResultsPreviewItem.innerHTML = `<a href="${result[i].url}" class="search-res_list-item-title">${result[i].title}</a>`;
                }

                renderContainer.appendChild(searchResultsPreviewItem);
            }
            mainResultsBlock.appendChild(renderContainer);
        }
    }
    elementInViewport(el) {
        const rect = el.getBoundingClientRect();
        return (
            // rect.top >= 0 &&
            rect.left >= 0
            && rect.bottom <= (window.innerHeight || document.documentElement.clientHeight)
            && rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }
    printException(text) {
        this.searchResultsContainer.innerHTML = `<div>${text}</div>`;
        this.loadMore.style.display = 'none';
    }
    updateSearchUrlParams(key) {
        const keyToUpdate = (key.length > 0 ? `?key=${key}` : '');
        window.history.replaceState(null, '', keyToUpdate);
    }
    scrollTop() {
        (function smoothscroll() {
            const currentScroll = document.documentElement.scrollTop || document.body.scrollTop;
            if (currentScroll > 0) {
                window.requestAnimationFrame(smoothscroll);
                window.scrollTo(0, currentScroll - (currentScroll / 5));
            }
        }());
    }
}
