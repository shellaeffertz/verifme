@extends('layouts.app')

@section('style')
@endsection

@section('content')
    <div class="rules card">
        <div class="card-title">
            Rules and Instructions
        </div>
        <div class="card-body">
            <div class="rule">
                You will deal Directly with the seller here.
            </div>

            <div class="rule">
                After Delivery is Done Instantly you will have 6H to Check and report issues .
            </div>
            
            <div class="rule">
                Delivery as Prorder can take up to 24h-48h ; money will be locked till delivery is done.
            </div>
            <div class="rule">
                Sharing any direct contact by ticket or in listing you will be banned.
            </div>
            <div class="rule">
                If you have any issues please <a class="contact-button" href="/support">contact us</a>.
            </div>
        </div>
    </div>

    <div class="news card">
        <div class="card-title">
            Keep in mind
        </div>
        <div class="card-body">
            <div class="rule">
                If You Have Any Question ,Problem, Suggestion Or Request Please Feel Free To <a class="contact-button" href="/support"> Open Ticket</a>.
            </div>
            <div class="rule">
                Our Domain is  : ||Verifme.com - Please it .           
            </div>
            <div class="rule">
                If you want to become a reseller open a ticket <a class="contact-button" href="/support">contact us</a>.
            </div>
        </div>
    </div>

    
    <div class="news card">
        <div class="card-title">
            Available Payment Methods
        </div>
        <div class="card-body">
            <div class=" bold rule">
               Bitcoin. 
            </div>
            <div class="bold rule">
                Ethereum.
            </div>
            <div class="bold rule">
                Litecoin.
            </div>
            <a class="simple-btn" href="/buy">Add Balance</a>
        </div>
    </div>
@endsection

@section('title')
    Welcome
@endsection

@section('subtitle')
    Hi {{ Auth::user()->nickname }}
@endsection
