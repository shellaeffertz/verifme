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

    <div class="create-form">

        <div class="form-group">

            <h2 class="section-headline">USER INFORMATION</h2>

            <form method="POST" action="{{ route('admin.user-update', $user->id) }}">
                @csrf
                @method('PUT')

                <div>
                    <label>Nickname</label>
                    <input type="text" value="{{ $user->nickname }}" disabled>
                </div>
     
                <div>
                    <label>Email</label>
                    <input type="text" value="{{ $user->email }}" disabled>
                </div>
     
                <div>
                    <label>Username</label>
                    <input type="text" value="{{ $user->username }}" disabled>
                </div>
     
                <div>
                    <label for="balance">Balance</label>
                    <input id="balance" type="text" name="balance" value="{{ $user->balance }}">
                </div>
    
                <fieldset>

                    <legend> USER ROLE </legend>
                
                    <div class="user-role">

                        <div class="checkbox-wrapper">
                            <label for="is_admin">Admin</label>
                            <input id="is_admin" type="checkbox" value="on" name="is_admin" {{ $user->is_admin ? "checked" : '' }}>
                        </div>
        
                        <div class="checkbox-wrapper">
                            <label for="is_seller">Seller</label>
                            <input id="is_seller" type="checkbox" value="on" name="is_seller" {{ $user->is_seller ? "checked" : '' }}>
                        </div>
        
                        <div class="checkbox-wrapper">
                            <label for="is_support">Support</label>
                            <input id="is_support" type="checkbox" value="on" name="is_support" {{ $user->is_support ? "checked" : '' }}>
                        </div>
        
                    </div>

                </fieldset>
     
                <div>
                    <label for="commission">Commission %</label>
                    <input id="commission" type="number" name="commission" value="{{ $user->commission * 100 }}">
                </div>
     
                <fieldset>

                    <legend>  AFFILIATE </legend>

                    <div class="checkbox-wrapper">
                        <label for="is_affiliate">Affiliate</label>
                        <input id="is_affiliate" type="checkbox" value="on" name="is_affiliate" {{ $user->is_affiliate ? "checked" : '' }}>
                    </div>
        
                    <div>
                        <label for="affiliate_commission">Affiliate Commission %</label>
                        <input id="affiliate_commission" type="number" name="affiliate_commission" value="{{ $user->affiliate_commission * 100 }}">
                    </div>
        
                    <div>
                        <label for="affiliate_code">Affiliate Code</label>
                        <input id="affiliate_code" type="text" name="affiliate_code" value="{{ $user->affiliate_code }}">
                    </div>

                </fieldset>
     
                <fieldset>

                    <legend>Other Actions</legend>

                    <div class="user-role">
                        <div class="checkbox-wrapper">
                            <label for="is_banned">Ban</label>
                            <input id="is_banned" type="checkbox" name="is_banned" {{ $user->is_banned ? "checked" : '' }}>
                        </div>
    
                        @if($user->is_seller)
                            <div class="checkbox-wrapper">
                                <label for="is_verified_seller">Verified</label>
                                <input id="is_verified_seller" type="checkbox" value="on" name="is_verified_seller" {{ $user->is_verified_seller ? "checked" : '' }}>
                            </div>
                        @endif
                    </div>

                </fieldset>
    
                <div class="form-btn-wrapper">
                    <button type="submit" class="simple-btn">Save</button>
                </div>
    
            </form>
    
        </div>

    </div>

@endsection


