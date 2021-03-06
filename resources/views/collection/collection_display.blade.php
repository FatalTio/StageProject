@extends('welcome')

@section('content')

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('styles/collection/collection_display.css') }}">

    @php 
        if(isset($howToTest)){
            $urlToCall = url('/csCannonFunctions', [
                'net' => $net, 
                'address' => $address, 
                'function' => $function
            ]); 
        }
    @endphp

    @foreach($errors->all() as $error)

        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">

            <span class="font-weight-bold">Oops, we have a problem !</span> {{ $error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>

    @endforeach

    @if(isset($error))

        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">

            <span class="font-weight-bold">Oops, we have a problem !</span> {{ $error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>

    @endif


    @if(isset($urlToCall))

        <div class="spinner-grow" role="status">
            <span class="sr-only"></span>
        </div>

        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        </ul>

        <div class="tab-content" id="pills-tabContent">
        </div>

        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script>
        <script>
            const urlToCall = "<?php print_r($urlToCall) ?>";
        </script>
        <script type="text/javascript" src="{{ asset('js/collection/collection_display.js') }}"></script>


    @elseif(isset($refMap) && isset($table))

        <div class="spinner-grow" role="status">
            <span class="sr-only"></span>
        </div>
    
        <button id="serverSide" class="btn btn-outline-success switchTables">Table Server Side</button>
        <button id="clientSide" class="btn btn-outline-primary switchTables">Table Client Side</button>

        <div class="container-fluid" id="tableContainer">
            <table class="text-light table table-dark" id="factoryTable">
                <thead></thead>
                <tbody></tbody>
            </table>
        </div>

        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script>
        <script>
            const refMap = '<?php print_r(json_encode($refMap)) ?>';
            const table = '<?php print_r($table) ?>';
        </script>
        <script type="text/javascript" src="{{ asset('js/collection/factory.js') }}"></script>

    @endif

@endsection