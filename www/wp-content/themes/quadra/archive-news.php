<?php

    get_header();
    $options = get_design_plus_option();

    // サイドバータイプ
    if($options['news_archive_sidebar_type'] == 'type1'){
      $sidebar_type = 'left';
    }else{
      $sidebar_type = 'right';
    }

    $no_thumbnail = $options['hide_archive_news_thumbnail'];

    if($options['show_archive_news_header_title']){
      get_template_part('template-parts/page-header-title'); 
    }

?>
<div id="news_archive">
  <div id="main_contents" class="<?php echo $sidebar_type; ?>">
    <div class="inner">
      <div id="main_col">
        <div class="inner">
          <div id="news_archive_list" <?php if($no_thumbnail){ ?>class="no_thumbnail"<?php } ?>>
            <?php
              while ( have_posts() ) : the_post();

                if(has_post_thumbnail()) {
                  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size4' );
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
                    <p class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></p>
                    <h2 class="title lines"><span class="two"><?php the_title(); ?></span></h2>
                  </div>
                </div>
              </a>
            </article>
            <?php endwhile; ?>
          </div><!-- END #news_archive_list -->
          <?php get_template_part('template-parts/navigation'); ?>
        </div><!-- END .inner -->
      </div><!-- END #main_col -->
    <?php
        // widget ------------------------
        get_sidebar();
    ?>
    </div><!-- END #main_contents_inner -->
  </div><!-- END #main_contents -->
</div><!-- END #news_archive -->
<?php
    
    get_footer();