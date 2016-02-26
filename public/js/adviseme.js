$(document).ready(function() {

      $('#getAdvise').on('click', function(event) {

          event.preventDefault(); // To prevent following the link (optional)

          $.ajax({
              url: '/getadvise',
              type: 'GET',
              success: animateMe,
              error: function(data) {
                  alert('woops!');
              }
          });
      });
});


function animateMe(results) {
  products = results.products;

  if(products)
  {

    findProduct(products);

  }
  else
  {
      console.log('no products ');
  }
}

function findProduct(products) {
    var myProgress = document.getElementById("myProgress");
    var width      = 0;
    var pos        = 0;
    var minimum    = 0;

    $nbElt           = Object.keys(products).length;
    myProgress.width = '100%';

    var randomnumber = Math.floor(Math.random() * ($nbElt - minimum + 1)) + minimum;

    var id = setInterval(function() {
        var product = products[pos];
        var elem    = document.getElementById("myBar");
        $nbElt      = Object.keys(products).length;

      if (pos == $nbElt) {

        pos = 0;
      } else {

        if(products) {

            var myImg = document.getElementById("myProduct");
            if(product.media_slug)
            {
                var slug = product.media_slug;
                var imgSrc = slug.replace('/img/','/img/250/');
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
    }, 100);
}
