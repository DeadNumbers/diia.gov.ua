import dompurify from 'dompurify';

const axios = require('axios');

export default class Medvisnovki {
    constructor() {
        this.settings();
        this.generate();
        this.texts();
        this.bindEvents();
        this.viewAuth();
    }
    settings() {
        this.filterForm = document.getElementById('medv_current_form');
        this.filterFormBtn = document.getElementById('med_send');
        this.searchResultsContainer = document.getElementById('searchResult');
        this.searchResultsPDF = document.getElementById('searchResultPDF');
        this.loader = document.getElementById('loadMore');
        this.filterParameters = '';
        this.localisation = '';
        this.localisationName = '';
    }
    generate() {
        const btnPrint = $('#btnPrint');

        const styles = '<style>body{font-size: 12px;margin: 0;font-family: "e-Ukraine", Arial, Helvetica, sans-serif;line-height: 1;padding-right: 20px;padding-left: 20px;letter-spacing: -0.02em;}@font-face{font-family: testFont; src: url(https://my.diia.gov.ua/fonts/e-Ukraine-Light.woff);}@font-face{font-family: testFontReg; src: url(https://my.diia.gov.ua/fonts/e-Ukraine-Regular.woff);}​ @font-face{font-family: testFontMed; src: url(https://my.diia.gov.ua/fonts/e-Ukraine-Medium.woff);}p{padding: 5px 0;}.borderBottom{border-bottom: 1px solid #bbb;}.separator{border-top: 2px solid #000;font-size: 110%;font-weight: 600;margin-top: 40px;padding-top: 40px;}.clear{float: none;clear: both;}.dib{display: inline-block;}.txtc{text-align: center;}.txtr{text-align: right;}.title{font-size: 24px;font-weight: 600;line-height:120%;}.fs110{font-size: 110%}.fs130{font-size: 130%}.fntsz90{font-size: 90%;}.fs85{font-size: 85%}.fs75{font-size: 75%}.fwb{font-weight: 600}.fntWB{font-weight: bold;}.fntWN{font-weight: normal;}.form{padding: 5%;}.mt5pers{margin-top: 5%;}.mt3pers{margin-top: 3%;}.mb3pers{margin-bottom: 3%;}.mb2pers{margin-bottom: 2%;}.form-label{color: #999;font-size: 9px;padding-bottom: 0;margin-bottom: 0;}.input{padding: 0 0 5px 0;margin-bottom: 0;width: 100%;}.prevent-separate{page-break-inside: avoid!important;break-inside: avoid!important;}.input-group{height: 10px;padding: 0 0 5px 0;margin-bottom: 0;}.noborder{border: none;}.pl5{padding-left: 5px;}.pr5{padding-right: 5px;}.pb5{padding-bottom: 5px;}.pb30{padding-bottom: 30px;}.mb30{margin-bottom: 30px;}.label{background-color: #F1F1F1;border-radius: 40px;padding: 10px 20px;display: inline-block;margin-top: 3%;margin-bottom: 1%;}.w25{width: 25%;}.w50{width: 50%;}.w70{width: 70%;}.w75{width: 75%;}.w85{width: 85%;}.w60{width: 60%;}.w30{width: 30%;}.mw50{max-width: 50%;}.minw70{min-width: 70px;}.nopadding{padding: 0;margin: 0;}.d-flex{display:flex;}.flr{float: right;}.fll{float: left;}.m0{margin: 0;}.mb15{margin-bottom: 15px;}.mr10{margin-right: 10px;}.ml10{margin-left: 10px;}.mt10{margin-top: 10px;}.mb10{margin-bottom: 10px;}.p0{padding: 0;}.pr15{padding-right: 15px;}.pb15{padding-bottom: 15px;}.pl15{padding-left: 15px;}.p5{padding: 5px;}.p10{padding: 10px;}.pl10pers{padding-left: 10%;}.vertAl-m{vertical-align: middle;}</style>';

        btnPrint.on('click', () => {
            const divContents = $('#pdfDoc').html();
            const printWindow = window.open('', '', 'height=400,width=800');

            printWindow.document.write('<html><head><title>Медичний висновок</title>');
            printWindow.document.write(styles);
            printWindow.document.write('</head><body>');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
    }
    texts() {
        this.exeptionText = (this.localisationName === 'en' ? 'Something went wrong' : 'Щось пішло не так');
        this.noResults = (this.localisationName === 'en' ? 'Nothing found' : 'Нічого не знайдено');
    }
    getLocalisation() {
        const html = document.querySelector('html');
        this.localisationName = html.getAttribute('lang') || '';
        this.localisation = (this.localisationName.length === 0 ? '' : `&lang=${this.localisationName}`);
    }
    clearResults() {
        this.searchResultsContainer.innerHTML = '';
    }
    requestStart() {
        this.filterForm.style.display = 'none';
        this.loader.style.display = 'block';
    }
    requestEnd() {
        this.loader.style.display = 'none';
        this.filterForm.style.display = 'none';
    }
    printException(text) {
        this.loader.style.display = 'none';
        this.searchResultsContainer.innerHTML = `<div class="error_not-found">${text}</div>`;
        this.searchErrorContainer.innerHTML = 'Error';
    }
    getCookie(name) {
        const reg = `(?:^|; )${name.replace(/([.$?*|{}()[]\\\/\+^])/g, '\\$1')}=([^;]*)`;
        const matches = document.cookie.match(new RegExp(reg));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }
    viewAuth() {
        const Cookie = this.getCookie('jwt');
        const parseStr = Cookie ? JSON.parse(Cookie) : '';

        if (parseStr.id) {
            $('#formAuthSelect').show();
            $('#medv_vysn_ower').hide();
            $('input[name="WhatMed"][value="1"]').attr('checked', true);
        } else {
            $("input[name='identityTypeID'][value='1']").attr('checked', true);
        }
    }
    getRequestParams() {
        this.clearResults();

        const Cookie = this.getCookie('jwt');
        const parseStr = Cookie ? JSON.parse(Cookie) : '';

        // const userId = parseStr.id ? `&userId=${parseStr.id}` : '';
        const medicDokNumb = this.filterForm.elements.medicDokNumb.value.trim().length > 0 ? `&medicDokNumb=${this.filterForm.elements.medicDokNumb.value.trim()}` : '';
        const identityTypeID = this.filterForm.elements.identityTypeID.value.trim().length > 0 ? `&identityTypeID=${this.filterForm.elements.identityTypeID.value.trim()}` : '';
        const rnokpp = this.filterForm.elements.rnokpp.value.trim().length > 0 ? `&rnokpp=${this.filterForm.elements.rnokpp.value.trim()}` : '';
        const identityDocNumb = this.filterForm.elements.identityDocNumb.value.trim().length > 0 ? `&identityDocNumb=${this.filterForm.elements.identityDocNumb.value.trim()}` : '';
        const series = this.filterForm.elements.series.value.trim().length > 0 ? `&series=${this.filterForm.elements.series.value.trim()}` : '';
        const number = this.filterForm.elements.number.value.trim().length > 0 ? `&number=${this.filterForm.elements.number.value.trim()}` : '';
        const passportTypeID = this.filterForm.elements.passportTypeID.value.trim().length > 0 ? `&passportTypeID=${this.filterForm.elements.passportTypeID.value.trim()}` : '';
        const userId = ((identityTypeID === '') && (parseStr.id)) ? `&userId=${parseStr.id}` : '';

        const params = `${medicDokNumb}${identityTypeID}${rnokpp}${identityDocNumb}${series}${number}${passportTypeID}${userId}`;
        console.log(params);
        this.filterParameters = dompurify.sanitize(params);
    }
    bindEvents() {
        this.filterForm.onsubmit = (e) => {
            e.preventDefault();
            e.stopPropagation();
            this.update();
        };
    }
    renderPDF(result) {
        // Генерируем PDF
        const { medicalDocument } = result.data;
        const { publicGetCompositionRequest } = result.data;

        const respPassIdCheck = publicGetCompositionRequest.identificationInfo.identityDocument ? publicGetCompositionRequest.identificationInfo.identityDocument.documentNumber : '';
        let respPassLength = '';

        if (respPassIdCheck.length === 8) {
            respPassLength = 'серія та номер паспорта';
        } else if (respPassIdCheck.length === 9) {
            respPassLength = 'номер ID-картки';
        } else {
            respPassLength = '';
        }

        this.searchResultsPDF.innerHTML = `
        <div id="pdfDoc">
          <div class="form">
            <div>
              <img src="https://my.diia.gov.ua/static/media/uasign.dcce7ac6.svg" />&nbsp;
              <img src="https://my.diia.gov.ua/static/media/diia-logo.a25c719a.svg" />
            </div>
            <p class="title fntWB">
              Медичний висновок<br>
              № ${medicalDocument.docNumb} від ${medicalDocument.docDate.replace(/^(\d+)-(\d+)-(\d+)$/, '$3.$2.$1')}
            </p>
            ${publicGetCompositionRequest.identificationInfo.identityDocument ? `
              <p class="form-label">${respPassLength}</p>
              <p class="borderBottom mb2pers input">${publicGetCompositionRequest.identificationInfo.identityDocument.documentNumber}</p>
            ` : ''}
            ${medicalDocument.type ? `
              <p class="form-label">Тип медичного висновку</p>
              <p class="borderBottom mb2pers input">${medicalDocument.type}</p>` : ''}
            ${publicGetCompositionRequest.identificationInfo.taxRNOKPP ? `
              <p class="form-label">Ідентифікатор</p>
              <p class="borderBottom mb2pers input">${publicGetCompositionRequest.identificationInfo.taxRNOKPP}</p>` : ''}
            ${medicalDocument.docOrgName ? `
              <p class="form-label">Заклад охорони здоров’я, що видав висновок</p>
              <p class="borderBottom mb2pers input">${medicalDocument.docOrgName}</p>` : ''}
            ${medicalDocument.validityPeriodStart ? `
              <p class="form-label">Дійсний з</p>
              <p class="borderBottom mb2pers input">${medicalDocument.validityPeriodStart.replace(/^(\d+)-(\d+)-(\d+)$/, '$3.$2.$1')}</p>` : ''}
            ${medicalDocument.validityPeriodEnd ? `
              <p class="form-label">Дійсний по</p>
              <p class="borderBottom mb2pers input">${medicalDocument.validityPeriodEnd.replace(/^(\d+)-(\d+)-(\d+)$/, '$3.$2.$1')}</p>` : ''}
          </div>
      </div>`;
    }
    renderHtml(result) {
        const { medicalDocument } = result.data;
        const { publicGetCompositionRequest } = result.data;

        const respPassIdCheck = publicGetCompositionRequest.identificationInfo.identityDocument ? publicGetCompositionRequest.identificationInfo.identityDocument.documentNumber : '';
        let respPassLength = '';

        if (respPassIdCheck.length === 8) {
            respPassLength = 'серія та номер паспорта';
        } else if (respPassIdCheck.length === 9) {
            respPassLength = 'номер ID-картки';
        } else {
            respPassLength = '';
        }

        console.log(respPassLength, respPassIdCheck.length);

        this.searchResultsContainer.innerHTML = `
        <div class="medv_step medv_step-two" id="medv_step_two">
          <div class="medv_vysn">
            <span class="medv_vysn-title">Медичний висновок, знайдений за вашим запитом:</span>
            <ul>
              <!-- Номер мед висновку -->
              <li>номер медичного висновку ${medicalDocument.docNumb}</li>
              <!-- РНОКПП -->
              ${publicGetCompositionRequest.identificationInfo.taxRNOKPP ? `
                <li>РНОКПП ${publicGetCompositionRequest.identificationInfo.taxRNOKPP}</li>
              ` : ''}
              <!-- Номер паспорту -->
              ${publicGetCompositionRequest.identificationInfo.identityDocument ? `
                <li>${respPassLength} ${publicGetCompositionRequest.identificationInfo.identityDocument.documentNumber}</li>
              ` : ''}
            </ul>

            <div class="medv_vysn-finish">

            ${medicalDocument.type ? `
            <div class="medv_vysn-finish__row">
                <div class="medv_vysn-finish__item">
                  <span class="medv_vysn-finish__title">Тип медичного висновку</span>
                  <span class="medv_vysn-finish__cont">${medicalDocument.type}</span>
                </div>
              </div>` : ''}

            ${medicalDocument.docDate ? `
            <div class="medv_vysn-finish__row">
                <div class="medv_vysn-finish__item">
                  <span class="medv_vysn-finish__title">Дата створення</span>
                  <span class="medv_vysn-finish__cont">${medicalDocument.docDate.replace(/^(\d+)-(\d+)-(\d+)$/, '$3.$2.$1')}</span>
                </div>
              </div>` : ''}

            ${publicGetCompositionRequest.identificationInfo.taxRNOKPP ? `
            <div class="medv_vysn-finish__row">
                <div class="medv_vysn-finish__item">
                  <span class="medv_vysn-finish__title">Ідентифікатор</span>
                  <span class="medv_vysn-finish__cont">${publicGetCompositionRequest.identificationInfo.taxRNOKPP}</span>
                </div>
              </div>` : ''}

            ${medicalDocument.docNumb ? `
            <div class="medv_vysn-finish__row">
                <div class="medv_vysn-finish__item">
                  <span class="medv_vysn-finish__title">Номер документу</span>
                  <span class="medv_vysn-finish__cont">${medicalDocument.docNumb}</span>
                </div>
              </div>` : ''}

            ${medicalDocument.docOrgName ? `
            <div class="medv_vysn-finish__row">
                <div class="medv_vysn-finish__item">
                  <span class="medv_vysn-finish__title">Заклад охорони здоров’я, що видав висновок</span>
                  <span class="medv_vysn-finish__cont">${medicalDocument.docOrgName}</span>
                </div>
              </div>` : ''}

              ${medicalDocument.validityPeriodStart ? `
              <div class="medv_vysn-finish__row">
                  <div class="medv_vysn-finish__item">
                    <span class="medv_vysn-finish__title">Дійсний з</span>
                    <span class="medv_vysn-finish__cont">${medicalDocument.validityPeriodStart.replace(/^(\d+)-(\d+)-(\d+)$/, '$3.$2.$1')}</span>
                  </div>
                </div>` : ''}

                ${medicalDocument.validityPeriodEnd ? `
                <div class="medv_vysn-finish__row">
                    <div class="medv_vysn-finish__item">
                      <span class="medv_vysn-finish__title">Дійсний по</span>
                      <span class="medv_vysn-finish__cont">${medicalDocument.validityPeriodEnd.replace(/^(\d+)-(\d+)-(\d+)$/, '$3.$2.$1')}</span>
                    </div>
                  </div>` : ''}
            </div>
          </div>
        </div>`;
    }
    update() {
        this.getRequestParams();
        this.getResults();
    }
    getResults() {
        // const testParameters = medicDokNumb=XC4P-9099-X7M7-7546&rnokpp=3132919692
        this.requestStart();
        axios.get(`/api/v1/health?${this.filterParameters}&g-recaptcha-response=${window.medvisnovkiReCaptchaToken}`)
            .then((response) => {
                if (response.data.error) {
                    if (response.data.error.message === 'Nszu response error') {
                        this.printException(`
                      <div class="row">
                        <div class="col-12">
                          <div class="medv_form-error">
                            <span class="medv_form-error--emoji">🤷‍♂️</span>
                            <span class="medv_form-error--title">Ви не можете скористатися послугою</span>
                            <span class="medv_form-error--text">Перевірте коректність введених даних або спробуйте пізніше</span>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12">
                          <div class="medv_form-send">
                            <button class="btn_send" id="med_back" onclick="location.reload();">Назад до пошуку</button>
                          </div>
                        </div>
                      </div>`);
                        console.log(response.data.error.message);
                    } else if (response.data.error.details.errorCode === '404') {
                        this.printException(`
                          <div class="row">
                            <div class="col-12">
                              <div class="medv_form-error">
                                <span class="medv_form-error--emoji">🤷‍♂️</span>
                                <span class="medv_form-error--title">За вашим запитом нічого не знайдено</span>
                                <span class="medv_form-error--text">Медичний висновок відсутній, внесено невірний номер медичного висновку або він не підписаний лікарем. Перевірте, чи правильно ви ввели номер. Якщо все вірно, зверніться до лікаря, який видав висновок</span>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12">
                              <div class="medv_form-send">
                                <button class="btn_send" id="med_back" onclick="location.reload();">Назад до пошуку</button>
                              </div>
                            </div>
                          </div>`);
                        console.log('Error 404');
                    } else if (response.data.error.details.errorCode === '500') {
                        this.printException(`
                          <div class="row">
                            <div class="col-12">
                              <div class="medv_form-error">
                                <span class="medv_form-error--emoji">🤷‍♂️</span>
                                <span class="medv_form-error--title">На жаль, сталася помилка</span>
                                <span class="medv_form-error--text">Сервіс перевірки медичного висновку тимчасово недоступний. Спробуйте пізніше</span>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12">
                              <div class="medv_form-send">
                                <button class="btn_send" id="med_back" onclick="location.reload();">Назад до пошуку</button>
                              </div>
                            </div>
                          </div>`);
                        console.log('Error 500');
                    } else if (response.data.error.details.errorCode === '10910') {
                        this.printException(`
                          <div class="row">
                            <div class="col-12">
                              <div class="medv_form-error">
                                <span class="medv_form-error--emoji">🤷‍♂️</span>
                                <span class="medv_form-error--title">Неправильні дані</span>
                                <span class="medv_form-error--text">Дані для перевірки медичного висновку не співпадають. Введіть РНОКПП або паспортні дані отримувача</span>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12">
                              <div class="medv_form-send">
                                <button class="btn_send" id="med_back" onclick="location.reload();">Назад до пошуку</button>
                              </div>
                            </div>
                          </div>`);
                        console.log('Error 10910');
                    } else if (response.data.error.details.errorCode === '10911') {
                        this.printException(`
                          <div class="row">
                            <div class="col-12">
                              <div class="medv_form-error">
                                <span class="medv_form-error--emoji">🤷‍♂️</span>
                                <span class="medv_form-error--title">На жаль, сталася помилка</span>
                                <span class="medv_form-error--text">В електронній системі охорони здоров’я не зазначено РНОКПП отримувача. Спробуйте пошук за паспортними даними або зверніться до лікаря для оновлення персональних даних.</span>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12">
                              <div class="medv_form-send">
                                <button class="btn_send" id="med_back" onclick="location.reload();">Назад до пошуку</button>
                              </div>
                            </div>
                          </div>`);
                        console.log('Error 10911');
                    } else if (response.data.error.details.errorCode === '10912') {
                        this.printException(`
                          <div class="row">
                            <div class="col-12">
                              <div class="medv_form-error">
                                <span class="medv_form-error--emoji">🤷‍♂️</span>
                                <span class="medv_form-error--title">Неправильні дані</span>
                                <span class="medv_form-error--text">Невірно зазначено РНОКПП отримувача. Перевірте, чи правильно ви ввели РНОКПП (ІПН). Спробуйте пошук за УНЗР або паспортними даними, або зверніться до лікаря для оновлення персональних даних</span>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12">
                              <div class="medv_form-send">
                                <button class="btn_send" id="med_back" onclick="location.reload();">Назад до пошуку</button>
                              </div>
                            </div>
                          </div>`);
                        console.log('Error 10912');
                    } else if (response.data.error.details.errorCode === '10913') {
                        this.printException(`
                          <div class="row">
                            <div class="col-12">
                              <div class="medv_form-error">
                                <span class="medv_form-error--emoji">🤷‍♂️</span>
                                <span class="medv_form-error--title">На жаль, сталася помилка</span>
                                <span class="medv_form-error--text">В електронній системі охорони здоров’я не зазначено УНЗР отримувача. Спробуйте пошук за РНОКПП або паспортними даними, або зверніться до лікаря для оновлення персональних даних</span>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12">
                              <div class="medv_form-send">
                                <button class="btn_send" id="med_back" onclick="location.reload();">Назад до пошуку</button>
                              </div>
                            </div>
                          </div>`);
                        console.log('Error 10913');
                    } else if (response.data.error.details.errorCode === '10914') {
                        this.printException(`
                          <div class="row">
                            <div class="col-12">
                              <div class="medv_form-error">
                                <span class="medv_form-error--emoji">🤷‍♂️</span>
                                <span class="medv_form-error--title">Неправильні дані</span>
                                <span class="medv_form-error--text">Невірно зазначено УНЗР отримувача. Перевірте, чи правильно ви ввели номер. Спробуйте пошук за РНОКПП або паспортними даними, або зверніться до лікаря для оновлення персональних даних</span>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12">
                              <div class="medv_form-send">
                                <button class="btn_send" id="med_back" onclick="location.reload();">Назад до пошуку</button>
                              </div>
                            </div>
                          </div>`);
                        console.log('Error 10914');
                    } else if (response.data.error.details.errorCode === '10915') {
                        this.printException(`
                          <div class="row">
                            <div class="col-12">
                              <div class="medv_form-error">
                                <span class="medv_form-error--emoji">🤷‍♂️</span>
                                <span class="medv_form-error--title">Сталася помилка</span>
                                <span class="medv_form-error--text">Введіть паспортні дані отримувача. Спробуйте пошук за УНЗР або РНОКПП, або зверніться до лікаря для оновлення персональних даних</span>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12">
                              <div class="medv_form-send">
                                <button class="btn_send" id="med_back" onclick="location.reload();">Назад до пошуку</button>
                              </div>
                            </div>
                          </div>`);
                        console.log('Error 10915');
                    } else if (response.data.error.details.errorCode === '10916') {
                        this.printException(`
                          <div class="row">
                            <div class="col-12">
                              <div class="medv_form-error">
                                <span class="medv_form-error--emoji">🤷‍♂️</span>
                                <span class="medv_form-error--title">На жаль, сталася помилка</span>
                                <span class="medv_form-error--text">Реквізити паспорту отримувача відсутні в електронній системі охорони здоров’я. Спробуйте пошук за УНЗР або РНОКПП, або зверніться до лікаря для оновлення персональних даних</span>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12">
                              <div class="medv_form-send">
                                <button class="btn_send" id="med_back" onclick="location.reload();">Назад до пошуку</button>
                              </div>
                            </div>
                          </div>`);
                        console.log('Error 10916');
                    } else if (response.data.error.details.errorCode === '10917') {
                        this.printException(`
                          <div class="row">
                            <div class="col-12">
                              <div class="medv_form-error">
                                <span class="medv_form-error--emoji">🤷‍♂️</span>
                                <span class="medv_form-error--title">Неправильні дані</span>
                                <span class="medv_form-error--text">Реквізити паспорту отримувача не відповідають даним, зазначеним в електронній системі охорони здоров’я. Перевірте, чи правильно ви ввели дані. Спробуйте пошук за УНЗР або РНОКПП, або зверніться до лікаря для оновлення персональних даних</span>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12">
                              <div class="medv_form-send">
                                <button class="btn_send" id="med_back" onclick="location.reload();">Назад до пошуку</button>
                              </div>
                            </div>
                          </div>`);
                        console.log('Error 10917');
                    } else {
                        this.printException(`
                          <div class="row">
                            <div class="col-12">
                              <div class="medv_form-error">
                                <span class="medv_form-error--emoji">🤷‍♂️</span>
                                <span class="medv_form-error--title">Ви не можете скористатися послугою</span>
                                <span class="medv_form-error--text">${response.data.error.message}</span>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12">
                              <div class="medv_form-send">
                                <button class="btn_send" id="med_back" onclick="location.reload();">Назад до пошуку</button>
                              </div>
                            </div>
                          </div>`);
                        console.log(response.data.error.message);
                    }
                } else {
                    $('#afterSearch').show();
                    this.renderHtml(response.data);
                    this.renderPDF(response.data);
                    console.log(response.data);
                }
                this.requestEnd();
            })
            .catch((error) => {
                // handle error
                console.log(error.error.message);
                this.requestEnd();
                this.printException(`${this.exeptionText
                }
                <div class="row">
                  <div class="col-12">
                    <div class="medv_form-send">
                      <button class="btn_send" id="med_back" onclick="location.reload();">Назад до пошуку</button>
                    </div>
                  </div>
                </div>
              `);
            })
            .then(() => {
                // always executed
            });
    }
}
