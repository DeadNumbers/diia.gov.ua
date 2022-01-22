export default function printIframe() {
    const iframeToPrint = document.createElement('iframe');
    const elemsToPrint = document.querySelectorAll('[data-is-pdf-render="1"]');
    const btnToPrint = document.getElementById('print-instruction');
    const { body } = document;
    iframeToPrint.className = 'd-none';
    iframeToPrint.id = 'print-iframe';
    iframeToPrint.setAttribute('media', 'all');
    body.appendChild(iframeToPrint);

    window.addEventListener('load', () => {
        const iframe = document.getElementById('print-iframe');
        if (iframe && elemsToPrint.length && btnToPrint) {
            let elemsToPrintContent = '';
            const iframeWindow = (iframe.contentWindow || iframe.contentDocument);
            let docum;
            if (iframeWindow.document) {
                docum = iframeWindow.document;
            } else {
                docum = iframeWindow;
            }
            elemsToPrint.forEach((item) => {
                elemsToPrintContent += item.innerHTML;
            });
            docum.body.className = 'editor-content';
            docum.body.innerHTML = elemsToPrintContent;
            $(iframe).contents().find('head').append('<link rel="stylesheet" type="text/css" href="/themes/diia/assets/javascript/build/printIframe.css">');
            btnToPrint.addEventListener('click', () => {
                iframeWindow.print();
            });
        }
    });
}
