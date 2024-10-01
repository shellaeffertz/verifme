<div class="form-group" >

    <div class="product-info">
  
      <span>{{ ucfirst($order->public->account_type)}} Crypto & Exchanges</span>
  
      @if ($order->public->country)
        <span>{{ $order->public->country }}</span>
      @endif
  
    </div>
  
    <h1>{{ $order->title }}</h1>
  
    @if($order->public->description)
      <p>
        {{ $order->public->description }}
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
      @if ($order->private->account_details)
        <div class="private-info">
          <label>Account Details :</label>
          <textarea disabled>{{ $order->private->account_details }}</textarea>
        </div>
      @endif
  
      @if (isset($order->private->document_links) && $order->private->document_links)
        <div>
          <label>Document Links :</label>
          <textarea disabled>{{ $order->private->document_links }}</textarea>
        </div>
      @endif
    @endif
   
  </div> 
   