export default function initAccordionBootstrap(element, parentClassActive) {
    $(element).on('click', function(e) {
        e.preventDefault();
        if (parentClassActive) {
            $(this).parent().toggleClass('active');
        } else {
            $(this).toggleClass('active');
        }
        $(this).next().collapse('toggle');
    });
}
