<?php
/*
 * The sidebar for displaying widgets.
 */
?>

<?php if ( is_active_sidebar( 'primary' ) ) {?>
	<div id="sidebar">
       <?php dynamic_sidebar( 'primary' ); ?>
           <?php if( is_user_logged_in() ) {?>
           <?php $cat_args=array(
                                'orderby' => 'name',
                                'order' => 'ASC'
                                );
                    $categories=get_categories($cat_args);
                    foreach($categories as $category) {
                           $args=array(
                           'showposts' => -1,
                           'category__in' => array($category->term_id),
                           'caller_get_posts'=>1
              ); } ?>
              <h4>Recent Posts</h4>
              <ul>
              <?php
              $args = array( 'numberposts' => '5' );
              $recent_posts = wp_get_recent_posts( $args );

              foreach( $recent_posts as $recent ){
                    echo '<li><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </li> ';
              }?>
              <hr color="#eee">
              <h4>Categories</h4>
              <ul>
              <?php wp_list_categories('title_li=&hide_empty=0'); ?>
	      <hr color="#eee">
              <h4>Tag Cloud</h4>
              <ul>
              <?php wp_tag_cloud('hide_empty=0'); ?>
              <hr color="#eee">
<?php } ?>
</ul>
</div>
           
<?php } ?>
