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
            <div class="bold rule">
                XMR.
            </div>
            <a class="simple-btn" href="/buy">Add Balance</a>
            @if(Auth::user()->telegram_chat_id == NULL)
            <a class="simple-btn" href="/auth/telegram/redirect">Telegram Notification</a>
            @endif
        </div>
    </div>
@endsection

@section('title')
    Welcome 
@endsection

@section('subtitle')
    <div class="title-container">
        Hi {{ Auth::user()->nickname }}
    </div>
    @if(!Auth::user()->is_seller)
    <div class="button-container">
        <a class="simple-btn" href="/support/new">Become a seller</a>
    </div>
    @endif
    <style>
        .title-container {
    display: inline-block;
}

.button-container {
    display: inline-block;
    float: right;
}

.button-container 
.become-seller-btn {
  padding: .5rem 1rem;
  border: 1px solid #6d400622;
  border-radius: 2px;
  background-color: #ff0000;
  color: var(--background--main);
  font-size: .75rem;
  cursor: pointer;
  font-weight: 500;
  letter-spacing: 2px;
}
.button-container 
.become-seller-btn:hover {
  background-color: var(--background--main);
  color: #f70000;
  transition: all .3s ease-in-out;
}

    </style>
@endsection
