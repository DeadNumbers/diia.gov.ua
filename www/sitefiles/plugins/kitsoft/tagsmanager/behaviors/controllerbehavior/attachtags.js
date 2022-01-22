$.ajax({
	type: 'post',

	headers: {
        'X-OCTOBER-REQUEST-HANDLER': 'onAttachTagsButton',
        'X-Requested-With': 'XMLHttpRequest'
    },

    success: function(data) {
        $('.toolbar-widget .control-toolbar .toolbar-item.toolbar-primary div[data-control="toolbar"]').eq(0).append(data.result)
    }
})