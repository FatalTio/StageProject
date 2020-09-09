@extends('welcome')

@section('content')

    <link rel="stylesheet" href="{{ asset('styles/datasource/result.css') }}">
    <section>

        <h1 class="text-center text-success font-weight-bold mt-3">{{ $function }}()</h1>
        <h1 class="text-center text-primary font-weight-bold mt-3">{{ $address }}</h1>

        @if(empty($results))

            <h2 class="text-center text-warning font-weight-bold mt-3">This request find nothing !</h2>

            <a href="{{ url('functionsTest', ['howToTest' => $howToTest]) }}" class="btn btn-outline-danger font-weight-bold col-4 offset-4 mt-5">Back to the research</a>

        @else

            @foreach($results as $name => $result)

                <hr class="mt-4 mb-4">

                <h2 class="text-center text-warning font-weight-bold mt-3">{{ $name }}</h2>
                <h2 class="text-center text-warning font-weight-bold mt-3"> {{ $result ? 'This request responds in ' . $result['time'] . ' sec' : 'This request find nothing !' }}</h2>


                <button data-toggle="popover" data-placement="right" data-content="{{ count($result['data']) }} {{ $function == 'getBalance' ? 'contracts' : 'transactions' }}"
                data-value="{{ $name }}" class="contractButton btn btn-outline-warning font-weight-bold col-6 offset-3 mt-3">
                    {{ $function == 'getBalance' ? 'View the list of contracts' : 'View the top ten transactions' }}
                </button>


                <div id="responseDiv" class="container mt-4 col-6">

                    <div id="{{ $name }}" class="contractsList container mt-3 bg-dark text-success text-center font-weight-normal">

                        <h3 class="text-center text-success font-weight-bold mt-3 mb-2"><ins>{{ count($result['data']) }} contract(s) :</ins></h3>

                        <ol>
                            @php
                                $i = 0;
                            @endphp

                            @foreach($result['data'] as $contract)

                                @if($blockchain != 'Ethereum')

                                    <li> {{ $contract['contract'] }} </li>
                                
                                @else

                                    @if($function == 'TxHistory')
                                        <li><h5 class="font-weight-bold">Transaction Index : </h5>{{ $contract['transactionIndex'] }}<br/>
                                        <h5 class="font-weight-bold">From : </h5>{{ $contract['from'] }}<br/>
                                        <h5 class="font-weight-bold">To : </h5>{{ $contract['to'] }}<br/>
                                        <h5 class="font-weight-bold">Value : </h5>{{ $contract['value'] }}</li><hr>

                                        @php
                                            $i ++;
                                        @endphp

                                        @if($i<10)
                                            @continue
                                        @else
                                            @break
                                        @endif
                                            
                                    @endif

                                @endif

                            @endforeach

                        </ol>

                    </div>

                </div>

                @if($result)

                    <a href="{{ url('/datasourcesToJson', ['datasource' => $name, 'function' => $function, 'address' => $address]) }}" target="_blank" type="button" 
                        class="btn btn-outline-success font-weight-bold col-4 offset-4 mt-3">
                            View the Json result
                    </a>
                @else
                    <a href="{{ url('functionsTest', ['howToTest' => $howTotest]) }}" class="btn btn-outline-danger font-weight-bold col-4 offset-4 mt-5">Back to the research</a>
                @endif

            @endforeach
        
        @endif

    </section>

    <script src="{{ asset('js/datasource/result.js') }}"></script>

@endsection