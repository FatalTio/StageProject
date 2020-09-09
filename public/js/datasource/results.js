jQuery(document).ready(function($){
    
    $.get(url, function(datas, status){

        $.each(datas, function(index, content){

            $datasource = $('#' + index);
            $datasource.html(index)
            $datasource.append('<br>')

            $.each(content, function (name, data){
                
                if(!data.isArray){

                    $datasource.append(name)
                    $datasource.append('<br>')
                    $datasource.append('     ' + data)
                    $datasource.append('<br>')

                }else{

                    $.each(data, function(dataName, dataContent){



                    })
                }

            })
        })

    })
});