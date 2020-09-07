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

    hr{
        width: 75%;
        height: 2px;
        background-color: antiquewhite;
    }

</style>
<section>

    <h1 class="text-center text-success font-weight-bold mt-3">{{ $function }}()</h1>
    <h1 class="text-center text-primary font-weight-bold mt-3">{{ $address }}</h1>

    @if(empty($results))

        <a href="{{ url('functionsTest', ['howToTest' => $howToTest]) }}" class="btn btn-outline-danger font-weight-bold col-4 offset-4 mt-5">Back to the research</a>

    @else

        @foreach($results as $name => $result)

            <hr class="mt-4 mb-4">

            <h2 class="text-center text-warning font-weight-bold mt-3">{{ $name }}</h2>
            <h2 class="text-center text-warning font-weight-bold mt-3"> {{ $result ? 'This request responds in ' . $result['time'] . ' sec' : 'This request find nothing !' }}</h2>


            <button data-toggle="popover" data-placement="right" data-content="{{ count($result['data']) }} contract(s)"
            data-value="{{ $name }}" class="contractButton btn btn-outline-warning font-weight-bold col-6 offset-3 mt-3">
                View the list of contracts
            </button>


            <div id="responseDiv" class="container mt-4 col-6">

                <div id="{{ $name }}" class="contractsList container mt-3 col-6 bg-dark text-success text-center">

                    <h3 class="text-center text-success font-weight-bold mt-3 mb-2"><ins>{{ count($result['data']) }} contract(s) :</ins></h3>

                    <ol>

                        @foreach($result['data'] as $contract)

                            <li> {{ $contract['contract'] }} </li>

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