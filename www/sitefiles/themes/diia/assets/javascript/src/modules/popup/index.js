export default function initPopup(selector, zoom) {
    const galleryLight = $(selector);
    $(galleryLight).magnificPopup({
        type: 'image',
        gallery: {
            enabled: true,
            tPrev: 'Попередня',
            tNext: 'Наступна',
            tCounter: '%curr% з %total%'
        },
        tLoading: 'Зачекайте, завантаження',
        tClose: 'Закрити (Esc)',
        image: {
            tError: 'Зображення не завантажено :('
        },
        callbacks: {
            change() {
                const currentWrap = this.content;
                const currentSrc = this.currItem.el[0].attributes.srcOrigin.nodeValue;
                const size = this.currItem.el[0].attributes.dataSize.nodeValue;
                let sizeName;
                let countedSize;

                if (size >= 1000000) {
                    sizeName = 'Мб';
                    countedSize = size / 1000000;
                } else if (size < 1000000) {
                    sizeName = 'Кб';
                    countedSize = size / 1000;
                }

                const Headline = document.querySelector('.page_title-text') || '';

                if (Headline && Headline.textContent) {
                    $(currentWrap).find('.mfp-img').attr('alt', Headline.textContent);
                    $(currentWrap).find('.mfp-img').attr('title', Headline.textContent);
                }

                $(currentWrap).find('.download__wrapper').remove();
                $(currentWrap).append(
                    `<div class="download__wrapper">
                        <a class="download-link" href="${currentSrc}" download>Завантажити оригінальне зображення</a>
                        <span class="size">${countedSize.toFixed(2)} ${sizeName}</span>
                     </div>`
                );
            },
            buildControls() {
                if (this.arrowLeft) {
                    this.contentContainer.append(this.arrowLeft.add(this.arrowRight));
                }
            },
            open() {
                $('html').css('margin-right', 0);
            },
            close() {
                $('html').prop('style', '');
            }
        },
        zoom: {
            enabled: zoom,
            duration: 300, // don't foget to change the duration also in CSS
            opener(element) {
                return element.find('img');
            }
        }
    });
}
