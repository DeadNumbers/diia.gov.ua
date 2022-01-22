export default function(requestUrl) {
    const currentForm = $('#modal-send-email');
    const btn = document.getElementById('modal-send-email-btn');
    if (currentForm && btn) {
        let emailError = 'Поле не може бути порожнім';
        let emailExapmle = 'Необхідний формат адреси: email@example.com';
        let shortEmail = 'Будь ласка, введіть не менше 5-ти символів';

        if (window.location.pathname.indexOf('/en') !== -1) {
            emailError = 'Error in email address';
            emailExapmle = 'Required format: email@example.com';
            shortEmail = 'Enter at least 5 characters in the field';
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
                email: {
                    required: true,
                    email: true,
                    minlength: 5
                }
            },
            messages: {
                email: {
                    required: emailError,
                    email: emailExapmle,
                    minlength: shortEmail
                }
            },
            // focusCleanup: true,
            errorPlacement(error, element) {
                error.insertAfter(element);
                if (element.attr('name') === 'email') {
                    error.insertAfter('input.form-service_input');
                }
            }
        });

        $(btn).on('click', (e) => {
            if (!currentForm.valid()) {
                e.preventDefault();
                e.stopPropagation();
                return;
            }
            $(currentForm).request(`${requestUrl}`, {
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
