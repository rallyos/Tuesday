/*  This script gets the list with available webfonts using JavaScript client library for accessing Google APIs    
*    Big thanks to Giovanni Cappellotto for this - https://twitter.com/johnnyaboh/status/277772967444885505
----------------------------------*/
jQuery(window).load(function() {

    var key = 'AIzaSyC7-G7JrndXolGKlpGZTKSb215fDRCY_8c';
    
    // Gets web fonts list and appends it to select menu
    gapi.client.load('webfonts', 'v1', function() {
        var request = gapi.client.webfonts.webfonts.list({
            key: key
        });
        request.execute(function(response) {
                response.items.forEach(function(font, id) {
                jQuery('<option/>', {
                    value: font.family,
                    text: font.family
                    }).appendTo('#customize-control-font select');
                });
        });
    });

});