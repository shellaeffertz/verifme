@extends('layouts.app')

@section('style')
@endsection

@section('content')
    <div class="rules card">
        <div class="card-title mb-3">
            Welcome  {{ Auth::user()->username }}
        </div>
        <div class="card-body mb-3">
            <div class="rule mb-3">
                We Spend alot of money to get you clients So you can sell for a Higher price than u ever wish Make sure to <span class="special-span">Add 10%</span>.
            </div>
            <div class="rule mb-3">
                If You Have Any Question , Suggestion Or Request Please Feel Free To <a class="contact-button" href="/support">Open Ticket</a>
            </div>
            <div class="rule mb-3">
                Your selling nickname in this shop is {{ Auth::user()->nickname }}
            </div>
            <div class="rule mb-3">
                You get paid any time you like using Withdraw section
            </div>
            <div class="rule mb-3">
                Make sure to increase the product price by 10% this amount is used to cover our advertising
            </div>
            <div class="rule mb-3">
                Your total received money until now is {{ Auth::user()->balance }}            
            </div>
        </div>
    </div>
@endsection

@section('title')
    Terms of service
@endsection

@section('subtitle')
Hello  {{ Auth::user()->nickname }}
@endsection
