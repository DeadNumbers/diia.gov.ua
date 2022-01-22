export default function inputToggler(formId) {
    const Form = document.getElementById(formId);
    const inputsCheckbox = Form ? Form.querySelectorAll('input[type="checkbox"]') : '';
    const inputsRadio = Form ? Form.querySelectorAll('input[type="radio"]') : '';
    const TextArea = Form ? Form.querySelectorAll('.js-textarea') : '';
    [...inputsCheckbox].forEach((item) => {
        item.addEventListener('change', function() {
            const parent = this.parentElement;
            const textAreaItem = parent.nextElementSibling;

            if (this.checked && textAreaItem) {
                if (textAreaItem.classList.contains('d-none')) {
                    textAreaItem.classList.remove('d-none');
                } else if (!textAreaItem.classList.contains('d-none')) {
                    textAreaItem.classList.add('d-none');
                }
            } else if (!this.checked && textAreaItem) {
                if (!textAreaItem.classList.contains('d-none')) {
                    textAreaItem.classList.add('d-none');
                }
            }
            // console.log('change', parent, textAreaItem, TextArea);
        });
    });
    [...inputsRadio].forEach((item) => {
        item.addEventListener('change', function() {
            const parent = this.parentElement;
            const textAreaItem = parent.nextElementSibling;
            if (this.checked && textAreaItem) {
                if (textAreaItem.classList.contains('d-none')) {
                    textAreaItem.classList.remove('d-none');
                } else if (!textAreaItem.classList.contains('d-none')) {
                    textAreaItem.classList.add('d-none');
                }
            } else if (!this.checked && textAreaItem) {
                if (!textAreaItem.classList.contains('d-none')) {
                    textAreaItem.classList.add('d-none');
                }
            }
            // console.log('change', parent, textAreaItem, TextArea);
            TextArea.forEach((elem) => {
                const textArea = elem;

                if (textArea !== textAreaItem) {
                    /* if (textArea.value.trim().length < 5) {
                    	textArea.value = '';
                    } */
                    if (!textArea.classList.contains('d-none')) {
                        textArea.classList.add('d-none');
                    }
                }
            });
        });
    });
}
