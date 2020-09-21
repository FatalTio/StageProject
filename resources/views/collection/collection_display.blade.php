@extends('welcome')

@section('content')

    <link rel="stylesheet" href="{{ asset('styles/collection/collection_display.css') }}">

    @php 
        $urlToCall = url('/csCannonFunctions', [
            'net' => $net, 
            'address' => $address, 
            'function' => $function
        ]); 
    @endphp

    @foreach($errors->all() as $error)

        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">

            <span class="font-weight-bold">Oops, we have a problem !</span> {{ $error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>

    @endforeach

    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

    </ul>


    <div class="tab-content" id="pills-tabContent">

        <div class="tab-pane fade show active" id="pills-{datasourceName}" role="tabpanel"
            aria-labelledby="pills-{datasourceName}-tab">

            <nav aria-label="Page navigation">

                <ul class="pagination col-10 offset-1">
                    <li class="page-item">
                    </li>
                </ul>

            </nav>

            <div class="col-10 offset-1" id="datasTable">

                <h5 class="text-warning"></h5>

                <div class="spinner-grow" role="status">
                    <span class="sr-only"></span>
                </div>

            </div>
        </div>
    </div>

<script>
    const urlToCall = "<?php print_r($urlToCall) ?>"
</script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="{{ asset('js/collection/collection_display.js') }}"></script>

@endsection