<?php
/*
 * The template for displaying single post.
 */
?>

<?php get_header(); ?>
<div id="content">

	<?php while (have_posts()) : the_post(); ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 
			<h1 class="post-title-single"><?php the_title(); ?></h1>

			<?php get_template_part( 'content-postmeta' ); ?>

			<?php if (has_post_format('status') ) {?>
				<?php printf( '<a href="%1$s">%2$s</a>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), get_avatar( get_the_author_meta( 'ID' ), 96 )  ); ?>
			<?php } ?>
	
			<?php the_content(); ?>

			<?php if ( $multipage ) { ?>
				<div class="pagelink"><?php wp_link_pages(); ?></div>
			<?php } ?> 
<hr>
<h5>Attached Files:</h5>
<?php
$args = array( 'post_type' => 'attachment', 'posts_per_page' => -1, 'post_status' =>'any', 'post_parent' => $post->ID );
$attachments = get_posts( $args );
if ( $attachments ) {
    foreach ( $attachments as $attachment ) {
        //echo apply_filters( 'the_ext' , $attachment->post_content );
        the_attachment_link( $attachment->ID , false );
        echo ' | ';
    }
} else {
    echo "<p><em>No attached files</em>.</p>";
    }
?>
<hr>
			<?php get_template_part( 'content-postmeta-single' ); ?>
		</div>
		<?php comments_template(); ?>

	<?php endwhile; ?>

	<?php

$url = get_permalink();
$urllen = strlen($url);
$urlid = get_the_ID();
$urlidlen = strlen($urlid);
$urlsubtract = $urlidlen + 2;
$urlpos = $urllen - $urlsubtract;
$addurl = substr_replace($url, 'page_id=527&task=edit&',$urlpos,0);
$finalpos = strlen($addurl) - $urlsubtract;
$addurl2 = substr_replace($addurl, 'postid=' . $urlid, $finalpos,0);
$finalurl = substr($addurl2, 0, -$urlsubtract);
$editlink = '<a href="' . $finalurl . '">Edit</a>';

//edit_post_link( __( 'Edit', 'myknowledgebase' ), '<div class="edit-link">', '</div>' );
edit_post_link( $editlink, '<div class="edit-link">', '</div>' );
     ?>

</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>