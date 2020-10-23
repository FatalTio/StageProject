@extends('welcome')

@section('content')

    <link rel="stylesheet" href="{{ asset('styles/index.css') }}">

    <div class="container text-center mt-5 pt-5 text-warning">

        <h1 class="mainPage">Welcome to CsCannon Test</h1>

        <h3 class="mainPage">Here you can determine which Datasource or CsCannon's function to use</h3>

        <h5 class="mainPage mt-5">Select an option for start the test</h5>

    </div>

    <div id="br">
    </div>

    <div id="buttons" class="container-fluid col-6 offset-3 row justify-content-around">

        <div>
            <a href="{{ url('functionsTest', ['howToTest' => 'CsCannon']) }}" data-value="cscFunctions" id="functions"
                type="button" class="buttonShow mainPage btn btn-outline-warning">
                CsCanon functions
            </a>
        </div>

        <div>
            <a href="{{ url('functionsTest', ['howToTest' => 'datasources']) }}" data-value="blockchainDatasources"
                id="datasources" type="button" class="buttonShow mainPage btn btn-outline-success">
                Test Datasources
            </a>
        </div>

    </div>


    <div class="col-2 offset-5 mt-5">
        <a href="{{ url('functionsTest', ['howToTest' => 'htmlTables']) }}" id="functions" type="button"
            class="buttonShow mainPage btn btn-outline-primary">
            HTML Tables
        </a>
    </div>

    <div class="col-2 offset-5 mt-5">
        <form action="{{ url('factoryJson') }}" method="GET">
            <div class="form-group">
                <label for="factoryInput">Factory To View in table</label>
                <input name="factory" type="text" class="form-control" id="factoryInput" aria-describedby="factoryHelp">
                <small id="factoryHelp" class="form-text text-muted text-center">Enter a CsCannon Factory</small>
            </div>
            <button type="submit" class="btn btn-primary col-6 offset-3">Submit</button>
        </form>
    </div>

        <div class="container-fluid mt-3">

            <div id="cscFunctions"
                class="col-6 offset-3 alertFunctions alert alert-primary text-center font-weight-bold overflow-auto">
                <h3>eg :</h3>

                <span class="text-primary">$address</span> = 'XXXXXX'; <br />

                <span class="text-primary">$addressFactory</span> = <span
                    class="text-success">BlockchainRouting</span>::<span
                    class="text-warning">getAddressFactory</span>($address); <br />
                <span class="text-primary">$addressToQuery</span> = $addressFactory-><span
                    class="text-warning">get</span>($address); <br />

                <span class="text-primary">$addressToQuery</span>-><span class="text-warning">setDataSource</span>(new
                <span class="text-success">Datasource</span>);
                <br />
                <span class="text-primary">$balance</span> = $addressToQuery-><span
                    class="text-warning">getBalance</span>();
                <br />
            </div>

            <div id="blockchainDatasources"
                class="col-6 offset-3 alertFunctions alert alert-primary text-center font-weight-bold overflow-auto">

                <ul class="text-success font-weight-bold">

                    @foreach ($datasources as $datasource)
                    <li>{{ $datasource->name }}</li>
                    @endforeach

                </ul>

            </div>

        </div>



        <script src="{{ asset('js/index.js') }}"></script>

        @endsection
