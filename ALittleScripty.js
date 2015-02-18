/*jslint browser: true*/
/*global $, jQuery, alert*/
$(document).ready(function () {
  $('.description').hover(function () {
    $(this).find('.pop-up').slideDown(250);
  }, function () {
    $(this).find('.pop-up').slideUp(250);
  }
  );
  $(HTMLBodyElement).scroll(function () {
    if ($(this).scrollTop() < 50) {
      $('#pic').stop().animate({
        opacity: 1
      }, 200);
    }
    else if ($(this).scrollTop() < 100) {
      $('#pic').stop().animate({
        opacity: 0.8
      }, 50);
    }
    else if ($(this).scrollTop() < 150) {
      $('#pic').stop().animate({
        opacity: 0.7
      }, 50);
    }
    else if ($(this).scrollTop() < 200) {
      $('#pic').stop().animate({
        opacity: 0.5
      }, 50);
    }
    else if ($(this).scrollTop() < 250) {
      $('#pic').stop().animate({
        opacity: 0.3
      }, 50);
    }
    else {
      $('#pic').stop().animate({
        opacity: 0
      }, 50);
    }
  });
    
    $('.img-over').hover(function () {
        $(this).fadeTo(500, 1, function(){
            $('.img-desc').animate({
                top: "+=40",
                opacity: "1"
            },300);
        });
    }, function(){
        $(this).fadeTo(0, 0, function(){
            $('.img-desc').animate({
                top: "-=40",
                opacity: "0"
            }, 100);
        });
    }
    );
});
