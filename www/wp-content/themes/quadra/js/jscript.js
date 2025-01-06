jQuery(document).ready(function($){

  var $window = $(window);


  $("a").bind("focus",function(){if(this.blur)this.blur();});
  $("a.target_blank").attr("target","_blank");


  // カレントメニューのボーダー
  var currentMenu = $("#global_menu > ul > .current-menu-item");
  if (currentMenu[0]) {
    $("#global_menu_border").css({
      "width": currentMenu.width(),
      "left": currentMenu.position().left,
      "opacity": 1
    });
  }

  $("#global_menu > ul > li").hover(

    function(){
      $("#global_menu_border").css({
        "width": $(this).width(), "left": $(this).position().left, "opacity": 1
      });
    },

    function(){
      $('.megamenu').on({
        'mouseenter':function(){
          $("#global_menu_border").css({
            "width": $(".active_megamenu_button").width(),
            "left": $(".active_megamenu_button").position().left,
            "opacity": 1
          });
        },
        'mouseleave':function(){
          if (currentMenu[0]) {
            $("#global_menu_border").css({
              "width": currentMenu.width(),
              "left": currentMenu.position().left
            });
          } else {
            $("#global_menu_border").css('opacity',0);
          }
        }
      });
      if (currentMenu[0]) {
        $("#global_menu_border").css({
          "width": currentMenu.width(),
          "left": currentMenu.position().left
        });
      } else {
        $("#global_menu_border").css('opacity',0);
      }
    }
    
  ); // END .hover

  // クリック式のアコーディオン
  $('.accordion_type1').on('click', function() {

    var acc_height = $(this).find('.desc').innerHeight();
    if($(this).hasClass('active')){
      $(this).find('.content').css('height', '').removeClass('active');
      $(this).removeClass('active');
    }else{
      $(this).find('.content').css('height', acc_height).addClass('active');
      $(this).addClass('active');
    }

  });

  //ホバー式のアコーディオン
  $('.accordion_type2').on({
      'mouseenter':function(){ 
        let height = $(this).find('.desc').innerHeight();
        $(this).find('.content').css('height', height);
      },
      'mouseleave':function(){
        $(this).find('.content').css('height', '');
      }
  });

  // 記事内タブ
  $('.tcd_tab > .tab_labels > .tab_label').on('click',function(){
    var tab_index = $('.tab_label').index(this);
    $(this).addClass('is-active').siblings('.tab_label').removeClass('is-active');
    $(this).closest('.tab_labels').next('.tab_contents').find('.tab_content').removeClass('is-show');
    $('.tab_content').eq(tab_index).addClass('is-show');
  });


  // mega menu -------------------------------------------------

  // mega menu A animation
  $(document).on({mouseenter : function(){
    $(this).parent().siblings().removeClass('active')
    $(this).parent().addClass('active');
    var $content_id = "." + $(this).attr('data-cat-id');
    $(".megamenu_b .post_list").hide();
    $($content_id).show();
    return false;
  }}, '.megamenu_b .category_list a');

  // mega menu basic animation
  $('[data-megamenu]').each(function() {

    var mega_menu_button = $(this);
    var sub_menu_wrap =  "#" + $(this).data("megamenu");
    var hide_sub_menu_timer;
    var hide_sub_menu_interval = function() {
      if (hide_sub_menu_timer) {
        clearInterval(hide_sub_menu_timer);
        hide_sub_menu_timer = null;
      }
      hide_sub_menu_timer = setInterval(function() {
        if (!$(mega_menu_button).is(':hover') && !$(sub_menu_wrap).is(':hover')) {
          $(sub_menu_wrap).stop().css('z-index','100').removeClass('active_mega_menu');
          clearInterval(hide_sub_menu_timer);
          hide_sub_menu_timer = null;
        }
      }, 20);
    };

    mega_menu_button.hover(
     function(){
       if (hide_sub_menu_timer) {
         clearInterval(hide_sub_menu_timer);
         hide_sub_menu_timer = null;
       }
       if ($('html').hasClass('pc')) {
         $(this).parent().addClass('active_megamenu_button');
         $(this).parent().find("ul").addClass('megamenu_child_menu');
         $(sub_menu_wrap).stop().css('z-index','200').addClass('active_mega_menu');
       }
     },
     function(){
       if ($('html').hasClass('pc')) {
         $(this).parent().removeClass('active_megamenu_button');
         $(this).parent().find("ul").removeClass('megamenu_child_menu');
         hide_sub_menu_interval();
       }
     }
    );

    $(sub_menu_wrap).hover(
      function(){
        $(mega_menu_button).parent().addClass('active_megamenu_button');
      },
      function(){
        $(mega_menu_button).parent().removeClass('active_megamenu_button');
      }
    );


    $('#header').on('mouseout', sub_menu_wrap, function(){
     if ($('html').hasClass('pc')) {
       hide_sub_menu_interval();
     }
    });

  }); // end mega menu


  //return top button for PC
  $('#return_top2 a').click(function() {
    var myHref= $(this).attr("href");
    var myPos = $(myHref).offset().top;
    $("html,body").animate({scrollTop : myPos}, 1000, 'easeOutExpo');
    return false;
  });


  //return top button for mobile
  var return_top_button = $('#return_top');
  $('a',return_top_button).click(function() {
    var myHref= $(this).attr("href");
    var myPos = $(myHref).offset().top;
    $("html,body").animate({scrollTop : myPos}, 1000, 'easeOutExpo');
    return false;
  });
  return_top_button.removeClass('active');
  $window.scroll(function () {
    if ($(this).scrollTop() > 100) {
      return_top_button.addClass('active');
    } else {
      return_top_button.removeClass('active');
    }
  });


  //fixed footer content
  var fixedFooter = $('#fixed_footer_content');
  fixedFooter.removeClass('active');
  $window.scroll(function () {
    if ($(this).scrollTop() > 330) {
      fixedFooter.addClass('active');
    } else {
      fixedFooter.removeClass('active');
    }
  });
  $('#fixed_footer_content .close').click(function() {
    $("#fixed_footer_content").hide();
    return false;
  });


  // comment button
  $("#comment_tab li").click(function() {
    $("#comment_tab li").removeClass('active');
    $(this).addClass("active");
    $("#comments .tab_contents").hide();
    var selected_tab = $(this).find("a").attr("href");
    $(selected_tab).fadeIn();
    return false;
  });


  //custom drop menu widget
  $(".tcdw_custom_drop_menu li:has(ul)").addClass('parent_menu');
  $(".tcdw_custom_drop_menu li").hover(function(){
     $(">ul:not(:animated)",this).slideDown("fast");
     $(this).addClass("active");
  }, function(){
     $(">ul",this).slideUp("fast");
     $(this).removeClass("active");
  });


  // design select box widget
  $(".design_select_box select").on("click" , function() {
    $(this).closest('.design_select_box').toggleClass("open");
  });
  $(document).mouseup(function (e){
    var container = $(".design_select_box");
    if (container.has(e.target).length === 0) {
      container.removeClass("open");
    }
  });

  // tab post list widget
  $('.widget_tab_post_list_button').on('click', 'a', function(e){
    e.preventDefault();
    e.stopPropagation();
    $(this).addClass('active');
    $(this).siblings().removeClass('active');
    
    var $tab_list_class = "." + $(this).attr('data-tab');
    $(this).closest('.tab_post_list_widget').find(".widget_tab_post_list").removeClass('active');
    $(this).closest('.tab_post_list_widget').find($tab_list_class).addClass('active');

    return false;
  });


  //archive list widget
  if ($('.p-dropdown').length) {
    $('.p-dropdown__title').click(function() {
      $(this).toggleClass('is-active');
      $('+ .p-dropdown__list:not(:animated)', this).slideToggle();
    });
  }


  //category widget
  $(".tcd_category_list li:has(ul)").addClass('parent_menu');
  $(".tcd_category_list li.parent_menu > a").parent().prepend("<span class='child_menu_button'></span>");
  $(".tcd_category_list li .child_menu_button").on('click',function() {
     if($(this).parent().hasClass("open")) {
       $(this).parent().removeClass("active");
       $(this).parent().removeClass("open");
       $(this).parent().find('>ul:not(:animated)').slideUp("fast");
       return false;
     } else {
       $(this).parent().addClass("active");
       $(this).parent().addClass("open");
       $(this).parent().find('>ul:not(:animated)').slideDown("fast");
       return false;
     };
  });


  //search widget
  $('.widget_search #searchsubmit').wrap('<div class="submit_button"></div>');
  $('.google_search #searchsubmit').wrap('<div class="submit_button"></div>');


  // active header
  if (!$('body').hasClass('active_header')) {
    $("#global_menu li.menu-item-has-children").hover(function(){
      $('#header').addClass('active_mega_menu');
    }, function(){
      $('#header').removeClass('active_mega_menu');
    });
  };
  

  // global menu
  $("#global_menu li:not(.megamenu_parent)").hover(function(){
    $(">ul:not(:animated)",this).slideDown("fast");
    $(this).addClass("active");
  }, function(){
    $(">ul",this).slideUp("fast");
    $(this).removeClass("active");
  });

  // quick tag - underline ------------------------------------------
  if ($('.q_underline').length) {
    var gradient_prefix = null;

    $('.q_underline').each(function(){
      var bbc = $(this).css('borderBottomColor');
      if (jQuery.inArray(bbc, ['transparent', 'rgba(0, 0, 0, 0)']) == -1) {
        if (gradient_prefix === null) {
          gradient_prefix = '';
          var ua = navigator.userAgent.toLowerCase();
          if (/webkit/.test(ua)) {
            gradient_prefix = '-webkit-';
          } else if (/firefox/.test(ua)) {
            gradient_prefix = '-moz-';
          } else {
            gradient_prefix = '';
          }
        }
        $(this).css('borderBottomColor', 'transparent');
        if (gradient_prefix) {
          $(this).css('backgroundImage', gradient_prefix+'linear-gradient(left, transparent 50%, '+bbc+ ' 50%)');
        } else {
          $(this).css('backgroundImage', 'linear-gradient(to right, transparent 50%, '+bbc+ ' 50%)');
        }
      }
    });

    $window.on('scroll.q_underline', function(){
      $('.q_underline:not(.is-active)').each(function(){
        var top = $(this).offset().top;
        if ($window.scrollTop() > top - window.innerHeight) {
          $(this).addClass('is-active');
        }
      });
      if (!$('.q_underline:not(.is-active)').length) {
        $window.off('scroll.q_underline');
      }
    });
  }

// responsive ------------------------------------------------------------------------
var mql = window.matchMedia('screen and (min-width: 1201px)');
function checkBreakPoint(mql) {

 if(mql.matches){ //PC

   $("html").removeClass("mobile");
   $("html").addClass("pc");

   $('a.megamenu_button').parent().addClass('megamenu_parent');

 } else { //smart phone

   $("html").removeClass("pc");
   $("html").addClass("mobile");

   // perfect scroll
   if ($('#drawer_menu').length) {
     if(! $(body).hasClass('mobile_device') ) {
       new SimpleBar($('#drawer_menu')[0]);
     };
   };
   if ($('.data_table.type2').length) {
     $('.data_table.type2').each(function(){
       if(! $(body).hasClass('mobile_device') ) {
         new SimpleBar($(this)[0]);
       }
     });
   }

   // drawer menu
   $("#mobile_menu .child_menu_button").remove();
   $('#mobile_menu li > ul').parent().prepend("<span class='child_menu_button'><span class='icon'></span></span>");
   $("#mobile_menu .child_menu_button").on('click',function() {
     if($(this).parent().hasClass("open")) {
       $(this).parent().removeClass("open");
       $(this).parent().find('>ul:not(:animated)').slideUp("fast");
       return false;
     } else {
       $(this).parent().addClass("open");
       $(this).parent().find('>ul:not(:animated)').slideDown("fast");
       return false;
     };
   });

   // drawer menu button
   var menu_button = $('#global_menu_button');
   menu_button.off();
   menu_button.removeAttr('style');
   menu_button.toggleClass("active",false);

  // open drawer menu
   menu_button.on('click', function(e) {

      e.preventDefault();
      e.stopPropagation();
      $('html').toggleClass('open_menu');

      $('#container').one('click', function(e){
        if($('html').hasClass('open_menu')){
          $('html').removeClass('open_menu');
          return false;
        };
      });

   });

  // animation scroll link
  $('#mobile_menu a[href^="#"]').click(function() {
    var myHref= $(this).attr("href");
    if($("html").hasClass("mobile") && $("body").hasClass("use_mobile_header_fix")) {
      var myPos = $(myHref).offset().top - 60;
    } else if($("html").hasClass("mobile")) {
      var myPos = $(myHref).offset().top;
    } else if($("html").hasClass("pc") && $("body").hasClass("use_header_fix")) {
      if($("html").hasClass("pc") && $("body").hasClass("menu_type2 hide_header_logo hide_global_menu")) {
        var myPos = $(myHref).offset().top;
      } else {
        var myPos = $(myHref).offset().top - 70;
      }
    } else {
      var myPos = $(myHref).offset().top;
    }
    $("html,body").animate({scrollTop : myPos}, 1000, 'easeOutExpo');
    if($('html').hasClass('open_menu')){
      $('html').removeClass('open_menu');
      return false;
    };
    return false;
  });

 };
};
mql.addListener(checkBreakPoint);
checkBreakPoint(mql);


  //search widget
  $('.widget_search #searchsubmit').wrap('<div class="submit_button"></div>');
  $('.google_search #searchsubmit').wrap('<div class="submit_button"></div>');

  //calendar widget
  /*$('.wp-calendar-table td').each(function () {
    if ( $(this).children().length == 0 ) {
      $(this).addClass('no_link');
      $(this).wrapInner('<span></span>');
    } else {
      $(this).addClass('has_link');
    }
  });*/

// テキストウィジェットとHTMLウィジェットにエディターのクラスを追加する
$('.widget_text .textwidget').addClass('post_content');

// アーカイブとカテゴリーのセレクトボックスにselect_wrapのクラスを追加する
  $('.widget_archive select').wrap('<div class="select_wrap"></div>');
  $('.widget_categories form').wrap('<div class="select_wrap"></div>');

});