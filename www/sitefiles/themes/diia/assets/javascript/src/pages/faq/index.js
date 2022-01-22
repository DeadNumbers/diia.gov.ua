import header from '../../modules/header';
import AccordionParent from '../../modules/AccordionParent';

/**
 * Home page
 */
class Faq {
    /**
     * Home page constructor
     */
    constructor() {
        this.initModules();
    }
    /**
     *  Method for init plugins
     */
    initModules() {
        header();
        new AccordionParent('.js-faq_item-title').showAll();
        this.settings();
        this.validate();
    }
    settings() {
        this.currentForm = $('#form-faq-item');
    }
    validate() {
        const { currentForm } = this;

        currentForm.on('change', (e) => {
            e.target.value = e.target.value.replace(/["'<>]/gi, ' ');
        });

        const btn = document.getElementById('form-faq-item-btn');

        // let emailError = 'Поле Електронна пошта не може бути порожнім';
        let emailExapmle = 'Необхідний формат адреси: email@example.com';
        let emailShort = 'Будь ласка, введіть не менше 5-ти символів';

        let textError = 'Поле не може бути порожнім';
        let textShort = 'Будь ласка, введіть не менше 3-x символів';
        let textShortName = 'Будь ласка, введіть не менше 2-x символів';
        let textLong = 'Будь ласка, введіть не більше 250-ти символів';

        if (window.location.pathname.indexOf('/en') !== -1) {
            // emailError = 'Error in email address';
            emailExapmle = 'Required format: email@example.com';
            emailShort = 'Enter at least 5 characters in the field';

            textError = 'The field cannot be blank';
            textShort = 'Enter at least 3 characters in the field';
            textShortName = 'Enter at least 2 characters in the field';
            textLong = 'Please enter a maximum of 250 characters';
        }

        $.validator.setDefaults({
            submitHandler(form) {
                form.submit();
            }
        });

        $.validator.methods.email = function(value, element) {
            const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return this.optional(element) || re.test(String(value).toLowerCase());
        };

        currentForm.validate({
            debug: true,
            ignore: '.ignore',
            errorElement: 'div',
            rules: {
                name: {
                    required: true,
                    minlength: 2,
                    maxlength: 250
                },
                email: {
                    required: true,
                    email: true,
                    minlength: 5
                },
                company: {
                    required: true,
                    minlength: 3,
                    maxlength: 250
                },
                question: {
                    required: true,
                    minlength: 3,
                    maxlength: 250
                }
            },
            messages: {
                name: {
                    required: textError,
                    minlength: textShortName,
                    maxlength: textLong
                },
                email: {
                    required: textError,
                    email: emailExapmle,
                    minlength: emailShort
                },
                company: {
                    required: textError,
                    minlength: textShort,
                    maxlength: textLong
                },
                question: {
                    required: textError,
                    minlength: textShort,
                    maxlength: textLong
                }
            },
            // focusCleanup: true,
            errorPlacement(error, element) {
                error.insertAfter(element);
                /* if (element.attr('name') === 'email') {
                    error.insertAfter('input.form-service_input');
                } */
            }
        });
        $(btn).on('click', (e) => {
            if (!currentForm.valid()) {
                e.preventDefault();
                e.stopPropagation();
                return;
            }

            $('#form-faq-item input').each(function() {
                this.value = this.value.replace(/["'<>]/gi, ' ');
            });

            $(currentForm).request('onSubmitForm', {
                success() {
                    $('#exampleModal').find('.modal-service_body').css({ display: 'none' });
                    $('#exampleModal').find('.modal-service_done').css({ display: 'block' });
                    console.log('success');
                    setTimeout(() => {
                        $('#exampleModal').modal('hide');
                        setTimeout(() => {
                            $('#exampleModal').find('.modal-service_done').css({ display: 'none' });
                            $('#exampleModal').find('.modal-service_body').css({ display: 'block' });
                            $(currentForm)[0].reset();
                        }, 500);
                    }, 1500);
                },
                error() {
                    console.log('error');
                }
            });
        });
    }
}
new Faq();
