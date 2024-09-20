<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | Account Stealth</title>
    <link rel="stylesheet" href="{{ asset('./assets/css/app.css') }}"> 
    <link rel="stylesheet" href="{{ asset('./assets/css/modal.css') }}" />
    <link rel="stylesheet" href="{{ asset('./css/sucess-modal.css') }}" />
    <script src="https://kit.fontawesome.com/81f1f5a8fc.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="{{ asset('./assets/logo3.png') }}" type="image/x-icon">

    @yield('style')

    <style>
/* Seller profile style  */
        /* body{
    margin-top:20px;
    color: #1a202c;
    text-align: left;
    background-color: #e2e8f0;    
} */
.main-body-profile {
    padding: 15px;
}
.card-profile {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
}

.card-profile {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: .25rem;
}

.card-body-profile {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm-profile {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm-profile>.col, .gutters-sm-profile>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}
.mb-3-profile, .my-3-profile {
    margin-bottom: 1rem!important;
}

.bg-gray-300-profile {
    background-color: #e2e8f0;
}
.h-100-profile {
    height: 100%!important;
}
.shadow-none-profile {
    box-shadow: none!important;
}


/*  */

/* become a seller style */
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
/* become a seller style */
        /* Your default image size for larger screens */
        .custom-image {
        width: 150px;
        height: 100px;
        }

        /* Media query for mobile devices with a maximum width of 768px */
        @media (max-width: 768px) {
        .custom-image {
            width: 150px; /* Adjust the width for mobile */
            height: 50px; /* Allow the height to adjust proportionally */
        }
        }


        .description-container {
          position: relative;
        }
      
        .truncated-description {
          display: block;
          overflow: hidden;
          text-overflow: ellipsis;
          white-space: nowrap;
          /* Add a fixed height to make the text truncate and show "..." */
          height: 1.5em;
        }
      
        .tooltip {
          display: none;
         
          max-width: 300px;
          /* Preserve line breaks within the tooltip content */
          white-space: pre-wrap;
          word-wrap: break-word;
        }
      
        /* Show the tooltip on hover */
        .description-container:hover .tooltip {
          display: block;
        }
        .description-container:hover .truncated-description {
          display: none;
        }
        .special-span {
            color: red;
            font-size: 18px;
        }
        .d-flex {
            display: flex;
            align-items: center
            width: 100%;
            padding: 5px 0;
            gap: .3rem;
        }

        .justify-content-center {
            justify-content: center;
        }


      </style>
</head>

<body>
    @include('layouts.navbar')
    <main>
        <div class="container-x">
            <div class="page-details">
                <div class="page-title">
                    @yield('title')
                </div>
                <div class="page-subtitle">
                    @yield('subtitle')
                </div>

                
                @if ($errors->any())
                    <div class="errors">
                        @foreach ($errors->all() as $error)
                            <label>
                                <input type="checkbox" class="alertCheckbox" autocomplete="off" />
                                <div class="alert error">
                                    <span class="alertClose">X</span>
                                    <span class="alertText">ERROR : {{ $error }}
                                        <br class="clear" /></span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                @endif

                @if (session('success'))
                    <div class="success">
                    
                        <label>
                            <input type="checkbox" class="alertCheckbox-success" autocomplete="off" />
                            <div class="alert-success success">
                            <span class="alertClose-success">X</span>
                            <span class="alertText-success">SUCCESS : {{ session('success') }}
                            <br class="clear-success"/></span>
                            </div>
                        </label>
                
                    </div>
                @endif

            </div>

            @yield('content')
        </div>
    </main>
    <script src="{{ asset('./assets/js/app.js') }}"></script>
    <!-- MDB -->

    @stack('script')
    @livewireScripts
</body>

</html>
