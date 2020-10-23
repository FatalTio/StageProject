jQuery(document).ready(function($){

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
            console.log('false');
            setTimeout(function(e){
                $('#greyBgc, #guideDiv').fadeIn(500);
            },1000);
        }else{
            console.log('true');
            $('#greyBgc, #guideDiv').fadeOut(500);
        }
    }


    $divsToShow = $('#guideDiv, #greyBgc');
    $closeGuide = $('#closeGuide');

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
