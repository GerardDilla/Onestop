// var playPause = anime({
//     targets:'img.loading',
//     loop:true,
//     keyframes:[
//         {rotate:'360deg'}
//     ],
//     translateY: {
//         value:    ['160px', '0'], 
//         duration: 575,
//         easing:   'easeInQuad',
//       },
//     duration:3000,
//     autoplay:false
// });
// $('#amazing path').css('display','none')
var playPause2 = anime({
    targets: '#amazing path',
    strokeDashoffset: [anime.setDashoffset, 0],
    easing: 'easeInOutSine',
    duration: 1000,
    delay: function(el, i) { return i * 200 },
    direction: 'reverse',
    // loop: false,
    autoplay:true,
    begin: function(anim) {
        var f = window.setInterval(function(){
            $('.transition-effect').css('z-index','0');
            clearInterval(f);
            $('.content input.input-material').children(':first').focus();
            $('.content input.input-material').children(':first').addClass('active');
            console.log($('.content input.input-material').children(':first'));
        },1000);
        
      }
  });
  $(window).on('beforeunload',function(){
    // console.log('wazzup');
    // var playPause = anime({
    // targets: '#amazing path',
    // strokeDashoffset: [anime.setDashoffset, 0],
    // easing: 'easeInOutSine',
    // duration: 1000,
    // delay: function(el, i) { return i * 200 },
    // direction: 'normal',
    // // loop: false,
    // autoplay:true,
        
    // });
    // playPause.play();
    // gsap.to('.form-holder',{opacity:0,duration:1,y:-50});
    // gsap.to('.anim1',{opacity:0,duration:1,y:-50,stagger:0.6});
    // gsap.to('.anim2',{opacity:0,duration:1,y:-50,stagger:0.6});
    // gsap.to('.anim3',{opacity:0,delay:.5,duration:1,y:-50,stagger:0.3});
    // var t1 = gsap.timeline();
    // t1.to('ul.transition li',{duration:.2,scaleY:1,transformOrigin:"bottom left",stagger:.1,delay:.1});
    // $('.transition-effect').css('z-index','1001');
    // $('#amazing').css('z-index','1002');
});
//   playPause.play();
//   alert('hello');
$(document).ready(function(){
    gsap.from('.form-holder',{opacity:0,duration:1,y:-50});
    gsap.from('.anim1',{opacity:0,duration:1,y:-50,stagger:0.6});
    gsap.from('.anim2',{opacity:0,duration:1,y:-50,stagger:0.6});
    gsap.from('.anim3',{opacity:0,delay:.5,duration:1,y:-50,stagger:0.3});
    // playPause.play();

    var t1 = gsap.timeline();
    // t1.to('ul.transition li',{duration:.2,scaleY:1,transformOrigin:"bottom left",stagger:.1,delay:.1});
    t1.to('ul.transition li',{duration:.2,scaleY:0,transformOrigin:"bottom left",stagger:.1,delay:.1});
    // var setInterval = window.setInterval(function(){ 
    //     $('#loading').hide();
    //     $('.loading').hide();
    //     clearInterval(setInterval);
    //     alert('1');
    // }, 2000);
});
// $('.leave_button').on('click',function(){
//     var setInterval2 = window.setInterval(function(){ 
        
//         // alert('1');
//         clearInterval(setInterval2);
//         // playPause();
//     }, 100);
//     gsap.to('.form-holder',{opacity:0,duration:1,y:-50});
//     gsap.to('.anim1',{opacity:0,duration:1,y:-50,stagger:0.6});
//     gsap.to('.anim2',{opacity:0,duration:1,y:-50,stagger:0.6});
//     gsap.to('.anim3',{opacity:0,delay:.5,duration:1,y:-50,stagger:0.3});
//     var t1 = gsap.timeline();
//     t1.to('ul.transition li',{duration:.2,scaleY:1,transformOrigin:"bottom left",stagger:.1,delay:.1});
// });
// $('form').submit(function(){
//     gsap.to('.form-holder',{opacity:0,duration:1,y:-50});
//     gsap.to('.anim1',{opacity:0,duration:1,y:-50,stagger:0.6});
//     gsap.to('.anim2',{opacity:0,duration:1,y:-50,stagger:0.6});
//     gsap.to('.anim3',{opacity:0,delay:.5,duration:1,y:-50,stagger:0.3});
//     var t1 = gsap.timeline();
//     t1.to('ul.transition li',{duration:.2,scaleY:1,transformOrigin:"bottom left",stagger:.1,delay:.1});
// })