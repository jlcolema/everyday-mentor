/***************************************************
      Live Search
***************************************************/

//var _url = '';
jQuery(function ($) {
    'use strict';

    jQuery.Autocomplete.prototype.suggest = function () {
      
        if (this.suggestions.length === 0) {
            this.hide();
            return;
        }

        var that = this,
            formatResult = that.options.formatResult,
            value = that.getQuery(that.currentValue),
            className = that.classes.suggestion,
            classSelected = that.classes.selected,
            container = $(that.suggestionsContainer),
            html = '';
        // Build suggestions inner HTML
        $.each(that.suggestions, function (i, suggestion) {
            //html += '<div class="' + className + suggestion.css + '" data-index="' + i + '"><p class="ls-'+suggestion.type_color+'">'+suggestion.type_label+'</p> <h4>'+suggestion.icon + formatResult(suggestion, value) + '</h4></div>';
            html += '<div class="' + className + suggestion.css + '" data-index="' + i + '"><h4>'+suggestion.icon + formatResult(suggestion, value) + '</h4></div>';
        });

        container.html(html).show();
        that.visible = true;

        // Select first value by default:
        if (that.options.autoSelectFirst) {
            that.selectedIndex = 0;
            container.children().first().addClass(classSelected);
        }
    };
    
 // Initialize ajax autocomplete:
    $('[name=s]').autocomplete({
        serviceUrl: _url + '/wp-admin/admin-ajax.php',
        params: {'action':'search_title'},
        minChars: 1,
        maxHeight: 450,
        onSelect: function(suggestion) {
        //  $('#content').html('<h2>Redirecting ... </h2>');
            window.location = suggestion.data.url;
        }
    });
});
