// $.noConflict();
jQuery(document).ready(function($){
    
    $('#selectFunction').change(()=>{

        $('.alertFunctions').slideUp(500);

        $selectedOption = $('#selectFunction option:selected').attr('data-alert');
        $('#' + $selectedOption).slideDown(500);
    })

    $('.close').popover({ trigger : "hover" });


    $('#selectBlockchain').change(()=>{

        $('#selectNet').css('visibility', 'hidden');

        $blockchain = $('#selectBlockchain option:selected').val()

        $.ajax({

            url: '/getNets/' + $blockchain,
            type : 'get',
            beforeSend: function(){

                $('.spinner-grow').show();
            },
            success: function(response){

                $('.spinner-grow').hide();

                $('#selectNet').html('<option selected="selected">Select a '+ $blockchain +' net</option>')
                $('#selectNet').css('visibility', 'visible');
    
                $.each(response, function(index, content){

                    $newContent = content.name.replace('_', ' ');
                    $('#selectNet').append('<option>' + $newContent + '</option>')

                })
            },
            error: function (jqXHR, exception){

                let msg = '';

                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                $('#post').html(msg);
            }
        })
    })


    $('#infoIcon').popover({ trigger : "hover" })


});
