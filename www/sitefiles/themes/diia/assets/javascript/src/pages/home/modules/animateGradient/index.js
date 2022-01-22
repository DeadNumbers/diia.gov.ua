export default function animateGradient() {
    const element = document.querySelector('.js-header_bg-gradient');

    if (!element) return;

    const intersectionObserver = new IntersectionObserver(((entries) => {
        // Если intersectionRatio равен 0, цель вне зоны видимости и нам не нужно ничего делать
        if (entries[0].intersectionRatio <= 0) {
            element.style.animationPlayState = 'paused';
            setTimeout(() => {
                console.log('Not in viewport, animation is', element.style.animationPlayState);
            }, 10);
        } else {
            element.style.animationPlayState = 'running';
            setTimeout(() => {
                console.log('In viewport, animation is', element.style.animationPlayState);
            }, 10);
        }
    }));

    intersectionObserver.observe(element);
}
