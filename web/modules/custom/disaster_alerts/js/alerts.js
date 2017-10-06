(function ($) {
  Drupal.behaviors.alerts = {
    attach: function (context, settings) {
      $('body').once('alerts').each(function() {
        $(document).ready(function() {
          $('.alert-header > .add-phone-number-form > .alerts-submit').on('click', function(e) {
            e.preventDefault();
            $.ajax({
              type: "POST",
              url: "/disaster_alerts/alert_init",
              data: $('.alert-header > #add-phone-number-form').serializeArray(),
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
          $('.footer-alert > form.add-phone-number-form > .alerts-submit').on('click', function(e) {
            e.preventDefault();
            $.ajax({
              type: "POST",
              url: "/disaster_alerts/alert_init",
              data: $('.footer-alert > #add-phone-number-form').serializeArray(),
              error: function (xhr, ajaxOptions, thrownError) {
                console.log('ERROR (xhr): ', xhr);
                console.log('ERROR (ajaxOptions): ', ajaxOptions);
                console.log('ERROR (thrownError): ', thrownError);
              },
              success: function(data) {
                $(".the-return-footer").html("<p> " + data.data + "</p>");
              }
            });

          })
        })
      });
    }
  }
})(jQuery)
