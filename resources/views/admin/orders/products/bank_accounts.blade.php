<a class="simple-btn" href="/admin/order/refund/{{$order->uuid}}">Refund Order</a><br>
<div class="form-group" style="padding: 15px;">

  <div>
    <label>Order Status:</label>
    <input type="text" value="{{ $order->status }}" disabled>
  </div>

  <div>
    <label>Product Title:</label>
    <input type="text" value="{{ $order->title }}" disabled>
  </div>

  <div>
    <label>Product Price:</label>
    <input type="text" value="${{ $order->price }}" disabled>
  </div>

  <div>
    <label>Seller Nickname:</label>
    <input type="text" value="{{ $order->seller->nickname }}" disabled>
  </div>

  <div>
    <label>Product Type :</label>
    <input type="text" value="{{ $order->type }}" disabled> 
  </div>

  @if ($order->public->description)
    <div>
      <label>Product Description : </label>
      <input type="text" value="{{ $order->public->description }}" disabled>
    </div>
  @endif


  @if ($order->public->account_type)
    <div>
      <label>Product Account Type : </label>
      <input type="text" value="{{ $order->public->account_type }}" disabled>
    </div>
  @endif

  @if ($order->public->country)
    <div>
      <label>Product Country : </label>
      <input type="text" value="{{ $order->public->country }}" disabled>
    </div>
  @endif

  @if ($order->delivery_type)
    <div>
      <label>Product Delivery Type : </label>
      <input type="text" value="{{ $order->delivery_type }}" disabled>
    </div>
  @endif

  @if ($order->delivery_period)
    <div>
      <label>Product Delivery Period :  </label>
      <input type="text" value="{{ $order->delivery_period }}" disabled>
    </div>
  @endif

  @if($order->delivery_type == 'instant')
      @if ($order->private->account_details)
        <label>Product Account Details :</label>
        <input type="text" value="{{ $order->private->account_details }}" disabled>
      @endif
      
      @if ($order->private->document_links)
        <label>Product Document Links :</label>
        <input type="text" value="{{ $order->private->document_links }}" disabled>
      @endif
  @endif
  
</div>