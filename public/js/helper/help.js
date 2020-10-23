jQuery(document).ready(function($){

    $divsToShow = $('#guideDiv, #greyBgc');
    $closeGuide = $('#closeGuide');

    function getCookiesArray(){

        let cookies = [];

        if(document.cookie && document.cookie != ''){
            const split = document.cookie.split(';');
            for(i=0; i<split.length; i++){

                const newSplit = split[i].split('=');
                newSplit[0] = newSplit[0].replace(/^ /, '')
                cookies[newSplit[0]] = newSplit[1];
            }
        }
        return cookies;
    }

    function checkIfShowGuide(array){

        array.forEach(function (index, value){
            if(index === 'no_message'){
                return value;
            }
        })
        return null;
    }

    function showDiv(bool){
        if(bool === false){
            $divsToShow.fadeIn(500);
        }else{
            $divsToShow.fadeOut(500);
        }
    }


    $closeGuide.mouseover(()=>{
        $closeGuide.addClass('rotateCross');
    })

    $closeGuide.mouseleave(()=>{
        $closeGuide.removeClass('rotateCross');
    })

    $closeGuide.on('click', () => {
        $divsToShow.fadeOut(500);
    })


    $('#acceptButton').on('click', () => {
        if($('#dontShow').is(':checked')){

            document.cookie = 'no_message=true';
            $divsToShow.fadeOut(500);
            showDiv(true);
        }else{
            $divsToShow.fadeOut(500);
        }
    })


    $('#helperIcon').on('click', () => {
        document.cookie = 'no_message=false';
        showDiv(false);
    })


    document.addEventListener('DOMContentLoaded', ()=>{

        setInterval(function(){
            const boolVal = checkIfShowGuide(getCookiesArray()) === "true";
            showDiv(boolVal);
        }, 1000);
    })

});
