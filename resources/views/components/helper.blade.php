<link rel="stylesheet" href="{{ asset('styles/components/helper.css') }}">

<div id="helperIcon">
    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-question-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033a.237.237 0 0 1-.24-.247C5.35 4.091 6.737 3.5 8.005 3.5c1.396 0 2.672.73 2.672 2.24 0 1.08-.635 1.594-1.244 2.057-.737.559-1.01.768-1.01 1.486v.105a.25.25 0 0 1-.25.25h-.81a.25.25 0 0 1-.25-.246l-.004-.217c-.038-.927.495-1.498 1.168-1.987.59-.444.965-.736.965-1.371 0-.825-.628-1.168-1.314-1.168-.803 0-1.253.478-1.342 1.134-.018.137-.128.25-.266.25h-.825zm2.325 6.443c-.584 0-1.009-.394-1.009-.927 0-.552.425-.94 1.01-.94.609 0 1.028.388 1.028.94 0 .533-.42.927-1.029.927z"/>
    </svg>
</div>

<div id="helperContent" class="bg-dark">

    <div id="closeMenu">
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
        </svg>
    </div>

    <ul id="helperList" class="mr-auto col-10">

        <a href="#" class="nav-item dopdown-toggle" id="cscDropDown" data-toggle="dropdown"><li>CsCannon</li></a>

            {{-- <div class="dropdown-menu" aria-labelledby="cscDropDown"> --}}
            <div id="cscMenu">
                <a class="dropdown-item" href="#">What is CsCannon</a>
                <a class="dropdown-item" href="#">Functions</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" target="_blank" href="https://github.com/everdreamsoft/CrystalSpark-Cannon">Github</a>
            </div>

        <a href="#"><li class="nav-item">Blockchains</li></a>
        <a href="#"><li class="nav-item">Datasources</li></a>
        <a href="#"><li class="nav-item">About us</li></a>
        <!-- <li></li>
        <li></li> -->

    </ul>

</div>


<script src="{{ asset('js/helper/helper.js') }}"></script>