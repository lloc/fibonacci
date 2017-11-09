jQuery(document).ready(function($) {
  'use strict';

  var sequence = LLOC.apiurl + 'sequence';

  $.post(sequence).done(function(response) {
    console.debug(response);
  });

  $(document).keyup(function(e) {
    switch (e.keyCode) {
      case 13:
        $.get(sequence).done(function(response) {
          console.log(response);

          $.ajax({url: sequence, type: 'PUT'}).done(function(response) {
            console.debug(response);
          });
        });
        break;
      case 27:
        $.ajax({url: sequence, type: 'DELETE'}).done(function(response) {
          console.debug(response);
        });
        break;
    }
  });
});