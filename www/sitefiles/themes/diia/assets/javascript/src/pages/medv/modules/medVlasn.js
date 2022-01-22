export default class MedVla {
    constructor() {
        this.settings();
        this.toggleInfo();
    }
    settings() {
        this.mvYes = document.getElementById('medv_vlasn_yes');
        this.mvNo = document.getElementById('medv_vlasn_no');
        this.vyOwr = document.getElementById('medv_vysn_ower');

        this.RNOKPP = $('input#rnokpp');
        this.Serial = $('input#serial');
        this.PassNum = $('input#pass_num');
        this.IdCardNum = $('input#id_card_num');
        this.PosvidNum = $('input#posvid_num');
    }
    toggleInfo() {
        $(this.mvYes).show();

        $(":radio[name='identityTypeID'][value='1']").change(() => {
            $(this.mvYes).slideDown();
            $(this.mvNo).slideUp();
            this.PosvidNum.val('');
        });

        $(":radio[name='identityTypeID'][value='7']").change(() => {
            $(this.mvNo).slideDown();
            $(this.mvYes).slideUp();
            this.RNOKPP.val('');
            this.Serial.val('').attr('disabled', false);
            this.PassNum.val('').attr('disabled', false);
            this.IdCardNum.val('').attr('disabled', false);
        });

        $(":radio[name='WhatMed'][value='1']").change(() => {
            $(this.vyOwr).slideUp();
            $('#vlasn_yes').attr('checked', false);
            $('#vlasn_no').attr('checked', false);
        });

        $(":radio[name='WhatMed'][value='2']").change(() => {
            $(this.vyOwr).slideDown();
            $('#vlasn_yes').attr('checked', true);
            this.RNOKPP.val('');
            this.Serial.val('').attr('disabled', false);
            this.PassNum.val('').attr('disabled', false);
            this.IdCardNum.val('').attr('disabled', false);
        });
    }
}
