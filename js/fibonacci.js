jQuery(document).ready(function($) {
  'use strict';

  var settings = { url: LLOC.apiurl + 'sequence', type: 'POST' };
  $.ajax(settings).done(function(response) {
    console.debug(response);
  });

  $(document).keyup(function(e) {
    switch (e.keyCode) {
      case 13:
        settings.type = 'GET';
        $.ajax(settings).done(function(response) {
          console.log(response);

          settings.type = 'PUT';
          $.ajax(settings).done(function(response) {
            console.debug(response);
          });
        });
        break;
      case 27:
        settings.type = 'DELETE';
        $.ajax(settings).done(function(response) {
          console.debug(response);
        });
        break;
    }
  });
});