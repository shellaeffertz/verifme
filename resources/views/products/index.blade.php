@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('.././css/accounts.css') }}" />
    <link rel="stylesheet" href="{{ asset('.././assets/css/modal-box.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection


@section('content')
    @if ($type == 'accounts')
        @livewire('products.accounts', ['query' => $query])
    @elseif($type == 'payement_processors')
        {{-- @livewire('products.hostings',['query' => $query]) --}}
        @livewire('products.hostings')
    @elseif($type == 'crypto_exchanges')
        {{-- @livewire('products.leads', ['query' => $query]) --}}
        @livewire('products.leads')
    @elseif($type == 'real_fackedocs')
        @livewire('products.smtps')
    @elseif($type == 'cracked_account')
        @livewire('products.rdps')
    @endif
@endsection

@section('title')
    {{ $type }}
@endsection

@push('script')
    <script>
        const buy_confirm = (id, $title, $price) => {
            const confirmation_model = document.querySelector('.modal');
            const confirmation_model_content = document.querySelector('.modal-content ');
            const confirmation_model_buttons = document.querySelector('.confirmation_model_buttons');
            const confirmation_model_buttons_yes = document.querySelector(
                '.confirmation_model_buttons button:first-child');
            const confirmation_model_buttons_no = document.querySelector(
                '.confirmation_model_buttons button:last-child');

            confirmation_model.style.display = 'block';
            confirmation_model_content.innerHTML = `
               <div class="modal-header">
                <span onclick="buy_cancel()" class="close">&times;</span>
                <h3>Are you sure  want to buy this product?</h3>
               </div>
                <div class="line">
                  <h4 class="char1">Title: </h4>
                 <input  value = ${$title} disabled >
               </div>
               <div class="line">
                  <h4 class="char1">Price: </h4>
                 <input  value = "$${$price}" disabled >
               </div>
                
     
                <div class="modal-body">
                <button class="next-button" onclick="buy('${id}')">Yes</button>
                <button class="next-button" onclick="buy_cancel()">No</button>
               </div>
            `;
        }

        const buy_cancel = () => {
            const confirmation_model = document.querySelector('.modal');
            confirmation_model.style.display = 'none';
        }

        const buy = (id) => {
            // create a form
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/products/buy';

            // add product id to form
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'product_id';
            input.value = id;
            form.appendChild(input);

            // submit form
            document.body.appendChild(form);
            form.submit();
        }
        const rangeInput = document.querySelectorAll(".range-input input"),
            priceInput = document.querySelectorAll(".price-input input"),
            range = document.querySelector(".slider .progress");
        let priceGap = 100;

        priceInput.forEach((input) => {
            input.addEventListener("input", (e) => {
                let minPrice = parseInt(priceInput[0].value),
                    maxPrice = parseInt(priceInput[1].value);

                if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
                    if (e.target.className === "input-min") {
                        rangeInput[0].value = minPrice;
                        range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
                    } else {
                        rangeInput[1].value = maxPrice;
                        range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
                    }
                }
            });
        });

        rangeInput.forEach((input) => {
            input.addEventListener("input", (e) => {
                let minVal = parseInt(rangeInput[0].value),
                    maxVal = parseInt(rangeInput[1].value);

                if (maxVal - minVal < priceGap) {
                    if (e.target.className === "range-min") {
                        rangeInput[0].value = maxVal - priceGap;
                    } else {
                        rangeInput[1].value = minVal + priceGap;
                    }
                } else {
                    priceInput[0].value = minVal;
                    priceInput[1].value = maxVal;
                    range.style.left = (minVal / rangeInput[0].max) * 100 + "%";
                    range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
                }
            });
        });
    </script>
@endpush
