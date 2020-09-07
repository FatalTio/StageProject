<style>
    a{
        padding-right: 0 !important;
    }
</style>

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
        <a class="navbar-brand font-weight-bold" href="{{ url('/index') }}"><span>CsCannon Tester</span> <small>by</small> <span class="text-warning">EverDream</span>Soft</a>

        {{-- <a class="nav-link text-warning" target="_blank" href="https://github.com/everdreamsoft/CrystalSpark-Cannon"><h5>CsCannon Git</h5></a> --}}

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
