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
    {{ $howToTest == 'CsCannon' ? 'Here we test the CsCannon functions' : 'Here we test the differents Datasources' }} 
</h1>


<h2 class="text-center text-warning font-weight-bold mt-3"> Enter your address and choose your blockchain</h2>

<section id="blockchain_choose" class="rounded text-light container col-6 mt-5 pt-5 pb-5">

    <form class="container text-center col-6 font-weight-bold" 
        action={{ $howToTest == 'CsCannon' ? url('/testDatasources') : url('/dataSourceTests') }} 
        method="POST">

        <input type="hidden" name="howToTest" value="{{ $howToTest }}">

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

                @if($howToTest == 'CsCannon')
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
@include('components/scripts')

<script src="js/blockchain/index.js"></script>