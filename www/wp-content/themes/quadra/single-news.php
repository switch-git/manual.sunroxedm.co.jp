<?php
     get_header();
     $options = get_design_plus_option();

     // サイドバータイプ
     if($options['news_single_sidebar_type'] == 'type1'){
        $sidebar_type = 'left';
     }else{
        $sidebar_type = 'right';
     }

     $no_thumbnail = $options['hide_archive_news_thumbnail'];
     
     get_template_part('template-parts/breadcrumb');

?>
<div id="single_news">
  <div id="main_contents" class="<?php echo $sidebar_type; ?>">
    <div class="inner">
      <div id="main_col">
        <div class="inner">
          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <article id="article">
            <?php if($page == '1') { // ***** only show on first page ***** ?>
            <div id="news_title">
              <ul class="meta_top clearfix">
                <li class="date"><time class="entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></li>
                <?php
                    if ( $options['single_news_show_update']){
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
              <h1 class="title rich_font entry-title"><?php the_title(); ?></h1>
            </div>
            <?php
               if(has_post_thumbnail()) {
                 $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
            ?>
            <div id="news_image">
              <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
            </div>
            <?php };

               // sns button top ------------------------------------------------------------------------------------------------------------------------
               if($options['single_news_show_sns_top']) {
            ?>
            <div class="single_share clearfix" id="single_share_top">
            <?php get_template_part('template-parts/sns-btn-top'); ?>
            </div>
            <?php };

               // copy title&url button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
               if($options['single_news_show_copy_top']) {
            ?>
            <div class="single_copy_title_url" id="single_copy_title_url_top">
            <button class="single_copy_title_url_btn" data-clipboard-text="<?php echo esc_attr( strip_tags( get_the_title() ) . ' ' . get_permalink() ); ?>" data-clipboard-copied="<?php echo esc_attr( __( 'COPIED Title&amp;URL', 'tcd-w' ) ); ?>"><?php _e( 'COPY Title&amp;URL', 'tcd-w' ); ?></button>
            </div>
            <?php };

               // banner top ------------------------------------------------------------------------------------------------------------------------
               if(!is_mobile()) {
                 if( $options['news_single_top_ad_code'] ) {
            ?>
            <div id="single_banner_top" class="single_banner">
            <?php echo $options['news_single_top_ad_code']; ?>
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
               if($options['single_news_show_sns_btm']) {
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
               // banner bottom ------------------------------------------------------------------------------------------------------------------------
               if(!is_mobile()) {
                 if( $options['news_single_bottom_ad_code'] ) {
          ?>
          <div id="single_banner_bottom" class="single_banner">
          <?php echo $options['news_single_bottom_ad_code']; ?>
          </div><!-- END #single_banner_bottom -->
          <?php
                    };
               };
          
               // mobile banner ------------------------------------------------------------------------------------------------------------------------
               if(is_mobile()) {
                 if( $options['news_single_mobile_ad_code'] ) {
          ?>
          <div id="single_banner_bottom" class="single_banner">
          <?php echo $options['news_single_mobile_ad_code']; ?>
          </div><!-- END #single_banner_bottom -->
          <?php
                 };
               };
          
          endwhile; endif;

          // recent news ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
          if ($options['show_recent_news']){
            $post_num = $options['recent_news_num'];
            if(is_mobile()){ $post_num = $options['recent_news_num_mobile']; }

            $args = array( 'post_type' => 'news', 'showposts'=> $post_num);
            $recent_news = new wp_query($args);
            if($recent_news->have_posts()):
          ?>
          <div id="recent_news">
            <h2 class="headline rich_font"><span><?php echo wp_kses_post(nl2br($options['recent_news_headline'])); ?></span></h2>
            <div id="recent_news_list" <?php if($no_thumbnail){ ?>class="no_thumbnail"<?php } ?>>
            <?php
               while( $recent_news->have_posts() ) : $recent_news->the_post();

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
               <?php if(!$no_thumbnail){ ?>
               <div class="image_wrap">
                 <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
               </div>
               <?php } ?>
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