
<div>

<div>
    <div class="title-container card-title">
        Notes 
    </div>
    @if(!Auth::user()->is_seller)
    <div class="button-container">
        <a class="simple-btn" href="/support/new">Become a seller</a>
    </div>
    @endif
    <div class="card-body">
        <div class="rule">
            All the product that you will buy are warrantied for <span class="special-span">48H</span>.
        </div>
        <div class="rule">
            If You Have Any Questions  ,Problem Or Request Please Feel Free To <a class="contact-button" href="/support"> Open Ticket</a>.
        </div>
        <div class="rule">
            All Money Stay Safe with us neither Buyer or  Seller Can Scam   <a class="contact-button" href="/support">contact us</a>.
        </div>
    </div>
</div>
    <div class="d-flex">
        <div class="wrapper2">
            <div class="search-wrapper">
                <input wire:model="search" type="text" placeholder="Search product..." />
            </div>
            <select wire:model="country">
                <option disabled>Select Country</option>
                <option value="all">All Countries</option> 
                @foreach (config('country') as $country)
                    <option value="{{ $country }}">{{ $country }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="account-type-btn-wrapper">
        <button wire:click="changeAccountType('personal')" class="{{$query == 'personal' ? 'account-type-btn active' : 'account-type-btn'}}" type="button">Personal</button>
        <button class="{{$query == 'business' ? 'account-type-btn active' : 'account-type-btn'}}" wire:click="changeAccountType('business')" class="account-type-btn" type="button">Business</button>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width:17%;">Title</th>
                <th>Price</th>
                <th>Delivery</th>
                <th>
                    <span style="display: block;">P.W</span>
                    <span style="display: block;font-size: 9px;">(Product Warranty)</span>
                </th>
                <th>Country</th>
                <th style="width:30%;">Description</th>
                <th>Seller</th>
                <th></th>
            </tr>
        </thead> 
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td mobile-title="Title" class="title-column">{{ $product->title }}</td>
                    <td mobile-title="Price">${{ $product->priceTotal }}</td>
                    <td mobile-title="Delivery Type">{{ $product->delivery_type }}</td>
                    <td mobile-title="Delivery Period">{{ $product->delivery_period }}</td>
                    <td mobile-title="Country">{{ $product->public_data->country }}</td>
                    <td mobile-title="Description" class="description-column">
                        <p>
                            {{Str::limit($product->public_data->description, 50, '...') }}
                        </p>
                        <p class="full-description">
                            {{ $product->public_data->description }}
                        </p>            
                    </td>
                    <td mobile-title="Seller">{{ $product->seller->nickname }}</td>
                    <td mobile-title="">
                        <button class="simple-btn"
                            onclick="buy_confirm('{{ $product->id }}', '{{ $product->title }}', '{{ $product->price }}')">Buy</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
      
        {{ $products->links() }}


    <div class="modal">
        <div class="modal-content ">
            <div class="modal-header">
                <span onclick="closeModal()" class="close">&times;</span>
                <p>Are you sure want to buy this product?</p>
            </div>
            <div class="modal-body two-btn">
                <button class="next-button">Yes</button>
                <button class="next-button">No</button>
            </div>
        </div>
    </div>

    {{-- <script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
    <div class="elfsight-app-bc77e82b-43eb-41cc-b7ef-5e159654a169" data-elfsight-app-lazy></div> --}}

</div>

