export default function initScrollToTop() {
    const scrollToTop = '.scrollToTop';
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $(scrollToTop).fadeIn();
        } else {
            $(scrollToTop).fadeOut();
        }
    });
    $(scrollToTop).click(() => {
        $('html, body').animate({
            scrollTop: 0,
        }, 500);
    });
}
