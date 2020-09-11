@extends('welcome')

@section('content')

<link rel="stylesheet" href="{{ asset('styles/datasource/results.css') }}">

@php
    $urlToJson = url('dataSourceJson', ['blockchain' => $blockchain, 'function' => $function, 'address' => $address,]);
@endphp

<h1 class="text-center text-success font-weight-bold mt-3">{{ $function }}()</h1>
<h1 class="text-center text-primary font-weight-bold mt-3">{{ $address }}</h1>
<h1 class="text-center text-primary font-weight-bold mt-3"></h1>

@if(empty($datasources))

    <h2 class="text-center text-warning font-weight-bold mt-3">This request find nothing !</h2>

    <a href="{{ url('functionsTest', ['howToTest' => $howToTest]) }}" class="btn btn-outline-danger font-weight-bold col-4 offset-4 mt-5">Back to the research</a>

@else

    <ul class="nav container-fluid col-6 offset-3 nav-tabs" id="myTab" role="tablist">

        @foreach($datasources as $name => $url)

            @php $id = uniqid(); @endphp

            <li class="nav-item" role="presentation">
                <a class="nav-link active bg-dark text-light" data-toggle="tab" href="#{{ $name }}" role="tab" aria-controls="home"
                    aria-selected="true">{{ $name }}</a>
            </li>

        @endforeach

    </ul>

    <div class="tab-content container-fluid col-8 offset-2" id="tabContent">

        @foreach ($datasources as $name => $url )

            <div class="tab-pane fade show active overflow-auto" id="{{ $name }}" role="tabpanel" aria-labelledby="home-tab">
            
                <pre class="jsonContent text-success bg-dark">

                    <div class="spinner-border text-success"></div>
                    <code id="{{ $name . $function }}"></code>

                </pre>

            </div>
            
        @endforeach
        
    </div>


@endif



<script>
    let functionToTest = "<?php print_r($function) ?>";
    let urlToQuery = "<?php print_r($urlToJson) ?>";
</script>

<script src="{{ asset('js/datasource/results.js') }}"></script>

@endsection

