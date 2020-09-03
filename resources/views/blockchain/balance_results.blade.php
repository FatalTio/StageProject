@extends('welcome')

<header>
    @include('components.header')
</header>

<style>

    .contractsList{
        font-weight: bold;
        border-radius: 10px;
        padding-top: 10px;
        display: none;
    }

    .contractButton{
        box-shadow: 1px 1px 5px #ffc107;
    }

</style>
<body>
<section>

    <h1 class="text-center text-success font-weight-bold mt-3">{{ $function }}()</h1>
    <h1 class="text-center text-primary font-weight-bold mt-3">{{ $address }}</h1>

    @foreach($results as $name => $result)

        <h2 class="text-center text-warning font-weight-bold mt-3">This request responds in {{ $result['time'] }}</h2>

        <h3 class="text-center text-warning font-weight-bold mt-3">With the Datasource : {{ $name }}</h3>
        

        <a href="{{ url('/viewJson', ['datasource' => $name, 'function' => $function, 'address' => $address]) }}" target="_blank" type="button" 
            class="btn btn-outline-success font-weight-bold col-4 offset-4 mt-3">
                View the Json result
        </a>

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

        @endif

    @endforeach

</section>
</body>

@include('components/footer')

<script src="http://code.jquery.com/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.0/anime.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script>

    $.noConflict();
    jQuery(document).ready(function($){

        $('.contractButton').on('click', (e)=>{

            $divToDisplay = $(e.currentTarget).attr('data-value');
            $('#' + $divToDisplay).slideToggle(500);
        });

        $('.contractButton').popover({ trigger : "hover" });
    });

</script>