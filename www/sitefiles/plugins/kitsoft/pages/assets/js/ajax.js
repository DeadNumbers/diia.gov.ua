jQuery(window).on('ajaxInvalidField', function(event, fieldElement, fieldName, errorMsg, isFirst) {
    $(fieldElement).closest('.form-group').addClass('has-error')
});

$(document).on('ajaxPromise', '[data-request]', function() {
    $(this).closest('form').find('.form-group.has-error').removeClass('has-error')
});

$(window).on('ajaxErrorMessage', function(event, message){
	console.log(message)
    event.preventDefault()
})