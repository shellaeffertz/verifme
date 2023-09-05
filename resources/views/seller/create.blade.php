@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('.././css/seller-create-product.css') }}" />
    <link rel="stylesheet" href="{{ asset('.././css/modal.css') }}" />
@endsection


@section('content')
    <div class="page">
        @switch($type)
            @case('accounts')
                @include('seller.create-forms.accounts-form')
                @break

                @case('payement_processors')
                @include('seller.create-forms.hostings-form')
                @break

                @case('crypto_exchanges')
                @include('seller.create-forms.leads-form')
                @break

                @case('cracked_account')
                @include('seller.create-forms.rdps-form')
                @break

                @case('real_fakedocs')
                @include('seller.create-forms.smtps-form')
                @break

            @default
                <h1>Invalid product type</h1>
                @break
        @endswitch
    </div>
@endsection



@section('title')
    List a new product
@endsection


@section('subtitle')
    Create a new {{ Str::camel($type) }}
@endsection


@push('script')
    <script>
        let delivery_type_selector = document.querySelector('#delivery_type');

        let clear_children = function(parent) {
            let children = parent.children;
            for (let i = 0; i < children.length; i++) {
                let child = children[i];
                if (child.tagName == 'INPUT' || child.tagName == 'TEXTAREA') {
                    child.value = '';
                }
                clear_children(child);
            }
        }

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
                clear_children(private_data_container);
            }
        }

        delivery_type_selector.addEventListener('change', function(event) {
            display_fields();
        });
    </script>
@endpush
