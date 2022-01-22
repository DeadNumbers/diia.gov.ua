$(document).ready(function () {
	var lang = $('html').attr('lang')

    $.request('onServiceHit', {
    	data: {
    		lang: lang
    	}
	})

	$('a.online-mss-btn').on('click', function() {
		$.request('onServiceActionHit', {
	    	data: {
	    		lang: lang
	    	}
		})
	})
})