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


    <div class="spinner-grow" role="status">
        <span class="sr-only"></span>
    </div>


    @if(isset($urlToCall))

        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        </ul>

        <div class="tab-content" id="pills-tabContent">
        </div>

    @else
        <div class="container-fluid">
            <table class="text-light table table-dark" id="factoryTable">
                <thead></thead>
                <tbody></tbody>
            </table>
        </div>
    @endif


<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script>

@if(isset($urlToCall))
    <script>
        const urlToCall = "<?php print_r($urlToCall) ?>";
    </script>
    <script type="text/javascript" src="{{ asset('js/collection/collection_display.js') }}"></script>
@else
    <script>
        const refMap = '<?php print_r(json_encode($refMap)) ?>';
        const table = '<?php print_r($table) ?>';
    </script>
    <script type="text/javascript" src="{{ asset('js/collection/factory.js') }}"></script>
@endif

@endsection