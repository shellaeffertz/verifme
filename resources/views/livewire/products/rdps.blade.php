<div>
    <div class="card-title">
        Notes
    </div>
    <div class="card-body">
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
            <input wire:model="search" type="text" placeholder="Search product..." />
            <select wire:model="country">
                <option disabled>Select Country</option>
                <option value="all">All Countries</option>
                @foreach (config('country') as $country)
                    <option value="{{ $country }}">{{ $country }}</option>
                @endforeach
            </select>
        </div>
    </div>


    <table>
        <thead>
            <tr>
                <th style="width:17%;">Title</th>
                <th>Price</th>
                <th>Type</th>
                <th>Period</th>
                <th>Country</th>
                <th style="width:30%;">Description</th>
                <th>Seller</th>
                <th>Buy</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td mobile-title="Title">{{ $product->title }}</td>
                    <td mobile-title="Price">${{ $product->price }}</td>
                    <td mobile-title="Delivery Type">{{ $product->delivery_type }}</td>
                    <td mobile-title="Delivery Period">{{ $product->delivery_period }}</td>
                    <td mobile-title="Country">{{ $product->public_data->country }}</td>

                    <td >
                        <div class="description-container">
                            <p class="truncated-description">
                              {{Str::limit($product->public_data->description, 50, '...') }}
                            </p>
                         
                            <span class="tooltip">                  
                              {{  str_replace("\r\n","\n", $product->public_data->description) }}
                            </span>
                        </div>               
                    </td>
                    <td mobile-title="Seller">{{ $product->seller->nickname }}</td>
                    <td mobile-title="Buy">
                        <button class="simple-btn"
                            onclick="buy_confirm('{{ $product->id }}', '{{ $product->title }}', '{{ $product->price }}')">Buy</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <div class="d-flex justify-content-center">
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
