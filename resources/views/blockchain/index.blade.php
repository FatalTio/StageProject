@include('components/header')

@extends('welcome')

<style>

    #blockchain_choose{
        background-image: url('https://www.pgconnects.com/london/wp-content/uploads/sites/4/2018/01/photo-Shaban-Shaame.jpg');
        background-repeat: no-repeat;
        background-position: center;
    }

    .opacityClass{
        opacity : 0.5;
    }

    .alertFunctions{
        display: none;
    }

</style>

<h1 class="text-center text-warning font-weight-bold mt-3">
    {{ $testToDo == 'CsCannon' ? 'Here we test the CsCannon functions' : 'Here we test the differents Datasources' }} 
</h1>


<h2 class="text-center text-warning font-weight-bold mt-3"> Enter your address and choose your blockchain</h2>

<section id="blockchain_choose" class="rounded text-light container col-6 mt-5 pt-5 pb-5">

    <form class="container text-center col-6 font-weight-bold" 
        action={{ $testToDo == 'CsCannon' ? url('/testDatasources') : url('/dataSourceTests') }} 
        method="POST">

        <input type="hidden" name="howToTest" value="{{ $testToDo }}">

        <div class="form-group">

            <label for="blockchainAddress">Blockchain Address</label>
            <input name="address" type="text" class="opacityClass form-control text-success font-weight-bold" id="blockchainAddress" placeholder="0xXXXXX">

        </div>

        <div class="form-group">

            <label for="selectBlockchain">Select your blockchain</label>

            <select name="blockchain" class="opacityClass form-control font-weight-bold" id="selectBlockchain">

                <option selected="selected">Choose a blockchain</option>

                @foreach ($blockchains as $blockchain)
                    <option>{{ $blockchain->name }}</option>
                @endforeach
                
            </select>

        </div>


        <div class="form-group">

            <label>Select a function</label>

            <select id="selectFunction" name="function" class="opacityClass form-control font-weight-bold">

                <option selected="selected">Action to do</option>
                <option data-alert="getBalanceAlert">getBalance</option>

                @if($testToDo == 'CsCannon')
                    <option data-alert="obsByCollectionAlert">returnObsByCollection</option>
                @else
                    <option data-alert="txHistoryAlert">TxHistory</option>
                @endif
                    
            </select>

        </div>

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <input type="submit" class="btn btn-warning mt-3 font-weight-bold mb-3" value="View all Datasources">

        <div id="txHistoryAlert" class="alertFunctions alert alert-success" role="alert">
            <button type="button" data-toggle="popover" data-content="Do not show this alert" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            This function find all last transactions of the specified address
        </div>

        <div id="getBalanceAlert" class="alertFunctions alert alert-success" role="alert">
            <button type="button" data-toggle="popover" data-content="Do not show this alert" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            This function find all contracts and their quantities on the specified address
        </div>

        <div id="obsByCollectionAlert" class="alertFunctions alert alert-success" role="alert">
            <button type="button" data-toggle="popover" data-content="Do not show this alert" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            This function find all the Collections, contracts, assets and their quantities on the specified address
        </div>

    </form>

</section>

@include('components/footer')

<script src="http://code.jquery.com/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script>

    $.noConflict();
    jQuery(document).ready(function($){
        
        $('#selectFunction').change(()=>{

            $('.alertFunctions').slideUp(500);

            $selectedOption = $('#selectFunction option:selected').attr('data-alert');
            $('#' + $selectedOption).slideDown(500);
        })

        $('.close').popover({ trigger : "hover" });

    });
        
</script>