
<!DOCTYPE html>  
 <html>  
      <head>  
           <title>Webslesson Tutorial | How to load Product on price change using Ajax Jquery with PHP Mysql</title>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
      </head>  
      <body>  
           <br /><br />  
           <div class="container" style="width:800px;">  
                <br />  
                <h3 align="center">Load Product on price change using Ajax Jquery with PHP Mysql</h3>  
                <br />  
                <div align="center">  
                     <input type="range" min="10000" max="55000" step="1000" value="10000" id="min_price" name="min_price" />  
                     <span id="price_range"></span>  
                </div>  
                <br /><br /><br />  
                <div id="product_loading">  
                
                @foreach($products as $product)
                <div class="col-md-4">  
                     <div style="border:1px solid #ccc; padding:12px; margin-bottom:16px; height:375px;" align="center">  
                          <img height="200px" src="{{ URL::to('/images/'.$product->product_image) }}" class="img-responsive" />  
                          <h3>{{$product->product_name}}</h3>  
                          <h4>Price - {{$product->product_price}}</h4>  
                     </div>  
                </div>
                @endforeach  
        
                </div>  
           </div>  
      </body>  
 </html>  

 <script type="text/javascript">
   
   $(document).ready(function(){

      $('#min_price').change(function(){

            var price = $(this).val();
            $('#price_range').text(price);

            $.ajax({

              url: '/api/product-by-price',
              method: 'POST',
              data: {
                price: price
              },
              success:function(data){
                $('#product_loading').html(data);
              }


            });

      })


   })

 </script>
