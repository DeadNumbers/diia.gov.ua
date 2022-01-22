import 'classlist-polyfill';

const scroll = require('window-scroll');

export default function fixPosition() {
    const shareBlock = document.getElementById('shareBlock');
    const newsWrapper = document.querySelector('.news__wrapper');
    const shareBlockSelector = '#shareBlock';
    const shareLimitBlock = '#layout-footer';
    const { body } = document.body;
    const { html } = document.documentElement;
    const height = Math.max(body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight);
    let resultComparing;
    let topValue;
    let blockPosition;
    let footerPosition;

    function collision($div1, $div2) {
        if ($div1.length > 0 && $div2.length > 0) {
            const x1 = $div1.offset().left;
            const y1 = $div1.offset().top;
            const h1 = $div1.outerHeight(true);
            const w1 = $div1.outerWidth(true);
            const b1 = y1 + h1;
            const r1 = x1 + w1;
            const x2 = $div2.offset().left;
            const y2 = $div2.offset().top;
            const h2 = $div2.outerHeight(true);
            const w2 = $div2.outerWidth(true);
            const b2 = y2 + h2;
            const r2 = x2 + w2;
            if (b1 < y2 || y1 > b2 || r1 < x2 || x1 > r2) {
                return false;
            }
            return true;
        }
        return false;
    }

    if (shareBlock && window.innerWidth > 768) {
        (function() {
            window.onscroll = function() {
                resultComparing = collision($(shareBlockSelector), $(shareLimitBlock));
                if (shareBlock.getAttribute('data-position') === 'act') {
                    footerPosition = 700;
                    blockPosition = 635;
                    topValue = scroll.getScrollY() - 600;
                } else if (shareBlock.getAttribute('data-position') === 'news') {
                    footerPosition = 500;
                    blockPosition = 420;
                    topValue = scroll.getScrollY() - 400;
                } else if (shareBlock.getAttribute('data-position') === 'service') {
                    footerPosition = 500;
                    blockPosition = 260;
                    topValue = scroll.getScrollY() - 265;
                } else if (shareBlock.getAttribute('data-position') === 'events') {
                    footerPosition = 1000;
                    blockPosition = 645;
                    topValue = scroll.getScrollY() - 600;
                }

                if (scroll.getScrollY() > blockPosition && scroll.getScrollY() < height - footerPosition) {
                    if (resultComparing === false) {
                        if (shareBlock) {
                            shareBlock.classList.add('active');
                            shareBlock.style.opacity = '1';
                        }
                        if (newsWrapper) {
                            newsWrapper.classList.add('active');
                        }
                        shareBlock.style.top = `${topValue}px`;
                    } else if (shareBlock) {
                        shareBlock.style.opacity = '0';
                    }
                } else {
                    if (shareBlock) {
                        shareBlock.classList.remove('active');
                        shareBlock.style.opacity = '1';
                    }
                    if (newsWrapper) {
                        newsWrapper.classList.remove('active');
                    }
                }
            };
        }());
    }
}
