@extends('welcome')

@section('content')

<link rel="stylesheet" href="{{ asset('styles/datasource/results.css') }}">

@php
    $urlToJson = url('dataSourceJson', ['net' => $net, 'function' => $function, 'address' => $address,]);
@endphp

<h1 class="text-center text-success font-weight-bold mt-3">{{ $function }}()</h1>
<h1 class="text-center text-primary font-weight-bold mt-3">{{ $address }}</h1>
<h1 class="text-center text-primary font-weight-bold mt-3"></h1>

@if(empty($datasources))

    <h2 class="text-center text-warning font-weight-bold mt-3">This request find nothing !</h2>

    <a href="{{ url('functionsTest', ['howToTest' => $howToTest]) }}" class="btn btn-outline-danger font-weight-bold col-4 offset-4 mt-5">Back to the research</a>

@else

    <nav>
        <div class="nav container-fluid col-6 offset-3 nav-tabs" id="nav-tab" role="tablist">

            @php $i = 0; @endphp

            @foreach($datasources as $name => $url)

                    <a class="nav-item nav-link {{ $i == 0 ? 'active ' : '' }} navItem text-light" id="{{ 'nav-' . $name . '-tab'}}"
                    data-toggle="tab" href="#{{ 'nav-' . $name }}" role="tab" aria-controls="{{ 'nav-' . $name }}" aria-selected="{{ $i == 0 ? 'true' : 'false' }}">
                        {{ $name }}
                    </a>

                @php $i++; @endphp

            @endforeach

        </div>
    </nav>

    <div class="tab-content container-fluid col-8 offset-2" id="tabContent">

        @php $count = 0; @endphp

        @foreach ($datasources as $name => $url )

            <div class="tab-pane fade {{ $count == 0 ? 'active show ' : '' }}overflow-auto" id="{{ 'nav-' . $name }}" role="tabpanel" aria-labelledby="{{ 'nav-' . $name . '-tab'}}">

                <pre class="jsonContent text-success bg-dark">

                    <div class="spinner-border text-success"></div>
                    <code id="{{ $name . $function }}"></code>

                </pre>

            </div>
            @php $count ++; @endphp

        @endforeach

    </div>


@endif



<script>
    let functionToTest = "<?php print_r($function) ?>";
    let urlToQuery = "<?php print_r($urlToJson) ?>";
</script>

<script src="{{ asset('js/datasource/results.js') }}"></script>

@endsection

