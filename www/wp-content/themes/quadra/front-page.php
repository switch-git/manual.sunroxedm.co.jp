<?php
    
    get_header();

    $options = get_design_plus_option();

    // トップページ用固定ページのコンテンツを出力 ------------------------------------------------------------------------------
    if( (!is_mobile() && $options['index_content_type'] == 'type2') || (is_mobile() && $options['mobile_index_content_type'] == 'type3') ){
      if ( have_posts() ) : while ( have_posts() ) : the_post();

?>
 <div id="front_page_contents">
   <article id="article">
    <div class="post_content clearfix">
     <?php
        
        the_content();
        if ( ! post_password_required() ) {
          custom_wp_link_pages();
        }

     ?>
    </div>
   </article>
 </div><!-- END #front_page_contents -->
<?php

      endwhile; endif;

    } else {

      get_template_part('template-parts/index_content_builder');

    }; // END index_content_type

    get_footer();