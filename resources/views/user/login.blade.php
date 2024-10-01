<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account Stealth - Login</title>
    {{-- <link rel="stylesheet" href="{{ asset('./assets/css/user.css') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('./assets/css/modal.css') }}" />
    <link rel="stylesheet" href="{{ asset('./assets/css/login.css') }}"> 
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.key') }}"></script>
    <link rel="icon" href="{{ asset('./assets/logo3.png') }}" type="image/x-icon">

    <style>
      .loginContainer {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    }

.loginContainer .row div .loginCard {
    width: 100%;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

.loginContainer .row div .accordionCard {
    width: 100%;
    padding: 4px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    border: 0;
    height: 100%;
}

/* Add media query to make the login card and accordion card full-width on small screens */
@media (max-width: 767px) {

    .loginContainer .row div .loginCard,
    .loginContainer .row div .accordionCard {
        width: 100%;
    }

    .qsts {
        display: none;
    }
}

/* Update logo container to center the logo properly */
.logocontainer {
    margin: 20px auto;
    /* Add some margin for spacing */
    text-align: center;
}

/* Make the canvas occupy the full width and height of the screen */
canvas#canvas {
    position: absolute;
    top: 0;
    left: 0;
    pointer-events: none;
    z-index: -1;
    /* Change the z-index to -1 to move it behind other elements */
    width: 100%;
    height: 100vh;
}

.logocontainer img {
    width: 100px;
    height: 100px;
}

a {
    text-decoration: none;
}

canvas {
    display: block;
}
.special-paragraph {
    font-weight: bold;
    font-size: 18px;
    color: #d24216; /* Or any other color you prefer */
    text-align: center;
    margin: 20px 0;
}

    </style>

</head>

<body>

    <!--  Matric effects -->
    <canvas id="canvas"></canvas>
    <div class="container loginContainer">
        <div class="row">
            <!-- Login Card -->
            <div class="col-md-6">
                <div class="card loginCard">
                  {{--  error handler --}}
                  <div class="errors">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <label>
                                <input type="checkbox" class="alertCheckbox" autocomplete="off" />
                                <div class="error alert">
                                    <span class="alertClose">X</span>
                                    <span class="alertText">ERROR : {{ $error }}
                                        <br class="clear" /></span>
                                </div>
                            </label>
                        @endforeach
                    @endif
                </div>
                  {{-- error handler --}}
                    <div class="text-center logocontainer">
                        <!-- logo -->
                        <img src="{{asset('./assets/logo3.png')}}" alt="logo" class="logo">
                    </div>
                    <div class="special-paragraph">
                      More than 80% of Sellers Are reselling to you Products for x2 at least 
                                             
                  </div>
                  
                    <div class="card-body">
                        <form method="POST" id="login-form" class="row g-3">
                            <div class="col-md-12">
                              <label for="Username" class="form-label">Username</label>
                              <input type="text" class="form-control" id="Username" name="username" placeholder="Email / Username" required>
                            </div>
                            <div class="col-md-12">
                              <label for="Password" class="form-label">Password</label>
                              <input type="password" class="form-control" id="Password" placeholder="Password" name="password" required>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Remember Me</label>
                                </div>
                            </div>
                            <!-- forget password -->
                            <div class="col-md-6 d-flex justify-content-end">
                                <a href="reset" class="forget-password">Forget Password?</a>
                            </div>
                            <!-- dont have account -->
                            <div class="col-md-12 text-center">
                               <span class="psw">Don't have an account ? <a href="register">Sign Up.</a></span>
                            </div>
                            <div class="d-grid gap-2 col-6 mx-auto">
                              <button style="background-color: #d9614e;" class="btn g-recaptcha"
                              data-sitekey="{{ config('services.recaptcha.key')}}"
                              data-callback="onSubmit"
                              data-action="submit">
                                <i id="icon" class="bi bi-unlock-fill"></i>
                                Sign in
                              </button>
                            </div>
                          </form>
                    </div>
                  </div>
            </div>
            <!-- Frequency asked questions accordions Card -->
            <div class="col-md-6 qsts">
                <div class="accordion card accordionCard" id="accordionExample">
                    <!-- accordion item 1 -->
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                          What is the purpose of Verifme?
                        </button>
                      </h2>
                      <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            Verifme is a broker website dedicated for buy or selling items that help you to develop your work.
                        </div>
                      </div>
                    </div>
                    <!-- accordion item 2 -->
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          What Verifme provides ?
                        </button>
                      </h2>
                      <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            We provide powerful tools  , verified accounts , cheap hosting, data for marketing, helping you to grow your business, Buy Tools, Shells, RDP, Cpanel, Mailer, SMTP, Leads, Combo By Cryptocurrency
                        </div>
                      </div>
                    </div>
                    <!-- accordion item 3 -->
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          Terms of service
                        </button>
                      </h2>
                      <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            All items are sold to you conditioned upon your acceptance without modification of the terms, 
                            conditions, and notices contained. By accessing the website at https://Verifme.com , you are agreeing 
                            to be bound by these terms of service, and all applicable laws and regulations, and agree that you 
                            are responsible for compliance with any applicable local laws. If you do not agree with any of these 
                            terms, you are prohibited from using or accessing this site. 
                            The materials contained in this website are protected by applicable copyright and trademark law.
                        </div>
                      </div>
                    </div>
                    <!-- accordion item 4 -->
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                          Privacy Policy
                      </h2>
                      <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            - This item has been sold for the specific use of applications. This item may not be used for unlawful 
                            purposes and that use is expressly prohibited under the terms and conditions of its use. <br/>
                            - Verifme may revise these terms of service for its website at any time without notice. 
                            By using this website you are agreeing to be bound by the then-current version of these terms of service.
                        </div>
                      </div>
                    </div>
                    <!-- accordion item 5 -->
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            Verifme Warranty
                        </button>
                      </h2>
                      <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                             After releasing money to seller We do not make guarantees as to the provenance of these items. However of the seller seems to be untrusted he will be banned 
                            and buyer might be compensated                        </div>
                      </div>
                    </div>
                    <!-- accordion item 6 -->
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingSix">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                          Limitations of liability
                        </button>
                      </h2>
                      <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            In no event, verifme be liable for any direct, indirect, punitive, incidental, or special consequential damages, 
                            to way for using items from the buyer buy it or seller sell it, whatsoever arising out of or connected 
                            with the use or misuse of its items.                        
                        </div>
                      </div>
                    </div>
                    <!-- accordion item 7 -->
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingSeven">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                          Verifme keywords
                        </button>
                      </h2>
                      <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            Verifme , buy N26, buy Account, buy Bank, buy Verified , buy Sumup, buy wirex , buy Bunq ,buy accounts, steath accounts, verified accounts, revolut , qonto , bunq ,N26, banks ,verified banks , vcc unlimited , stripe , stripe business , square 
                            buy combo, buy cryptocurrency, buy Stripe , buy Coinbase, buy Bybit, buy Binance , buy Revolut , 
                            buy Docs, buy ID, buy verification , buy qonto , buy wamo , buy revolut business , buy wise , buy bnb, buy binance, 
                            buy wise business , buy ada, buy polkadot, buy Account , buy uni, buy uniswap, buy solana, buy sol, 
                            buy chainlink, buy link, buy luna, buy avalanche, buy avax, buy terra, buy matic, buy polygon, 
                            buy shiba, buy shib, buy doge, buy safemoon, buy sa
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script type="text/javascript" src="./js/modal.js"></script> --}}
    <script>
        function onSubmit(token) {
            document.getElementById("login-form").submit();
        }
    </script>
    <script src="{{asset('./assets/js/login.js')}}"></script>
</body>

</html>