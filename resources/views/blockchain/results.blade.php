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

    .footerEDS{
        position: absolute;
        bottom: 0;
    }

    .contractButton{
        box-shadow: 1px 1px 5px #ffc107;
    }

</style>
<body>
<section>


    @foreach($results as $name => $result)

        <h2 class="text-center text-warning font-weight-bold mt-3">This request responds in {{ $result['time'] }}</h2>

        <h3 class="text-center text-warning font-weight-bold mt-3">With the Datasource : {{ $name }}</h3>

        <h5 class="text-center text-warning font-weight-bold mt-3">For {{ count($result['contracts']) }} blockchain(s) :</h5>

        <div id="responseDiv" class="container mt-4 col-6">

            @foreach($result['contracts'] as $index => $contracts)

                <button data-value="{{ $index }}" class="contractButton btn btn-outline-warning font-weight-bold col-6 offset-3 mt-3">
                    {{ $index }}
                </button>

                <div id="{{ $index }}" class="contractsList container mt-5 col-6 bg-dark text-success text-center">

                    <h3 class="text-center text-success font-weight-bold mt-3 mb-2"><ins>{{ count($contracts) }} contracts :</ins></h3>

                    <ol>

                        @foreach($contracts as $contractName => $contract)

                            <li>{{ $contractName }}</li>

                        @endforeach

                    </ol>

                </div>

            @endforeach

        </div>

    @endforeach

</section>
</body>

@include('components/footer')

<script src="http://code.jquery.com/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.0/anime.min.js"></script>
<script>

    $.noConflict();
    jQuery(document).ready(function($){

        $('.contractButton').on('click', (e)=>{

            $divToDisplay = $(e.currentTarget).attr('data-value');

            $('#' + $divToDisplay).slideToggle(500);
            setTimeout(function(){
                $('footer').toggleClass('footerEDS')
            },250);
        });
    });

</script>