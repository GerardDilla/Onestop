var playPause = anime({
    targets:'img.loading',
    loop:true,
    keyframes:[
        {rotate:'360deg'}
    ],
    translateY: {
        value:    ['160px', '0'], 
        duration: 575,
        easing:   'easeInQuad',
      },
    duration:3000,
    autoplay:false
});
$(document).ready(function(){
    gsap.from('.form-holder',{opacity:0,duration:1,y:-50});
    gsap.from('.anim1',{opacity:0,duration:1,y:-50,stagger:0.6});
    gsap.from('.anim2',{opacity:0,duration:1,y:-50,stagger:0.6});
    gsap.from('.anim3',{opacity:0,delay:.5,duration:1,y:-50,stagger:0.3});
    // playPause.play();

    var t1 = gsap.timeline();
    t1.to('ul.transition li',{duration:.2,scaleY:0,transformOrigin:"bottom left",stagger:.1,delay:.1});
    var setInterval = window.setInterval(function(){ 
        // $('.transition-effect').css('z-index','0');
        $('#loading').hide();
        $('.loading').hide();
        clearInterval(setInterval);
        // alert('1');
    }, 1000);
});
$('.leave_button').on('click',function(){
    gsap.to('.form-holder',{opacity:0,duration:1,y:-50});
    gsap.to('.anim1',{opacity:0,duration:1,y:-50,stagger:0.6});
    gsap.to('.anim2',{opacity:0,duration:1,y:-50,stagger:0.6});
    gsap.to('.anim3',{opacity:0,delay:.5,duration:1,y:-50,stagger:0.3});
    var t1 = gsap.timeline();
    t1.to('ul.transition li',{duration:.2,scaleY:1,transformOrigin:"bottom left",stagger:.1,delay:.1});
});
// $('form').submit(function(){
//     gsap.to('.form-holder',{opacity:0,duration:1,y:-50});
//     gsap.to('.anim1',{opacity:0,duration:1,y:-50,stagger:0.6});
//     gsap.to('.anim2',{opacity:0,duration:1,y:-50,stagger:0.6});
//     gsap.to('.anim3',{opacity:0,delay:.5,duration:1,y:-50,stagger:0.3});
//     var t1 = gsap.timeline();
//     t1.to('ul.transition li',{duration:.2,scaleY:1,transformOrigin:"bottom left",stagger:.1,delay:.1});
// })