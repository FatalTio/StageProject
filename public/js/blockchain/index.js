jQuery(document).ready(function($){

    $('.close').popover({ trigger : "hover" });
    $('#infoIcon').popover({ trigger : "hover" })

    $('#selectBlockchain').change(()=>{

        $blockchain = $('#selectBlockchain option:selected').val()

        $('#selectNet').css('visibility', 'hidden');

        if($blockchain != $('#defaultBlockchainOption').val()){

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
    
                    $msg = '';
    
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
                    $('#jsonAlert').slideDown(500).html($msg);
                }
            })

        }
    })


    $('#selectFunction').change(()=>{

        $('.alertFunctions').slideUp(500);

        $selectedOption = $('#selectFunction option:selected').attr('data-alert');
        $('#' + $selectedOption).slideDown(500);
    })

});
