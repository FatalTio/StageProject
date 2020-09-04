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
        background-color: #F9EEBF;
        height: 2px;
        width: 60%;
        margin: auto;
        margin-top: 75px;
    }

    #mainPageMove {
        width: 20px;
        height: 2px;
    }

    #cscCode {
        border-radius: 30px;
    }

    #cscFunctions,
    #blockchainDatasources,
    #cscCode {
        display: none;
    }

    ul {
        list-style-type: none;
    }

</style>


<div class="container text-center mt-5 pt-5 text-warning">

    <h1 class="mainPage">Welcome to CsCannon Test</h1>

    <h3 class="mainPage">Here you can determine which Datasource or CsCannon's function to use</h3>

    <h5 class="mainPage mt-5">Select an option for start the test<h5>

</div>

<div id="br">
    <div class="bg-warning" id="mainPageMove"></div>
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


    <div id="cscCode" class="text-light bg-dark container mt-5 pt-3 pb-3 text-center col-8">
    </div>


    <div id="cscFunctions">
        <h3>eg :</h3>

        <span class="text-primary">$address</span> = 'XXXXXX'; <br />

        <span class="text-primary">$addressFactory</span> = <span class="text-success">BlockchainRouting</span>::<span
            class="text-warning">getAddressFactory</span>($address); <br />
        <span class="text-primary">$addressToQuery</span> = $addressFactory-><span
            class="text-warning">get</span>($address); <br />

        <span class="text-primary">$addressToQuery</span>-><span class="text-warning">setDataSource</span>($datasource);
        <br />
        <span class="text-primary">$balance</span> = $addressToQuery-><span class="text-warning">getBalance</span>();
        <br />
    </div>

    <div id="blockchainDatasources">

        <ul class="text-success font-weight-bold">

            @foreach ($datasources as $datasource)
                <li>{{ $datasource->name }}</li>
            @endforeach

        </ul>

    </div>

@include('components/footer')


    <script src="http://code.jquery.com/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.0/anime.min.js"></script>
    <script>

        const mainPageMove = document.getElementById('mainPageMove');
        const animReceiver = document.getElementById('br')


        const anim = (animReceiverWidth, mainPageMoveWidth) => {
            anime({
                targets: '#mainPageMove',
                translateX: animReceiverWidth - mainPageMoveWidth,
                easing: 'linear',
                duration: 1500,
                loop: true,
                direction: 'alternate'
            })
        }


        document.addEventListener("DOMContentLoaded", firstAnime = ()=>{
            anim(animReceiver.clientWidth, mainPageMove.clientWidth);
        })

        window.addEventListener('resize',()=>{
            anime.remove(anim);
            anim(animReceiver.clientWidth, mainPageMove.clientWidth);
        });

        $.noConflict();
        jQuery(document).ready(function($){

            $('.buttonShow').mouseover(display = (e)=>{

                $divToShow = $(e.currentTarget).attr('data-value');
                $htmlToReplace = $('#' + $divToShow).html();

                $('#cscCode').html($htmlToReplace);
                $('#cscCode').show(600);
            });
        });
        
    </script>