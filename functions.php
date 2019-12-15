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
		'icon_url' 		=> 'dashicons-admin-site',
		'redirect'		=> false
	));
	acf_add_options_page(array(
		'page_title' 	=> 'Opciones Inicio',
		'menu_title'	=> 'Opciones Inicio',
		'menu_slug' 	=> 'opciones-inicio',
		'capability'	=> 'edit_posts',
		'icon_url'    => 'dashicons-admin-home',
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

/*** Inicio Modo Mantenimiento ***/
function mode_maintenance(){

		$logo = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxNTEuMyAyNDcuODYiPjxkZWZzPjxzdHlsZT4uY2xzLTF7ZmlsbDojYzcyNDYzO30uY2xzLTJ7ZmlsbDojMWNiNDhkO30uY2xzLTN7ZmlsbDojZjVjNzNkO30uY2xzLTR7ZmlsbDojMzMzO308L3N0eWxlPjwvZGVmcz48dGl0bGU+cGxhemEtZGVsLXNvbDwvdGl0bGU+PGcgaWQ9IkNhcGFfMiIgZGF0YS1uYW1lPSJDYXBhIDIiPjxnIGlkPSJDYXBhXzEtMiIgZGF0YS1uYW1lPSJDYXBhIDEiPjxwYXRoIGNsYXNzPSJjbHMtMSIgZD0iTTEyNi41OCw4OS40NkE1Ni4yMSw1Ni4yMSwwLDAsMCw4Ny42NywwYTg3LjYxLDg3LjYxLDAsMCwxLDI2LjE1LDI1QzEyOC42Nyw0Ni4zMywxMzIuODUsNzEsMTI2LjU4LDg5LjQ2WiIvPjxwYXRoIGNsYXNzPSJjbHMtMiIgZD0iTTExMy43LDM4LjA4YTU2LjIsNTYuMiwwLDAsMC05Ni45Mi0xMUE4Ny42LDg3LjYsMCwwLDEsNTEuNDYsMTYuODhDNzcuNCwxNC43LDEwMC44NSwyMy40MiwxMTMuNywzOC4wOFoiLz48cGF0aCBjbGFzcz0iY2xzLTMiIGQ9Ik02Mi43NywyMy41NEE1Ni4yMiw1Ni4yMiwwLDAsMCw0Ljc1LDEwMmE4Ny41Niw4Ny41NiwwLDAsMSw4LjU0LTM1LjEyQzI0LjM3LDQzLjMsNDMuNjUsMjcuMzUsNjIuNzcsMjMuNTRaIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNMjQuNzEsNjAuMzlhNTYuMjEsNTYuMjEsMCwwLDAsMzguOTEsODkuNDUsODcuNyw4Ny43LDAsMCwxLTI2LjE0LTI1QzIyLjYzLDEwMy41MSwxOC40NSw3OC44NSwyNC43MSw2MC4zOVoiLz48cGF0aCBjbGFzcz0iY2xzLTIiIGQ9Ik0zNy41OSwxMTEuNzZhNTYuMjIsNTYuMjIsMCwwLDAsOTYuOTMsMTFBODcuNTksODcuNTksMCwwLDEsOTkuODQsMTMzQzczLjksMTM1LjE0LDUwLjQ1LDEyNi40MiwzNy41OSwxMTEuNzZaIi8+PHBhdGggY2xhc3M9ImNscy0zIiBkPSJNODguNTMsMTI2LjNhNTYuMjEsNTYuMjEsMCwwLDAsNTgtNzguNDJBODcuNjYsODcuNjYsMCwwLDEsMTM4LDgzQzEyNi45MiwxMDYuNTQsMTA3LjY1LDEyMi40OSw4OC41MywxMjYuM1oiLz48cGF0aCBjbGFzcz0iY2xzLTQiIGQ9Ik01MSwxODQuNjNhMS4yNCwxLjI0LDAsMCwxLS45Mi0uMzgsMS4yNiwxLjI2LDAsMCwxLS4zOC0uOTJWMTY2LjRhMS4zLDEuMywwLDAsMSwyLjQ1LS42TDYwLDE4MS40OGgtLjhsNy42Mi0xNS42OGExLjI5LDEuMjksMCwwLDEsMi40NS42djE2LjkzYTEuMjMsMS4yMywwLDAsMS0uMzkuOTIsMS4yNywxLjI3LDAsMCwxLS45MS4zOCwxLjI0LDEuMjQsMCwwLDEtLjkyLS4zOCwxLjI2LDEuMjYsMCwwLDEtLjM4LS45MlYxNzBsLjUtLjEyLTYuNTUsMTMuMzVhMS4yOSwxLjI5LDAsMCwxLTEuMTIuNjUsMS4yNSwxLjI1LDAsMCwxLTEuMi0uNzhsLTYuNDgtMTMsLjUtLjEzdjEzLjMzYTEuMjUsMS4yNSwwLDAsMS0uMzcuOTJBMS4yNywxLjI3LDAsMCwxLDUxLDE4NC42M1oiLz48cGF0aCBjbGFzcz0iY2xzLTQiIGQ9Ik03OS43NCwxODQuNzNhNiw2LDAsMCwxLTMuMjgtLjkyLDYuNDcsNi40NywwLDAsMS0yLjI4LTIuNDcsNy4zNSw3LjM1LDAsMCwxLS44NC0zLjU0LDcsNywwLDAsMSwuOTEtMy41NSw2LjcxLDYuNzEsMCwwLDEsMi40OC0yLjQ4LDcuMTQsNy4xNCwwLDAsMSw3LDAsNi43Myw2LjczLDAsMCwxLDIuNDYsMi40OCw3LDcsMCwwLDEsLjkyLDMuNTVoLTFhNy4zNSw3LjM1LDAsMCwxLS44NCwzLjU0QTYuNDcsNi40NywwLDAsMSw4MywxODMuODEsNiw2LDAsMCwxLDc5Ljc0LDE4NC43M1ptLjUtMi4yNWE0LjI4LDQuMjgsMCwwLDAsMy44NS0yLjI5LDUsNSwwLDAsMCwuNTctMi4zOSw1LDUsMCwwLDAtLjU3LTIuNDEsNC4zOCw0LjM4LDAsMCwwLTcuNzEsMCw0LjkyLDQuOTIsMCwwLDAtLjU5LDIuNDEsNC44Nyw0Ljg3LDAsMCwwLC41OSwyLjM5LDQuMzcsNC4zNywwLDAsMCwzLjg2LDIuMjlabTUuNiwyLjE3YTEuMjMsMS4yMywwLDAsMS0uOTEtLjM2LDEuMjQsMS4yNCwwLDAsMS0uMzYtLjkxdi0zLjgzTDg1LDE3Ni45bDIuMDguOXY1LjU4YTEuMjUsMS4yNSwwLDAsMS0uMzcuOTFBMS4yMywxLjIzLDAsMCwxLDg1Ljg0LDE4NC42NVoiLz48cGF0aCBjbGFzcz0iY2xzLTQiIGQ9Ik05NC4xNiwxODQuNjNhMy4zMSwzLjMxLDAsMCwxLTItLjYsNC4wNyw0LjA3LDAsMCwxLTEuMzItMS42NCw1LjYzLDUuNjMsMCwwLDEtLjQ4LTIuMzlWMTY2LjM1YTEuMiwxLjIsMCwwLDEsMS4yNS0xLjI1LDEuMiwxLjIsMCwwLDEsMS4yNSwxLjI1VjE4MGEzLDMsMCwwLDAsLjM1LDEuNTMsMSwxLDAsMCwwLC45LjZoLjYzYTEsMSwwLDAsMSwuODEuMzUsMS4yOCwxLjI4LDAsMCwxLC4zMS45LDEuMDgsMS4wOCwwLDAsMS0uNDcuOSwyLjA2LDIuMDYsMCwwLDEtMS4yMy4zNVoiLz48cGF0aCBjbGFzcz0iY2xzLTQiIGQ9Ik0xMDEuNjYsMTg0LjYzYTMuMzEsMy4zMSwwLDAsMS0yLS42LDQuMDcsNC4wNywwLDAsMS0xLjMyLTEuNjQsNS42Myw1LjYzLDAsMCwxLS40OC0yLjM5VjE2Ni4zNWExLjIsMS4yLDAsMCwxLDEuMjUtMS4yNSwxLjIsMS4yLDAsMCwxLDEuMjUsMS4yNVYxODBhMywzLDAsMCwwLC4zNSwxLjUzLDEsMSwwLDAsMCwuOS42aC42M2ExLDEsMCwwLDEsLjgxLjM1LDEuMjgsMS4yOCwwLDAsMSwuMzEuOSwxLjA4LDEuMDgsMCwwLDEtLjQ3LjksMi4wNiwyLjA2LDAsMCwxLTEuMjMuMzVaIi8+PHBhdGggY2xhc3M9ImNscy00IiBkPSJNMjcuMjEsMjE4LjYxYTIsMiwwLDAsMS0yLTJWMTkwYTIsMiwwLDAsMSwuNTktMS40NywyLDIsMCwwLDEsMS40NS0uNTdoNy44NWExMC40MiwxMC40MiwwLDAsMSw1LjIyLDEuMyw5LjIxLDkuMjEsMCwwLDEsMy41NSwzLjU5LDEwLjY5LDEwLjY5LDAsMCwxLDEuMjcsNS4yOCwxMC4xMSwxMC4xMSwwLDAsMS0xLjI3LDUuMSw5LjA5LDkuMDksMCwwLDEtMy41NSwzLjQ5QTEwLjYxLDEwLjYxLDAsMCwxLDM1LjA2LDIwOEgyOS4yNXY4LjU5YTIsMiwwLDAsMS0uNTcsMS40NUEyLDIsMCwwLDEsMjcuMjEsMjE4LjYxWm0yLTE0LjRoNS44MWE2LjI1LDYuMjUsMCwwLDAsMy4xOC0uNzksNS42OSw1LjY5LDAsMCwwLDIuMTUtMi4xNSw2LjE4LDYuMTgsMCwwLDAsLjc5LTMuMTQsNi43NCw2Ljc0LDAsMCwwLS43OS0zLjMyLDUuODIsNS44MiwwLDAsMC0yLjE1LTIuMjUsNi4wOCw2LjA4LDAsMCwwLTMuMTgtLjgzSDI5LjI1WiIvPjxwYXRoIGNsYXNzPSJjbHMtNCIgZD0iTTU0LjMyLDIxOC42MWE1LjE2LDUuMTYsMCwwLDEtMy4wNi0uOTQsNi4zMiw2LjMyLDAsMCwxLTIuMDgtMi41Nyw5LjA2LDkuMDYsMCwwLDEtLjc0LTMuNzVWMTg5LjkzYTIsMiwwLDEsMSwzLjkyLDB2MjEuNDJhNC42Miw0LjYyLDAsMCwwLC41NSwyLjM5LDEuNjMsMS42MywwLDAsMCwxLjQxLjk1aDFhMS42NSwxLjY1LDAsMCwxLDEuMjguNTQsMiwyLDAsMCwxLC40OSwxLjQyLDEuNjksMS42OSwwLDAsMS0uNzUsMS40MSwzLjEsMy4xLDAsMCwxLTEuOTIuNTVaIi8+PHBhdGggY2xhc3M9ImNscy00IiBkPSJNNjguNzYsMjE4Ljc3YTkuNDIsOS40MiwwLDAsMS01LjE0LTEuNDRBMTAuMjUsMTAuMjUsMCwwLDEsNjAsMjEzLjQ1YTExLjY2LDExLjY2LDAsMCwxLTEuMzEtNS41NSwxMC44MiwxMC44MiwwLDAsMSwxLjQzLTUuNTdBMTAuNjIsMTAuNjIsMCwwLDEsNjQsMTk4LjQyLDEwLjgxLDEwLjgxLDAsMCwxLDY5LjU1LDE5N2ExMC41NiwxMC41NiwwLDAsMSw5LjM2LDUuMzQsMTAuOTIsMTAuOTIsMCwwLDEsMS40Myw1LjU3SDc4LjgxYTExLjU1LDExLjU1LDAsMCwxLTEuMzIsNS41NSwxMC4xLDEwLjEsMCwwLDEtMy41OSwzLjg4QTkuMzksOS4zOSwwLDAsMSw2OC43NiwyMTguNzdabS43OS0zLjU0YTYuNjMsNi42MywwLDAsMCwzLjU3LTEsNi44LDYuOCwwLDAsMCwyLjQ3LTIuNjMsNy43NSw3Ljc1LDAsMCwwLC45LTMuNzQsNy44Myw3LjgzLDAsMCwwLS45LTMuNzksNi44Nyw2Ljg3LDAsMCwwLTIuNDctMi42Myw3LjA4LDcuMDgsMCwwLDAtNy4xMiwwLDYuOSw2LjksMCwwLDAtMi41MSwyLjYzLDcuNjMsNy42MywwLDAsMC0uOTMsMy43OSw3LjU1LDcuNTUsMCwwLDAsLjkzLDMuNzRBNi44Myw2LjgzLDAsMCwwLDY2LDIxNC4yNyw2LjY0LDYuNjQsMCwwLDAsNjkuNTUsMjE1LjIzWm04Ljc5LDMuNDJhMiwyLDAsMCwxLTEuNDQtLjU3LDIsMiwwLDAsMS0uNTYtMS40M3YtNmwuNzQtNC4xNiwzLjI2LDEuNDJ2OC43NWExLjk1LDEuOTUsMCwwLDEtMiwyWiIvPjxwYXRoIGNsYXNzPSJjbHMtNCIgZD0iTTg2Ljc3LDIwMC44M2ExLjg0LDEuODQsMCwxLDEsMC0zLjY4aDEzLjM4YTEuODQsMS44NCwwLDEsMSwwLDMuNjhabS4zOSwxNy43OGExLjg1LDEuODUsMCwwLDEsMC0zLjY5aDEzLjM4YTEuODUsMS44NSwwLDEsMSwwLDMuNjlabTEuMTgtLjc1LTIuNjctMi4zNUw5OSwxOTcuODlsMi42MywyLjM2WiIvPjxwYXRoIGNsYXNzPSJjbHMtNCIgZD0iTTExNS42NSwyMTguNzdhOS40Miw5LjQyLDAsMCwxLTUuMTQtMS40NCwxMC4xNywxMC4xNywwLDAsMS0zLjU5LTMuODgsMTEuNTUsMTEuNTUsMCwwLDEtMS4zMS01LjU1LDEwLjgyLDEwLjgyLDAsMCwxLDEuNDMtNS41NywxMC42MiwxMC42MiwwLDAsMSwzLjg4LTMuOTEsMTAuODEsMTAuODEsMCwwLDEsNS41Mi0xLjQzLDEwLjUyLDEwLjUyLDAsMCwxLDkuMzUsNS4zNCwxMC44MywxMC44MywwLDAsMSwxLjQ0LDUuNTdIMTI1LjdhMTEuNTUsMTEuNTUsMCwwLDEtMS4zMiw1LjU1LDEwLjE3LDEwLjE3LDAsMCwxLTMuNTksMy44OEE5LjQyLDkuNDIsMCwwLDEsMTE1LjY1LDIxOC43N1ptLjc5LTMuNTRhNi42Myw2LjYzLDAsMCwwLDMuNTctMSw2LjgsNi44LDAsMCwwLDIuNDctMi42Myw3Ljc1LDcuNzUsMCwwLDAsLjktMy43NCw3LjgzLDcuODMsMCwwLDAtLjktMy43OSw2Ljg3LDYuODcsMCwwLDAtMi40Ny0yLjYzLDcuMSw3LjEsMCwwLDAtNy4xMywwLDcuMDUsNy4wNSwwLDAsMC0yLjUxLDIuNjMsNy43Myw3LjczLDAsMCwwLS45MiwzLjc5LDcuNjUsNy42NSwwLDAsMCwuOTIsMy43NCw3LDcsMCwwLDAsMi41MSwyLjYzQTYuNjcsNi42NywwLDAsMCwxMTYuNDQsMjE1LjIzWm04Ljc5LDMuNDJhMS45NSwxLjk1LDAsMCwxLTItMnYtNmwuNzUtNC4xNiwzLjI2LDEuNDJ2OC43NWExLjk1LDEuOTUsMCwwLDEtMiwyWiIvPjxwYXRoIGNsYXNzPSJjbHMtNCIgZD0iTTMwLjgxLDI0Ny42N2E4LjQzLDguNDMsMCwwLDEtNC4zMi0xLjEyLDguMzQsOC4zNCwwLDAsMS0zLTMuMDYsOC41LDguNSwwLDAsMS0xLjEyLTQuMzYsOSw5LDAsMCwxLDEtNC4zNSw4LDgsMCwwLDEsMi44MS0zLjA1LDcuNjUsNy42NSwwLDAsMSwxMCwxLjY4di04LjNhMS41MSwxLjUxLDAsMCwxLC40NS0xLjE0LDEuNywxLjcsMCwwLDEsMi4yNiwwLDEuNTgsMS41OCwwLDAsMSwuNDMsMS4xNHYxNGE4LjYsOC42LDAsMCwxLTEuMTIsNC4zNiw4LjI3LDguMjcsMCwwLDEtNy4zNCw0LjE4Wm0wLTIuNzZhNS4xOCw1LjE4LDAsMCwwLDIuOC0uNzYsNS4zLDUuMywwLDAsMCwxLjk0LTIuMDcsNi4xOCw2LjE4LDAsMCwwLC43MS0zLDYsNiwwLDAsMC0uNzEtMi45NSw1LjMyLDUuMzIsMCwwLDAtMS45NC0yLjA1LDUuNTYsNS41NiwwLDAsMC01LjU4LDAsNS40Nyw1LjQ3LDAsMCwwLTIsMi4wNSw1Ljk0LDUuOTQsMCwwLDAtLjcyLDIuOTUsNi4wOCw2LjA4LDAsMCwwLC43MiwzLDUuNDUsNS40NSwwLDAsMCwyLDIuMDdBNS4yMSw1LjIxLDAsMCwwLDMwLjgxLDI0NC45MVoiLz48cGF0aCBjbGFzcz0iY2xzLTQiIGQ9Ik01Mi43LDI0Ny42N2E5LjIsOS4yLDAsMCwxLTQuNTMtMS4wOSw4LDgsMCwwLDEtMy4xMS0zLDguNjYsOC42NiwwLDAsMS0xLjEyLTQuNDFBOSw5LDAsMCwxLDQ1LDIzNC43MmE3Ljc2LDcuNzYsMCwwLDEsMi45NC0zLDguNDYsOC40NiwwLDAsMSw0LjMtMS4wOSw3LjY4LDcuNjgsMCwwLDEsNC4xMiwxLjA2QTYuODksNi44OSwwLDAsMSw1OSwyMzQuNTlhOS43NCw5Ljc0LDAsMCwxLC45MSw0LjI5LDEuMzIsMS4zMiwwLDAsMS0uNCwxLDEuNCwxLjQsMCwwLDEtMSwuMzhINDYuMDl2LTIuNDZoMTIuM2wtMS4yNi44N2E2Ljc0LDYuNzQsMCwwLDAtLjYxLTIuNzYsNC40OSw0LjQ5LDAsMCwwLTQuMjgtMi42Myw1LjY1LDUuNjUsMCwwLDAtMywuNzcsNSw1LDAsMCwwLTEuODksMi4xMSw2Ljg4LDYuODgsMCwwLDAtLjY0LDMsNS43OSw1Ljc5LDAsMCwwLC43NywzLDUuNiw1LjYsMCwwLDAsMi4xMiwyLjA5LDYuMTcsNi4xNywwLDAsMCwzLjEuNzcsNiw2LDAsMCwwLDItLjM1LDYuMTgsNi4xOCwwLDAsMCwxLjYxLS44MiwxLjc4LDEuNzgsMCwwLDEsMS0uMzUsMS4zOCwxLjM4LDAsMCwxLC45NC4zMiwxLjUsMS41LDAsMCwxLC41NSwxLDEuMDksMS4wOSwwLDAsMS0uNDksMSw4LjcyLDguNzIsMCwwLDEtMi42LDEuMzVBOS4yNSw5LjI1LDAsMCwxLDUyLjcsMjQ3LjY3WiIvPjxwYXRoIGNsYXNzPSJjbHMtNCIgZD0iTTY3Ljg5LDI0Ny41NWE0LjA5LDQuMDksMCwwLDEtMi40LS43NCw0Ljg2LDQuODYsMCwwLDEtMS42My0yLDcsNywwLDAsMS0uNTgtMi45NFYyMjUuMDhhMS40NywxLjQ3LDAsMCwxLDEuNTQtMS41NCwxLjQ2LDEuNDYsMCwwLDEsMS4xLjQzLDEuNSwxLjUsMCwwLDEsLjQzLDEuMTF2MTYuNzhhMy43NiwzLjc2LDAsMCwwLC40MywxLjg4LDEuMjgsMS4yOCwwLDAsMCwxLjExLjc0aC43N2ExLjI3LDEuMjcsMCwwLDEsMSwuNDNBMS42LDEuNiwwLDAsMSw3MCwyNDZhMS4zMiwxLjMyLDAsMCwxLS41OCwxLjExLDIuNDYsMi40NiwwLDAsMS0xLjUxLjQzWiIvPjxwYXRoIGNsYXNzPSJjbHMtNCIgZD0iTTkwLjA2LDI0Ny44NmExMS4zNSwxMS4zNSwwLDAsMS0zLjc1LS42Miw5LjY3LDkuNjcsMCwwLDEtMy4xMS0xLjcyQTYuODQsNi44NCwwLDAsMSw4MS4yNiwyNDNhMS4yMiwxLjIyLDAsMCwxLDAtMS4yLDEuNTQsMS41NCwwLDAsMSwxLjA5LS43MSwxLjU2LDEuNTYsMCwwLDEsMS4wOS4xNywyLDIsMCwwLDEsLjgyLjg4LDMuOTQsMy45NCwwLDAsMCwxLjIxLDEuNDEsNy4xMiw3LjEyLDAsMCwwLDIsMSw3Ljg0LDcuODQsMCwwLDAsMi41My40LDgsOCwwLDAsMCwyLjcyLS40Niw0LjkxLDQuOTEsMCwwLDAsMi0xLjM0LDMuMTgsMy4xOCwwLDAsMCwuNzctMi4xNyw0LjA3LDQuMDcsMCwwLDAtMS4yOC0yLjkyLDYuODEsNi44MSwwLDAsMC00LjE5LTEuNiwxMC40OSwxMC40OSwwLDAsMS02LTIuMjQsNS45LDUuOSwwLDAsMS0yLjE4LTQuNjQsNS4zMyw1LjMzLDAsMCwxLDEuMTQtMy40NUE3LDcsMCwwLDEsODYuMTQsMjI0YTEyLjI1LDEyLjI1LDAsMCwxLDQuMzUtLjc0LDkuMjYsOS4yNiwwLDAsMSwzLjI3LjUzLDcuNjEsNy42MSwwLDAsMSwyLjQ0LDEuNDRBOS40Miw5LjQyLDAsMCwxLDk4LDIyNy40MWExLjkxLDEuOTEsMCwwLDEsLjM1LDEuMjgsMS4yNywxLjI3LDAsMCwxLS42Ljk0LDEuNDcsMS40NywwLDAsMS0xLjI2LjE1LDEuNywxLjcsMCwwLDEtMS0uOCw1LjU5LDUuNTksMCwwLDAtMS4yLTEuNSw1LjI2LDUuMjYsMCwwLDAtMS42Ni0xLDYuNCw2LjQsMCwwLDAtMi4yNS0uMzYsNy4zNiw3LjM2LDAsMCwwLTMuODEuODVBMi45LDIuOSwwLDAsMCw4NSwyMjkuNjlhMy41NywzLjU3LDAsMCwwLC40OCwxLjc3LDMuODUsMy44NSwwLDAsMCwxLjc1LDEuNDYsMTEuNjQsMTEuNjQsMCwwLDAsMy42OC44Niw5LjYyLDkuNjIsMCwwLDEsNS43LDIuMjMsNi4zMSw2LjMxLDAsMCwxLDIsNC45LDYuMTMsNi4xMywwLDAsMS0uNzIsM0E2LjYxLDYuNjEsMCwwLDEsOTYsMjQ2LjEyYTguNDgsOC40OCwwLDAsMS0yLjc2LDEuMzFBMTIuMywxMi4zLDAsMCwxLDkwLjA2LDI0Ny44NloiLz48cGF0aCBjbGFzcz0iY2xzLTQiIGQ9Ik0xMTAuOSwyNDcuNjdhOC42OCw4LjY4LDAsMCwxLTQuNC0xLjA5LDcuODYsNy44NiwwLDAsMS0zLTMsOS40NSw5LjQ1LDAsMCwxLDAtOC44NSw3LjgyLDcuODIsMCwwLDEsMy0zLDguNzgsOC43OCwwLDAsMSw0LjQtMS4wOSw4LjY4LDguNjgsMCwwLDEsNC4zNiwxLjA5LDcuOTEsNy45MSwwLDAsMSwzLDMsOC44LDguOCwwLDAsMSwxLjA5LDQuNDQsOC45NCw4Ljk0LDAsMCwxLTEuMDcsNC40MSw3LjgzLDcuODMsMCwwLDEtMywzQTguNyw4LjcsMCwwLDEsMTEwLjksMjQ3LjY3Wm0wLTIuNzZhNS40Myw1LjQzLDAsMCwwLDIuODMtLjc0LDUuMTQsNS4xNCwwLDAsMCwxLjkyLTIsNi4yMSw2LjIxLDAsMCwwLC42OS0zLDYuMzIsNi4zMiwwLDAsMC0uNjktMyw1LjEsNS4xLDAsMCwwLTEuOTItMiw1LjQzLDUuNDMsMCwwLDAtNy42LDIsNi4yMSw2LjIxLDAsMCwwLS43LDMsNi4xLDYuMSwwLDAsMCwuNywzLDUuMzMsNS4zMywwLDAsMCwxLjk0LDJBNS40LDUuNCwwLDAsMCwxMTAuOSwyNDQuOTFaIi8+PHBhdGggY2xhc3M9ImNscy00IiBkPSJNMTI4LDI0Ny41NWE0LjA5LDQuMDksMCwwLDEtMi40LS43NCw0Ljg0LDQuODQsMCwwLDEtMS42Mi0yLDcsNywwLDAsMS0uNTktMi45NFYyMjUuMDhhMS41NywxLjU3LDAsMCwxLDIuNjUtMS4xMSwxLjU0LDEuNTQsMCwwLDEsLjQzLDEuMTF2MTYuNzhhMy42NiwzLjY2LDAsMCwwLC40MywxLjg4LDEuMjYsMS4yNiwwLDAsMCwxLjEuNzRoLjc3YTEuMjcsMS4yNywwLDAsMSwxLC40MywxLjU1LDEuNTUsMCwwLDEsLjM4LDEuMSwxLjMyLDEuMzIsMCwwLDEtLjU4LDEuMTEsMi40NiwyLjQ2LDAsMCwxLTEuNTEuNDNaIi8+PC9nPjwvZz48L3N2Zz4=';

		$mantenimiento ='
		<style>
			'.get_field('modo_mantencion_style', 'options').'
		h1 {
			border-bottom:0;
			padding-bottom: 0;
		}

		img {
			display:inline-block;
			width: 120px;
		}

		#error-page {
			margin: 50px;
			display:flex;
			align-items: center;
			justify-content: center;
			height: calc(100vh - 100px);
			width: calc(100% - 100px);
			max-width: 100%;
		}

		@media (max-width: 768px) {
			#error-page {
				margin: 0;
				width: 100vw;
				height: 100vh;
			}
		}

		</style>
		<main class="text-align-center-xs">
			<img src="'.$logo.'">
			<h1>Estamos en mantenimiento</h1>
			<p>Pronto volveremos con nuevas mejoras en nuestro sitio.</p>
		</main>
		';

    if(get_field('modo_mantencion', 'options') && !is_user_logged_in()){
        wp_die($mantenimiento, 'Sitio en Mantenimiento', array( 'response' => 503 )); 
    }
}
add_action('init', 'mode_maintenance'); 
/*** Fin Modo Mantenimiento ***/




add_action('nav_menu_css_class', 'add_current_nav_class', 10, 2 );  
function add_current_nav_class($classes, $item) {  
  // Getting the current post details  
  global $post;  
  // Make sure we're not on a single blog post before running the code...  
  if ( !is_singular( 'post' ) ) {
    // Getting the post type of the current post  
    $current_post_type = get_post_type_object(get_post_type($post->ID));  
    $current_post_type_slug = $current_post_type->rewrite['slug'];  
    // Getting the URL of the menu item  
    $menu_slug = strtolower(trim($item->url));  
    // If the menu item URL contains the current post types slug add the current-menu-item class  
    if (strpos($menu_slug,$current_post_type_slug) !== false) {  
      $classes[] = 'current-menu-item';  
    }   
    // as we are not on a single blog post, stop blog menu from highlighting  
    else {  
      $classes = array_diff( $classes, array( 'current_page_parent' ) );  
    }  
  }
  // Return the corrected set of classes to be added to the menu item  
  return $classes;  
} 
