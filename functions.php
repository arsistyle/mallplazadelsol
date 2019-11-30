<?php
/**
 * mallplazadelsol functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package mallplazadelsol
 */

if ( ! function_exists( 'mallplazadelsol_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function mallplazadelsol_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on mallplazadelsol, use a find and replace
		 * to change 'mallplazadelsol' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'mallplazadelsol', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'principal' => esc_html__( 'Menú principal', 'mallplazadelsol' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'mallplazadelsol_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'mallplazadelsol_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mallplazadelsol_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'mallplazadelsol_content_width', 640 );
}
add_action( 'after_setup_theme', 'mallplazadelsol_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mallplazadelsol_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'mallplazadelsol' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'mallplazadelsol' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Contacto footer', 'mallplazadelsol' ),
		'id'            => 'contacto-footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'mallplazadelsol' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'mallplazadelsol_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function mallplazadelsol_scripts() {
	wp_enqueue_style( 'mallplazadelsol-style', get_stylesheet_uri() );

	//wp_enqueue_script( 'mallplazadelsol-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	//wp_enqueue_script( 'mallplazadelsol-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'mallpalazadelsol-functions', get_template_directory_uri() . '/js/alljs.min.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mallplazadelsol_scripts' );

// Pagina de opciones
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Opciones globales',
		'menu_title'	=> 'Opciones globales',
		'menu_slug' 	=> 'opciones-globales',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	acf_add_options_page(array(
		'page_title' 	=> 'Opciones Inicio',
		'menu_title'	=> 'Opciones Inicio',
		'menu_slug' 	=> 'opciones-inicio',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
}

// CORTAR IMAGENES
function crop_image($url, $width, $height = null, $crop = null, $single = true) {

	//validate inputs
		if (!$url OR !$width)
			return false;

	//define upload path & dir
		$upload_info = wp_upload_dir();
		$upload_dir = $upload_info['basedir'];
		$upload_url = $upload_info['baseurl'];

	//check if $img_url is local
		if (strpos($url, $upload_url) === false)
			return false;

	//define path of image
		$rel_path = str_replace($upload_url, '', $url);
		$img_path = $upload_dir . $rel_path;

	//check if img path exists, and is an image indeed
		if (!file_exists($img_path) OR !getimagesize($img_path))
			return false;

	//get image info
		$info = pathinfo($img_path);
		$ext = $info['extension'];
		list($orig_w, $orig_h) = getimagesize($img_path);

	//get image size after cropping
		$dims = image_resize_dimensions($orig_w, $orig_h, $width, $height, $crop);
		$dst_w = $dims[4];
		$dst_h = $dims[5];

	//use this to check if cropped image already exists, so we can return that instead
		$suffix = "{$dst_w}x{$dst_h}";
		$dst_rel_path = str_replace('.' . $ext, '', $rel_path);
		$destfilename = "{$upload_dir}{$dst_rel_path}-{$suffix}.{$ext}";

		if (!$dst_h) {
	//can't resize, so return original url
			$img_url = $url;
			$dst_w = $orig_w;
			$dst_h = $orig_h;
		}
	//else check if cache exists
		elseif (file_exists($destfilename) && getimagesize($destfilename)) {
			$img_url = "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}";
		}
	//else, we resize the image and return the new resized image url
		else {

	// Note: pre-3.5 fallback check 
			if (function_exists('wp_get_image_editor')) {

				$editor = wp_get_image_editor($img_path);

				if (is_wp_error($editor) || is_wp_error($editor->resize($width, $height, $crop)))
					return false;

				$resized_file = $editor->save();

				if (!is_wp_error($resized_file)) {
					$resized_rel_path = str_replace($upload_dir, '', $resized_file['path']);
					$img_url = $upload_url . $resized_rel_path;
				} else {
					return false;
				}
			} else {

				$resized_img_path = image_resize($img_path, $width, $height, $crop);
				if (!is_wp_error($resized_img_path)) {
					$resized_rel_path = str_replace($upload_dir, '', $resized_img_path);
					$img_url = $upload_url . $resized_rel_path;
				} else {
					return false;
				}
			}
		}

	//return the output
		if ($single) {
	//str return
			$image = $img_url;
		} else {
	//array return
			$image = array(
				0 => $img_url,
				1 => $dst_w,
				2 => $dst_h
			);
		}

		return $image;
}

