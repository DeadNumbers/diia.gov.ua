export default class Accordion {
    constructor(heading) {
        this.heading = heading;
    }
    showOne() {
        const accordionHeading = document.querySelectorAll(this.heading);
        if (accordionHeading.length) {
            accordionHeading.forEach((item) => {
                item.addEventListener('click', () => {
                    accordionHeading.forEach((element) => {
                        if (element.classList.contains('active')) element.classList.remove('active');
                    });
                    item.classList.add('active');
                });
            });
        }
    }
    showOneCheckActive() {
        const accordionHeading = document.querySelectorAll(this.heading);
        if (accordionHeading.length) {
            accordionHeading.forEach((item) => {
                item.addEventListener('click', (e) => {
                    accordionHeading.forEach((element) => {
                        if (element !== e.target && element.classList.contains('active')) {
                            element.classList.remove('active');
                        }
                    });
                    if (e.target.className.includes('active')) {
                        e.target.classList.remove('active');
                    } else {
                        e.target.classList.add('active');
                    }
                });
            });
        }
    }
    showAll() {
        const accordionHeading = document.querySelectorAll(this.heading);
        if (accordionHeading.length) {
            accordionHeading.forEach((item) => {
                item.addEventListener('click', () => {
                    if (item.classList.contains('active')) {
                        item.classList.remove('active');
                    } else {
                        item.classList.add('active');
                    }
                });
            });
        }
    }
}
