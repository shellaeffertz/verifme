@extends('layouts.app')

@section('style')
<style>
    .form-group {
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        margin-bottom: 10px;
    }

    input[type=text],
    input[type=email],
    input[type=password],
    select,
    textarea {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
        resize: none;
    }
</style>
@endsection

@section('title')
    New Ticket
@endsection

@section('subtitle')
    We are here to help you. Please fill the form below and we will get back to you as soon as possible.
@endsection

@section('content')
<form action="{{ route('support.client.store') }}" method="POST">
    <div class="form-group">
     {{-- <label for="subject">Subject</label>
        <input type="text" name="subject" placeholder="Subject" class="form-control"> --}}

        <select name="subject" class="select-box">
            <option value="Become Seller">Become Seller </option>
            <option value="Issue with Order">Issue with Order</option>
            <option value="Issue with Payement">Issue with Payement </option>
            <option value="Suggestions">Suggestions</option>
            <option value="Others">Others</option>
        </select>
    </div>
    <div class="form-group">
        <label for="message">Message</label>
        <textarea name="message"></textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="simple-btn">Send</button>
    </div>
</form>

@endsection

