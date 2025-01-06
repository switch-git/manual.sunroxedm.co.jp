<?php
     function has_loading_screen(){
       $options = get_design_plus_option();
?>
<script>

<?php if(wp_is_mobile()) { ?>
jQuery(window).bind("pageshow", function(event) {
  if (event.originalEvent.persisted) {
    window.location.reload()
  }
});
<?php }; ?>

jQuery(function($){

  var winH = $(window).innerHeight();
  if( $('#site_loader_overlay').length ){
    $('#site_loader_overlay').css('height', winH);
  }

  <?php if ($options['load_icon'] == 'type4' || $options['load_icon'] == 'type5') { ?>
  $('#site_loader_logo').addClass('active');
  <?php if ($options['use_load_catch_animation']) { ?>
  if( $('#site_loader_logo.use_text_animation .catch').length ){
    setTimeout(function(){
      $("#site_loader_logo.use_text_animation .catch span").each(function(i){
        $(this).delay(i * 50).queue(function(next) {
          $(this).addClass('animate');
          next();
        });
      });
    }, 500);
  };
  <?php }; ?>
  <?php }; ?>

  setTimeout(function(){

    $('body').addClass('end_loading');

    <?php
         // front page -----------------------------------
         if(is_front_page()) {
           $display_header_content = '';
           if(!is_mobile() && $options['show_index_slider']) {
             $display_header_content = 'show';
           } elseif(is_mobile() && ($options['mobile_show_index_slider'] != 'type3') ) {
             $display_header_content = 'show';
           }
          //  if($display_header_content == 'show') {
          //    get_template_part('functions/slider_ini');
          //  };
         };
    ?>

    $("#page_header .bg_image").addClass('animate');
    $("#page_header .animate_item").each(function(i){
      $(this).delay(i *700).queue(function(next) {
        $(this).addClass('animate');
        next();
      });
    });
    if( $('#page_header .animation_type2').length ){
      setTimeout(function(){
        $("#page_header .animation_type2 span").each(function(i){
          $(this).delay(i * 50).queue(function(next) {
            $(this).addClass('animate');
            next();
          });
        });
      }, 500);
    };

  }, <?php if($options['load_time']) { echo esc_html($options['load_time']); } else { echo '7000'; }; ?>);

  $(window).on('scroll load', function(i) {
    var scTop = $(this).scrollTop();
    var scBottom = scTop + $(this).height();
    $('.inview').each( function(i) {
      var thisPos = $(this).offset().top + 100;
      if ( thisPos < scBottom ) {
        $(this).addClass('animate');
      }
    });
  });

});
</script>
<?php } ?>
<?php
     // no loading ------------------------------------------------------------------------------------------------------------------
     function no_loading_screen(){
       $options = get_design_plus_option();
?>
<script>

<?php if(wp_is_mobile()) { ?>
jQuery(window).bind("pageshow", function(event) {
  if (event.originalEvent.persisted) {
    window.location.reload()
  }
});
<?php }; ?>

jQuery(document).ready(function($){

  $("#page_header .bg_image").addClass('animate');
  $("#page_header .animate_item").each(function(i){
    $(this).delay(i *700).queue(function(next) {
      $(this).addClass('animate');
      next();
    });
  });

  if( $('#page_header .animation_type2').length ){
    setTimeout(function(){
      $("#page_header .animation_type2 span").each(function(i){
        $(this).delay(i * 50).queue(function(next) {
          $(this).addClass('animate');
          next();
        });
      });
    }, 500);
  };

  $(window).on('scroll load', function(i) {
    var scTop = $(this).scrollTop();
    var scBottom = scTop + $(this).height();
    $('.inview').each( function(i) {
      var thisPos = $(this).offset().top + 100;
      if ( thisPos < scBottom ) {
        $(this).addClass('animate');
      }
    });
  });

});

</script>
<?php } ?>