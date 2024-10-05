<div>

    <div class="d-flex">
        <div class="wrapper2">
            <input wire:model="search" type="text" placeholder="Search listings by title..." />
        </div>
        <div style="display: none;" wire:loading>
            <div class="loader"></div>
        </div>
    </div>

    @if (count($products) == 0)

        <p class="no-results">No Results.</p>

    @else

        <div class="display-table">

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Seller</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Price</th>
                        <th>Created At</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td mobile-title="ID">{{$product->id}}</td>
                            <td mobile-title="Title" class="description-column">
                                <p>
                                    {{Str::limit($product->title, 50, '...') }}
                                </p>
                                @if(Str::length($product->title) > 50)
                                    <p class="full-description">
                                        {{ $product->title }}
                                    </p>
                                @endif            
                            </td>
                            <td mobile-title="SellerName">{{$product->seller->nickname}}</td>
                            <td mobile-title="TYPE">{{ ucwords(implode(' ', explode('_', $product->type))) }}</td>
                            <td mobile-title="STATUS">{{ $product->status }}</td>
                            <td mobile-title="PRICE">{{ $product->price }}$</td>
                            <td mobile-title="DATE">{{ $product->created_at }}</td>
                            <td>
                                <a class="simple-btn" href="{{ route('admin.product.show', $product->id) }}">
                                    View
                                </a>
                            </td>
                            <td>
                                <a class="simple-btn" onclick="deleteProduct({{ $product->id }})">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            {{ $products->links() }}

        </div>

    @endif

</div>
