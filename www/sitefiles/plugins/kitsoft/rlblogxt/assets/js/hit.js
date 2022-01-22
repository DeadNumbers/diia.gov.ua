$(document).ready(function () {
    var lang = $('html').attr('lang')
    var url = '/api/blog/hit/' + $('#data-slug').data('slug')

    if (lang) {
        url = url + '?lang=' + lang
    }

    fetch(url);
});