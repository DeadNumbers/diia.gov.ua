export default function initPrint() {
    const printBtn = document.querySelector('#printBtn');
    if (printBtn) {
        printBtn.onclick = function(e) {
            e.preventDefault();
            window.print();
        };
    }
}
