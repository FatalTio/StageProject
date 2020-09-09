// $.noConflict();
jQuery(document).ready(function($){

    $('.buttonShow').mouseover(display = (e)=>{

        $divToShow = $(e.currentTarget).attr('data-value');

        if($divToShow != $('.buttonShow').attr('data-open') ){

            $('.buttonShow').attr('data-open', '');
            $('.alertFunctions').slideUp(600);
        }

        $('#' + $divToShow).slideDown(600);
        $('.buttonShow').attr('data-open', $divToShow);

    })
});