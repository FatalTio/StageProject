jQuery(document).ready(function($){

    if(refMap != 'null' && content != 'null'){


    }

    const references = refMap.replace('[', '').replace(']', '')

    let columns = [];



    $('#factoryTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "/factoryJson/" + entity
    })


})