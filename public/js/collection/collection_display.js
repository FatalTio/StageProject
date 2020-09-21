jQuery(document).ready(function($){

    document.addEventListener('DOMContentLoaded', getDatas(urlToCall));


    function getDatas(myUrl){

        $.ajax({

            url: myUrl,
            type : 'get',
            beforeSend: function(){
                $('.spinner-grow').show();
            },
            success: function(response){
    
                $('.spinner-grow').hide();
    
                let countDatasources = 0;

                $.each(response, function(datasource, content){
        
                    let active = '';
                    let selected = '';
        
                    if(countDatasources == 0){
                        active = 'active';
                        selected = 'true';
                    }else{
                        active = '';
                        selected = 'false';
                    }
        
                    let datasources = '<li class="nav-item" id='+ datasource 
                    +'><a class="nav-link datasources'+ active 
                    +' id="pills-'+ datasource +'-tab" data-toggle="pill" href="#pills-'+datasource
                    +'" role="tab" aria-controls="pills-'+datasource
                    +'" aria-selected='+ selected +'>'+
                     datasource 
                     +'</a></li>';
                    
                    $('#pills-tab').append(datasources);
        
                    let tableCreate = '<table id="'+ datasource + '_table" class="datasourceTable table table-striped table-dark"><thead><tr id="'+ datasource +'Scope"></tr></thead></table>';
        
                    $('#datasTable').html(tableCreate)
        
                    countDatasources ++;
        
                    let datasToDisplay = [];

                    $.each(content, function(name, datas){
        
                        if($.type(datas) == 'object'){
                            $.each(datas, function(info, data){

                                if($.type(data) == 'string'){
        
                                    $('#datasTable').prepend('<h5 class="text-warning">'+ data +'</h5>');
                                }else{

                                    $.each(data, function(string, metaDatas){
                                        metaDatas.name = info;
                                        datasToDisplay.push(metaDatas);
                                    })
                                }
                            })
                        }
                    })
                    initDataTable(datasToDisplay);
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


    function initDataTable(arrayToDisplay){

        let columnDatas = [];

        $.each(arrayToDisplay[0], function(name){
            columnDatas.push({ title: name, data: name});
        })
        
        const myTables = $('.datasourceTable');

        $.each(myTables, function(index, table){

            $('#' + table.id).DataTable({

                data: arrayToDisplay,
                columns: columnDatas.reverse()
            }) 
        })

    }


})