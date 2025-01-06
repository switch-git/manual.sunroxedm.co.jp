<?php
global $wp_rewrite;

$paginate_base = get_pagenum_link(1);

if (strpos($paginate_base, '?') || ! $wp_rewrite->using_permalinks()) {
	$paginate_format = '';
	$paginate_base = add_query_arg('paged', '%#%');
} else {
	$paginate_format = (substr($paginate_base, -1 ,1) == '/' ? '' : '/') .
	user_trailingslashit('page/%#%/', 'paged');
	$paginate_base .= '%_%';
}

if (show_posts_nav()) {

$post_type = get_query_var('post_type');
if(!($post_type == 'blog'||$post_type == 'news')) $post_type = 'blog';

$options = get_design_plus_option();

$total_post_num = $wp_query->found_posts;
$default_post_on_page = is_mobile()? $options['archive_'.$post_type.'_num_mobile']:$options['archive_'.$post_type.'_num'];
$temp1 = floor($total_post_num/$default_post_on_page);
$temp2 = $total_post_num%$default_post_on_page;
if($temp2>0):
	$total_page = $temp1 + 1;
else:
	$total_page = $temp1;
endif;

$paged = $paged ?: 1;
$range = is_mobile()? floor($options['pager_range_mobile']/2) : floor($options['pager_range']/2);
$show_arrow = is_mobile()? $options['pager_show_arrow_mobile'] : $options['pager_show_arrow'];

echo '<div class="page_navi clearfix">'. "\n";
$links = paginate_links( array(
	'base' => $paginate_base,
	'format' => $paginate_format,
	'total' => $total_page,
	'show_all' => true,
	'prev_next' => false,
	'current' => ($paged ? $paged : 1),
	'type' => 'array',
));
echo '<ul class="page-numbers">'. "\n";
if($paged>1){
	if($show_arrow){
		echo '<li><a class="first page-numbers" href="'.get_pagenum_link( 1 ).'"><span>&laquo;</span></a></li>';
	}
	echo '<li><a class="prev page-numbers" href="'.get_pagenum_link( $paged - 1 ).'"><span>&laquo;</span></a></li>';
}
for ($i=1; $i<=$total_page; $i++){
	if($i>=$paged-$range && $i<=$paged+$range){
		echo '<li>'. "\n";
		echo $links[$i-1]. "\n";
		echo '</li>'. "\n";
	}elseif($paged>($total_page-$range)&&$i>=($total_page-2*$range)){
		echo '<li>'. "\n";
		echo $links[$i-1]. "\n";
		echo '</li>'. "\n";
	}elseif(($range-$paged+1)>0&&$i<=(2*$range+1)){
		echo '<li>'. "\n";
		echo $links[$i-1]. "\n";
		echo '</li>'. "\n";
	}
}
if($paged<$total_page){
	echo '<li><a class="next page-numbers" href="'.get_pagenum_link( $paged + 1 ).'"><span>&raquo;</span></a></li>';
	if($show_arrow){
		echo '<li><a class="last page-numbers" href="'.get_pagenum_link( $total_page ).'"><span>&raquo;</span></a></li>';
	}
}
echo '</ul>'. "\n";
echo "\n</div>\n";
};

?>