<div>
<div>
    <div class="title-container card-title">
        Notes
    </div>

    <div>
        @auth
            @if(!Auth::user()?->is_seller)
                <div class="button-container">
                    <a class="simple-btn" href="/support/new">Become a seller</a>
                </div>
            @endif
        @else
            <div class="button-container">
                <a class="simple-btn" href="/login">Sign-In</a>
            </div>
        @endauth
    </div>

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

    <div style="display: none;" wire:loading>
        <div class="loader"></div>
    </div>

    <div class="display-table">

        <table>
            <thead>
                <tr>
                    <th style="width:17%;">Title</th>
                    <th>Price</th>
                    <th>Delivery</th>
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
                        <td mobile-title="Country">{{ $product->public_data->country }}</td>
                        <td mobile-title="Description" class="description-column">
                            <p>
                                {{Str::limit($product->public_data->description, 50, '...') }}
                            </p>
                            @if(Str::length($product->public_data->description) > 50)
                                <p class="full-description">
                                    {{ $product->public_data->description }}
                                </p>
                            @endif            
                        </td>
                        <td mobile-title="Seller">
                            @if($product->seller->is_verified_seller)
                                <div class="badge-wrapper">
                                    <span class="badge">This seller is Verified</span>
                                    {{ str_replace('User', 'Seller', $product->seller->nickname) }}
                                    <i class="fa-solid fa-check" style="color: green;font-size: 14px;"></i>
                                </div>
                            @else
                                {{ str_replace('User', 'Seller', $product->seller->nickname) }}
                            @endif
                        </td>
                        <td mobile-title="">
                            @auth
                                <button class="simple-btn"
                                    onclick="buy_confirm('{{ $product->id }}', '{{ $product->title }}', '{{ $product->price }}')"
                                >
                                    Buy
                                </button>
                            @else
                                <a href="/login" class="simple-btn">Buy</a>
                            @endauth
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
        {{ $products->links() }}

    </div>


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
</div>
