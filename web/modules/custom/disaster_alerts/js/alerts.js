(function ($) {
  Drupal.behaviors.alerts = {
    attach: function (context, settings) {
      $('body').each(function() {
        $(document).ready(function() {
          $('#edit-submit, #edit-submit--2').on('click', function(e) {
            e.preventDefault();
            $.ajax({
              type: "POST",
              url: "/disaster_alerts/alert_init",
              data: $('#add-phone-number-form').serializeArray(),
              error: function (xhr, ajaxOptions, thrownError) {
                console.log('ERROR (xhr): ', xhr);
                console.log('ERROR (ajaxOptions): ', ajaxOptions);
                console.log('ERROR (thrownError): ', thrownError);
              },
              success: function(data) {
                $(".the-return").html("<p> " + data.data + "</p>");
              }
            });

          })
        })
      });
    }
  }
})(jQuery)
