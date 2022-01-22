import PerfectScrollbar from 'perfect-scrollbar';

export default function initScrollBar(items) {
    const selectorsWrap = document.querySelectorAll(`${items}`);
    if (!selectorsWrap.length) return;
    selectorsWrap.forEach((element) => {
        const selectorResultItems = element.querySelectorAll('li');
        if (!selectorResultItems.length) return;
        let height = 0;
        selectorResultItems.forEach(() => {
            height += 50;
        });
        if (height >= 200) {
            new PerfectScrollbar(element, {
                wheelPropagation: true,
                maxScrollbarLength: '80',
                minScrollbarLength: '80',
            });
        }
    });

    window.PerfectScrollbar = PerfectScrollbar;
}
