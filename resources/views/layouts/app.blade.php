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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    @yield('style')

    <style>
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
    width: 100%;
    
    padding: 25px 5px 20px;
    display: flex;
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

                {{-- @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif --}}
            </div>




            @yield('content')
        </div>
    </main>
    <script src="{{ asset('./assets/js/app.js') }}"></script>
    @stack('script')
    @livewireScripts
</body>

</html>
