
const itemSelector = '.control-treelist .record';

function updateList(el) {

    const element = $(el);
    if (!element) {
        return;
    }
    for (let i=0; i < element.length; i++) {

        let _this = element[i];

        if ( $(_this).next().length > 0){
            if ( $(_this).next().html().trim().length !== 0 ){
                $(_this).addClass('not-empty');
            }
        } else {
            $(_this).removeClass('not-empty');
        }

        if ($(_this).hasClass('active')) {
            $(_this).addClass('updated');
        } else {
            $(_this).removeClass('updated');
        }
    }
}

function bindEvent() {
    const item = document.querySelectorAll('.not-empty');
    for ( let i = 0; i < item.length; i++ ){
        item[i].onclick = function () {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
                $(this).next().children().each(function () {
                    $(this).slideUp();
                });
                return;
            }
            $(this).removeClass('active');
            $(this).addClass('active');
            $(this).next().children().each(function () {
                $(this).slideDown();
            });
        };
    }
}

$(document).ready(function () {
    updateList(itemSelector);
    $('.control-treelist li > div.record > a.move').mouseup(function () {
        setTimeout(function () {
            updateList(itemSelector);
            bindEvent();
        },100);
    });
    bindEvent();
});