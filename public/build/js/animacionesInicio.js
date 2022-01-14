$(document).ready(function () {

console.log("READY");

 $( window ).scroll(function() {

    if($("video")[0].getBoundingClientRect().top < -100){

      /*   console.log("animación h2") */

        $(".section-tittle").animate({
            marginLeft: '0px'
        },500)

      /*  $(".section-tittle").hide().fadeIn(1500).css('left' ,'0'); */


    }
  /*   if($("video")[0].getBoundingClientRect().top >= -150){
        console.log("animación div")
        $("#caracteristicas").hide().fadeIn(1000);
    } */


    //console.log($("video")[0].getBoundingClientRect().top);

  });



});
