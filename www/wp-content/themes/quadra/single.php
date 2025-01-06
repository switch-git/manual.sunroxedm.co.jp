<?php

     get_header();
     $options = get_design_plus_option();

     // サイドバータイプ
     if($options['post_single_sidebar_type'] == 'type1'){
        $sidebar_type = 'left';
     }else{
        $sidebar_type = 'right';
     }

     get_template_part('template-parts/page-header-title');
     get_template_part('template-parts/breadcrumb');

?>
<div id="main_contents" class="<?php echo $sidebar_type; ?>">
  <div class="inner">
    <div id="main_col">
     <div class="inner">
       <?php

          if ( have_posts() ) : while ( have_posts() ) : the_post();

            $category = wp_get_post_terms( $post->ID, 'category' , array( 'orderby' => 'term_order' ));
            $exist_child = '';
            $counter = 0;
            if ( $category && ! is_wp_error($category) ) {

              foreach ( $category as $cat ) : $counter++;

                if($counter == 1) { //一周目

                  $cat_name = $cat->name;
                  $cat_id = $cat->term_id;
                  $cat_url = get_term_link($cat_id,'category');
                  $cat_parent = $cat->parent;

                    if($cat_parent == 0) { // 親カテゴリーだったら

                      $parent_cat_id = $cat_id;
                      $parent_cat_name = $cat_name; //これが親カテゴリーの名前
                      $parent_cat_url = $cat_url; //これが親カテゴリーのURL
                      $children = get_term_children( $cat_id, 'category' );//子カテゴリーを持っていたら
                      if ($children) { continue; } else { break; }

                  } else { $exist_child = true; //子カテゴリーだったら

                      $child_cat_id = $cat_id;
                      $child_cat_name = $cat_name;
                      $child_cat_url = $cat_url;
                      $parent_cat_id = $cat_parent;
                      $parent_cat_name = get_the_category_by_ID($parent_cat_id); // 親カテゴリーの名称
                      $parent_cat_url = get_term_link($parent_cat_id,'category');
                      break;

                  } //親子判定終了
                 } // 一周目終わり

                 if(in_array($cat->term_id, $children, true)) { //カテゴリーIDが$childrenの中身と一致するかどうか
                   $exist_child = true;
                   $child_cat_id = $cat->term_id;
                   $child_cat_name = get_the_category_by_ID($child_cat_id); // 子カテゴリーの名称
                   $child_cat_url = get_term_link($child_cat_id,'category'); //子カテゴリーのURL
                   break;

                } else { continue; }
               endforeach;
          };

          $term_meta = get_option( 'taxonomy_' . $parent_cat_id, array() );
          $bg_color = '';
          if(isset($term_meta['color2_use_sub'] ) && isset($term_meta['color2'])){
            if(!$term_meta['color2_use_sub']){
              $bg_color = 'style="background-color:'.esc_attr($term_meta['color2']).';"';
            }
          }

       ?>
       <article id="article">
         <?php if($page == '1') { // ***** only show on first page ***** ?>
         <div id="post_title">
          <?php if ( $options['single_post_show_category'] ) { ?>
          <ul class="category_list<?php if(!$exist_child) echo ' no_child'; ?>">
            <li><a class="category parent cat_id<?php echo esc_attr($parent_cat_id); ?>" href="<?php echo esc_url($parent_cat_url); ?>"<?php echo $bg_color; ?>><?php echo esc_html($parent_cat_name); ?></a></li>
            <?php if ( $exist_child ) { ?>
            <li><a class="category child cat_id<?php echo esc_attr($child_cat_id); ?>" href="<?php echo esc_url($child_cat_url); ?>"><?php echo esc_html($child_cat_name); ?></a></li>
            <?php }; ?>
          </ul>
          <?php }; ?>
          <h1 class="title rich_font entry-title"><?php the_title(); ?></h1>
          <?php if ( $options['single_post_show_date']){ ?>
          <ul class="meta_top clearfix">
            <li class="date"><time class="entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></li>
            <?php
               if ( $options['single_post_show_update']){
                 $post_date = get_the_time('Ymd');
                 $modified_date = get_the_modified_date('Ymd');
                 if($post_date < $modified_date){
            ?>
            <li class="update"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_modified_date('Y.m.d'); ?></time></li>
            <?php
                 };
               };
             };
            ?>
          </ul>
        </div><!-- #post_title -->
        <?php
          if(has_post_thumbnail()) {
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
        ?>
        <div id="post_image_wrap">
          <div id="post_image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
        </div>
        <?php };

          // sns button top ------------------------------------------------------------------------------------------------------------------------
          if($options['single_post_show_sns_top']) {

        ?>
        <div class="single_share clearfix" id="single_share_top">
        <?php get_template_part('template-parts/sns-btn-top'); ?>
        </div>
        <?php };

          // copy title&url button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
          if($options['single_post_show_copy_top']) {

        ?>
        <div class="single_copy_title_url" id="single_copy_title_url_top">
          <button class="single_copy_title_url_btn" data-clipboard-text="<?php echo esc_attr( strip_tags( get_the_title() ) . ' ' . get_permalink() ); ?>" data-clipboard-copied="<?php echo esc_attr( __( 'COPIED Title&amp;URL', 'tcd-w' ) ); ?>"><?php _e( 'COPY Title&amp;URL', 'tcd-w' ); ?></button>
        </div>
        <?php };

          // banner top ------------------------------------------------------------------------------------------------------------------------
          if(!is_mobile()) {
            if( $options['single_top_ad_code']) {
        ?>
        <div id="single_banner_top" class="single_banner">
        <?php echo $options['single_top_ad_code']; ?>
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
          if($options['single_post_show_sns_btm']) {
        ?>
        <div class="single_share clearfix" id="single_share_bottom">
        <?php get_template_part('template-parts/sns-btn-btm'); ?>
        </div>
       <?php };

          // meta ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
          if ($options['single_post_show_meta_box']) {
       ?>
       <ul id="post_meta_bottom" class="clearfix">
         <?php if ($options['single_post_show_meta_author']) : ?><li class="post_author"><?php _e("Author","tcd-w"); ?>: <?php if (function_exists('coauthors_posts_links')) { coauthors_posts_links(', ',', ','','',true); } else { the_author_posts_link(); }; ?></li><?php endif; ?>
         <?php if ($options['single_post_show_meta_category']){ ?><li class="post_category"><?php the_category(', '); ?></li><?php }; ?>
         <?php if ($options['single_post_show_meta_tag']): ?><?php the_tags('<li class="post_tag">',', ','</li>'); ?><?php endif; ?>
         <?php if ($options['single_post_show_meta_comment']) : if (comments_open()){ ?><li class="post_comment"><?php _e("Comment","tcd-w"); ?>: <a href="#comments"><?php comments_number( '0','1','%' ); ?></a></li><?php }; endif; ?>
       </ul>
       <?php }; ?>
     </article><!-- END #article -->
     <?php
        // Author profile ------------------------------------------------------------------------------------------------------------------------------
        $author_id = get_the_author_meta('ID');
        $user_data = get_userdata($author_id);
        if(!empty($user_data->show_author)) {
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
           <?php }; if($facebook || $tiktok || $twitter || $insta || $pinterest || $youtube || $contact || $user_url) { ?>
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
          if( $options['single_bottom_ad_code'] ) {
     ?>
     <div id="single_banner_bottom" class="single_banner">
     <?php echo $options['single_bottom_ad_code']; ?>
     </div><!-- END #single_banner_bottom -->
     <?php
          };
        };

        // mobile banner ------------------------------------------------------------------------------------------------------------------------
        if(is_mobile()) {
          if( $options['single_mobile_ad_code'] ) {
     ?>
     <div id="single_banner_bottom" class="single_banner">
     <?php echo $options['single_mobile_ad_code']; ?>
     </div><!-- END #single_banner_bottom -->
     <?php
          };
        };

       endwhile; endif;

       // comment ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
       if ($options['single_post_show_comment'] || $options['single_post_show_trackback']) { comments_template('', true); };

     ?>
    </div><!-- END #main_col .innner -->
  </div><!-- END #main_col -->
  <?php
      // widget ------------------------
      get_sidebar();
  ?>
 </div><!-- END #main_contents_inner -->
</div><!-- END #main_contents -->
<?php get_footer(); ?>