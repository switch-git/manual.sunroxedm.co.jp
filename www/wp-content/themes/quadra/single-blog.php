<?php
     get_header();
     $options = get_design_plus_option();

     // サイドバータイプ
     if($options['blog_single_sidebar_type'] == 'type1'){
        $sidebar_type = 'left';
     }else{
        $sidebar_type = 'right';
     }
     
     get_template_part('template-parts/breadcrumb');
     
?>
<div id="single_blog">
  <div id="main_contents" class="<?php echo $sidebar_type; ?>">
    <div class="inner">
      <div id="main_col">
        <div class="inner">
          <?php

            if ( have_posts() ) : while ( have_posts() ) : the_post();
              $category = wp_get_post_terms( $post->ID, 'blog_category' , array( 'orderby' => 'term_order' ));
              if ( $category && ! is_wp_error($category) ) {
                foreach ( $category as $cat ) :
                  $cat_name = $cat->name;
                  $cat_id = $cat->term_id;
                  $cat_url = get_term_link($cat_id,'blog_category');
                  break;
                endforeach;
              };

          ?>
          <article id="article">
            <?php if($page == '1') { // ***** only show on first page ***** ?>
              <div id="blog_title">
                <?php
                    if(has_post_thumbnail()) {
                      $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
                    } elseif($options['no_image1']) {
                      $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
                    } else {
                      $image = array();
                      $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image2.gif";
                    }  
                ?>
                <div id="blog_image">
                  <?php if ( $category && ! is_wp_error($category) ) { ?>
                  <a class="category" href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat_name); ?></a>
                  <?php }; ?>
                  <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
                </div>
                <div class="content">
                  <h1 class="title rich_font entry-title"><?php the_title(); ?></h1>
                  <?php if ( $options['single_blog_show_date']){ ?>
                  <ul class="meta_top clearfix">
                    <li class="date"><time class="entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></li>
                    <?php
                        if ( $options['single_blog_show_update']){
                          $post_date = get_the_time('Ymd');
                          $modified_date = get_the_modified_date('Ymd');
                          if($post_date < $modified_date){
                    ?>
                    <li class="update"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_modified_date('Y.m.d'); ?></time></li>
                    <?php
                          };
                        };
                    ?>
                  </ul>
                  <?php }; ?>
                </div>
              </div><!-- END #blog_title -->
              <?php
                    // sns button top ------------------------------------------------------------------------------------------------------------------------
                    if($options['single_blog_show_sns_top']) {
              ?>
              <div class="single_share clearfix" id="single_share_top">
                <?php get_template_part('template-parts/sns-btn-top'); ?>
              </div>
              <?php };

                    // copy title&url button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                    if($options['single_blog_show_copy_top']) {
              ?>
              <div class="single_copy_title_url" id="single_copy_title_url_top">
                <button class="single_copy_title_url_btn" data-clipboard-text="<?php echo esc_attr( strip_tags( get_the_title() ) . ' ' . get_permalink() ); ?>" data-clipboard-copied="<?php echo esc_attr( __( 'COPIED Title&amp;URL', 'tcd-w' ) ); ?>"><?php _e( 'COPY Title&amp;URL', 'tcd-w' ); ?></button>
              </div>
              <?php };
                          
                    // banner top ------------------------------------------------------------------------------------------------------------------------
                    if(!is_mobile()) {
                      if( $options['blog_single_top_ad_code'] ) {
              ?>
              <div id="single_banner_top" class="single_banner">
                <?php echo $options['blog_single_top_ad_code']; ?>
              </div><!-- END #single_banner_top -->
              <?php
                      };
                    };
                  }; // ***** END only show on first page *****
                  
                    // post content ------------------------------------------------------------------------------------------------------------------------
              ?>
              <div class="post_content clearfix">
                <?php
                    the_content();
                    if ( ! post_password_required() ) {
                      custom_wp_link_pages();
                    }
                ?>
              </div>
              <?php
                    // sns button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                    if($options['single_blog_show_sns_btm']) {
              ?>
              <div class="single_share clearfix" id="single_share_bottom">
                <?php get_template_part('template-parts/sns-btn-btm'); ?>
              </div>
            <?php }; ?>
          </article><!-- END #article -->
          <?php
                // page nav ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
          ?>
          <div id="news_next_prev_post">
            <?php next_prev_post_link(); ?>
          </div>
          <?php
                // Author profile ------------------------------------------------------------------------------------------------------------------------------
                $author_id = get_the_author_meta('ID');
                $user_data = get_userdata($author_id);
                if(!empty($user_data->show_author_blog)) {
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
          <div class="author_profile clearfix">
            <a class="avatar_area animate_image" href="<?php echo esc_url($author_url); ?>"><?php echo wp_kses_post(get_avatar($author_id, 300)); ?></a>
            <div class="info">
            <div class="info_inner">
              <div class="name rich_font"><a href="<?php echo esc_url($author_url); ?>"><span class="author"><?php echo esc_html($user_data->display_name); ?></span></a></div>
              <?php if($desc) { ?>
              <p class="desc"><span><?php echo esc_html($desc); ?></span></p>
              <?php }; ?>
              <?php if($facebook || $twitter || $tiktok || $insta || $pinterest || $youtube || $contact || $user_url) { ?>
              <ul id="author_sns" class="sns_button_list clearfix color_<?php echo esc_attr($options['single_sns_color_type']); ?>">
              <?php if($user_url) { ?><li class="user_url"><a href="<?php echo esc_url($user_url); ?>" target="_blank"><span><?php echo esc_url($user_url); ?></span></a></li><?php }; ?>
              <?php if($insta) { ?><li class="insta"><a href="<?php echo esc_url($insta); ?>" rel="nofollow" target="_blank" title="Instagram"><span>Instagram</span></a></li><?php }; ?>
              <?php if($tiktok) { ?><li class="tiktok"><a href="<?php echo esc_url($tiktok); ?>" rel="nofollow" target="_blank" title="TikTok"><span>TikTok</span></a></li><?php }; ?>
              <?php if($twitter) { ?><li class="twitter"><a href="<?php echo esc_url($twitter); ?>" rel="nofollow" target="_blank" title="X"><span>X</span></a></li><?php }; ?>
              <?php if($facebook) { ?><li class="facebook"><a href="<?php echo esc_url($facebook); ?>" rel="nofollow" target="_blank" title="Facebook"><span>Facebook</span></a></li><?php }; ?>
              <?php if($pinterest) { ?><li class="pinterest"><a href="<?php echo esc_url($pinterest); ?>" rel="nofollow" target="_blank" title="Pinterest"><span>Pinterest</span></a></li><?php }; ?>
              <?php if($youtube) { ?><li class="youtube"><a href="<?php echo esc_url($youtube); ?>" rel="nofollow" target="_blank" title="Youtube"><span>Youtube</span></a></li><?php }; ?>
              <?php if($contact) { ?><li class="contact"><a href="<?php echo esc_url($contact); ?>" rel="nofollow" target="_blank" title="Contact"><span>Contact</span></a></li><?php }; ?>
              </ul>
              <?php }; ?>
            </div>
            </div>
          </div><!-- END .author_profile -->
          <?php };

                // banner bottom ------------------------------------------------------------------------------------------------------------------------
                if(!is_mobile()) {
                  if( $options['blog_single_bottom_ad_code'] ) {
          ?>
          <div id="single_banner_bottom" class="single_banner">
            <?php echo $options['blog_single_bottom_ad_code']; ?>
          </div><!-- END #single_banner_bottom -->
          <?php
                  };
                };
          
                // mobile banner ------------------------------------------------------------------------------------------------------------------------
                if(is_mobile()) {
                  if( $options['blog_single_mobile_ad_code'] ) {
          ?>
          <div id="single_banner_bottom" class="single_banner">
            <?php echo $options['blog_single_mobile_ad_code']; ?>
          </div><!-- END #single_banner_bottom -->
          <?php
                  };
                };
          
          endwhile; endif;

                // related blog ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                if ($options['show_related_blog']){

                  if ( $category && ! is_wp_error($category) ) {

                    $post_num = $options['related_blog_num'];
                    if(is_mobile()){ $post_num = $options['related_blog_num_mobile']; }
                    $args = array( 'post_type' => 'blog', 'post__not_in' => array($post->ID), 'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC'), 'posts_per_page' => $post_num, 'tax_query' => array( array( 'taxonomy' => 'blog_category', 'field' => 'term_id', 'terms' => $cat_id ) ) );

                    $related_blog = new wp_query($args);
                    if($related_blog->have_posts()):
          ?>
          <div id="related_blog">
          <h2 class="headline rich_font">
            <span><?php echo wp_kses_post(nl2br($options['related_blog_headline'])); ?></span>
          </h2>
          <div id="related_blog_list">
            <?php
                while( $related_blog->have_posts() ) : $related_blog->the_post();

                if(has_post_thumbnail()) {
                  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size3' );
                } elseif($options['no_image1']) {
                  $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
                } else {
                  $image = array();
                  $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image2.gif";
                }
            ?>
            <article class="item">
            <a class="link animate_background <?php echo quadra_hover_type() ?>" href="<?php the_permalink(); ?>">
              <div class="image_wrap">
              <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
              </div>
              <div class="content">
              <div class="inner">
                <p class="date sp"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></p>
                <h3 class="title lines"><span class="two"><?php the_title(); ?></span></h3>
                <p class="date pc"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></p>
              </div>
              </div>
            </a>
            </article>
            <?php endwhile; wp_reset_query(); ?>
          </div><!-- END .news_list -->
          </div><!-- END #recent_news -->
          <?php
                endif;
                  };
                };
          ?>
        </div><!-- END .inner -->
      </div><!-- END #main_col -->
    <?php
        // widget ------------------------
        get_sidebar();
    ?>
    </div><!-- END #main_contents_inner -->
  </div><!-- END #main_contents -->
</div><!-- END #single_news -->
<?php get_footer(); ?>