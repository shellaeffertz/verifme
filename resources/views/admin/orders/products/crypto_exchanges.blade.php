<div class="form-group" >

    <div class="product-info">
  
      <span>{{ ucfirst($order->public_data->account_type)}} Crypto & Exchanges</span>
  
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
      @if ($order->delivery_type == 'preorder')
        <li>
          <span>Delivery Type :</span>
          <span>{{ ucfirst($order->delivery_type) }}</span>
        </li>
        <li>
          <span>Delivery Period :</span>
          <span>{{ $order->delivery_period }}</span>
        </li>
      @endif
    </ul>
   
    @if($order->delivery_type == 'instant')
      @if ($order->private_data->account_details)
        <div>
          <label>Account Details :</label>
          <textarea disabled>{{ $order->private_data->account_details }}</textarea>
        </div>
      @endif
  
      @if (isset($order->private_data->document_links) && $order->private_data->document_links)
        <div>
          <label>Document Links :</label>
          <textarea disabled>{{ $order->private_data->document_links }}</textarea>
        </div>
      @endif
    @endif
   
  </div> 
   