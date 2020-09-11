jQuery(document).ready(function($){

    $.ajax({

        url: urlToQuery,
        type: 'get',
        beforeSend: function(){

            $('.spinner-border').show();
        },
        success: function(response){

            $('.spinner-border').hide();

            $.each(response, function(index, content){

                $datasource = $('#' + index);
                $datasource.append(JSON.stringify(content, undefined, 2))
            })
        },
        error: function (jqXHR, exception){
            if(jqXHR.status == 500){
                alert('Internal error : ' + jqXHR.responseText)
            }else{
                alert('Unexpected error.')
            }
        }

    })

});