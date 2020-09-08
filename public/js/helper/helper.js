const helperDisplay = document.getElementById('helperIcon');
const closeMenu = document.getElementById('closeMenu');
let open = false;

helperDisplay.addEventListener('click', () => {
    openOrClose();
})

closeMenu.addEventListener('click', ()=>{
    openOrClose();
})

const openOrClose = () => {
    
    const translate = (open == false) ? 200 : -200;
    open = (translate == 200) ? true : false;

    anime({
        targets: '#helperContent',
        translateX: translate,
        duration: 800,
        easing: 'easeOutQuad'
    })
}


$.noConflict();
jQuery(document).ready(function($){

    $('#cscDropDown').on('click', ()=>{
        $('#cscMenu').slideToggle(500);
    })

});