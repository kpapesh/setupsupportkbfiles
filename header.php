<?php
/*
 * The header for displaying logo, menu, header-image, homepage-widgets and search bar.
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> >

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="<?php bloginfo( 'charset' ); ?>">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif; ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >
<div id="container">
	<div id="header-first">
		<div class="logo"> 
			<?php if ( get_theme_mod( 'myknowledgebase_logo' ) ) : ?> 
				<a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'>
				<img src='<?php echo esc_url( get_theme_mod( 'myknowledgebase_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'></a> 
			<?php else : ?> 
				<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></h1>
				<h2><?php bloginfo('description'); ?></h2> 
			<?php endif; ?>
		</div>

		<?php if ( has_nav_menu( 'primary' ) ) : ?> 
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container_class' => 'nav-head' ) ); ?>
		<?php endif; ?>
	</div>

	<?php if ( is_front_page() ) {?> 
	<?php if ( get_header_image() ) {?> 
	<div id="header-second">
		<div class="image-homepage"> 
			<img src="<?php echo get_header_image(); ?>" class="header-img" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
		</div>

		<?php if ( is_active_sidebar( 'homepage' ) ) {?> 
		<div class="sidebar-homepage"> 
			<?php dynamic_sidebar( 'homepage' ); ?>
		</div>
		<?php } ?>
	</div>
	<?php } ?> 
	<?php } ?>

	<div id="header-third"> 
		<?php if ( get_theme_mod( 'myknowledgebase_search' ) ) {
			$search_title = esc_attr( get_theme_mod( 'myknowledgebase_search' ) );
		} else {
			$search_title = esc_attr__( 'Search Posts', 'myknowledgebase' );
		} ?>

		<h3 class="searchbar-title"><?php echo $search_title; ?></h3>
		<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>"> 
			<input type="search" class="search-field" placeholder="<?php echo $search_title; ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo $search_title; ?>" /> 
			<input type="submit" class="search-submit" value="<?php _e( 'Search', 'myknowledgebase' ) ?>" />
			<input type="hidden" name="post_type" value="post" />
<?php do_action('add_checkbox_under_search'); ?>
		</form>
	</div>