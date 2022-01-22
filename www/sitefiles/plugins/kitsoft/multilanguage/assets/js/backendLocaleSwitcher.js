$(document).ready(function() {
	var $toolbar = $('nav .mainmenu-toolbar');
	var html = '<a href="javascript:;" onclick="$.oc.layout.toggleAccountMenu(this)" class="multilanguage-active-title"></a><div class="mainmenu-multilanguagemenu" style="right:auto;"><ul class="langs"></ul></div>';

	$toolbar.prepend(
		$('<li>', {class: 'mainmenu-multilanguage'})
			.append(html)
	);

	$.getJSON('/api/multilanguage', function(locales) {
		var activeLocale = $.cookie('backendLocale');

		for (key in locales) {
			if(key == activeLocale) {
				$('.multilanguage-active-title').text(locales[key]);
				break;
			}
		}		

		var url;
		var requestData;
		for (key in locales) {
			if(key == activeLocale) continue;
			url = $('input[name=languagesSwitcher][data-lang='+key+']').val();
			
			requestData = "locale: '" + key + "'";
			requestData = url ? requestData + ",redirect: '" + url + "'" : requestData;
			
			$toolbar.find('.langs').append(
				$('<li>').append($('<a>', {
					'data-code': key,
					href: '#',
					'data-request': 'onSwitchLocale',
					'data-request-data': requestData, 
				}).html(locales[key]))
			)
		}
	});
});
