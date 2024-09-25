@extends('layouts.app')

@section('title')
    New Ticket
@endsection

@section('subtitle')
    We are here to help you. Please fill the form below and we will get back to you as soon as possible.
@endsection

@section('content')

    <div class="create-form">

        <div class="form-group">

            <form action="{{ route('support.client.store') }}" method="POST">
    
                <div>
                    <label for="subject">Subject:</label>
                    <select id="subject" name="subject" class="select-box">
                        @if(! auth()->user()->is_seller)
                            <option value="Become Seller">Become Seller </option>
                        @endif
                        <option value="Issue with Order">Issue with Order</option>
                        <option value="Issue with Payement">Issue with Payement </option>
                        <option value="Suggestions">Suggestions</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
    
                <div>
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" rows="15"></textarea>
                </div>
    
                <div class="form-btn-wrapper">
                    <button type="submit" class="simple-btn">Send</button>
                </div>
    
            </form>
    
        </div>

    </div>

@endsection

