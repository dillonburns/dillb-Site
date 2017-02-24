$(document).ready(function (e) {
    $("#center_blurb").draggable();
});

var animTime = 300;

$(".about").mouseenter(function (e) {
    $("#center_blurb").fadeIn(animTime);
});

$("#center_blurb .close").click(function(e){
    $("#center_blurb").fadeOut(animTime);
})
