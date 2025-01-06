<?php

  $word_balloon_desc = get_post_meta($post->ID, 'word_balloon_desc', true);
  $word_balloon_bg_color = get_post_meta($post->ID, 'word_balloon_bg_color', true);
  $word_balloon_bg_color_use_sub = get_post_meta($post->ID, 'word_balloon_bg_color_use_sub', true);

  $side_navigation_type = get_post_meta($post->ID, 'side_navigation_type', true);
  $side_navigation_color = get_post_meta($post->ID, 'side_navigation_color', true);
  $side_navigation_color_use_main = get_post_meta($post->ID, 'side_navigation_color_use_main', true);
  $use_fix_side_navigation = get_post_meta($post->ID, 'use_fix_side_navigation', true);

  $menu_items = wp_get_nav_menu_items( $side_navigation_type, array() );
  $menu_items = is_array($menu_items)  ? $menu_items : array();
  $menu_items[] = !empty($menu_items[0]) ? $menu_items[0] : '';

  $counter = 0;
  $child = false;
  $side_nav = '';

  foreach($menu_items as $menu_item):

    if($counter !== 0){

      // 一つ前の要素
      $prev_label = esc_html($menu_items[$counter - 1]->title);
      $prev_url = esc_attr($menu_items[$counter - 1]->url);
      $parent = $menu_item->menu_item_parent;

      switch (true) {
          case (!$child && !$parent) || ($child && $parent) :
              $side_nav .= '<li class="item"><a class="link" href="'.$prev_url.'">'.$prev_label.'</a></li>'."\n";
              break;
          case !$child && $parent :
              $side_nav .= '<li class="item"><a class="link parent" href="'.$prev_url.'"><span>'.$prev_label.'</span></a>'."\n".'<div class="child_wrap">'."\n".'<ul class="sub-menu">'."\n";
              break;
          case $child && !$parent :
              $side_nav .= '<li class="item"><a class="link" href="'.$prev_url.'">'.$prev_label.'</a></li>'."\n".'</ul>'."\n".'</div>'."\n".'</li>';
              break;
      }

      if(!$parent){
        $child = false;
      }else{
        $child = true;
      }

    }

    $counter++;

  endforeach;

  if(!$side_navigation_color_use_main){
    $nav_style = 'style="--tcd-side-menu-color:'.esc_attr($side_navigation_color).';"';
  }else{
    $nav_style = 'style="--tcd-word-balloon-color: rgba(var(--tcd-key1-color, 0,147,203),1);"';
  }

  if(!$word_balloon_bg_color_use_sub){
    $word_balloon_style = 'style="--tcd-word-balloon-color:'.esc_attr($word_balloon_bg_color).';"';
  }else{
    $word_balloon_style = 'style="--tcd-word-balloon-color: rgba(var(
    --tcd-key2-color, 0,48,66),1);"';
  }

?>
<div id="side_col">
 <div class="inner">
 <?php echo empty($menu_items[0]) && empty($word_balloon_desc) ? '<p class="desc no-menu">'. __('To display a custom menu, set the menu in the advanced settings.','tcd-w') .'</p>' : ''; ?>
 <?php  if($word_balloon_desc){ ?>
  <div id="side_word_balloon" <?php echo $word_balloon_style; ?>>
    <p class="desc"><span><?php echo wp_kses_post(nl2br($word_balloon_desc)); ?></span></p>
    <div class="triangle"></div>
  </div>
  <?php } ?>
  <?php if(!empty($side_navigation_type)){ ?>
  <div id="side_navigation" <?php if($use_fix_side_navigation){ echo 'class="sticky"'; } ?> <?php echo $nav_style; ?>>
    <ul class="list">
      <?php echo $side_nav; ?>
    </ul>
  </div>
  <?php } ?>
 </div>
</div>
