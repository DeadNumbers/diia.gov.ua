/**
 * Helper for input placeholder label`s
 * @param {string} selector - jquery selector, wrapper (.form-control for example)
 */
export default function initPlaceholder(selector) {
    const currentInput = $(selector);
    // Transform input label`s
    currentInput.find('input').on('input', (e) => {
        $(e.currentTarget).attr('data-empty', !e.currentTarget.value);
    });
    // Focus on current input if click on label
    currentInput.find('input ~ label.placeholder').on('click', function() {
        $(this).closest('div').find('input').focus();
    });
}
