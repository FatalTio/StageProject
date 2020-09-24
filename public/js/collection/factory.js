jQuery(document).ready(function($){

    if(refMap != 'null' && content != 'null'){


    }

    const references = refMap.replace('[', '').replace(']', '');

    const refColumns = references.split(',');

    let columnsArray = [];

    refColumns.forEach(element => {
        str = element.replace(/^"(.*)"$/, '$1');
        columnsArray.push({ searchable: true, title: str, data: str })
    });

    const entityFactory = entity.replace(/^"(.*)"$/, '$1').replace('CsCannon', '').replace(/\\/g, '');
    const host = window.location.host;

    const myUrl = 'http://' + host + '/factoryJson/' + entityFactory;


    $('#factoryTable').DataTable({
        // processing: true,
        // serverSide: true,
        ajax: {
            url: myUrl,
            dataSrc: 'data',
        },
        columns: columnsArray,
        paging: true,
        searching: {'regex': true},
        lengthMenu: [ [10,25,50,100,-1], [10,25,50,100, 'All'] ],
        pageLength: 10,
    })

})