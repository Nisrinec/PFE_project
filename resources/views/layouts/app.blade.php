<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles') <!-- Include section for additional styles -->
</head>
<body>
    @include('header') <!-- Include the header partial -->

    <div id="app">
        @yield('content')
    </div>

    <script src="{{ mix('js/app.js') }}"></script> <!-- Link to your compiled JS -->
    @yield('scripts')
    <body>
        
        @if(Request::is('settings/notification')) 
            @include('partials.notifications')
        @endif
        
      
    
       
    </body>
    {{-- <div>
        @if(auth()->check())
            @foreach(auth()->user()->notifications as $notification)
                @include('settings.notification', ['notification' => $notification])
            @endforeach
        @endif
    </div> --}}
</body>
</html>