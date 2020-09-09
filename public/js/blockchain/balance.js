// $.noConflict();
jQuery(document).ready(function($){

    $('.contractButton').on('click', (e)=>{

        $divToDisplay = $(e.currentTarget).attr('data-value');
        $('#' + $divToDisplay).slideToggle(500);
    });

    $('.contractButton').popover({ trigger : "hover" });
});