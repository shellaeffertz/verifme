<div class="create-form">
    <form method="POST">
        <!--  General -->
        <div class="form-group">
            <h2 class="section-headline">PUBLIC DETAILS</h2>
            <input type="hidden" name="type" value="{{$product->type}}" />


            <div>
                <label for="title">Title</label>
                <input type="text" placeholder="Accounts Name ..." id="title" name="title"
                    value="{{ $product->title }}" />
            </div>


            <div>
                <label for="price">Price<small>($)</small></label>
                <input type="text" placeholder="Product Cost..." id="price" name="price"
                    value="{{ $product->price }}" />
            </div>


            <div>
                <label for="delivery_type">Delivery Type</label>
                <select name="delivery_type" id="delivery_type">
                    <option value="instant" {{ $product->delivery_type == 'instant' ? 'selected' : '' }}>Instant
                    </option>
                    <option value="preorder" {{ $product->delivery_type == 'preorder' ? 'selected' : '' }}>Preorder
                    </option>
                </select>
            </div>




            <div class="hidden" id="delivery_period_container">
                <label for="delivery_period">Delivery Period</label>
                <select name="delivery_period" id="delivery_period">
                    <option value="1d" {{ $product->delivery_period == '1d' ? 'selected' : '' }}>24H</option>
                    <option value="2d" {{ $product->delivery_period == '2d' ? 'selected' : '' }}>48H</option>
                </select>
            </div>
            

            <div>
                <label for="country">Country</label>
                <select name="country" id="country">
                    @foreach (config('country') as $country)
                        <option value="{{ $country }}"
                            {{ $product->public_data->country == $country ? 'selected' : '' }}>
                            {{ $country }}</option>
                    @endforeach
                </select>
            </div>



            <div>
                <label for="description">Description</label>
                <textarea rows=5 type="text" placeholder="was created 5 years ago..." id="description" name="description">
                {{ $product->public_data->description }}
              </textarea>
            </div>

        </div>
        <!--  Details -->
        <div class="form-group" id="private_data_container">
            <h2 class="section-headline">PRIVATE DETAILS <small>Only shared with Clients after the purchase process is
                    completed</small></h2>
            <div>
                <label for="account_details">Account Private Details</label>
                <textarea rows=5 type="text" placeholder="Username: aaa, Password: bbb, Login Link: xxxx..." id="account_details"
                    name="account_details">{{ $product->private_data->account_details }}</textarea>
            </div>




        </div> <!-- /.form-group -->
        <div class="form-btn-wrapper">
            <input type="submit" value="UPDATE">
        </div>

    </form>

</div>
