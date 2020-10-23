<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('components/head')
        <link rel="stylesheet" href="{{ asset('styles/welcome.css') }}">
    </head>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.0/anime.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

<body>

{{--    @if(Cookie::get('dontShow') != 'true')--}}
{{--        @include('components/guide')--}}
{{--    @endif--}}
    @include('components/guide')

    <header>
        @include('components/header')
    </header>

    <nav id="helperContent">
        @include('components/helper')
    </nav>

    <div id="content">
        @yield('content')
    </div>

    <footer class='container-fluid bg-dark dark'>
        @include('components/footer')
    </footer>

</body>

</html>


