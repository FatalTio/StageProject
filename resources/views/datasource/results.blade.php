@extends('welcome')

@section('content')

<link rel="stylesheet" href="{{ asset('styles/datasource/results.css') }}">

@php
    $urlToJson = url('dataSourceJson', ['address' => $address, 'blockchain' => $blockchain, 'function' => $function]);
@endphp

<h1 class="text-center text-success font-weight-bold mt-3">{{ $function }}()</h1>
<h1 class="text-center text-primary font-weight-bold mt-3">{{ $address }}</h1>

@if(empty($results))

    <h2 class="text-center text-warning font-weight-bold mt-3">This request find nothing !</h2>

    <a href="{{ url('functionsTest', ['howToTest' => $howToTest]) }}" class="btn btn-outline-danger font-weight-bold col-4 offset-4 mt-5">Back to the research</a>

@else

    <ul class="nav container-fluid col-6 offset-3 nav-tabs" id="myTab" role="tablist">

        @foreach($results as $name => $result)

            @php $id = uniqid(); @endphp

            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="{{ $name . $id }}" data-toggle="tab" href="#{{ $id . $name }}" role="tab" aria-controls="home"
                    aria-selected="true">{{ $name }}</a>
            </li>

        @endforeach
    </ul>


@endif

<div class="tab-content container-fluid col-6 offset-3" id="tabContent">

    @foreach ($results as $name => $result )

        <div class="tab-pane fade show active overflow-auto" id="{{ $id . $name }}" role="tabpanel" aria-labelledby="home-tab">
        
            <pre id="{{ $name }}" class="text-success bg-dark">
        
{{-- {{ $name }} : <br>
        @foreach($result as $index => $datas)
    {{ $index }} : <br>
            @if(!is_array($datas))
        @php print_r(json_encode($datas)) @endphp
            @elseif(is_array($datas))
                @foreach($datas as $data)
        @php print_r(json_encode($data)); @endphp<br>
                @endforeach
            @endif

        @endforeach --}}

            {{-- @php
                $resultJson = json_encode($result);
            print_r($result);
            @endphp --}}

            </pre>
        </div>
        
    @endforeach
    
</div>

<script>
    let url = "<?php print_r($urlToJson) ?>";

console.log(url);
</script>

<script src="{{ asset('js/datasource/results.js') }}"></script>

@endsection

