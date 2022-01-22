
let mainNews = {
    init: () => {
        mainNews.settings();
        mainNews.getLocalisation();
        mainNews.bindEvents();
    },
    bindEvents: () => {
        $('.js_update_tabs').on('click', function () {
            mainNews.tabHref = $(this).attr('href');
            mainNews.categoryId = $(this).data('category');
            mainNews.tagId = $(this).data('tag');
            if (mainNews.tagId === 0) return;
            if ( mainNews.prevTabs.indexOf(mainNews.tabHref) !== -1 ) return;
            mainNews.prevTabs.push(mainNews.tabHref);
            mainNews.loadNews();
        });
    },
    settings: () => {
        mainNews.tabHref = '';
        mainNews.categoryId = null;
        mainNews.tagId = null;
        mainNews.prevTabs = [];
        mainNews.localisationName = '';
    },
    getLocalisation: () => {
        const html = document.querySelector('html');
        mainNews.localisationName = html.getAttribute('lang') ||'';
        ( this.localisationName === 'en' ? moment.locale('en') : moment.locale('uk') );
    },
    loadNews: () => {
        $('#loadMore').show();
        $.ajax({
            type: 'POST',
            headers: {
                'x-october-request-handler': 'onLoadPostsByCategoryAndTag'
            },
            data: {
                category: mainNews.categoryId,
                tag: mainNews.tagId,
                lang: mainNews.localisationName
            }
        }).done((res) => {
            $('#loadMore').hide();
            if (res.main) {
                mainNews.renderMainNews(res.data);
                mainNews.renderOtherNews(res.data);
            } else {
                mainNews.renderGovNews(res.data);
            }
        });
    },
    renderMainNews: (news) => {
        let result = '';
        $.each(news, function (key, value) {
            if (key > 5) return;
            let html = '<li>';
            if (key <= 1) {
                let titleClass = value.featured_images.length > 0 ? 'white' : '';
                let date = timeFormatDayFirst(value);
                html += '<div class="main-item">' +
                    mainNews.renderImageForMainNews(value,value.slug) +
                    '<div class="addition">' +
                    mainNews.renderNewsTag(value) +
                    '<div class="time">' + date + '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="main_item_text updated">' +
                    '<a href="/' + mainNews.localisationName + '/news/' + value.slug + '" class="title ' + titleClass + '">' +
                    '<span>' + value.title + '</span>' +
                    '</a>' +
                    '</div>' +
                    '</li>';
                result += html;
            }
            if (key > 1 && key <= 5) {
                html += '<div class="news-item" style="height: 169px;">' +
                    '<a href="' + mainNews.localisationName + '/news/' + value.slug + '" class="title">' +
                    '<span>' + value.title + '<span>' +
                    '</a>' +
                    '<div class="addition">' +
                    '<div class="time">' + timeFormatDayFirst(value) + '</div>' +
                    mainNews.renderNewsTag(value) +
                    '</div>' +
                    '<div class="clearfix"></div>' +
                    '</div></li>';
                result += html;
            }
        });
        $(mainNews.tabHref).find('.main-page-news-list').empty();
        $(mainNews.tabHref).find('.main-page-news-list').append(result + '<div class="clearfix"></div>');
    },
    renderOtherNews: (news) => {
        let result = '';
        $.each(news, function (key, value) {
            if (key > 5) {
                let date = timeFormatHoursFirst(value);
                let html = '<ul class="news-list">' +
                    '<li>' +
                    '<div class="date">' + date + '</div>' +
                    '<a href="' + mainNews.localisationName + '/news/' + value.slug + '" class="title">' +
                    '<span>' + value.title + '</span>' +
                    '</a>' +
                    '</li>' +
                    '</ul>';
                result += html;
            }
        });
        $(mainNews.tabHref).find('.other-news').append(result);
    },
    renderNewsTag: (post) => {
        if (post.tags.length > 0) {
            let html = '<a href="' + mainNews.localisationName + '/tag/' + post.tags[0]['slug'] + '" class="tag">' + post.tags[0]['name'] + '</a>';
            return html;
        }
    },
    renderImageForMainNews: (post,link) => {
        if (post.featured_images.length > 0) {
            let html = '' +
                '' +
                '<div class="background" style="background-image:url(' + post.featured_images[0]['path'] + ')">' +
                '<a href="/' + mainNews.localisationName + '/news/' + link + '" class="title white"></a>' +
                '</div>' +
                '' +
                '<div class="background-filter"></div>';
            return html;
        }
        let html = '<div class="background">' +
            '<a href="/' + mainNews.localisationName + '/news/' + link + '" class="title white"></a>' +
            '</div>';
        return html;
    },
    renderGovNews: (news) => {
        let count = $(news).length;
        let result = '';
        $.each(news, function (key, value) {
            let html = '';
            if ((key + 1) % 4 === 1) {
                html += '<div class="col-md-4">' +
                    '<ul class="news-list">';
            }
            html += '<li>';
            if (value.featured_images.length > 0) {
                html += '<div class="preview" style="background-image:url(' + value.featured_images[0]['path'] + ');"></div>';
            }
            html += '<div class="date">' + timeFormatHoursFirst(value) + '</div>';
            html += '<a href="' + mainNews.localisationName + '/news/' + value.slug + '" class="title">' + '<span>' + value.title + '</span>' + '</a>';
            html += '</li>';
            if ((key + 1) % 4 === 0 || key === count - 1) {
                html += '</ul></div>';
            }
            result += html;
        });
        $(mainNews.tabHref).find('.gov-news').append(result);
    }
};

function timeFormatHoursFirst(value) {
    let date = moment(value.published_at).format('H:mm, DD MMMM YYYY');
    return date;
}
function timeFormatDayFirst(value) {
    let date = moment(value.published_at).format('DD MMMM H:mm');
    return date;
}

$(document).on('ready', mainNews.init());
