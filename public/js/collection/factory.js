jQuery(document).ready(function($){

    if(refMap != 'null' && content != 'null'){


    }

    const references = refMap.replace('[', '').replace(']', '');

    const refColumns = references.split(',');

    let columnsArray = [];

    refColumns.forEach(element => {
        str = element.replace(/^"(.*)"$/, '$1');
        if(str != 'creationTimestamp'){
            columnsArray.push({ title: str, data: str })
        }
    });


    // const entityFactory = entity.replace(/^"(.*)"$/, '$1').replace('CsCannon', '').replace(/\\/g, '');
    // const host = window.location.host;

    // const myUrl = 'http://' + host + '/factoryJson/' + entityFactory;

    const loc = window.location;
    // loc.protocol + loc.host + 
    const myUrl = '/dbToJson/' + table;

    console.log(myUrl);

    console.log(columnsArray);

    $('#factoryTable').DataTable({
        // processing: true,
        // serverSide: true,
        columns: columnsArray,
        ajax: myUrl,
        // ajax: {
            // url: '/dbToJson/' + table,
            // dataSrc: 'data',
        // },
        
        // paging: true,
        // searching: {'regex': true},
        // lengthMenu: [ [10,25,50,100,-1], [10,25,50,100, 'All'] ],
        // pageLength: 10,
    })

})