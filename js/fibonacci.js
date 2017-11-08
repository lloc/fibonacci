jQuery(document).ready(function($) {
  var data = {action: 'fibonacci_create'};

  $.get(LLOC.ajaxurl, data).done(function(response) {
    console.debug(response.data);
  });

  $(document).keyup(function(e) {
    switch (e.keyCode) {
      case 13:
        data.action = 'fibonacci_read';

        $.get(LLOC.ajaxurl, data).done(function(response) {
          console.log(response.data);

          data.action = 'fibonacci_update';

          $.post(LLOC.ajaxurl, data).done(function(response) {
            console.debug(response.data);
          });
        });
        break;
      case 27:
        data.action = 'fibonacci_delete';

        $.post(LLOC.ajaxurl, data).done(function(response) {
          console.debug(response.data);
        });
        break;
    }
  });
});