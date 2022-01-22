export default function imageAltTags() {
    try {
        const OGTITLE = document.querySelector('meta[property="og:title"]');
        if (OGTITLE) {
            let attr = OGTITLE.getAttribute('content');
            const articleLevel = document.querySelector('.article-level-2');
            const pageTitleText = document.querySelector('.page_title-text');
            if (attr) {
                attr = attr.toLowerCase();
                const allImages = document.getElementsByTagName('img');
                Array.from(allImages).forEach((element) => {
                    if (!element.getAttribute('alt')) element.setAttribute('alt', attr);
                    // element.getAttribute('title') ? '' : element.setAttribute('title', attr);
                });
                return;
            } if (articleLevel) {
                let articleLevelContent = articleLevel.textContent;
                articleLevelContent = articleLevelContent.toLowerCase();
                const allImages = document.getElementsByTagName('img');
                Array.from(allImages).forEach((element) => {
                    if (!element.getAttribute('alt')) element.setAttribute('alt', articleLevelContent);
                    // element.getAttribute('title') ? '' : element.setAttribute('title', articleLevelContent);
                });
                return;
            } if (pageTitleText) {
                let pageTitleTextContent = pageTitleText.textContent;
                pageTitleTextContent = pageTitleTextContent.toLowerCase();
                const allImages = document.getElementsByTagName('img');
                Array.from(allImages).forEach((element) => {
                    if (!element.getAttribute('alt')) element.setAttribute('alt', pageTitleTextContent);
                    // element.getAttribute('title') ? '' : element.setAttribute('title', pageTitleTextContent);
                });
                return;
            }
        }
    } catch (e) {
        console.log(e);
    }
}
