jQuery(document).ready(function($){
    
    $.get(url, function(datas, status){

        $.each(datas, function(index, content){

            $datasourceName = index;
            $('#'+$datasourceName).html(index)
            $('#'+$datasourceName).append('<br>')

            $.each(content, function (name, data){
                console.log(name);
                
                if(!data.isArray){
                    $('#'+$datasourceName).append(name)
                    $('#'+$datasourceName).append('<br>')
                    $('#'+$datasourceName).append('     ' + data)
                    $('#'+$datasourceName).append('<br>')
                }else{

                    $.each(data, function(dataName, dataContent){

                        

                    })

                }
            })
        })

    })

});