jQuery(document).ready(function(){
    jQuery('.navbar-toggler').click(function(){
        jQuery('.navbar-collapse').slideToggle(300);
    });
    
    smallScreenMenu();
    let temp;
    function resizeEnd(){
        smallScreenMenu();
    }

    jQuery(window).resize(function(){
        clearTimeout(temp);
        temp = setTimeout(resizeEnd, 100);
        resetMenu();
    });
});


const subMenus = jQuery('.sub-menu');
const menuLinks = jQuery('.menu-link');

function smallScreenMenu(){
    if(jQuery(window).innerWidth() <= 992){
        menuLinks.each(function(item){
            jQuery(this).click(function(){
                jQuery(this).next().slideToggle();
            });
        });
    } else {
        menuLinks.each(function(item){
            jQuery(this).off('click');
        });
    }
}

function resetMenu(){
    if(jQuery(window).innerWidth() > 992){
        subMenus.each(function(item){
            jQuery(this).css('display', 'none');
        });
    }
}