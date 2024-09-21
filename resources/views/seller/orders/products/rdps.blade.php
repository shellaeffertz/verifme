<div class="form-group" >

    <div class="product-info">
  
      <span>Cracked Account</span>
  
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
    </ul>
   
    @if($order->delivery_type == 'instant')
      @if ($order->private->account_details)
        <div class="private-info">
          <label>Account Details :</label>
          <p>Please store this information securely and do not share it with anyone.</p>
          <textarea disabled>{{ $order->private->account_details }}</textarea>
        </div>
      @endif
  
      @if ($order->private->document_links)
        <div>
          <label>Document Links :</label>
          <textarea disabled>{{ $order->private->document_links }}</textarea>
        </div>
      @endif
    @endif
   
  </div> 
   