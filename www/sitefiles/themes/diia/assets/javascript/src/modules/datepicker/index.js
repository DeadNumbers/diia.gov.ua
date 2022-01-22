/**
 * Helper for init datepicker
 * @param {string} selector - jquery selector
 * @param {object} [config] - plugin config is optional
 */
export default function initDatepicker(selector, config) {
    $(selector).datepicker(config);
}
