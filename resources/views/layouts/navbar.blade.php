<header>
    <nav>
        <div class="nav-header">
            <div class="mobile-toggle">
                {{-- <img src="{{ asset('./assets/list.png') }}" alt="menu"> --}}
                <i style="font-size: 28px;color: #1C3879;" class="fa-solid fa-bars"></i>
            </div>
            <div class="logo">
                <a href="{{ route('home') }}"> <!-- Replace "your_link_here" with the actual URL you want the logo to link to -->
                  <img src="{{ asset('./assets/logo3.png') }}" alt="logo" class="custom-image">
                </a>
            </div>              
            <a href="/notifications">
                <div class="spacer"
                    data-count="{{ \App\Models\Notification::where('user_id', Auth::user()->id)->where('seen', false)->count() }}">
                    <img src="{{ asset('./assets/icons/bell.png') }}" alt="notification">
                </div>
            </a>
        </div>

        <div class="nav-links">
            <div class="nav-groups">
                @if (Auth::user()->is_admin)
                    <div class="nav-group">
                        <div class="nav-group-title">ADMIN</div>
                        <div class="nav-group-items">
                            <a class="link" href="/">
                                <img src="{{ asset('./assets/icons/dash2.png') }}" alt="Dashboard Icon">
                                {{-- have to change it and add some KPI that will helps the support and the admin --}}
                                Dashboard
                            </a>
                            <a class="link" href="/admin/notifications">
                                <img src="{{ asset('./assets/icons/bell.png') }}" alt="notifications" />
                                <div class="nav-item">
                                    <div class="nav-item-title">
                                        Notifications
                                    </div>
                                    <div class="nav-item-count">
                                        {{ \App\Models\Notification::whereNull('user_id')->where('seen', false)->count() }}
                                    </div>
                                </div>
                            </a>
                            <a class="link" href="/admin/users">
                                <img src="{{ asset('./assets/icons/users2.png') }}" alt="users" />
                                <div class="nav-item">
                                    <div class="nav-item-title">
                                        Users
                                    </div>
                                    <div class="nav-item-count">
                                        {{ \App\Models\User::all()->count() }}
                                    </div>

                                </div>
                            </a>

                            <a class="link" href="/admin/orders">
                                <img src="{{ asset('./assets/icons/order2.png') }}" alt="orders" />
                                <div class="nav-item">
                                    <div class="nav-item-title">
                                        Orders
                                    </div>
                                    <div class="nav-item-count">
                                        {{ \App\Models\Order::all()->count() }}
                                    </div>

                                </div>
                            </a>

                            <a class="link" href="/admin/products">
                                <img src="{{ asset('./assets/icons/product.png') }}" alt="products" />
                                Listing Products
                                <div class="nav-item-count">
                                    {{ \App\Models\Product::where('status', 'active')->count() }}
                                </div>
                            </a>

                            <a class="link" href="/admin/support">
                                <img src="{{ asset('./assets/icons/support.png') }}" alt="support" />
                                <div class="nav-item">
                                    <div class="nav-item-title">
                                        Support
                                    </div>
                                    <div class="nav-item-count">
                                        {{ \App\Models\SupportTicket::where('status', 'open')->count() }}
                                    </div>

                                </div>
                            </a>
                            <a class="link" href="/admin/withdraws">
                                <img src="{{ asset('./assets/icons/with2.png') }}" alt="withdraw" />
                                Withdraws
                            </a>
                            <a class="link" href="/admin/affiliates">
                                <img src="{{ asset('./assets/icons/ref-req.png') }}" alt="referrals" />
                                Referal Requests
                            </a>
                        </div>
                    </div>
                @endif

                @if (Auth::user()->is_support)
                    <div class="nav-group">
                        <div class="nav-group-title">SUPPORT</div>
                        <div class="nav-group-items">
                            <a class="link" href="/">
                                <img src="{{ asset('./assets/icons/dash2.png') }}" alt="Dashboard Icon">
          
                                Dashboard 
                            </a>
                            <a class="link" href="/admin/notifications">
                                <img src="{{ asset('./assets/icons/bell.png') }}" alt="notifications" />
                                <div class="nav-item">
                                    <div class="nav-item-title">
                                        Notifications
                                    </div>
                                    <div class="nav-item-count">
                                        {{ \App\Models\Notification::whereNull('user_id')->where('seen', false)->count() }}
                                    </div>
                                </div>
                            </a>

                            <a class="link" href="/admin/orders">
                                <img src="{{ asset('./assets/icons/order2.png') }}" alt="orders" />
                                <div class="nav-item">
                                    <div class="nav-item-title">
                                        Orders
                                    </div>
                                    <div class="nav-item-count">
                                        {{ \App\Models\Order::all()->count() }}
                                    </div>

                                </div>
                            </a>

                            <a class="link" href="/admin/support">
                                <img src="{{ asset('./assets/icons/support.png') }}" alt="support" />
                                <div class="nav-item">
                                    <div class="nav-item-title">
                                        Support
                                    </div>
                                    <div class="nav-item-count">
                                        {{ \App\Models\SupportTicket::where('status', 'open')->count() }}
                                    </div>

                                </div>
                            </a>
                            <a class="link" href="/admin/withdraws">
                                <img src="{{ asset('./assets/icons/with2.png') }}" alt="withdraw" />
                                Withdraws
                            </a>
                            <a class="link" href="/admin/affiliates">
                                <img src="{{ asset('./assets/icons/ref-req.png') }}" alt="referrals" />
                                Referal Requests
                            </a>
                        </div>
                    </div>
                @endif
                
                @if (Auth::user()->is_seller)
                    <div class="nav-group">
                        <div class="nav-group-title">SELLER</div>
                        <div class="nav-group-items">
                            <a class="link" href="{{ route('seller.tos') }}">
                                <img src="{{ asset('./assets/icons/tos.png') }}" alt="dashboard" />
                                    Terms of Service
                                </a>    
                            <a class="link" href="/seller">
                                <img src="{{ asset('./assets/icons/dash2.png') }}" alt="dashboard" />
                                Dashboard
                            </a>
                            <a class="link" href="/seller/products">
                                <img src="{{ asset('./assets/icons/product.png') }}" alt="products" />
                                Sell Products 
                                <div class="nav-item-count">
                                    {{ \App\Models\Product::where('status', 'active')->where('seller_id',auth()->user()->id)->count() }}
                                </div>
                            </a>
                            <a class="link" href="/seller/orders">
                                <img src="{{ asset('./assets/icons/order2.png') }}" alt="orders" />
                                My Orders
                                <div class="nav-item-count">
                                    {{ \App\Models\Order::where('status', 'pending')->where('seller_id',auth()->user()->id)->count() }}
                                </div>
                            </a>
                        </div>
                    </div>
                @endif
                <div class="nav-group">
                    <div class="nav-group-title">PRODUCTS</div>
                    <div class="nav-group-items">

                        <a class="link" href="{{ route('products.accounts') }}" style="cursor: pointer;">
                            <img src="{{ asset('./assets/icons/bank.png') }}" alt="banks" />
                            Bank-Accounts
                        </a>

                        {{-- <a class="link" style="cursor: pointer;" onclick="showsubsection(1)">

                            <img src="{{ asset('./assets/icons/bank.png') }}" alt="banks" />
                            Bank-Accounts

                            <i class="fa fa-arrow-down icone" id="test1"></i>
                        </a>

                        <div class="subsection" id="subsection1">
                            <a class="link" href="/products/accounts?query=personal">
                                Personal
                            </a>
                            <a class="link" href="/products/accounts?query=business">
                                Business
                            </a>
                        </div> --}}



                        <a class="link" href="/products/payement-process">
                            <img src="{{ asset('./assets/icons/creditcard.png') }}" alt="creditcard" />
                            Payement Processors
                        </a>

                        <a class="link" href="/products/crypto">
                            <img src="{{ asset('./assets/icons/cryptoexch.png') }}" alt="cryptoexch" />
                            Crypto & Exchanges
                        </a>
                        <a class="link" href="/products/cracked">
                            <img src="{{ asset('./assets/icons/cracked.png') }}" alt="cracked" />
                            Cracked Accounts
                        </a>
                        <a class="link" href="/products/smtps">
                            <img src="{{ asset('./assets/icons/docs.png') }}" alt="docs" />
                            Real & Fake Docs
                        </a>

                    </div>
                </div>
                <div class="nav-group nav-group-bottom">
                    <div class="nav-group-title">ACCOUNT</div>
                    <div class="nav-group-items">
                        <div class="balance">
                            <div class="current-balance">
                                ${{ Auth::user()->balance }}
                            </div>
                            <a class="buy-balance" href="/buy">
                                Add Balance
                            </a>
                        </div>
                        <a class="link" href="/notifications">
                            <img src="{{ asset('./assets/icons/bell.png') }}" alt="notifications" />
                            <div class="nav-item">
                                <div class="nav-item-title">
                                    Notifications
                                </div>
                                <div class="nav-item-count">
                                    {{ \App\Models\Notification::where('user_id', Auth::user()->id)->where('seen', false)->count() }}
                                </div>
                            </div>
                        </a>



                        <a class="link" href="/profile">
                            <img src="{{ asset('./assets/icons/profile.png') }}" alt="profile" />
                            Profile
                        </a>
                        <a class="link" href="/orders">
                            <img src="{{ asset('./assets/icons/pursheses.png') }}" alt="orders" />
                            My Purchases
                            <div class="nav-item-count">
                                {{ \App\Models\Order::where('status', 'pending')->where('buyer_id', Auth::user()->id)->count() }}
                            </div>
                        </a>
                        @if (Auth::user()->is_seller)
                            <a class="link" href="/withdraw">
                                <img src="{{ asset('./assets/icons/with2.png') }}" alt="profile" />
                                Withdraw
                            </a>
                        @endif

                        <a class="link" href="/affiliate">
                            <img src="{{ asset('./assets/icons/affiliate.png') }}" alt="affiliate" />
                            Affiliate Program
                        </a>
                        <a class="link" href="/support">
                            <img src="{{ asset('./assets/icons/support-ticket.png') }}" alt="affiliate" />
                            Support Tickets
                        </a>
                        @if (session('impersonate'))
                            <a class="link" href="/impersonation/end">
                                <img src="{{ asset('./assets/icons/shift.png') }}" alt="shift" />
                                Leave Impersonation
                            </a>
                        @endif


                        <a class="link" href="/logout">
                            <img src="{{ asset('./assets/icons/logout.png') }}" alt="logout" />
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </nav>
</header>
