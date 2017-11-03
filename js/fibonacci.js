jQuery(document).ready(function($) {
  var token, data = {action: 'fibonacci_create'};

  $.get(LF.ajaxurl, data).done(function(response) {
    console.log("Response (create): " + response);
    token = response.data;
  });

  $(document).keyup(function(e) {
    switch(e.keyCode) {
      case 13:
        data = {action: 'fibonacci_read', token: token};

        $.get(LF.ajaxurl, data).done(function(response) {
          console.log("Response (read): " + response.data);

          data = {
            action: 'fibonacci_update',
            token: token,
            num: response.data
          };

          $.post(LF.ajaxurl, data).done(function(response) {
            console.log("Response (update): " + response.data);
          });
        });
        break;
      case 27:
        data = {action: 'fibonacci_delete', token: token};

        $.post(LF.ajaxurl, data).done(function(response) {
          console.log("Response (delete): " + response.data);
        });
        break;
    }
  });

});