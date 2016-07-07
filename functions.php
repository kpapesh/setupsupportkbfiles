<?php
/*
 * Theme functions and definitions.
 */

// Sets up theme defaults and registers various WordPress features that MyKnowledgeBase supports
	function myknowledgebase_setup() { 
		// Set max content width for img, video, and more
			global $content_width; 
			if ( ! isset( $content_width ) )
			$content_width = 780;

		// Make theme available for translation
			load_theme_textdomain('myknowledgebase', get_template_directory() . '/languages');  

		// Register Menu
			register_nav_menus( array( 
				'primary' => __( 'Primary Navigation', 'myknowledgebase' ), 
		 	) ); 

		// Add document title
			add_theme_support( 'title-tag' );

		// Add editor styles
			add_editor_style( 'custom-editor-style.css' );

		// Custom header	
			$header_args = array(		
				'width' => 600,
				'height' => 400,
				'default-image' => get_template_directory_uri() . '/images/boats.jpg',
				'header-text' => false,
				'uploads' => true,
			);	
			add_theme_support( 'custom-header', $header_args );

		// Default header
			register_default_headers( array(
				'boats' => array(
					'url' => get_template_directory_uri() . '/images/boats.jpg',
					'thumbnail_url' => get_template_directory_uri() . '/images/boats.jpg',
					'description' => __( 'Default header', 'myknowledgebase' )
				)
			) );

		// Post thumbnails
			add_theme_support( 'post-thumbnails' ); 

		// Resize thumbnails
			set_post_thumbnail_size( 250, 250 ); 

		// Resize single page thumbnail
			add_image_size( 'single', 250, 250 ); 

		// This feature adds RSS feed links to html head 
			add_theme_support( 'automatic-feed-links' );

		// Switch default core markup for search form, comment form, comments and caption to output valid html5
			add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'caption' ) );

		// Background color
			$background_args = array( 
				'default-color' => 'ffffff', 
			); 
			add_theme_support( 'custom-background', $background_args );

		// Post formats
			add_theme_support( 'post-formats', array( 'aside', 'status', 'image', 'video', 'gallery', 'audio' ) );
	}
	add_action( 'after_setup_theme', 'myknowledgebase_setup' ); 


// Add html5 support for IE 8 and older 
	function myknowledgebase_html5() { 
		echo '<!--[if lt IE 9]>'. "\n"; 
		echo '<script src="' . esc_url( get_template_directory_uri() . '/js/ie.js' ) . '"></script>'. "\n"; 
		echo '<![endif]-->'. "\n"; 
	}
	add_action( 'wp_head', 'myknowledgebase_html5' ); 


// Enqueues scripts and styles for front-end
	function myknowledgebase_scripts() {
		wp_enqueue_style( 'myknowledgebase-style', get_stylesheet_uri() );
		wp_enqueue_script( 'myknowledgebase-nav', get_template_directory_uri() . '/js/nav.js', array( 'jquery' ) );
		wp_enqueue_style( 'myknowledgebase-googlefonts', '//fonts.googleapis.com/css?family=Open+Sans' ); 

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// mobile nav args
		$myknowledgebase_mobile_nav_args = array(
			'navText' => __( 'Menu', 'myknowledgebase' )
		);
		// localize script with data for mobile nav
		wp_localize_script( 'myknowledgebase-nav', 'objectL10n', $myknowledgebase_mobile_nav_args );
	}
	add_action( 'wp_enqueue_scripts', 'myknowledgebase_scripts' );


// Sidebars
	function myknowledgebase_widgets_init() {
		register_sidebar( array(
			'name' => __( 'Primary Sidebar', 'myknowledgebase' ),
			'id' => 'primary',
			'description' => __( 'You can add one or multiple widgets here.', 'myknowledgebase' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>',
		) );

		register_sidebar( array(
			'name' => __( 'Homepage Sidebar', 'myknowledgebase' ),
			'id' => 'homepage',
			'description' => __( 'You can add one or multiple widgets here.', 'myknowledgebase' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>',
		) );

		register_sidebar( array(
			'name' => __( 'Footer Right', 'myknowledgebase' ),
			'id' => 'footer-right',
			'description' => __( 'You can add one or multiple widgets here.', 'myknowledgebase' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>',
		) );

		register_sidebar( array(
			'name' => __( 'Footer Middle', 'myknowledgebase' ),
			'id' => 'footer-middle',
			'description' => __( 'You can add one or multiple widgets here.', 'myknowledgebase' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>',
		) );

		register_sidebar( array(
			'name' => __( 'Footer Left', 'myknowledgebase' ),
			'id' => 'footer-left',
			'description' => __( 'You can add one or multiple widgets here.', 'myknowledgebase' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>',
		) );
	}
	add_action( 'widgets_init', 'myknowledgebase_widgets_init' );


// Add class to post nav 
	function myknowledgebase_post_next() { 
		return 'class="nav-next"'; 
	}
	add_filter('next_posts_link_attributes', 'myknowledgebase_post_next', 999); 

	function myknowledgebase_post_prev() { 
		return 'class="nav-prev"'; 
	}
	add_filter('previous_posts_link_attributes', 'myknowledgebase_post_prev', 999); 


// Add class to comment nav 
	function myknowledgebase_comment_next() { 
		return 'class="comment-next"'; 
	}
	add_filter('next_comments_link_attributes', 'myknowledgebase_comment_next', 999); 

	function myknowledgebase_comment_prev() { 
		return 'class="comment-prev"'; 
	}
	add_filter('previous_comments_link_attributes', 'myknowledgebase_comment_prev', 999); 


// Custom excerpt lenght (default length is 55 words)
	function myknowledgebase_excerpt_length( $length ) { 
		return 75; 
	} 
	add_filter( 'excerpt_length', 'myknowledgebase_excerpt_length', 999 ); 


// Theme Customizer (logo and searchbar title and posts per category)
	function myknowledgebase_theme_customizer( $wp_customize ) { 
		$wp_customize->add_section( 'myknowledgebase_logo_section' , array( 
			'title' => __( 'Logo', 'myknowledgebase' ), 
			'priority' => 30, 
			'description' => __( 'Upload a logo to replace blogname and description in header.', 'myknowledgebase' ),
		) );
		$wp_customize->add_setting( 'myknowledgebase_logo', array( 
			'capability' => 'edit_theme_options', 
			'sanitize_callback' => 'esc_url_raw', 
		) ); 
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'myknowledgebase_logo', array( 
			'label' => __( 'Logo', 'myknowledgebase' ), 
			'section' => 'myknowledgebase_logo_section', 
			'settings' => 'myknowledgebase_logo', 
		) ) );
		$wp_customize->add_section( 'myknowledgebase_posts_section' , array( 	
			'title' => __( 'Knowledgebase', 'myknowledgebase' ), 
			'priority' => 31, 
			'description' => __( 'Set amount of posts for each knowledgebase category.', 'myknowledgebase' ),
		) );
		$wp_customize->add_setting( 'myknowledgebase_posts', array( 
			'capability' => 'edit_theme_options', 
			'sanitize_callback' => 'sanitize_text_field', 
		) ); 
		$wp_customize->add_control( new WP_Customize_Control ( $wp_customize, 'myknowledgebase_posts', array( 
			'label' => __( 'Posts per category', 'myknowledgebase' ), 
			'description' => __( 'Only numeric characters allowed.', 'myknowledgebase' ), 
			'section' => 'myknowledgebase_posts_section', 
			'type' => 'number', 
			'settings' => 'myknowledgebase_posts', 
		) ) );
		$wp_customize->add_section( 'myknowledgebase_search_section' , array( 	
			'title' => __( 'Search Bar', 'myknowledgebase' ), 
			'priority' => 32, 
			'description' => __( 'Change title of the knowledgebase search bar.', 'myknowledgebase' ),
		) );
		$wp_customize->add_setting( 'myknowledgebase_search', array( 
			'capability' => 'edit_theme_options', 
			'sanitize_callback' => 'sanitize_text_field', 
		) ); 
		$wp_customize->add_control( new WP_Customize_Control ( $wp_customize, 'myknowledgebase_search', array( 
			'label' => __( 'Search Bar Title', 'myknowledgebase' ), 
			'description' => __( 'This will overwrite the default title.', 'myknowledgebase' ), 
			'section' => 'myknowledgebase_search_section', 
			'settings' => 'myknowledgebase_search', 
		) ) );

	} 
	add_action('customize_register', 'myknowledgebase_theme_customizer');

//custom section
function my_wp_nav_menu_args( $args = '' ) {

if( is_user_logged_in() ) {
    $args['menu'] = 'Home - Logged In';
    } else {
      $args['menu'] = 'Home - Logged Out';
      }
	return $args;

}
add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );

//trim private or protected off of titles.
function the_title_trim($title)
{
    $pattern[0] = '/Protected:/';
    $pattern[1] = '/Private:/';
    $replacement[0] = ''; // Enter some text to put in place of Protected:
    $replacement[1] = ''; // Enter some text to put in place of Private:

    return preg_replace($pattern, $replacement, $title);
}

add_filter('the_title', 'the_title_trim');

//show private posts if user is a 'Contributor'
function fb_add_cap2role() {
    global $wp_roles;

    $wp_roles->add_cap('Contributor', 'read_private_posts');
}
add_action( 'init', 'fb_add_cap2role' );

//Show all categories (even if empty)
add_filter( 'widget_categories_args', 'show_private_post_in_widget' );
function show_private_post_in_widget( $cat_args ) {

    if( current_user_can( 'read_private_posts' ) ) {
        $cat_args['hide_empty'] = 0;
    }

    return $cat_args;
}

?>
