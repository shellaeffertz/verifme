@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('./assets/css/buy2.css') }}" />
@endsection


@section('content')

            <div class="page-content">

                <div class="line">
                    <p class="char1">Amount : </p>
                    <input value="${{ $coin_payment->amount_usd }} " disabled>
                </div>
                <br>

                <div class="line">
                    <p class="char1"> Amount in {{ $coin_payment->coin }} :</p>
                    <input value=" {{ $coin_payment->amount_coin }} " disabled>
                </div>
                <br>

                <div class="line">
                    <p class="char1">Wallet Address :</p>
                    <input value="{{ $coin_payment->address }}" disabled>
                </div>
                <br>

                <div class="line">
                    <p class="char1"> Scann QR Code to pay :</p>
                    <img src="{{ $coin_payment->qrcode_url }}" alt="qr code">
                </div>
                <br>

                <div class="line">
                    <p class="char1">Check the status here :</p>
                    <div>
                        <a href="{{ $coin_payment->status_url }}" target="_blank">Status</a>
                    </div>

                </div>
                <br>

                <div class="line">
                    <p class="char1">Adresse valid until :</p>
                    <input value="{{ $coin_payment->timeout_at }}" disabled>
                </div>
                <br>



            </div>


  
@endsection

@section('title')
    Payment - Details
@endsection
