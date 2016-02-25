$(document).ready(function() {

      $('#getAdvise').on('click', function(event) {

          event.preventDefault(); // To prevent following the link (optional)

          $.ajax({
              url: '/getadvise',
              type: 'GET',
              success: function(result){

                  if(result.products)
                  {
                      animateMe(result);
                  }

              },
              error: function(data) {
                  alert('woops!');
              }
          });
      });
});


function animateMe(results) {
  products = results.products;
  var myProgress = document.getElementById("myProgress");
  var elem = document.getElementById("myBar");
  var width = 0;

  var $nbElt = 0;
  $nbElt = Object.keys(products).length;
  myProgress.width = '100%';

  minimum = 0;
  var randomnumber = Math.floor(Math.random() * ($nbElt - minimum + 1)) + minimum;
  if(products)
  {

      var pos = 0;

      var id = setInterval(frame, 100);
      function frame() {
          $nbElt = Object.keys(products).length;

          var product = products[pos];


        if (pos == $nbElt) {
          pos = 0;
        } else {

          if(products)
          {
              var myImg = document.getElementById("myProduct");
              if(product.media_slug)
              {
                  var slug = product.media_slug;
                  var imgSrc = slug.replace('/img/','/img/150/');
                  myImg.src = imgSrc;
              }
              else
              {
                  myImg.src = '';
              }
              elem.style.width = pos + '%';
          }
          pos++;
        }
        if( randomnumber == pos)
        {
            clearInterval(id);
            mybutton = document.getElementById("getAdvise");
            mybutton.innerHTML = "Found: " + product.product_title;
            elem.style.width = 100 + '%';
        }
      }
  }
  else
  {
      console.log('no products ');
  }
}
