@extends('welcome')

<header>
    @include('components.header')
</header>

<style>
    #buttons {
        padding-top: 100px;
    }

    .mainPage {
        font-weight: bold;
    }

    #br {
        background: #F9EEBF;
        height: 2px;
        width: 60%;
        margin: auto;
        margin-top: 75px;
        
    }

    #cscFunctions,
    #blockchainDatasources {
        display: none;
    }

    ul {
        list-style-type: none;
    }

    .alertFunctions{
        height: 25%;
    }

</style>


<div class="container text-center mt-5 pt-5 text-warning">

    <h1 class="mainPage">Welcome to CsCannon Test</h1>

    <h3 class="mainPage">Here you can determine which Datasource or CsCannon's function to use</h3>

    <h5 class="mainPage mt-5">Select an option for start the test<h5>

</div>

<div id="br">
</div>

    <div id="buttons" class="container-fluid col-6 offset-3 row justify-content-around">

        <div>
            <a href="{{ url('functionsTest', ['howToTest' => 'CsCannon']) }}" data-value="cscFunctions" id="functions" type="button"
                class="buttonShow mainPage btn btn-outline-warning">
                CsCanon functions
            </a>
        </div>

        <div>
            <a href="{{ url('functionsTest', ['howToTest' => 'datasources']) }}" data-value="blockchainDatasources" id="datasources" type="button"
                class="buttonShow mainPage btn btn-outline-success">
                Tests Datasources
            </a>
        </div>

    </div>


    <div class="container-fluid mt-3">

        <div id="cscFunctions" class="col-6 offset-3 alertFunctions alert alert-primary text-center font-weight-bold overflow-auto">
            <h3>eg :</h3>

            <span class="text-primary">$address</span> = 'XXXXXX'; <br />

            <span class="text-primary">$addressFactory</span> = <span class="text-success">BlockchainRouting</span>::<span
                class="text-warning">getAddressFactory</span>($address); <br />
            <span class="text-primary">$addressToQuery</span> = $addressFactory-><span
                class="text-warning">get</span>($address); <br />

            <span class="text-primary">$addressToQuery</span>-><span class="text-warning">setDataSource</span>(new <span class="text-success">Datasource</span>);
            <br />
            <span class="text-primary">$balance</span> = $addressToQuery-><span class="text-warning">getBalance</span>();
            <br />
        </div>

        <div id="blockchainDatasources" class="col-6 offset-3 alertFunctions alert alert-primary text-center font-weight-bold overflow-auto">

            <ul class="text-success font-weight-bold">

                @foreach ($datasources as $datasource)
                    <li>{{ $datasource->name }}</li>
                @endforeach

            </ul>

        </div>

    </div>

@include('components/footer')


    <script src="http://code.jquery.com/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script>


        $.noConflict();
        jQuery(document).ready(function($){

            $('.buttonShow').mouseover(display = (e)=>{

                $divToShow = $(e.currentTarget).attr('data-value');

                if($divToShow != $('.buttonShow').attr('data-open') ){

                    $('.buttonShow').attr('data-open', '');
                    $('.alertFunctions').slideUp(600);
                }

                $('#' + $divToShow).slideDown(600);
                $('.buttonShow').attr('data-open', $divToShow);

            })
        });
        
    </script>