$(document).ready(function () {

console.log("READY");

 $( window ).scroll(function() {

    if($("video")[0].getBoundingClientRect().top < -100){

      /*   console.log("animación h2") */

        $(".section-tittle").animate({
            marginLeft: '0px'
        },500)
        $("#caracteristicas").addClass("animate__animated animate__zoomIn animate__slow");

    }

  });

});
