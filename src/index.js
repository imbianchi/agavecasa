jQuery(document).ready(function ($) {
    "use strict";

    $.getScript('http://localhost/agave.loc/wp-content/themes/agavecasa/src/modules/search/Search.js')
        .done(function () {
            var search = new Search();
        })

});