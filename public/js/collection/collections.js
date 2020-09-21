jQuery(document).ready(function($){

    $('.collectionTable').DataTable({
        paging: true,
    });

    // hide tables and show the needed table
    $('.collections').click((e)=>{
        const paginationNeeded = $(e.currentTarget).attr('href');

        $('.collectionsContent').hide();
        $(paginationNeeded).slideDown(100);
    })

})

// Init arrays of classes needed
const collPagin = document.getElementsByClassName('collections');
const paginArray = Array.from(collPagin);

const allDatasources = document.getElementsByClassName('collection_show');
const collectionsArray = Array.from(allDatasources);

const contents = document.getElementsByClassName('collectionsContent');
const contentsArray = Array.from(contents);


// function hide all tables except the first displayed
function showTheTable()
{
    // hide all elements
    contentsArray.forEach(element => {
        element.style.display = 'none';
    });
    
    let actualDatasource = '';
    
    // get the Datasource of current display
    collectionsArray.forEach(element => {
    
        const classes = Array.from(element.classList)
    
        if(classes.includes('show')){
            actualDatasource = element.getAttribute('data-datasource');
        }
    });
    
    let divToShow = "";
    
    // find the table to show, depending of displayed datasource
    paginArray.forEach(element => {
    
        const classes = Array.from(element.classList)
    
        if(classes.includes('current')){
    
            const hrefContent = element.getAttribute('href');
            const idToShow = hrefContent.replace('#', '');
    
            if(idToShow.includes(actualDatasource)){
                divToShow = document.getElementById(idToShow);
            }
        }
    });
    
    //show the good table
    divToShow.style.display = 'block';
}


document.addEventListener('DOMContentLoaded', showTheTable);


// const navDatasources = document.getElementsByClassName('datasources');


// function collecionsToShow(){

//     const allCollectionsShow = document.getElementsByClassName('collection_show');

//     const allCollectionsArray = Array.from(allCollectionsShow);
//     const navDatasourcesArray = Array.from(navDatasources);

//     let datasourceActive = '';

//     navDatasourcesArray.forEach(element => {
//         const classes = element.classList;

//         classes.forEach(elemClass => {
//             if(elemClass == 'active'){
//                 datasourceActive = element.innerHTML;
//             }
//         });
//     });

//     allCollectionsArray.forEach(element => {

//         if(element.classList.includes(' ' + datasourceActive + ' ')){
//             element.style.display = 'block';
//         }else{
//             element.style.display = 'none';
//         }
//     });
// }

// // document.addEventListener('DOMContentLoaded', collecionsToShow);
// // navDatasources.addEventListener('click', collecionsToShow);


