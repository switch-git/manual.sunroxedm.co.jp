<?php 

  $options = get_design_plus_option();

  $footer_bg_color = '';
  if(!$options['footer_bg_color_use_sub']){
    $footer_bg_color = 'style="background-color:'.esc_attr($options['footer_bg_color']).';"';
  }

?>
<footer id="footer"<?php echo $footer_bg_color; ?>>
  <?php

    if(is_page()){ 
      $page_hide_footer = get_post_meta($post->ID, 'page_hide_footer', true);
    } else {
      $page_hide_footer = '';
    }
    
    if(!$page_hide_footer && !is_404()){
       
  ?>
  <div class="inner">
  <?php
       // footer menu ------------------------------------------------------
       if ( has_nav_menu('footer-menu1') || has_nav_menu('footer-menu2') || has_nav_menu('footer-menu3') ) {
  ?>
  <div id="footer_menu" <?php if(!has_nav_menu('footer-menu1') || !has_nav_menu('footer-menu2') || !has_nav_menu('footer-menu3')){ ?>class="not_full"<?php } ?>>
   <?php if (has_nav_menu('footer-menu1')) { ?>
   <div class="footer_menu">
    <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'footer-menu1' , 'container' => '' , 'depth' => '1') ); ?>
   </div>
   <?php }; ?>
   <?php if (has_nav_menu('footer-menu2')) { ?>
   <div class="footer_menu">
    <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'footer-menu2' , 'container' => '' , 'depth' => '1') ); ?>
   </div>
   <?php }; ?>
   <?php if (has_nav_menu('footer-menu3')) { ?>
   <div class="footer_menu">
    <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'footer-menu3' , 'container' => '' , 'depth' => '1') ); ?>
   </div>
   <?php }; ?>
  </div><!-- END #footer_menu -->
  <?php };

       // logo area -----------------------------------------------------
       if( $options['show_footer_logo'] || $options['show_footer_sns'] || $options['show_footer_message'] || $options['footer_description'] ) {
  ?>
  <div id="footer_top">
   <?php
        // logo ------------------------
        if( $options['show_footer_logo']) {
   ?>
   <div id="footer_logo">
    <?php footer_logo(); ?>
   </div>
   <?php
        }; if($options['show_footer_message']){ ?>
   <p class="site_description"><?php echo esc_html(get_bloginfo('description')); ?></p>
   <?php } ?>
   <?php if($options['footer_description']){ ?>
   <p class="desc"><?php echo esc_html($options['footer_description']); ?></p>
   <?php }
   
        // footer sns ------------------------------------
        if($options['show_footer_sns']) {
          $facebook = $options['footer_facebook_url'];
          $tiktok = $options['footer_tiktok_url'];
          $twitter = $options['footer_twitter_url'];
          $insta = $options['footer_instagram_url'];
          $pinterest = $options['footer_pinterest_url'];
          $youtube = $options['footer_youtube_url'];
          $contact = $options['footer_contact_url'];
          $show_rss = $options['footer_show_rss'];
   ?>
   <ul id="footer_sns" class="sns_button_list clearfix color_<?php echo esc_attr($options['footer_sns_color_type']); ?>">
    <?php if($insta) { ?><li class="insta"><a href="<?php echo esc_url($insta); ?>" rel="nofollow noopener" target="_blank" title="Instagram"><span>Instagram</span></a></li><?php }; ?>
    <?php if($tiktok) { ?><li class="tiktok"><a href="<?php echo esc_url($tiktok); ?>" rel="nofollow noopener" target="_blank" title="TikTok"><span>TikTok</span></a></li><?php }; ?>
    <?php if($twitter) { ?><li class="twitter"><a href="<?php echo esc_url($twitter); ?>" rel="nofollow noopener" target="_blank" title="X"><span>X</span></a></li><?php }; ?>
    <?php if($facebook) { ?><li class="facebook"><a href="<?php echo esc_url($facebook); ?>" rel="nofollow noopener" target="_blank" title="Facebook"><span>Facebook</span></a></li><?php }; ?>
    <?php if($pinterest) { ?><li class="pinterest"><a href="<?php echo esc_url($pinterest); ?>" rel="nofollow noopener" target="_blank" title="Pinterest"><span>Pinterest</span></a></li><?php }; ?>
    <?php if($youtube) { ?><li class="youtube"><a href="<?php echo esc_url($youtube); ?>" rel="nofollow noopener" target="_blank" title="Youtube"><span>Youtube</span></a></li><?php }; ?>
    <?php if($contact) { ?><li class="contact"><a href="<?php echo esc_url($contact); ?>" rel="nofollow noopener" target="_blank" title="Contact"><span>Contact</span></a></li><?php }; ?>
    <?php if($show_rss) { ?><li class="rss"><a href="<?php bloginfo('rss2_url'); ?>" rel="nofollow noopener" target="_blank" title="RSS"><span>RSS</span></a></li><?php }; ?>
   </ul>
   <?php }; ?>
  </div><!-- END #footer_top -->
  <?php }; ?>
  </div><!-- END .inner -->
  <?php }; // END hide footer
  
        // copyright --------------------------------------------
  ?>
  <p id="copyright"><?php echo wp_kses_post($options['copyright']); ?></p>
 </footer>
 <?php if(!is_404()){ ?>
 <div id="return_top">
  <a href="#body"><span>TOP</span></a>
 </div>
 <?php
 
      }
      // footer bar for mobile device -------------------
      if( is_mobile() && ($options['footer_bar_display'] != 'type3') && ($options['footer_bar_type'] == 'type1') ) {
        get_template_part('template-parts/footer-bar');
      } elseif( is_mobile() && ($options['footer_bar_display'] != 'type3') && ($options['footer_bar_type'] == 'type2') ) {
 
 ?>
 <div id="dp-footer-bar" class="type2">
  <?php
       for($i = 1; $i <= 2; $i++) {
         if($options['show_footer_button'.$i]) {
  ?>
  <a class="footer_button num<?php echo $i; ?>" href="<?php echo esc_html($options['footer_button_url'.$i]); ?>" <?php if($options['footer_button_target'.$i]){ echo 'target="_blank"'; }; ?>>
   <span><?php echo esc_html($options['footer_button_label'.$i]); ?></span>
  </a>
  <?php }; }; ?>
 </div>
 <?php
      }
 ?>
</div><!-- #container -->
<?php // drawer menu -------------------------------------------- ?>
<?php if (has_nav_menu('global-menu') || has_nav_menu('top-menu') ) { ?>
<div id="drawer_menu">
 <nav>
   <?php
        if(is_front_page()){
          if(has_nav_menu('top-menu')) {
            wp_nav_menu( array( 'menu_id' => 'mobile_menu', 'sort_column' => 'menu_order', 'theme_location' => 'top-menu' , 'container' => '' ) );
          } elseif(has_nav_menu('global-menu')) {
            wp_nav_menu( array( 'menu_id' => 'mobile_menu', 'sort_column' => 'menu_order', 'theme_location' => 'global-menu' , 'container' => '' ) );
          }
        } else {
          if(has_nav_menu('global-menu')) {
            wp_nav_menu( array( 'menu_id' => 'mobile_menu', 'sort_column' => 'menu_order', 'theme_location' => 'global-menu' , 'container' => '' ) );
          }
        }
   ?>
 </nav>
 <?php
      // Search --------------------------------------------------------------------
      if( $options['show_header_search_mobile']) {
 ?>
 <div id="footer_search">
  <form role="search" method="get" id="footer_searchform" action="<?php echo esc_url(home_url()); ?>">
   <div class="input_area"><input type="text" value="" id="footer_search_input" name="s" autocomplete="off"></div>
   <div class="button"><label for="footer_search_button"></label><input type="submit" id="footer_search_button" value=""></div>
  </form>
 </div>
 <?php }; ?>
 <div id="mobile_banner">
  <?php if( $options['mobile_menu_ad_code'] ) { ?>
  <div class="banner">
   <?php echo $options['mobile_menu_ad_code']; ?>
  </div>
  <?php }; ?>
 </div><!-- END #footer_mobile_banner -->
</div>
<?php };

     // load script -----------------------------------------------------------
     if ($options['show_load_screen'] == 'type2') {
       if(is_front_page()){
         has_loading_screen();
       } else {
         no_loading_screen();
       }
     } elseif ($options['show_load_screen'] == 'type3') {
       if(is_front_page()){
         has_loading_screen();
       } elseif( ($options['load_icon_hide_archive'] == '1') && (is_home() || is_archive()) ){
         no_loading_screen();
       } elseif( ($options['load_icon_hide_archive'] != '1') && (is_home() || is_archive()) ){
         has_loading_screen();
       } else {
         no_loading_screen();
       }
     } else {
       no_loading_screen();
     };
?>

<?php
     // share button ----------------------------------------------------------------------
     if ( is_single() && ( $options['single_post_show_sns_top'] || $options['single_post_show_sns_btm'] || $options['single_news_show_sns_top'] || $options['single_news_show_sns_btm']) ) :
       if ( 'type5' == $options['sns_type_top'] || 'type5' == $options['sns_type_btm'] ) :
         if ( $options['show_twitter_top'] || $options['show_twitter_btm'] ) :
?>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<?php
         endif;
         if ( $options['show_fblike_top'] || $options['show_fbshare_top'] || $options['show_fblike_btm'] || $options['show_fbshare_btm'] ) :
?>
<!-- facebook share button code -->
<div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<?php
         endif;
         if ( $options['show_hatena_top'] || $options['show_hatena_btm'] ) :
?>
<script type="text/javascript" src="//b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
<?php
         endif;
         if ( $options['show_pocket_top'] || $options['show_pocket_btm'] ) :
?>
<script type="text/javascript">!function(d,i){if(!d.getElementById(i)){var j=d.createElement("script");j.id=i;j.src="https://widgets.getpocket.com/v1/j/btn.js?v=1";var w=d.getElementById(i);d.body.appendChild(j);}}(document,"pocket-btn-js");</script>
<?php
         endif;
         if ( ($options['show_pinterest_top'] && $options['sns_type_top'] == 'type5') || ($options['show_pinterest_btm'] && $options['sns_type_btm'] == 'type5') ) :
?>
<script async defer src="//assets.pinterest.com/js/pinit.js"></script>
<?php
         endif;
       endif;
     endif;
?>

<?php wp_footer(); ?>
</body>
</html>