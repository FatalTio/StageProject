// $.noConflict();
jQuery(document).ready(function($){
    
    $('#selectFunction').change(()=>{

        $('.alertFunctions').slideUp(500);

        $selectedOption = $('#selectFunction option:selected').attr('data-alert');
        $('#' + $selectedOption).slideDown(500);
    })

    $('.close').popover({ trigger : "hover" });

});