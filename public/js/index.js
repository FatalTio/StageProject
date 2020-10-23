jQuery(document).ready(function($){

    setTimeout(function(e){
        $('#greyBgc, #guideDiv').fadeIn(500);
    },1000);

    $('.buttonShow').mouseover(display = (e)=>{

        $divToShow = $(e.currentTarget).attr('data-value');

        if($divToShow != $('.buttonShow').attr('data-open') ){

            $('.buttonShow').attr('data-open', '');
            $('.alertFunctions').slideUp(600);
        }

        $('#' + $divToShow).slideDown(600);
        $('.buttonShow').attr('data-open', $divToShow);

    })

    $('#closeGuide').mouseover(()=>{
        $('#closeGuide').addClass('rotateCross');
    })

    $('#closeGuide').mouseleave(()=>{
        $('#closeGuide').removeClass('rotateCross');
    })

    $('#closeGuide').on('click', () => {
        $('#guideDiv, #greyBgc').fadeOut(500);
    })

    $('#acceptButton').on('click', () => {
        if($('#dontShow').is(':checked')){

            $.ajax({
                url: '/dontShow/true',
                type: 'get',
                success: function(response){
                    $('#guideDiv, #greyBgc').fadeOut(500);
                    console.log(response);
                },
            })
        }else{
            $('#guideDiv, #greyBgc').fadeOut(500);
        }
    })

});
