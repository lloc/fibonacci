jQuery(document).ready(function($) {
  var data = {action: 'fibonacci_create', token: null};

  $.get(LF.ajaxurl, data).done(function(response) {
    data.token = response.data;
  });

  $(document).keyup(function(e) {
    switch (e.keyCode) {
      case 13:
        data.action = 'fibonacci_read';

        $.get(LF.ajaxurl, data).done(function(response) {
          console.log(response.data);

          data.action = 'fibonacci_update';
          data.num = response.data;

          $.post(LF.ajaxurl, data).done(function(response) {
            delete data.num;
          });
        });
        break;
      case 27:
        data.action = 'fibonacci_delete';

        $.post(LF.ajaxurl, data).done(function(response) {
          console.log('Math is fun!');
        });
        break;
    }
  });
});