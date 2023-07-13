<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">



    <style>
        .sin-borde{
            border: none !important;
        }
    </style>


    <!-- Scripts -->
    @vite([ 'resources/js/app.js','resources/css/dashlite.css','resources/css/theme.css','resources/css/skins/theme-egyptian.css'])

</head>
<body class="nk-body bg-lighter npc-general has-sidebar" theme="dark">
    
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            @include('layouts.partials.sidebar')
            
            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap" id="app">
                <!-- main header @s -->
                @include('layouts.partials.header')
                <!-- main header @e -->
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                               @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content @e -->
                <!-- footer @s -->
                
                <!-- footer @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- select region modal -->
    
    <!-- JavaScript -->
    <script src="{{asset('js/bundle.js?ver=3.1.3')}}"></script>
    <script src="{{asset('js/scripts.js?ver=3.1.3')}}"></script>


</body>
</html>
