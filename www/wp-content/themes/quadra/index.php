<?php
    
    get_header();
    $options = get_design_plus_option();

    if(is_tag()) {
      $query_obj = get_queried_object();
      $catch = $query_obj->name;
      if (!empty($query_obj->description)){
        $desc = $query_obj->description;
      }
    }

    if(is_author()) {
      $author_info = $wp_query->get_queried_object();
      $author_id = $author_info->ID;
      $user_data = get_userdata($author_id);
      $user_name = $user_data->display_name;
      $catch = sprintf( __( 'Archive for %s', 'tcd-w' ), $user_name );
      $desc = '';
    }

    if( is_day() ) {
      $catch = sprintf( __( 'Archive for %s', 'tcd-w' ), get_the_time( __( 'F jS, Y', 'tcd-w' ) ) );
      $desc = '';
      $desc_mobile = '';
    } elseif ( is_month() ) {
      $catch = sprintf( __( 'Archive for %s', 'tcd-w' ), get_the_time( __( 'F, Y', 'tcd-w') ) );
      $desc = '';
    } elseif ( is_year() ) {
      $catch = sprintf( __( 'Archive for %s', 'tcd-w' ), get_the_time( __( 'Y', 'tcd-w') ) );
      $desc = '';
    }
    
    get_template_part('template-parts/page-header-title');

    // Author profile ------------------------------------------------------------------------------------------------------------------------------
    if ($paged == 0 && is_author()) {
      if(!empty($user_data->show_author) || !empty($user_data->show_author_blog)) {
        $desc = $user_data->description;
        $facebook = $user_data->facebook_url;
        $twitter = $user_data->twitter_url;
        $tiktok = $user_data->tiktok_url;
        $insta = $user_data->instagram_url;
        $pinterest = $user_data->pinterest_url;
        $youtube = $user_data->youtube_url;
        $contact = $user_data->contact_url;
        $author_url = get_author_posts_url($author_id);
        $user_url = $user_data->user_url;
    ?>
    <div id="author_archive_profile">
      <div class="inner">
        <div class="author_profile clearfix">
          <div class="avatar_area"><?php echo wp_kses_post(get_avatar($author_id, 300)); ?></div>
            <div class="info">
            <div class="info_inner">
              <h4 class="name rich_font"><?php echo esc_html($user_data->display_name); ?></h4>
              <?php if($desc) { ?>
              <p class="desc"><span><?php echo esc_html($desc); ?></span></p>
              <?php }; ?>
              <?php if($facebook || $twitter || $tiktok || $insta || $pinterest || $youtube || $contact || $user_url) { ?>
              <ul id="author_sns" class="sns_button_list clearfix color_<?php echo esc_attr($options['single_sns_color_type']); ?>">
              <?php if($user_url) { ?><li class="user_url"><a href="<?php echo esc_url($user_url); ?>" target="_blank"><span><?php echo esc_url($user_url); ?></span></a></li><?php }; ?>
              <?php if($insta) { ?><li class="insta"><a href="<?php echo esc_url($insta); ?>" rel="nofollow" target="_blank" title="Instagram"><span>Instagram</span></a></li><?php }; ?>
              <?php if($twitter) { ?><li class="twitter"><a href="<?php echo esc_url($twitter); ?>" rel="nofollow" target="_blank" title="X"><span>X</span></a></li><?php }; ?>
              <?php if($tiktok) { ?><li class="tiktok"><a href="<?php echo esc_url($tiktok); ?>" rel="nofollow" target="_blank" title="TikTok"><span>TikTok</span></a></li><?php }; ?>
              <?php if($facebook) { ?><li class="facebook"><a href="<?php echo esc_url($facebook); ?>" rel="nofollow" target="_blank" title="Facebook"><span>Facebook</span></a></li><?php }; ?>
              <?php if($pinterest) { ?><li class="pinterest"><a href="<?php echo esc_url($pinterest); ?>" rel="nofollow" target="_blank" title="Pinterest"><span>Pinterest</span></a></li><?php }; ?>
              <?php if($youtube) { ?><li class="youtube"><a href="<?php echo esc_url($youtube); ?>" rel="nofollow" target="_blank" title="Youtube"><span>Youtube</span></a></li><?php }; ?>
              <?php if($contact) { ?><li class="contact"><a href="<?php echo esc_url($contact); ?>" rel="nofollow" target="_blank" title="Contact"><span>Contact</span></a></li><?php }; ?>
              </ul>
              <?php }; ?>
            </div>
          </div>
        </div><!-- END .author_profile -->
      </div>
    </div><!-- END #author_archive_profile -->
    <?php 
      
      };
    
    }; 
    
    get_template_part('template-parts/index_post_list');
    
    get_footer();