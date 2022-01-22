export default class AccordionParent {
    constructor(heading) {
        this.heading = heading;
    }
    showOne() {
        const accordionHeading = document.querySelectorAll(this.heading);
        if (accordionHeading.length) {
            accordionHeading.forEach((item) => {
                item.addEventListener('click', () => {
                    accordionHeading.forEach((element) => {
                        if (element.parentElement) {
                            if (element.parentElement.classList.contains('active')) {
                                element.parentElement.classList.remove('active');
                            }
                        }
                    });
                    item.parentElement.classList.add('active');
                });
            });
        }
    }
    showAll() {
        const accordionHeading = document.querySelectorAll(this.heading);
        if (accordionHeading.length) {
            accordionHeading.forEach((item) => {
                item.addEventListener('click', () => {
                    if (item.parentElement) {
                        if (item.parentElement.classList.contains('active')) {
                            item.parentElement.classList.remove('active');
                        } else {
                            item.parentElement.classList.add('active');
                        }
                    }
                });
            });
        }
    }
}
