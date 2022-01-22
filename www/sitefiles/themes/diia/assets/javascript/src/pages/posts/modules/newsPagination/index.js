const axios = require('axios');

export default class newsPagination {
    constructor() {
        this.settings();
        this.getLocalisation();
        this.paginationInfo();
        this.bindEvents();
    }
    settings() {
        this.loadMore = document.getElementById('btn_more-news');
        this.paginationContainer = document.getElementById('post-navigation');
        this.newsContainer = document.getElementById('posts-container');
        this.renderBox = document.getElementById('posts-items-box');
    }
    getLocalisation() {
        const html = document.querySelector('html');
        this.localisationName = html.getAttribute('lang') || '';
        this.localisation = this.localisationName.length === 0 ? '' : `&lang=${this.localisationName}`;
    }
    renderHTML(data) {
        if (data.data && data.data.render && data.data.render.length) {
            this.removePaginationInfo();
            this.renderBox.insertAdjacentHTML('beforeend', data.data.render);
            this.replaceUrl(this.pageUrl);
            this.paginationInfo();
        }
        if (data.data.pagination) {
            this.paginationContainer.innerHTML = data.data.pagination;
        }
    }
    removePaginationInfo() {
        this.paginationInfoBtn.parentElement.removeChild(this.paginationInfoBtn);
    }
    paginationInfo() {
        this.paginationInfoBtn = document.getElementById('pagination-info');
        if (this.paginationInfoBtn) {
            this.pageСurrent = this.paginationInfoBtn.getAttribute('data-currentpage') || '';
            this.pageLast = this.paginationInfoBtn.getAttribute('data-lastpage') || '';
            this.nextPage = this.pageСurrent ? Number(this.pageСurrent) + 1 : '';
            if (this.pageСurrent && this.pageLast && this.loadMore) {
                if (Number(this.pageСurrent) === Number(this.pageLast)) {
                    if (!this.loadMore.classList.contains('d-none')) this.loadMore.classList.add('d-none');
                } else if (this.loadMore.classList.contains('d-none')) this.loadMore.classList.remove('d-none');
            }
        }
    }
    sendRequest() {
        const page = this.nextPage ? `page=${this.nextPage}` : '';
        this.pageUrl = `?${page}${this.localisation}`;
        axios({
            method: 'post',
            url: `${this.pageUrl}`,
            headers: {
                'x-october-request-handler': 'onPosts',
                'x-requested-with': 'XMLHttpRequest',
                'Content-Type': 'application/x-www-form-urlencoded',
                'cache-control': 'no-cache'
            }
        })
            .then((response) => {
                // handle success
                if (this.loadMore.classList.contains('disabled')) this.loadMore.classList.remove('disabled');
                this.renderHTML(response);
            })
            .catch((error) => {
                // handle error
                console.log(error);
            })
            .finally(() => {
                // always executed
            });
    }
    bindEvents() {
        if (this.loadMore) {
            this.loadMore.addEventListener('click', () => {
                if (!this.loadMore.classList.contains('d-none')) this.loadMore.classList.add('d-none');
                this.sendRequest();
            });
        }
    }
    replaceUrl(url) {
        window.history.replaceState(null, '', url);
    }
}
