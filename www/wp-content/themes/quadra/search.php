<?php
  get_header();
  $options = get_design_plus_option();
  if ( !empty( get_search_query() ) ) {
    $catch = sprintf( __( 'Search Results for %s', 'tcd-w' ), get_search_query() );
  } else {
    $catch = __( 'Search result', 'tcd-w' );
  }

  $search_result_message = __('There is no registered post.', 'tcd-w');
  if($options['search_result_message']){
    $search_result_message = $options['search_result_message'];
  }

?>
<div id="search_archive">
  <?php
    if ( empty( get_search_query() ) || !have_posts() ) {
        echo custom_searchform($options);
    }
  ?>
  <div class="inner">
    <?php if ( empty( get_search_query() ) ) { ?>
      <p id="no_post"><?php _e('Please enter search keyword.', 'tcd-w');  ?></p>
    <?php } else {
      
      if ( have_posts() ) :
      
    ?>
    <h1 class="headline"><span><?php echo wp_kses_post(nl2br($catch)); ?></span></h1>
    <div class="post_list">
      <?php while ( have_posts() ) : the_post(); ?>
      <article class="item">
        <a class="link <?php echo quadra_hover_type() ?>" href="<?php the_permalink(); ?>">
          <h2 class="title line"><span><?php the_title(); ?></span></h2>
          <p class="desc line"><span><?php echo trim_excerpt(150); ?></span></p>
        </a>
      </article>
      <?php endwhile; ?>
    </div>
    <?php
    
      get_template_part('template-parts/navigation');
      
      else:
      
    ?>
      <h2 id="no_post"><?php echo nl2br(remove_non_inline_elements($search_result_message)); ?></h2>
    <?php
      
      endif;
      
    };
    
    ?>
  </div><!-- END inner -->
</div><!-- END search_archive -->
<?php get_footer(); ?>