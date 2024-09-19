<a class="simple-btn" href="/admin/order/refund?order={{$order->uuid}}">Refund Order</a> <br> 
<div class="form-group"
    style="gap: .5rem; 
  padding: 20px 20px 10px 10px;
 
  box-shadow: 1px 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
">
<label for="nickname">Order Status:</label>
<input type="text" name="nickname" value=" {{ $order->status }}" disabled>

    <label for="nickname">Product Title:</label>
    <input type="text" name="nickname" value=" {{ $order->title }}" disabled>

    <label for="nickname"> Product Price:</label>
    <input type="text" name="nickname" value=" ${{ $order->price }}" disabled>

    <label for="nickname">Seller Nickname:</label>
    <input type="text" name="nickname" value="   {{ $order->seller->nickname }}" disabled>

    <label for="nickname"> Product Type :</label>
    <input type="text" name="nickname" value=" {{ $order->type }}" disabled>

    @if ($order->public->description)
        <label for="nickname"> Product Description : </label>
        <input type="text" name="nickname" value=" {{ $order->public->description }}" disabled>
    @endif

    @if ($order->public->country)
        <label for="nickname"> Product Country : </label>
        <input type="text" name="nickname" value=" {{ $order->public->country }}" disabled>
    @endif

    @if ($order->delivery_type)
        <label for="nickname"> Product Delivery Type : </label>
        <input type="text" name="nickname" value=" {{ $order->delivery_type }}" disabled>
    @endif

    @if ($order->delivery_period)
        <label for="nickname"> Product Delivery Period : </label>
        <input type="text" name="nickname" value=" {{ $order->delivery_period }}" disabled>
    @endif

    @if ($order->platform)
        <label for="nickname"> Product Platform : </label>
        <input type="text" name="nickname" value=" {{ $order->platform }}" disabled>
    @endif

  



    @if ($order->status == 'completed')


        @if ($order->private->document_links)
            <label for="nickname"> Product Documents : </label>
            <input type="text" name="nickname" value="  {{ $order->private->document_links }}" disabled>
        @endif
        @endif
</div>
