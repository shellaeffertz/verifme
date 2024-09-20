<div class="form-group" style="padding: 15px;" >

  <div>
    <label>Product Title:</label>
    <input type="text" value=" {{ $order->title }}" disabled>
  </div>

  <div>
    <label>Product Price:</label>
    <input type="text" value=" ${{ $order->price }}" disabled>
  </div>

  <div>
    <label>Seller Nickname:</label>
    <input type="text" value="   {{ $order->seller->nickname }}" disabled>
  </div>

  <div>
    <label>Product Type :</label>
    <input type="text" value=" {{ $order->type }}" disabled> 
  </div>

  @if ($order->public->description)
    <div>
        <label>  Product Description : </label>
        <textarea type="text" rows="3" disabled>{{ $order->public->description }}</textarea>
    </div>
  @endif

  @if ($order->public->country)
    <div>
      <label>Product Country : </label>
      <input type="text" value=" {{ $order->public->country }}" disabled>
    </div>
  @endif

  @if ($order->delivery_type)
    <div>
      <label>Product Delivery Type : </label>
      <input type="text" value=" {{ $order->delivery_type }}" disabled>
    </div>
  @endif

  @if ($order->delivery_period)
    <div>
      <label>Product Delivery Period :  </label>
      <input type="text" value=" {{ $order->delivery_period }}" disabled>
    </div>
  @endif

  @if ($order->public->account_type)
    <div>
      <label for="account_type">Product Account Type : </label>
      <input type="text" name="account_type" value=" {{ $order->public->account_type }}" disabled>
    </div>
  @endif
 
  @if ($order->private->account_details)
    <div>
      <label>Product Account Details :  </label>
      <input type="text" value=" {{ $order->private->account_details }}" disabled>
    </div>
  @endif

  @if ($order->private->document_links)
    <div>
      <label>Product Document Links : </label>
      <input type="text" value="   {{ $order->private->document_links }}" disabled>
    </div>
  @endif
 
</div> 
 