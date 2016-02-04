$(document).ready(function() {

      $('.bookmark').on('click', function(event) {

          event.preventDefault(); // To prevent following the link (optional)
          var productId = $(this).data('product');
          console.log('y click' + productId);

          $.ajax({
              url: '/user/bookmark/' + productId,
              type: 'GET',
              success: function(result){
                  var bookSpan = $('span[data-product="' + productId + '"]');
                  if(result.bookmarked)
                  {
                      bookSpan.removeClass('glyphicon-heart-empty');
                      bookSpan.addClass('glyphicon-heart');
                  }
                  else
                  {
                      bookSpan.removeClass('glyphicon-heart');
                      bookSpan.addClass('glyphicon-heart-empty');
                  }

              },
              error: function(data) {
                  alert('woops!');
              }
          });
      });
});
