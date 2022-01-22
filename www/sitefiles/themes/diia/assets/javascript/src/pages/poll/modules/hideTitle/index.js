export default function hideTitle() {
    const title = document.querySelector('.page_title-text');
    if (title) {
        const titleContent = title.textContent.trim().length ? title.textContent.trim() : '';
        if (titleContent && titleContent.includes('зворотного зв’язку')) {
            title.textContent = '';
            console.log('includes зворотного зв’язку');
        }
    }
}
