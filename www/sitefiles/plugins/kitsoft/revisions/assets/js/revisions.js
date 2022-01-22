/*
 * Scripts for the Revisions controller.
 */
+function ($) { "use strict";

    var Revisions = function() {

        this.clickRecord = function(revisionableId, revisionableType) {
            var newPopup = $('<a />')

            newPopup.popup({
                handler: 'onRevisionsList',
                size: 'giant'
            })
        }

        this.clickRevision = function(revisionId) {
            var newPopup = $('<a />')

            newPopup.popup({
                handler: 'onRevisionForm',
                size: 'huge',
                extraData: {
                    'revision_id': revisionId
                }
            })
        }

    }

    $.revisions = new Revisions;

}(window.jQuery);