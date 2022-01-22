$(document).ready(function () {
	$.ajax({
		method: 'POST',
		url: '/api/backend-toolbar',
		data: {
			hash: $('#page-hash').data('hash'),
			lang: $('html').attr('lang')
		},
		xhrFields: {
			withCredentials: true
		},
		success: function(data) {
			$('body').prepend(data)
		}
	})
})