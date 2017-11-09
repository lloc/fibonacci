jQuery(document).ready(function($) {
  'use strict';

  var settings = { url: LLOC.ajaxurl, data: {action: 'fibonacci_create'}};
  $.ajax(settings).done(function(response) {
    console.debug(response.data);
  });

  $(document).keyup(function(e) {
    switch (e.keyCode) {
      case 13:
        settings.data.action = 'fibonacci_read';

        $.ajax(settings).done(function(response) {
          console.log(response.data);

          settings.data.action = 'fibonacci_update';

          $.ajax(settings).done(function(response) {
            console.debug(response.data);
          });
        });
        break;
      case 27:
        settings.data.action = 'fibonacci_delete';

        $.ajax(settings).done(function(response) {
          console.debug(response.data);
        });
        break;
    }
  });
});