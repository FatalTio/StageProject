@extends('welcome')

@section('content')

<link rel="stylesheet" href="{{ asset('styles/datasource/results.css') }}">

<h1 class="text-center text-success font-weight-bold mt-3">{{ $function }}()</h1>
<h1 class="text-center text-primary font-weight-bold mt-3">{{ $address }}</h1>

@if(empty($results))

    <h2 class="text-center text-warning font-weight-bold mt-3">This request find nothing !</h2>

    <a href="{{ url('functionsTest', ['howToTest' => $howToTest]) }}" class="btn btn-outline-danger font-weight-bold col-4 offset-4 mt-5">Back to the research</a>

@else

    <ul class="nav nav-tabs" id="myTab" role="tablist">

        @foreach($results as $name => $result)

            @php $id = uniqid(); @endphp

            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="{{ $name . $id }}" data-toggle="tab" href="#{{ $name }}" role="tab" aria-controls="home"
                    aria-selected="true">{{ $name }}</a>
            </li>

        @endforeach
    </ul>


@endif

<div class="tab-content" id="myTabContent">

    @foreach ($results as $name => $result )

        <div class="tab-pane fade show active text-success" id="{{ $name }}" role="tabpanel" aria-labelledby="home-tab">
        @php print_r(json_encode($result)) @endphp
        </div>

    @endforeach
    
</div>



<script src="{{ asset('js/datasource/results.js') }}"></script>

@endsection

