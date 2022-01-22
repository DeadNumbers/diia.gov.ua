/**
 * Helper for init single chosen select
 * @param {string} selector - jquery selector
 * @param {object} [config] - chosen plugin config is optional
 */
export default function initChosen(selector, config) {
	$(selector).chosen(config);
	$('.chosen-container').trigger('mousedown.chosen');
	$(document).trigger('click');
	/* if ($(selector).length > 0) {
    	$(selector).on('touchstart', function(e){
    		e.stopPropagation(); e.preventDefault();
    		$(this).trigger('mousedown');
    	);
    } */
}
