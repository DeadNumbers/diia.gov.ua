/*
 * MultiMediaFinder plugin
 *
 * Data attributes:
 * - data-control="multimediafinder" - enables the plugin on an element
 * - data-option="value" - an option with a value
 *
 * JavaScript API:
 * $('a#someElement').recordFinder({ option: 'value' })
 *
 * Dependences:
 * - Some other plugin (filename.js)
 */

+function ($) { "use strict";
    var Base = $.oc.foundation.base,
        BaseProto = Base.prototype

    var MultiMediaFinder = function (element, options) {
        this.$el = $(element)
        this.options = options || {}

        $.oc.foundation.controlUtils.markDisposable(element)
        Base.call(this)
        this.init()
    }

    MultiMediaFinder.prototype = Object.create(BaseProto)
    MultiMediaFinder.prototype.constructor = MultiMediaFinder

    MultiMediaFinder.prototype.init = function() {
        if (this.options.isMulti === null) {
            this.options.isMulti = this.$el.hasClass('is-multi')
        }

        if (this.options.isPreview === null) {
            this.options.isPreview = this.$el.hasClass('is-preview')
        }

        if (this.options.isImage === null) {
            this.options.isImage = this.$el.hasClass('is-image')
        }

        this.$el.one('dispose-control', this.proxy(this.dispose))

        // Stop here for preview mode
        if (this.options.isPreview)
            return

        this.$el.on('click', '.find-button', this.proxy(this.onClickFindButton))
        this.$el.on('click', '.find-remove-button', this.proxy(this.onClickRemoveButton))

        this.$findValue = $('[data-find-value]', this.$el)

        this.$template = this.$el.parents('.form-group').find("script[type='text/template']").html()
        this.$filesContainer = this.$el.parents('.form-group').find(".upload-files-container")
    }

    MultiMediaFinder.prototype.dispose = function() {
        this.$el.off('click', '.find-button', this.proxy(this.onClickFindButton))
        this.$el.off('click', '.find-remove-button', this.proxy(this.onClickRemoveButton))
        this.$el.off('dispose-control', this.proxy(this.dispose))
        this.$el.removeData('oc.multiMediaFinder')

        this.$findValue = null
        this.$el = null

        // In some cases options could contain callbacks, 
        // so it's better to clean them up too.
        this.options = null

        BaseProto.dispose.call(this)
    }

    MultiMediaFinder.prototype.onClickRemoveButton = function() {
        this.$findValue.val('')
        this.evalIsPopulated()
    }

    MultiMediaFinder.prototype.onClickFindButton = function() {
        var self = this

        new $.oc.mediaManager.popup({
            alias: 'ocmediamanager',
            cropAndInsertButton: true,
            onInsert: function(items) {
                if (!items.length) {
                    alert('Please select image(s) to insert.')
                    return
                }

                $.each(items, function(key, value) {
                    $('form').request('onMultiFileUpload', {
                        data: {value: value.path},
                        success: function(data) {
                            value.id = data.id
                            var html = Mustache.render(self.$template, {
                                fileId: value.id,
                                publicUrl: value.publicUrl,
                                title: value.title
                            })
                            self.$filesContainer.append(html)
                        }
                    })                    
                })

                this.hide()
            }
        })

    }

    MultiMediaFinder.DEFAULTS = {
        isMulti: null,
        isPreview: null,
        isImage: null
    }

    // PLUGIN DEFINITION
    // ============================

    var old = $.fn.multiMediaFinder

    $.fn.multiMediaFinder = function (option) {
        var args = arguments;

        return this.each(function () {
            var $this   = $(this)
            var data    = $this.data('oc.multiMediaFinder')
            var options = $.extend({}, MultiMediaFinder.DEFAULTS, $this.data(), typeof option == 'object' && option)
            if (!data) $this.data('oc.multiMediaFinder', (data = new MultiMediaFinder(this, options)))
            if (typeof option == 'string') data[option].apply(data, args)
        })
      }

    $.fn.multiMediaFinder.Constructor = MultiMediaFinder

    $.fn.multiMediaFinder.noConflict = function () {
        $.fn.multiMediaFinder = old
        return this
    }

    $(document).render(function (){
        $('[data-control="multimediafinder"]').multiMediaFinder()
    })

}(window.jQuery);
