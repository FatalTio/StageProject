jQuery(document).ready(function($){
    
    $upIcon = "M7.247 4.86l-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z";
    $downIcon = "M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z";

    $('.col-icon').click((e)=>{

        $(e.currentTarget).toggleClass('bi-caret-up-fill').toggleClass('bi-caret-down-fill')

        $(e.currentTarget).children().attr('d', function (index, attr){
            return attr == $downIcon ? $upIcon : $downIcon;
        });

        $rowToSort = $(e.currentTarget).parent().attr('id');
        $myString = $rowToSort.replace('_col', '');

        const classArray = document.getElementsByClassName($myString);

        const myArray = Array.from(classArray);

        const htmlContent = [];

        myArray.forEach(element => {
            
            const myObj = { 
                html : element.innerText,
                tbody : element.getAttribute('data-tbody'),
                tr : element.getAttribute('data-tr'),
                class : String(element.classList),
                scope : (element.getAttribute('scope')) ? element.getAttribute('scope') : ''
            };

            htmlContent.push(myObj);
        });


        htmlContent.sort(function (a, b){

            if(isNaN(a.html) && isNaN(b.html)){
                return (a.html > b.html) ? 1 : -1;
            }
            return a.html - b.html;
        })

        const futureHtml = [];

        for(i=0; i<htmlContent.length; i++){
            
            const trToUp = document.getElementById(htmlContent[i].tr);
            const newHtml = trToUp.innerHTML;
            
            futureHtml.push(newHtml);
            trToUp.innerHTML = "";
        }

        const tableId = htmlContent[0].tbody;

        for(i=0; i<futureHtml.length; i++){

            const myTable = document.getElementById('table_' + tableId);
            const htmlToInsert = '<tbody><tr id="'+ htmlContent[i].tbody +
                '">'+ futureHtml[i]
                +'</tr></tbody>';

            document.getElementsByClassName(htmlContent[i].tbody)[i].innerHTML = htmlToInsert;
        }

        // htmlContent.sort();

        

        // console.log(myArray);

        // $allDatas = $.each($('.' + $myString), function() {
        //     return $(this).innerHTML;
        // }).get().join();

        // $.each($allDatas, function (index, data){
        //     console.log(data);
        // })

        // console.log($allDatas);
    })

})


