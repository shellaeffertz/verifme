@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('./assets/css/seller-withdraw.css') }}" />
<link rel="stylesheet" href="{{ asset('./assets/css/modal.css') }}" />
<link rel="stylesheet" href="{{ asset('././css/sucess-modal.css') }}" />


@endsection

@section('title')
    Withdraws
@endsection

 
@section('content')
  


    <form method="POST" class="buy-form">
        <input type="number" name="amount" placeholder="Amount">
        <div class="select-box">
        <select name="coin">
            <option value="BTC">BTC</option>
            <option value="ETH">ETH</option>
            <option value="LTC">LTC</option>
        </select>
         </div>
        <input type="text" name="address" placeholder="Address">
        <input type="submit" value="Withdraw" class="buton">
    </form>


        <h2>MY WITHDRAWS : </h2>
{{-- 
        <ul class="responsive-table">
            <li class="table-header">
                <div class="col col-1">Amount</div>
                <div class="col col-2">Coin</div>
                <div class="col col-3">Adresse</div>
                <div class="col col-4">Date</div>
                <div class="col col-5">Status</div>
            </li>
        
    <div class="withdraws">
        @foreach ($withdraws as $withdraw)
        <li class="table-row">
            <div class="col col-1">{{ $withdraw->amount }} USD</div>
            <div class="col col-2">{{ $withdraw->coin }}</div>
            <div class="col col-3 description-container">
                <p class="truncated-description">
                {{Str::limit($withdraw->address , 20, '...') }}
                </p>
                <span class="tooltip">                  
                    {{  str_replace("\r\n","\n", $withdraw->address) }}
                  </span>
            </div>

            <div class="col col-4">{{ $withdraw->created_at }}</div>
            <div class="col col-5">{{ $withdraw->status }}
                @if ($withdraw->status == 'rejected')
               <p style="color: brown">{{ $withdraw->reject_reason }}</p>
                @endif
            </div>

        </li>
        @endforeach
    </div> 
       </ul> --}}



       <div class="display-table">
        <table>
            <thead>
                <tr>
                    <th>Amount</th>
                    <th>Coin</th>
                    <th>Adresse</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($withdraws as $withdraw)
                    <tr>
                        <td mobile-title="TYPE">{{ $withdraw->amount }} USD</td>
                        <td mobile-title="TITLE">{{ $withdraw->coin }}</td>
                        <td mobile-title="PRICE">   
                            <div class="description-container">
                            <p class="truncated-description">
                            {{Str::limit($withdraw->address , 20, '...') }}
                            </p>
                            <span class="tooltip">                  
                                {{  str_replace("\r\n","\n", $withdraw->address) }}
                              </span>
                        </div>
                    </td>
                        <td mobile-title="STATUS">{{ $withdraw->created_at }}</td>
                        <td mobile-title="STATUS">     
                            {{ $withdraw->status }}
                            @if ($withdraw->status == 'rejected')
                           <p style="color: brown">{{ $withdraw->reject_reason }}</p>
                            @endif
                        </td>
                   
                    </tr>
                @endforeach
            </tbody>
        </table>


@endsection


