@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('.././css/seller-create-product.css') }}" />
    <link rel="stylesheet" href="{{ asset('.././css/modal.css') }}" />
@endsection


@section('content')
    <div class="page">


        @switch($product->type)
            @case('bank_accounts')
                @include('seller.update-forms.accounts-form')
            @break

            @case('payement_processors')
                @include('seller.update-forms.hostings-form')
            @break

            @case('crypto_exchanges')
                @include('seller.update-forms.leads-form')
            @break

            @case('cracked_account')
                @include('seller.update-forms.rdps-form')
            @break

            @case('real_fakedocs')
                @include('seller.update-forms.smtps-form')
            @break

            @default
        @endswitch
    </div>
@endsection

@section('title')
    Update Product
@endsection


@push('script')
    <script>
        let delivery_type_selector = document.querySelector('#delivery_type');

        let display_fields = function() {
            let delivery_type_selector = document.querySelector('#delivery_type');
            if (delivery_type_selector && delivery_type_selector.value == 'instant') {
                let delivery_period_container = document.querySelector('#delivery_period_container');
                delivery_period_container.classList.add('hidden');
                let private_data_container = document.querySelector('#private_data_container');
                private_data_container.classList.remove('hidden');
            } else {
                let delivery_period_container = document.querySelector('#delivery_period_container');
                delivery_period_container.classList.remove('hidden');
                let private_data_container = document.querySelector('#private_data_container');
                private_data_container.classList.add('hidden');
            }
        }

        delivery_type_selector.addEventListener('change', function(event) {
            display_fields();
        });

        display_fields();
    </script>
@endpush
