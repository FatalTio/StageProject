@extends('welcome')

@section('content')

@php 
    $urlToCall = url('/csCannonFunctions', [
        'net' => $net, 
        'address' => $address, 
        'function' => $function
    ]); 
@endphp



<script>
    const url = "<?php print_r($urlToCall) ?>"
</script>
<script type="text/javascript" src="{{ asset('js/collection/collection_display.js') }}"></script>

@endsection