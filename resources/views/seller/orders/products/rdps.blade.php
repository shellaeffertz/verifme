<div class="form-group" >

    <div class="product-info">
  
      <span>Cracked Account</span>
  
      @if ($order->public_data->country)
        <span>{{ $order->public_data->country }}</span>
      @endif
  
    </div>
  
    <h1>{{ $order->title }}</h1>
  
    @if($order->public_data->description)
      <p>
        {{ $order->public_data->description }}
      </p>
    @endif
  
    <h3>Order information</h3>
  
    <ul>
      <li>
        <span>Price : </span>
        <span>${{ $order->price }}</span>
      </li>
    </ul>
   
    @if($order->delivery_type == 'instant')
      @if ($order->private_data->account_details)
        <div class="private-info">
          <label>Account Details :</label>
          <textarea disabled>{{ $order->private_data->account_details }}</textarea>
        </div>
      @endif
  
      @if ($order->private_data->document_links)
        <div>
          <label>Document Links :</label>
          <textarea disabled>{{ $order->private_data->document_links }}</textarea>
        </div>
      @endif
    @endif
   
  </div> 
   