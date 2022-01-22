export default class MedVal {
    constructor() {
        this.initModules();
    }
    initModules() {
        this.settings();
        this.validatePas();
        this.validate();
        this.mask();
    }
    settings() {
        // Init Form
        this.currentForm = $('#medv_current_form');

        // Inputs
        this.NumMedVysn = $('input#num_med_vysn');
        this.RNOKPP = $('input#rnokpp');
        this.Serial = $('input#serial');
        this.PassNum = $('input#pass_num');
        this.IdCardNum = $('input#id_card_num');
        this.PosvidNum = $('input#posvid_num');
    }
    validatePas() {
        const inpPass = $('.input-pas');
        const inpPassId = $('.input-pasid');

        $(inpPass).on('input', function() {
            if (($(this.Serial).val !== '') && ($(this.PassNum).val !== '')) {
                $(inpPassId).attr('disabled', true);
            }
        });

        $(inpPassId).on('input', function() {
            if (this.val !== '') {
                $(inpPass).attr('disabled', true);
            }
        });

        $(inpPass).on('input', (e) => {
            const { value } = e.target;
            if (!value.length && !this.Serial.val().length && !this.PassNum.val().length) {
                $(inpPassId).attr('disabled', false);
            }
        });

        $(inpPassId).on('input', (e) => {
            const { value } = e.target;
            if (!value.length) {
                $(inpPass).attr('disabled', false);
            }
        });
    }
    validate() {
        const { currentForm } = this;
        const btn = document.getElementById('med_send'); // Init Send Btn

        const nmvRequired = 'Це поле є обов`язковим для заповнення';
        const nmvLength = 'Має містити 16 символів';
        const rnokppLength = 'Має містити 10 цифр';
        const serialLength = 'Обов`язкове поле';
        const passLength = 'Має містити 6 цифр';
        const idCardLength = 'Має містити 9 цифр';
        const reqGroup = 'Вкажіть хоча б один параметр для пошуку';
        const fieldRequired = 'Це поле є обов`язковим для заповнення';

        $.validator.addMethod('require_from_group', (value, element, options) => {
            const numberRequired = options[0];
            const selector = options[1];
            const fields = $(selector, element.form);
            const filledFields = fields.filter(function() {
                // it more clear to compare with empty string
                return $(this).val() !== '';
            });
            const emptyFields = fields.not(filledFields);
            // we will mark only first empty field as invalid
            if (filledFields.length < numberRequired && emptyFields[0] === element) {
                return false;
            }
            return true;
            // {0} below is the 0th item in the options field
        }, reqGroup);

        currentForm.validate({
            debug: true,
            errorClass: 'error',
            errorElement: 'span',
            errorPlacement(error, element) {
                const errorContainer = element.closest('.js-input-wrap').find('.medv_input-error');
                error.appendTo(errorContainer);
            },
            rules: {
                medicDokNumb: {
                    required: true,
                    rangelength: [19, 19]
                },
                rnokpp: {
                    required: false,
                    rangelength: [10, 10],
                    require_from_group: [2, '.input']
                },
                series: {
                    required: false,
                    // required: {
                    //     param: true,
                    //     depends() {
                    //         return $(this.PassNum).val !== null;
                    //     }
                    // },
                    rangelength: [2, 2],
                    require_from_group: [2, '.input']
                },
                number: {
                    required: false,
                    // required: {
                    //     param: true,
                    //     depends() {
                    //         return $(this.Serial).val !== null;
                    //     }
                    // },
                    rangelength: [6, 6],
                    require_from_group: [2, '.input']
                },
                passportTypeID: {
                    required: false
                },
                posvid_num: {
                    required: {
                        param: true,
                        depends() {
                            return $('#vlasn_no').is(':checked');
                        }
                    }
                }
            },
            messages: {
                medicDokNumb: { // Номер медичного висновку
                    required: nmvRequired,
                    rangelength: nmvLength
                },
                rnokpp: {
                    rangelength: rnokppLength,
                    required: fieldRequired
                },
                series: {
                    rangelength: serialLength,
                    required: fieldRequired
                },
                number: {
                    rangelength: passLength,
                    required: fieldRequired
                },
                passportTypeID: {
                    rangelength: idCardLength,
                    required: fieldRequired
                },
                posvid_num: {
                    required: nmvRequired
                }
            }
        });
        $(btn).on('click', (e) => {
            if (!$('#g-recaptcha-response').val()) {
                e.preventDefault();
                e.stopPropagation();
                $('#recaptchaError').text('Поле reCAPTCHA обов’язкове для заповнення');
            }
            if (($(this.Serial).val() && !$(this.PassNum).val()) || (!$(this.Serial).val() && $(this.PassNum).val())) {
                e.preventDefault();
                e.stopPropagation();
                $(this.Serial).addClass('error').css('border-color', 'red');
                $(this.PassNum).addClass('error').css('border-color', 'red');
            }
            if (!currentForm.valid()) {
                e.preventDefault();
                e.stopPropagation();
            }
        });
    }
    mask() {
        this.NumMedVysn.mask('ZZZZ-ZZZZ-ZZZZ-ZZZZ', {
            translation: {
                Z: { pattern: /[A-Za-z0-9]/ }
            }
        });

        this.RNOKPP.mask('9999999999', {
            translation: {
                9: { pattern: /[0-9]/ }
            }
        });

        this.Serial.mask('ZZ', {
            translation: {
                Z: { pattern: /[а-яА-ЯЁёєЄіІїЇґҐ]/ }
            }
        });

        this.PassNum.mask('999999', {
            translation: {
                9: { pattern: /[0-9]/ }
            }
        });

        this.IdCardNum.mask('999999999', {
            translation: {
                9: { pattern: /[0-9]/ }
            }
        });
    }
}
