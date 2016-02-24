$(document).ready(function() {

      $('#getAdvise').on('click', function(event) {

          event.preventDefault(); // To prevent following the link (optional)

          console.log('y click');

          $.ajax({
              url: '/getadvise',
              type: 'GET',
              success: function(result){

                  if(result.products)
                  {
                      //console.log(result.products[0]['product_id']);

                      animateMe(result.products);
                  }

              },
              error: function(data) {
                  alert('woops!');
              }
          });
      });
});
function animateMe(products) {
  var $products = products;
  var nbElt = $products.length;
  console.log('animateMe ' + $products[0]['product_id'] + " nbElt:" + nbElt);
  if($products)
  {
      var pos = 0;
      var id = setInterval(frame(), 10);
      function frame() {
          console.log($products[0]['product_id'] + ' ' + pos);

        if (pos == nbElt) {
          clearInterval(id);
        } else {
          pos++;
          if($products[pos])
          {
              //console.log('img ' . $products[pos]['media_slug']);

          }
          //elem.style.top = pos + 'px';
          //elem.style.left = pos + 'px';
        }
      }
  }
}
