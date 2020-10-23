
{{--@if(Cookie::get('dontShow') != 'true')--}}

    <div id="greyBgc" class=""></div>

    <div id="guideDiv" class="text-center font-weight-bold container col-10 offset-1">

        <svg id="closeGuide" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
        </svg>

        <h3>CsCannon Tester</h3>

        <p>
            CsCannon Test a pour but de vous aider à comprendre les functions que la librairie propose ainsi que les différentes datasources disponibles.
        </p>

        <br>

        <p>
            <u>Prérequis :</u>
        <li class="font-italic">
            <ol>
                Vous avez une address Blockchain
            </ol>
            <ol>
                Vous possédez un ou plusieurs assets ou vous avez de la crypto-monnaie.
            </ol>
        </li>
        </p>

        <br>

        <p>
            La partie "CsCannon functions" vous permet de tester la librairie CsCannon et certaines fonctions qu'elle propose
        </p>

        <p>
            La partie "Test Datasources" vous permet de consulter le résultat des différentes datasources directement
        </p>

        <p>
            La partie "HTML Tables" vous permet de visualiser sous forme de table HTML vos views en database
        </p>

        <div id="inputDiv" class="container">
            <div class="col-6 offset-3">
                <input type="radio" name="dontShow" id="dontShow" value="dontShow">
                <label for="dontShow">Ne plus afficher ce message</label>
            </div>

            <button id="acceptButton" class="btn btn-success col-6">J'ai compris !</button>
        </div>

    </div>
{{--@endif--}}
