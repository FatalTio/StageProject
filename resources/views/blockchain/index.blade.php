
@extends('welcome')

@section('content')


    <link rel="stylesheet" href="{{ asset('styles/blockchain/index.css') }}">

    <div id="jsonAlert" class="alert alert-danger alert-dismissible fade show text-center" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    @foreach($errors->all() as $error)

        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">

            <span class="font-weight-bold">Oops, we have a problem !</span> {{ $error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>

    @endforeach


    <h1 class="text-center text-warning font-weight-bold mt-3">

        @if($howToTest == 'CsCannon')
            Here we test the CsCannon functions
        @elseif($howToTest == 'datasources')
            Here we test the differents Datasources
        @elseif($howToTest == 'htmlTables')
            Enter the parameters for your tables <br> 
            <small>(called with CsCannon functions)</small>
        @endif

    </h1>

    <h2 class="text-center text-warning font-weight-bold mt-3"> Enter your address and choose your blockchain</h2>

    <div id="blockchain_choose" class="rounded text-light container col-6 mt-5 pt-5 pb-5">

        <form class="container text-center col-6 font-weight-bold" 
                @if($howToTest == 'CsCannon')
                    action={{ url('/testDatasources') }}
                @elseif($howToTest == 'datasources')
                    action={{ url('/dataSourceTests') }}
                @elseif($howToTest == 'htmlTables')
                    action={{ url('/htmlTableView') }}
                @endif
            method="POST">

            <input type="hidden" name="howToTest" value="{{ $howToTest }}">

            <div class="form-group">

                <label for="blockchainAddress">Blockchain Address</label>
                <input name="address" type="text" class="opacityClass form-control text-success font-weight-bold" id="blockchainAddress" placeholder="0xXXXXX" required>

            </div>

            <div class="form-group">

                <label for="selectBlockchain">Select your blockchain</label>

                <select name="blockchain" class="opacityClass form-control font-weight-bold" id="selectBlockchain" required>

                    <option id="defaultBlockchainOption" selected="selected">Choose a blockchain</option>

                    @foreach ($blockchains as $blockchain)
                        <option id="{{ $blockchain->name }}">{{ $blockchain->name }}</option>
                    @endforeach
                    
                </select>

            </div>


            <div class="form-group" id="netGroup">

                <label class="row justify-content-center">
                    Select which Net you want
                    <div id="infoIcon" data-toggle="popover" title="Testnets are blockchains only for testing" data-trigger="hover" 
                    data-content="Usually named 'Testnet' or 'Mainnet' but the Ethereum's Testnets are 'Rinkeby' and 'Ropsten'">

                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.93 4.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                        </svg>
                    </div>
                </label>

                <div class="spinner-grow text-success"></div>

                <select id="selectNet" name="net" class="opacityClass form-control font-weight-bold" required>
                        <option selected="selected">Select a Net</option>
                </select>

            </div>

            

            <div class="form-group" id="functionGroup">

                <label>Select a function</label>

                <select id="selectFunction" name="function" class="opacityClass form-control font-weight-bold" required>

                    <option selected="selected">Action to do</option>
                    <option data-alert="getBalanceAlert">getBalance</option>

                    @if($howToTest == 'CsCannon')
                        <option data-alert="obsByCollectionAlert">returnObsByCollection</option>
                    @elseif($howToTest == 'datasources')
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

    </div>

    <script src="{{ asset('js/blockchain/index.js') }}"></script>

@stop