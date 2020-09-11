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

                if(status != 200){
                    'Something is worng with this request !'
                }
    
                $datasource = $('#' + index);
    
                $datasource.append(JSON.stringify(content, undefined, 2))
            })
        }
    })
});