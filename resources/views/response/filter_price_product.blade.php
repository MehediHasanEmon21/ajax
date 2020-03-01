@foreach($products as $product)
<div class="col-md-4">  
     <div style="border:1px solid #ccc; padding:12px; margin-bottom:16px; height:375px;" align="center">  
          <img height="200px" src="{{ URL::to('/images/'.$product->product_image) }}" class="img-responsive" />  
          <h3>{{$product->product_name}}</h3>  
          <h4>Price - {{$product->product_price}}</h4>  
     </div>  
</div>
@endforeach