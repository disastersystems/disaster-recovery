(function ($) {
  Drupal.behaviors.zendesk_knowledge_base = {
    attach: function (context, settings) {
      $('body').once('knowledge-base').each(function() {
        $(document).ready(function() {
          $('#knowledge-base-search').on('submit', function(e) {
            e.preventDefault();
            var searchString = $('#search-query').val();
            var encodeString = encodeURIComponent(searchString);
            query = encodeString.replace(/%20/g, '+');
            window.open('https://stationhouston.zendesk.com/hc/en-us/search?utf8=%E2%9C%93&query=' + query, '_blank');
          })
        })
      });
    }
  }
})(jQuery)