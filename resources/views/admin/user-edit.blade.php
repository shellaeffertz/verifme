@extends('layouts.app')

@section('style')
 <style>
      input[type="checkbox"] {
            width: 20px;
            height: 20px;
        }

        input[type="checkbox"]:checked {
            background-color: #4CAF50;
        }
    </style> 
        <link rel="stylesheet" href="{{ asset('.././css/seller-create-product.css') }}" />

@endsection

@section('title')
    Edit User
@endsection


@section('content')
    <h2><small>{{ $user->nickname }}</small></h2>
     
    <form method="POST">
         <div class="form-group">
            <label for="nickname">Nickname</label>
            <input type="text" name="nickname" value="{{ $user->nickname }}" disabled>
         
 
            <label for="email">Email</label>
            <input type="text" name="email" value="{{ $user->email }}" disabled>
         
 
            <label for="username">Username</label>
            <input type="text" name="username" value="{{ $user->username }}" disabled>
         

 
            <label for="balance">Balance</label>
            <input type="text" name="balance" value="{{ $user->balance }}">
         
        
 
            <label for="is_admin">Admin</label>
            <input type="checkbox" name="is_admin" {{ $user->is_admin ? "checked" : '' }}>
         

 
            <label for="is_seller">Seller</label>
            <input type="checkbox" name="is_seller" {{ $user->is_seller ? "checked" : '' }}>
         

            <label for="is_support">Support</label>
            <input type="checkbox" name="is_support" {{ $user->is_support ? "checked" : '' }}>
 
            
            <label for="commission">Commission %</label>
            <input type="number" name="commission" value="{{ $user->commission * 100 }}">
         

 
            <label for="is_affiliate">Affiliate</label>
            <input type="checkbox" name="is_affiliate" {{ $user->is_affiliate ? "checked" : '' }}>
         

 
            <label for="affiliate_commission">Affiliate Commission %</label>
            <input type="number" name="affiliate_commission" value="{{ $user->affiliate_commission * 100 }}">
         

 
            <label for="affiliate_code">Affiliate Code</label>
            <input type="text" name="affiliate_code" value="{{ $user->affiliate_code }}">
         
        



 
            <label for="is_banned">Banned</label>
            <input type="checkbox" name="is_banned" {{ $user->is_banned ? "checked" : '' }}>
        </div>

        <input type="submit" value="Save">

    </form>
@endsection


