<?php
/**
 * Varya functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Varya
 * @since 1.0.0
 */

/**
 * varya only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

if ( ! function_exists( 'varya_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function varya_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on varya, use a find and replace
		 * to change 'varya' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'varya', get_template_directory() . '/languages' );

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
		set_post_thumbnail_size( 1568, 9999 );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'primary' => __( 'Primary Navigation', 'varya' ),
				'footer' => __( 'Footer Navigation', 'varya' ),
				'social' => __( 'Social Links Navigation', 'varya' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 120,
				'width'       => 120,
				'flex-width'  => false,
				'flex-height' => false,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( array(
			varya_fonts_url(),
			'./assets/css/variables-editor.css',
			'./assets/css/style-editor.css'
		) );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
				'name'      => __( 'Tiny', 'varya' ),
					'shortName' => __( 'XS', 'varya' ),
					'size'      => 14,
					'slug'      => 'tiny',
				),
				array(
					'name'      => __( 'Small', 'varya' ),
					'shortName' => __( 'S', 'varya' ),
					'size'      => 16,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Normal', 'varya' ),
					'shortName' => __( 'M', 'varya' ),
					'size'      => 18,
					'slug'      => 'normal',
				),
				array(
					'name'      => __( 'Large', 'varya' ),
					'shortName' => __( 'L', 'varya' ),
					'size'      => 20,
					'slug'      => 'large',
				),
				array(
					'name'      => __( 'Huge', 'varya' ),
					'shortName' => __( 'XL', 'varya' ),
					'size'      => 24,
					'slug'      => 'huge',
				),
			)
		);

		// Editor color palette.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Primary', 'varya' ),
					'slug'  => 'primary',
					'color' => '#000000',
				),
				array(
					'name'  => __( 'Secondary', 'varya' ),
					'slug'  => 'secondary',
					'color' => '#A36265',
				),
				array(
					'name'  => __( 'Foreground', 'varya' ),
					'slug'  => 'foreground',
					'color' => '#333333',
				),
				array(
					'name'  => __( 'Background Light', 'varya' ),
					'slug'  => 'background-light',
					'color' => '#FAFBF6',
				),
				array(
					'name'  => __( 'Background', 'varya' ),
					'slug'  => 'background',
					'color' => '#FFFFFF',
				),
			)
		);

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );
	}
endif;
add_action( 'after_setup_theme', 'varya_setup' );

/**
 * Add Google webfonts, if necessary
 *
 * - See: http://themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/
 */
function varya_fonts_url() {

	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	* supported by Playfair Display, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$fira_sans = esc_html_x( 'on', 'Fira Sans: on or off', 'varya' );

	/* Translators: If there are characters in your language that are not
	* supported by Roboto Sans, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$playfair_display = esc_html_x( 'on', 'Playfair Display: on or off', 'varya' );

	if ( 'off' !== $fira_sans || 'off' !== $playfair_display ) {
		$font_families = array();

		if ( 'off' !== $fira_sans ) {
			$font_families[] = 'Fira Sans:ital,wght@0,400;0,500;1,400';
		}

		if ( 'off' !== $playfair_display ) {
			$font_families[] = 'Playfair Display:ital,wght@0,400;0,700;1,400';
		}

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function varya_widgets_init() {

	register_sidebar(
		array(
			'name'          => __( 'Footer', 'varya' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your footer.', 'varya' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'varya_widgets_init' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width Content width.
 */
function varya_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'varya_content_width', 750 );
}
add_action( 'after_setup_theme', 'varya_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function varya_scripts() {
	// Enqueue Google fonts
	wp_enqueue_style( 'varya-fonts', varya_fonts_url(), array(), null );

	// Theme variables
	wp_enqueue_style( 'varya-variables-style', get_template_directory_uri() . '/assets/css/variables.css', array(), wp_get_theme()->get( 'Version' ) );

	// Theme styles
	wp_enqueue_style( 'varya-style', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );

	// RTL styles
	wp_style_add_data( 'varya-style', 'rtl', 'replace' );

	// Print styles
	wp_enqueue_style( 'varya-print-style', get_template_directory_uri() . '/assets/css/print.css', array(), wp_get_theme()->get( 'Version' ), 'print' );

	// Threaded comment reply styles
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Main navigation scripts
	// Check to see if the menu is not assigned and or empty
	$menu = wp_nav_menu(
		array (
			'echo' => FALSE,
			'menu' => 'primary',
			'fallback_cb' => '__return_false'
		)
	);

	if ( ! empty ( $menu ) ) {
		wp_enqueue_script( 'varya-main-navigation-scripts', get_template_directory_uri() . '/assets/js/main-navigation.js', array(), wp_get_theme()->get( 'Version' ), true );
	}
}
add_action( 'wp_enqueue_scripts', 'varya_scripts' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function varya_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'varya_skip_link_focus_fix' );

/**
 * SVG Icons class.
 */
require get_template_directory() . '/classes/class-varya-svg-icons.php';

/**
 * Custom Comment Walker template.
 */
require get_template_directory() . '/classes/class-varya-walker-comment.php';

/**
 * Enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * SVG Icons related functions.
 */
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Custom template tags for the theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}
