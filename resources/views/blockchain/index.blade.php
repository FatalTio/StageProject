<style>

    #blockchain_choose{
        background-image: url('https://www.pgconnects.com/london/wp-content/uploads/sites/4/2018/01/photo-Shaban-Shaame.jpg');
        background-repeat: no-repeat;
        background-position: center;
    }

    .opacityClass{
        opacity : 0.5;
    }

</style>



<section id="blockchain_choose" class="rounded text-light bg-dark container col-6 mt-5 pt-5 pb-5">

    <form class="container text-center col-6 font-weight-bold" action="{{ url('/testDatasources') }}" method="POST">
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

            <label for="selectFunction">Select a function</label>

            <select name="function" class="opacityClass form-control font-weight-bold" id="selectFunction">

                <option selected="selected">Action to do</option>

                <option>getBalance</option>

                <option>Tx History</option>
                
            </select>

        </div>

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <input type="submit" class="btn btn-warning mt-4 font-weight-bold" value="View all Datasources">

    </form>

</section>