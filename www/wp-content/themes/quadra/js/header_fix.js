jQuery(document).ready(function($){

  var header_height = 140;
  if($('html').hasClass('mobile')){
    header_height = 60;
  }

  var header_message_height = header_height;
  if($('#header_message').length){
    header_message_height = $('#header_message').innerHeight();
    header_message_height = header_message_height + header_height;
  }

  if($(window).scrollTop() > header_message_height) {
    $("#header").addClass("active");
  }

  $(window).scroll(function () {
    if($(this).scrollTop() > header_message_height) {
      $("#header").addClass("active");
    } else {
      if( !$('body').hasClass('header_on_hover') ){
         $("#header").removeClass("active");
      }
    };
  });


});