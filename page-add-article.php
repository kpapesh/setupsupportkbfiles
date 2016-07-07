<?php
/* 
 * Template Name: Add Article Template
 * Description: template for add article form.
 */
?>

<?php get_header(); ?>
<div id="content">

	<?php while ( have_posts() ) : the_post(); ?>

		<h1 class="page-title"><?php the_title(); ?></h1>

		<?php if ( has_post_thumbnail() ) { 
			the_post_thumbnail('single', array('class' => 'single-image')); 
		} ?>

		<?php the_content(); ?>

		<?php if ( $multipage ) { ?>
			<div class="pagelink"><?php wp_link_pages(); ?></div>
		<?php } ?>
<?php

$user = wp_get_current_user();


/* submit post */
if(isset($_POST['new_post']) == '1') {
    $post_title = $_POST['post_title'];
    $post_category = array( $_POST['cat'] );
    $post_content = $_POST['post_content'];
    $tags_input = trim( $_POST['tags_input'] );

    $post = array(
        'ID' => '',
        'post_author' => $user->ID,
        'post_title' => wp_strip_all_tags( $_POST['post_title'] ),
        'post_content' => $_POST['post_content'],
        'post_status' => 'pending',
        'post_category' => $post_category,
        'tags_input' => $_POST['tags_input']
    );
    
    //Check if post title is empty
    if(empty( $_POST['post_title'] )){
        echo '<font color="red">Title is Empty!</font><br>';
     }

    //Check if post content is empty
    if(empty( $_POST['post_content'] )){
        echo '<font color="red">Body is Empty!</font><br>';
    }

    //insert post
    $post_id = wp_insert_post($post);

    echo 'post submitted successfully<br><br>';

    /* File Attachment */
    include_once ABSPATH . 'wp-admin/includes/media.php';
    include_once ABSPATH . 'wp-admin/includes/file.php';
    include_once ABSPATH . 'wp-admin/includes/image.php';

    
    $attachment_id = media_handle_upload('post_file', $post_id);
       
    if(is_numeric($attachment_id)){
    
    update_post_meta($post_id, 'post_file', $attachment_id);
    
    echo 'file uploaded successfully.<br><br>';
    
     }
    
}
    
?>

<form method="post" action="" enctype="multipart/form-data">
                             
    Title<font color="red">*</font><br>
                             
    <input type="text" name="post_title" size="45" id="input-title"/><br><br>

    Category<font color="red">*</font><br>

    <!---to show default category use value_name=name&selected={categoryname}--->
    <?php wp_dropdown_categories('taxonomy=category&name=cat&orderby=name&hide_empty=0&hierarchical=1'); ?><br><br>

    Tags<br>
    <sub>separate multiple tags by commas</sub><br>
    <input type="text" name="tags_input" size="45" id="tags-input"/><br><br>
                             
    Body<font color="red">*</font>
<?php wp_editor('','post_content', array('media_buttons' => false)); ?><br><br>

    Attach File<br>                                                            
    <input type="file" name="post_file"/><br><br>
    
                                                                
    <input type="hidden" name="new_post" value="1"/>
                             
    <input class="subput round" type="submit" name="submit" value="Submit"/>
</form>

	<?php endwhile; ?>

</div>		
<?php get_sidebar(); ?>
<?php get_footer(); ?>
