@extends('welcome')

@section('content')

    <link rel="stylesheet" href="{{ asset('styles/blockchain/balance_result.css') }}">

    <section>

        <h1 class="text-center text-success font-weight-bold mt-3">{{ $function }}()</h1>
        <h1 class="text-center text-primary font-weight-bold mt-3">{{ $address }}</h1>

        @foreach($results as $name => $result)

            <h3 class="text-center text-warning font-weight-bold mt-3">Blockchain {{ $blockchain }}</h3>
            <h3 class="text-center text-warning font-weight-bold mt-3">With {{ $name }} :</h3>

            <h2 class="text-center text-warning font-weight-bold mt-3"> {{ $result ? 'This request responds in ' . $result['time'] : 'This request find nothing !' }}</h2>
            

            @if($result)

                <a href="{{ url('/viewJson', ['datasource' => $name, 'function' => $function, 'address' => $address]) }}" target="_blank" type="button" 
                    class="btn btn-outline-success font-weight-bold col-4 offset-4 mt-3">
                        View the Json result
                </a>
            @else
                <a href="{{ url('functionsTest', ['howToTest' => $howTotest]) }}" class="btn btn-outline-danger font-weight-bold col-4 offset-4 mt-5">
                    Back to the research
                </a>
            @endif

            @if($function == 'returnObsByCollection')

                <a target="_blank" href="{{ url('/toCollection', ['net' => $net, 'address' => $address, 'function' => $function]) }}" class="btn btn-outline-primary font-weight-bold col-4 offset-4 mt-5">
                    View to Laravel's Collection
                </a>

            @endif

            {{-- getBalance on Ethereum --}}
            @if(isset($result['contracts']))

                <h5 class="text-center text-warning font-weight-bold mt-3">For {{ count($result['contracts']) }} blockchain(s) :</h5>

                <div id="responseDiv" class="container mt-4 col-6">

                    @foreach($result['contracts'] as $index => $contracts)

                        <button data-toggle="popover" data-placement="right" data-content="{{ count($contracts) }} contract(s) }}" 
                            data-value="{{ $index }}" class="contractButton btn btn-outline-warning font-weight-bold col-6 offset-3 mt-3">

                            {{ $index }}
                        </button>

                        <div id="{{ $index }}" class="contractsList container mt-3 col-6 bg-dark text-success text-center">

                            <h3 class="text-center text-success font-weight-bold mt-3 mb-2"><ins>{{ count($contracts) }} contract(s) :</ins></h3>

                            <ol>

                                @foreach($contracts as $contractName => $contract)

                                    <li>{{ $contractName }}</li>

                                @endforeach

                            </ol>

                        </div>

                    @endforeach

                </div>

            {{-- returnObsByCollection --}}
            @elseif(isset($result['collections']))

                <h5 class="text-center text-warning font-weight-bold mt-3">For {{ count($result['collections']) }} collection(s) :</h5>

                <div id="responseDiv" class="container mt-4 col-6">

                    @foreach($result['collections'] as $collection)

                        <button data-toggle="popover" data-placement="right" data-content="{{ count($collection['orbs']) }} contract(s)" 
                            data-value="{{ $collection['id'] }}" class="contractButton btn btn-outline-warning font-weight-bold col-6 offset-3 mt-3">

                            {{ $collection['id'] }}
                        </button>

                        <div id="{{ $collection['id'] }}" class="contractsList container mt-3 col-6 bg-dark text-success text-center">

                            <h3 class="text-center text-success font-weight-bold mt-3 mb-2"><ins>{{ count($collection['orbs']) }} contract(s) :</ins></h3>

                            <ol>

                                @foreach($collection['orbs'] as $contract)

                                    <li>{{ $contract['contract'] }}</li>

                                @endforeach

                            </ol>

                        </div>

                    @endforeach

                </div>

            {{-- getBalance on Counterparty --}}
            @elseif(isset($result['results']))

                <h5 class="text-center text-warning font-weight-bold mt-3">{{ count($result['results']) }} contract(s) :</h5>

                <div id="responseDiv" class="container mt-4 col-6">

                    @foreach($result['results'] as $contractName => $contracts)

                        <button data-toggle="popover" data-placement="right" data-content="{{ count($contracts) }} contract(s)" 
                            data-value="{{ $contractName }}" class="contractButton btn btn-outline-warning font-weight-bold col-6 offset-3 mt-3">

                            {{ $contractName }}
                        </button>

                        {{-- <div id="{{ $contractName }}" class="contractsList container mt-3 col-6 bg-dark text-success text-center">

                            <h3 class="text-center text-success font-weight-bold mt-3 mb-2"><ins>{{ count($contracts) }} contract(s) :</ins></h3>

                            <ol>

                                <li>{{ $contractName }}</li>

                            </ol>

                        </div> --}}

                    @endforeach

                </div>

            @endif

        @endforeach

    </section>


    <script src="{{ asset('js/blockchain/balance.js') }}"></script>

@endsection