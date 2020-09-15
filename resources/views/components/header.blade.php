<link rel="stylesheet" href="{{ asset('styles/components/header.css') }}">

@php
    $cscActive = '';
    $datasourceActive = '';
@endphp

@if(isset($howToTest))
    @if($howToTest == 'CsCannon')
        @php
            $cscActive = 'active';
            $datasourceActive = '';
        @endphp
    @elseif($howToTest == 'datasources')
        @php
            $cscActive = '';
            $datasourceActive = 'active';
        @endphp
    @endif
@endif

<div>

    <nav class="navbar navbar-expand navbar-dark bg-dark">

        <a id="homeMenu" href="{{ url('/index') }}" class="mr-5 mb-1">
            <svg id="homeIcon" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-door" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z"/>
                <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
            </svg>
        </a>

        <a class="navbar-brand font-weight-bold" href="#"><span>CsCannon Tester</span> <small>by</small> <span class="eDsWarning">EverDream</span>Soft</a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto col-8 offset-4 col-lg-4 offset-lg-8 col-md-6 offset-md-6">
                
                <li class="nav-item {{ $cscActive }}">
                    <a class="nav-link" href="{{ url('functionsTest', ['howToTest' => 'CsCannon']) }}"><h5>CsCannon functions</h5></a>
                </li>

                <li class="nav-item {{ $datasourceActive }}">
                    <a class="nav-link" href="{{ url('functionsTest', ['howToTest' => 'datasources']) }}"><h5>Datasources</h5></a>
                </li>
            </ul>
        </div>
    </nav>
</div>
