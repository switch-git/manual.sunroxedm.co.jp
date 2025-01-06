<?php

  // 記事一覧

?>
<div id="archive">
  <div class="inner">
    <?php if ( have_posts() ) : ?>
    <div class="post_list">
      <?php while ( have_posts() ) : the_post(); ?>
      <article class="item">
        <a class="link <?php echo quadra_hover_type() ?>" href="<?php the_permalink(); ?>">
          <h2 class="title line"><span><?php the_title(); ?></span></h2>
          <p class="desc line" style="min-height:1em;"><span><?php echo trim_excerpt(150); ?></span></p>
        </a>
      </article><!-- END .item -->
      <?php endwhile; ?>
    </div><!-- END post_list -->
    <?php 
      get_template_part('template-parts/navigation');
      else:
    ?>
    <p id="no_post"><?php _e('There is no registered post.', 'tcd-w');  ?></p>
    <?php endif; ?>
  </div><!-- END .inner -->
</div><!-- END #archive -->