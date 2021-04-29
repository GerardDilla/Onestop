$(document).ready(function(){
    if($(window).width()==1024&&$(window).height()==1366){
        console.log('ipad pro')
        $('.first_row').removeClass('col-lg-6');
        $('.first_row').addClass('col-lg-12');
        $('.second_row').removeClass('col-lg-6');
        $('.second_row').addClass('col-lg-12');
    }
    else{
        $('.first_row').removeClass('col-lg-12');
        $('.first_row').addClass('col-lg-6');
        $('.second_row').removeClass('col-lg-12');
        $('.second_row').addClass('col-lg-6');
    }
    if($(window).width()==768&&$(window).height()==1024){
        $('.first_row').removeClass('col-md-6');
        $('.first_row').addClass('col-md-12');
        $('.second_row').removeClass('col-md-6');
        $('.second_row').addClass('col-md-12');
        // console.log('iPad')
    }
    else{
        $('.first_row').removeClass('col-md-12');
        $('.first_row').addClass('col-md-6');
        $('.second_row').removeClass('col-md-12');
        $('.second_row').addClass('col-md-6');
    }
})

$(window).resize(function(){
    // console.log($(window).width());
    if($(window).width()==1024&&$(window).height()==1366){
        $('.first_row').removeClass('col-lg-6');
        $('.first_row').addClass('col-lg-12');
        $('.second_row').removeClass('col-lg-6');
        $('.second_row').addClass('col-lg-12');
        console.log('iPad Pro')
    }
    else{
        $('.first_row').removeClass('col-lg-12');
        $('.first_row').addClass('col-lg-6');
        $('.second_row').removeClass('col-lg-12');
        $('.second_row').addClass('col-lg-6');
    }
    if($(window).width()==768&&$(window).height()==1024){
    $('.first_row').removeClass('col-md-6');
    $('.first_row').addClass('col-md-12');
    $('.second_row').removeClass('col-md-6');
    $('.second_row').addClass('col-md-12');
    // console.log('iPad')
    }
    else{
        $('.first_row').removeClass('col-md-12');
        $('.first_row').addClass('col-md-6');
        $('.second_row').removeClass('col-md-12');
        $('.second_row').addClass('col-md-6');
    }
})