jQuery(document).ready(function($){
  var nonce, data = { action: 'wpmi_create' };
  $.get(WPMI.ajaxurl, data, function(response) {
    console.log("Response (create): " + response);
    nonce = response.data.token;
  }).done(function() {
    data = {
      action: 'wpmi_update',
      token: nonce
    };
    $.post(WPMI.ajaxurl, data, function(response) {
      console.log("Response (update): " + response);
    });
  });
});
