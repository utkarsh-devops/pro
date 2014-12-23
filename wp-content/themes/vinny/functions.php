<?php
/** functions.php
 *
 * @author		Konstantin Obenland
 * @package		The Bootstrap
 * @since		1.0.0 - 05.02.2012
 */


if ( ! function_exists( 'the_bootstrap_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @author	WordPress.org
 * @since	1.0.0 - 05.02.2012
 *
 * @return	void
 */
function the_bootstrap_setup() {
	global $content_width;
	
	if ( ! isset( $content_width ) ) {
		$content_width = 770;
	}
	
	load_theme_textdomain( 'the-bootstrap', get_template_directory() . '/lang' );
	
	add_theme_support( 'automatic-feed-links' );
	
	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'post-formats', array(
		'aside',
		'chat',
		'link',
		'gallery',
		'status',
		'quote',
		'image',
		'video'
	) );
	
	add_theme_support( 'tha_hooks', array( 'all' ) );

	if ( version_compare( get_bloginfo( 'version' ), '3.4', '<' ) )
		// Custom Theme Options
		require_once( get_template_directory() . '/inc/theme-options.php' );
	else
		// Implement the Theme Customizer script
		require_once( get_template_directory() . '/inc/theme-customizer.php' );
	
	/**
	 * Custom template tags for this theme.
	 */
	require_once( get_template_directory() . '/inc/template-tags.php' );
	
	/**
	 * Implement the Custom Header feature
	 */
	require_once( get_template_directory() . '/inc/custom-header.php' );
	
	/**
	 * Custom Nav Menu handler for the Navbar.
	 */
	require_once( get_template_directory() . '/inc/nav-menu-walker.php' );
	
	/**
	 * Theme Hook Alliance
	 */
	require_if_theme_supports( 'tha_hooks', get_template_directory() . '/inc/tha-theme-hooks.php' );
	
	/**
	 * Including three menu (header-menu, primary and footer-menu).
	 * Primary is wrapping in a navbar containing div (wich support responsive variation)
	 * Header-menu and Footer-menu are inside pills dropdown menu
	 * 
	 * @since	1.2.2 - 07.04.2012
	 * @see		http://codex.wordpress.org/Function_Reference/register_nav_menus
	 */
	register_nav_menus( array(
		'primary'		=>	__( 'Main Navigation', 'the-bootstrap' ),
		'header-menu'  	=>	__( 'Header Menu', 'the-bootstrap' ),
		'footer-menu' 	=>	__( 'Footer Menu', 'the-bootstrap' )
	) );
	
} // the_bootstrap_setup
endif;

add_action('init','create_post_type');
function create_post_type(){
    register_post_type( 'vinny_news',
        array(
            'labels' => array(
                'name' => __( 'News' ),
                'singular_name' => __( 'News' )
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('thumbnail','title','editor','author'),
            'rewrite' => array('slug' => 'News')
        )
    );
    register_post_type( 'meet_patients',
        array(
            'labels' => array(
                'name' => __( 'Meet Patients' ),
                'singular_name' => __( 'Meet Patients' )
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('thumbnail','title','editor','author','custom-fields'),
            'rewrite' => array('slug' => 'meet_patients')
        )
    );


}

add_action( 'after_setup_theme', 'the_bootstrap_setup' );


/**
 * Returns the options object for The Bootstrap.
 *
 * @author	Automattic
 * @since	1.3.0 - 06.04.2012
 *
 * @return	stdClass	Theme Options
 */
function the_bootstrap_options() {
	return (object) wp_parse_args(
		get_option( 'the_bootstrap_theme_options', array() ),
		the_bootstrap_get_default_theme_options()
	);
}


/**
 * Returns the default options for The Bootstrap.
 *
 * @author	Automattic
 * @since	1.3.0 - 06.04.2012
 *
 * @return	void
 */
function the_bootstrap_get_default_theme_options() {
	$default_theme_options	=	array(
		'theme_layout'		=>	'content-sidebar',
		'navbar_site_name'	=>	false,
		'navbar_searchform'	=>	true,
		'navbar_inverse'	=>	true,
		'navbar_position'	=>	'static',
	);

	return apply_filters( 'the_bootstrap_default_theme_options', $default_theme_options );
}


/**
 * Adds The Bootstrap layout classes to the array of body classes.
 *
 * @author	WordPress.org
 * @since	1.3.0 - 06.04.2012
 *
 * @return	void
 */
function the_bootstrap_layout_classes( $existing_classes ) {
	$classes = array( the_bootstrap_options()->theme_layout );
	$classes = apply_filters( 'the_bootstrap_layout_classes', $classes );

	return array_merge( $existing_classes, $classes );
}
add_filter( 'body_class', 'the_bootstrap_layout_classes' );


/**
 * Adds Custom Background support
 *
 * @author	Konstantin Obenland
 * @since	1.2.5 - 11.04.2012
 *
 * @return	void
 */
function the_bootstrap_custom_background_setup() {
	
	$args = apply_filters( 'the_bootstrap_custom_background_args',  array(
		'default-color'	=>	'EFEFEF',
	) );
	
	add_theme_support( 'custom-background', $args );
	
	if ( ! function_exists( 'wp_get_theme' ) ) {
		// Compat: Versions of WordPress prior to 3.4.
		define( 'BACKGROUND_COLOR', $args['default-color'] );
		add_custom_background();
	}
}
add_action( 'after_setup_theme', 'the_bootstrap_custom_background_setup' );


/**
 * Register the sidebars.
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @return	void
 */
function the_bootstrap_widgets_init() {

	register_sidebar( array(
		'name'			=>	__( 'Main Sidebar', 'the-bootstrap' ),
		'id'			=>	'main',
		'before_widget'	=>	'<aside id="%1$s" class="widget well %2$s">',
		'after_widget'	=>	'</aside>',
		'before_title'	=>	'<h2 class="widget-title">',
		'after_title'	=>	'</h2>',
	) );
	
	register_sidebar( array(
		'name'			=>	__( 'Image Sidebar', 'the-bootstrap' ),
		'description'	=>	__( 'Shown on image attachment pages.', 'the-bootstrap' ),
		'id'			=>	'image',
		'before_widget'	=>	'<aside id="%1$s" class="widget well %2$s">',
		'after_widget'	=>	'</aside>',
		'before_title'	=>	'<h2 class="widget-title">',
		'after_title'	=>	'</h2>',
	) );

    register_sidebar( array(
        'name'			=>	__( 'Facebook like box'),
        'description'	=>	__( 'Facebook like box'),
        'id'			=>	'facebook_like_box',
        'before_widget'	=>	'',
        'after_widget'	=>	'',
        'before_title'	=>	'',
        'after_title'	=>	'',
    ) );

    register_sidebar( array(
        'name'			=>	__( 'Facebook like box iPad'),
        'description'	=>	__( 'Facebook like box iPad'),
        'id'			=>	'facebook_like_box_ipad',
        'before_widget'	=>	'',
        'after_widget'	=>	'',
        'before_title'	=>	'',
        'after_title'	=>	'',
    ) );

    register_sidebar( array(
        'name'			=>	__( 'Tweets'),
        'description'	=>	__( 'Fetched Tweets of Vinny'),
        'id'			=>	'vinny_tweets',
        'before_widget'	=>	'',
        'after_widget'	=>	'',
        'before_title'	=>	'',
        'after_title'	=>	'',
    ) );

    register_sidebar( array(
        'name'			=>	__( 'Meet Vinny'),
        'description'	=>	__( 'Meet Vinny'),
        'id'			=>	'meet_vinny',
        'before_widget'	=>	'',
        'after_widget'	=>	'',
        'before_title'	=>	'',
        'after_title'	=>	'',
    ) );

    register_sidebar( array(
        'name'			=>	__( 'Philanthropist Home Page'),
        'description'	=>	__( 'Home page content of Philanthropist site'),
        'id'			=>	'home',
        'before_widget'	=>	'',
        'after_widget'	=>	'',
        'before_title'	=>	'',
        'after_title'	=>	'',
    ) );
    register_sidebar( array(
        'name'			=>	__( 'Patrons and Teammates'),
        'description'	=>	__( 'List of Patrons and Teammates for supporter page of Philanthropist site'),
        'id'			=>	'patron',
        'before_widget'	=>	'',
        'after_widget'	=>	'',
        'before_title'	=>	'',
        'after_title'	=>	'',
    ) );
    register_sidebar( array(
        'name'			=>	__( 'Player Site Video'),
        'description'	=>	__( 'Video list of player site'),
        'id'			=>	'player_video',
        'before_widget'	=>	'',
        'after_widget'	=>	'',
        'before_title'	=>	'',
        'after_title'	=>	'',
    ) );
    register_sidebar( array(
        'name'			=>	__( 'Foundation Site Video'),
        'description'	=>	__( 'Video list of foundation site'),
        'id'			=>	'foundation_video',
        'before_widget'	=>	'',
        'after_widget'	=>	'',
        'before_title'	=>	'',
        'after_title'	=>	'',
    ) );


    include_once( 'inc/the-bootstrap-image-meta-widget.php' );
	register_widget( 'The_Bootstrap_Image_Meta_Widget' );
	
	include_once( 'inc/the-bootstrap-gallery-widget.php' );
	register_widget( 'The_Bootstrap_Gallery_Widget' );
}
add_action( 'widgets_init', 'the_bootstrap_widgets_init' );


/**
 * Registration of theme scripts and styles
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @return	void
 */
function the_bootstrap_register_scripts_styles() {

	if ( ! is_admin() ) {
		$theme_version = _the_bootstrap_version();
		$suffix = ( defined('SCRIPT_DEBUG') AND SCRIPT_DEBUG ) ? '' : '.min';
			
		/**
		 * Scripts
		 */
		wp_register_script(
			'tw-bootstrap',
            get_template_url() . "/js/bootstrap{$suffix}.js",
			array('jquery'),
			'2.0.3',
			true
		);
		
		wp_register_script(
			'the-bootstrap',
            get_template_url() . "/js/the-bootstrap{$suffix}.js",
			array('tw-bootstrap'),
			$theme_version,
			true
		);
				
		/**
		 * Styles
		 */
		wp_register_style(
			'tw-bootstrap',
            get_template_url() . "/css/bootstrap{$suffix}.css",
			array(),
			'2.0.3'
		);
		
		wp_register_style(
			'the-bootstrap',
            get_template_url() . "/style{$suffix}.css",
			array('tw-bootstrap'),
			$theme_version
		);
	}
}
add_action( 'init', 'the_bootstrap_register_scripts_styles' );


/**
 * Properly enqueue frontend scripts
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @return	void
 */
function the_bootstrap_print_scripts() {
	wp_enqueue_script( 'the-bootstrap' );
}
add_action( 'wp_enqueue_scripts', 'the_bootstrap_print_scripts' );


/**
 * Adds IE specific scripts
 * 
 * Respond.js has to be loaded after Theme styles
 *
 * @author	Konstantin Obenland
 * @since	1.7.0 - 11.06.2012
 *
 * @return	void
 */
function the_bootstrap_print_ie_scripts() {
	?>
	<!--[if lt IE 9]>
		<script src="<?php echo get_template_url(); ?>/js/html5shiv.min.js" type="text/javascript"></script>
		<script src="<?php echo get_template_url(); ?>/js/respond.min.js" type="text/javascript"></script>
	<![endif]-->
	<?php
}
add_action( 'wp_head', 'the_bootstrap_print_ie_scripts', 11 );


/**
 * Properly enqueue comment-reply script
 *
 * @author	Konstantin Obenland
 * @since	1.4.0 - 08.05.2012
 *
 * @return	void
 */
function the_bootstrap_comment_reply() {
	if ( get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'comment_form_before', 'the_bootstrap_comment_reply' );


/**
 * Properly enqueue frontend styles
 *
 * Since 'tw-bootstrap' was registered as a dependency, it'll get enqueued
 * automatically
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @return	void
 */
function the_bootstrap_print_styles() {
	if ( is_child_theme() ) {
		wp_enqueue_style( 'the-bootstrap-child', get_stylesheet_uri(), array( 'the-bootstrap' ) );
	} else {
		wp_enqueue_style( 'the-bootstrap' );
	}
	
	if ( 'static' != the_bootstrap_options()->navbar_position ) {
		$top_bottom	=	str_replace( 'navbar-fixed-', '', the_bootstrap_options()->navbar_position );
		$css		=	"body > .container{margin-{$top_bottom}:68px;}@media(min-width: 980px){body > .container{margin-{$top_bottom}:58px;}}";
	
		if ( is_admin_bar_showing() AND 'top' == $top_bottom )
			$css	.=	'.navbar.navbar-fixed-top{margin-top:28px;}';
	
		if ( function_exists( 'wp_add_inline_style' ) )
			wp_add_inline_style( 'the-bootstrap', $css );
		else
			echo "<style type='text/css'>\n{$css}\n</style>\n";
	}
}
add_action( 'wp_enqueue_scripts', 'the_bootstrap_print_styles' );


if ( ! function_exists( 'the_bootstrap_credits' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author,
 * comment and edit link
 *
 * @author	Konstantin Obenland
 * @since	1.2.2 - 07.04.2012
 *
 * @return	void
 */
function the_bootstrap_credits() {
	printf(
		'<span class="credits alignleft">' . __( '&copy; %1$s <a href="%2$s">%3$s</a>, all rights reserved.', 'the-bootstrap' ) . '</span>',
		date( 'Y' ),
		home_url( '/' ),
		get_bloginfo( 'name' )
	);
}
endif;


/**
 * Returns the blogname if no title was set.
 *
 * @author	Konstantin Obenland
 * @since	1.1.0 - 18.03.2012
 *
 * @param	string	$title
 * @param	string	$sep
 *
 * @return	string
 */
function the_bootstrap_wp_title( $title, $sep ) {
	
	if ( ! is_feed() ) {
		$title .= get_bloginfo( 'name' );
		
		if ( is_front_page() ) {
			$title .= " {$sep} " . get_bloginfo( 'description' );
		}
	}

	return $title;
}
add_filter( 'wp_title', 'the_bootstrap_wp_title', 1, 2 );


/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @author	WordPress.org
 * @since	1.0.0 - 05.02.2012
 *
 * @param	string	$more
 *
 * @return	string
 */
function the_bootstrap_continue_reading_link() {
	return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'the-bootstrap' ) . '</a>';
}


/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and the_bootstrap_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @author	WordPress.org
 * @since	1.0.0 - 05.02.2012
 *
 * @param	string	$more
 *
 * @return	string
 */
function the_bootstrap_auto_excerpt_more( $more ) {
	return '&hellip;' . the_bootstrap_continue_reading_link();
}
add_filter( 'excerpt_more', 'the_bootstrap_auto_excerpt_more' );


/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @author	WordPress.org
 * @since	1.0.0 - 05.02.2012
 *
 * @param	string	$output
 *
 * @return	string
 */
function the_bootstrap_custom_excerpt_more( $output ) {
	if ( has_excerpt() AND ! is_attachment() ) {
		$output .= the_bootstrap_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'the_bootstrap_custom_excerpt_more' );


/**
 * Get the wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @author	WordPress.org
 * @since	1.0.0 - 05.02.2012
 *
 * @param	array	$args
 *
 * @return	array
 */
function the_bootstrap_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'the_bootstrap_page_menu_args' );


/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 *
 * @author	Automattic
 * @since	1.0.0 - 05.02.2012
 *
 * @param	string	$url
 * @param	int		$id
 *
 * @return	string
 */
function the_bootstrap_enhanced_image_navigation( $url, $id ) {
    
	if ( is_attachment() AND wp_attachment_is_image( $id ) ) {
		$image = get_post( $id );
		if ( $image->post_parent AND $image->post_parent != $id )
			$url .= '#primary';
    }
    
    return $url;
}
add_filter( 'attachment_link', 'the_bootstrap_enhanced_image_navigation', 10, 2 );


/**
 * Displays comment list, when there are any
 *
 * @author	Konstantin Obenland
 * @since	1.7.0 - 16.06.2012
 *
 * @return	void
 */
function the_bootstrap_comments_list() {
	if ( post_password_required() ) : ?>
		<div id="comments">
			<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'the-bootstrap' ); ?></p>
		</div><!-- #comments -->
		<?php
		return;
	endif;
	
	
	if ( have_comments() ) : ?>
		<div id="comments">
			<h2 id="comments-title">
				<?php printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'the-bootstrap' ),
						number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' ); ?>
			</h2>
		
			<?php the_bootstrap_comment_nav(); ?>
		
			<ol class="commentlist unstyled">
				<?php wp_list_comments( array( 'callback' => 'the_bootstrap_comment' ) ); ?>
			</ol><!-- .commentlist .unstyled -->
		
			<?php the_bootstrap_comment_nav(); ?>
		
		</div><!-- #comments -->
	<?php endif;
}
add_action( 'comment_form_before', 'the_bootstrap_comments_list', 0 );
add_action( 'comment_form_comments_closed', 'the_bootstrap_comments_list', 1 );


/**
 * Echoes comments-are-closed message when post type supports comments and we're
 * not on a page
 *
 * @author	Konstantin Obenland
 * @since	1.7.0 - 16.06.2012
 *
 * @return	void
 */
function the_bootstrap_comments_closed() {
	if ( ! is_page() AND post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'the-bootstrap' ); ?></p>
	<?php endif;
}
add_action( 'comment_form_comments_closed', 'the_bootstrap_comments_closed' );


/**
 * Filters comments_form() default arguments
 *
 * @author	Konstantin Obenland
 * @since	1.7.0 - 16.06.2012
 *
 * @param	array	$defaults
 *
 * @return	array
 */
function the_bootstrap_comment_form_defaults( $defaults ) {
	return wp_parse_args( array(
		'comment_field'			=>	'<div class="comment-form-comment control-group"><label class="control-label" for="comment">' . _x( 'Comment', 'noun', 'the-bootstrap' ) . '</label><div class="controls"><textarea class="span7" id="comment" name="comment" rows="8" aria-required="true"></textarea></div></div>',
		'comment_notes_before'	=>	'',
		'comment_notes_after'	=>	'<div class="form-allowed-tags control-group"><label class="control-label">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'the-bootstrap' ), '</label><div class="controls"><pre>' . allowed_tags() . '</pre></div>' ) . '</div>
									 <div class="form-actions">',
		'title_reply'			=>	'<legend>' . __( 'Leave a reply', 'the-bootstrap' ) . '</legend>',
		'title_reply_to'		=>	'<legend>' . __( 'Leave a reply to %s', 'the-bootstrap' ). '</legend>',
		'must_log_in'			=>	'<div class="must-log-in control-group controls">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'the-bootstrap' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( get_the_ID() ) ) ) ) . '</div>',
		'logged_in_as'			=>	'<div class="logged-in-as control-group controls">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'the-bootstrap' ), admin_url( 'profile.php' ), wp_get_current_user()->display_name, wp_logout_url( apply_filters( 'the_permalink', get_permalink( get_the_ID() ) ) ) ) . '</div>',
	), $defaults );
}
add_filter( 'comment_form_defaults', 'the_bootstrap_comment_form_defaults' );


if ( ! function_exists( 'the_bootstrap_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own the_bootstrap_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @param	object	$comment	Comment data object.
 * @param	array	$args
 * @param	int		$depth		Depth of comment in reference to parents.
 *
 * @return	void
 */
function the_bootstrap_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	if ( 'pingback' == $comment->comment_type OR 'trackback' == $comment->comment_type ) : ?>
	
		<li id="li-comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<p class="row">
				<strong class="ping-label span1"><?php _e( 'Pingback:', 'the-bootstrap' ); ?></strong>
				<span class="span7"><?php comment_author_link(); edit_comment_link( __( 'Edit', 'the-bootstrap' ), '<span class="sep">&nbsp;</span><span class="edit-link label">', '</span>' ); ?></span>
			</p>
	
	<?php else:
		$offset	=	$depth - 1;
		$span	=	7 - $offset; ?>
		
		<li  id="li-comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<article id="comment-<?php comment_ID(); ?>" class="comment row">
				<div class="comment-author-avatar span1<?php if ($offset) echo " offset{$offset}"; ?>">
					<?php echo get_avatar( $comment, 70 ); ?>
				</div>
				<footer class="comment-meta span<?php echo $span; ?>">
					<p class="comment-author vcard">
						<?php
							/* translators: 1: comment author, 2: date and time */
							printf( __( '%1$s <span class="says">said</span> on %2$s:', 'the-bootstrap' ),
								sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
								sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
									esc_url( get_comment_link( $comment->comment_ID ) ),
									get_comment_time( 'c' ),
									/* translators: 1: date, 2: time */
									sprintf( __( '%1$s at %2$s', 'the-bootstrap' ), get_comment_date(), get_comment_time() )
								)
							);
							edit_comment_link( __( 'Edit', 'the-bootstrap' ), '<span class="sep">&nbsp;</span><span class="edit-link label">', '</span>' ); ?>
					</p><!-- .comment-author .vcard -->
	
					<?php if ( ! $comment->comment_approved ) : ?>
					<div class="comment-awaiting-moderation alert alert-info"><em><?php _e( 'Your comment is awaiting moderation.', 'the-bootstrap' ); ?></em></div>
					<?php endif; ?>
	
				</footer><!-- .comment-meta -->
	
				<div class="comment-content span<?php echo $span; ?>">
					<?php
					comment_text();
					comment_reply_link( array_merge( $args, array(
						'reply_text'	=>	__( 'Reply <span>&darr;</span>', 'the-bootstrap' ),
						'depth'			=>	$depth,
						'max_depth'		=>	$args['max_depth']
					) ) ); ?>
				</div><!-- .comment-content -->
			</article><!-- #comment-<?php comment_ID(); ?> .comment -->
			
	<?php endif; // comment_type
}
endif; // ends check for the_bootstrap_comment()


/**
 * Adds markup to the comment form which is needed to make it work with Bootstrap
 * needs
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @param	string	$html
 *
 * @return	string
 */
function the_bootstrap_comment_form_top() {
	echo '<div class="form-horizontal">';
}
add_action( 'comment_form_top', 'the_bootstrap_comment_form_top' );


/**
 * Adds markup to the comment form which is needed to make it work with Bootstrap
 * needs
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @param	string	$html
 *
 * @return	string
 */
function the_bootstrap_comment_form() {
	echo '</div></div>';
}
add_action( 'comment_form', 'the_bootstrap_comment_form' );


/**
 * Custom author form field for the comments form
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @param	string	$html
 *
 * @return	string
 */
function the_bootstrap_comment_form_field_author( $html ) {
	$commenter	=	wp_get_current_commenter();
	$req		=	get_option( 'require_name_email' );
	$aria_req	=	( $req ? " aria-required='true'" : '' );
	
	return	'<div class="comment-form-author control-group">
				<label for="author" class="control-label">' . __( 'Name', 'the-bootstrap' ) . '</label>
				<div class="controls">
					<input id="author" name="author" type="text" value="' . esc_attr(  $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />
					' . ( $req ? '<p class="help-inline"><span class="required">' . __('required', 'the-bootstrap') . '</span></p>' : '' ) . '
				</div>
			</div>';
}
add_filter( 'comment_form_field_author', 'the_bootstrap_comment_form_field_author');


/**
 * Custom HTML5 email form field for the comments form
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @param	string	$html
 *
 * @return	string
 */
function the_bootstrap_comment_form_field_email( $html ) {
	$commenter	=	wp_get_current_commenter();
	$req		=	get_option( 'require_name_email' );
	$aria_req	=	( $req ? " aria-required='true'" : '' );
	
	return	'<div class="comment-form-email control-group">
				<label for="email" class="control-label">' . __( 'Email', 'the-bootstrap' ) . '</label>
				<div class="controls">
					<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />
					<p class="help-inline">' . ( $req ? '<span class="required">' . __('required', 'the-bootstrap') . '</span>, ' : '' ) . __( 'will not be published', 'the-bootstrap' ) . '</p>
				</div>
			</div>';
}
add_filter( 'comment_form_field_email', 'the_bootstrap_comment_form_field_email');


/**
 * Custom HTML5 url form field for the comments form
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @param	string	$html
 *
 * @return	string
 */
function the_bootstrap_comment_form_field_url( $html ) {
	$commenter	=	wp_get_current_commenter();
	
	return	'<div class="comment-form-url control-group">
				<label for="url" class="control-label">' . __( 'Website', 'the-bootstrap' ) . '</label>
				<div class="controls">
					<input id="url" name="url" type="url" value="' . esc_attr(  $commenter['comment_author_url'] ) . '" size="30" />
				</div>
			</div>';
}
add_filter( 'comment_form_field_url', 'the_bootstrap_comment_form_field_url');


/**
 * Adjusts an attechment link to hold the class of 'thumbnail' and make it look
 * pretty
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @param	string	$link
 * @param	int		$id			Post ID.
 * @param	string	$size		Default is 'thumbnail'. Size of image, either array or string.
 * @param	bool	$permalink	Default is false. Whether to add permalink to image.
 * @param	bool	$icon		Default is false. Whether to include icon.
 * @param	string	$text		Default is false. If string, then will be link text.
 *
 * @return	string
 */
function the_bootstrap_get_attachment_link( $link, $id, $size, $permalink, $icon, $text ) {
	return ( ! $text ) ? str_replace( '<a ', '<a class="thumbnail" ', $link ) : $link;
}
add_filter( 'wp_get_attachment_link', 'the_bootstrap_get_attachment_link', 10, 6 );


/**
 * Adds the 'hero-unit' class for extra big font on sticky posts
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @param	array	$classes
 *
 * @return	array
 */
function the_bootstrap_post_classes( $classes ) {

	if ( is_sticky() AND is_home() ) {
		$classes[] = 'hero-unit';
	}
	
	return $classes;
}
add_filter( 'post_class', 'the_bootstrap_post_classes' );


/**
 * Callback function to display galleries (in HTML5)
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @param	string	$content
 * @param	array	$attr
 *
 * @return	string
 */
function the_bootstrap_post_gallery( $content, $attr ) {
	global $instance, $post;
	$instance++;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( ! $attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract( shortcode_atts( array(
		'order'			=>	'ASC',
		'orderby'		=>	'menu_order ID',
		'id'			=>	$post->ID,
		'itemtag'		=>	'figure',
		'icontag'		=>	'div',
		'captiontag'	=>	'figcaption',
		'columns'		=>	3,
		'size'			=>	'thumbnail',
		'include'		=>	'',
		'exclude'		=>	''
	), $attr ) );


	$id = intval( $id );
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( $include ) {
		$include = preg_replace( '/[^0-9,]+/', '', $include );
		$_attachments = get_posts( array(
			'include'			=>	$include,
			'post_status'		=>	'inherit',
			'post_type'			=>	'attachment',
			'post_mime_type'	=>	'image',
			'order'				=>	$order,
			'orderby'			=>	$orderby
		) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( $exclude ) {
		$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
		$attachments = get_children( array(
			'post_parent'		=>	$id,
			'exclude'			=>	$exclude,
			'post_status'		=>	'inherit',
			'post_type'			=>	'attachment',
			'post_mime_type'	=>	'image',
			'order'				=>	$order,
			'orderby'			=>	$orderby
		) );
	} else {
		$attachments = get_children( array(
			'post_parent'		=>	$id,
			'post_status'		=>	'inherit',
			'post_type'			=>	'attachment',
			'post_mime_type'	=>	'image',
			'order'				=>	$order,
			'orderby'			=>	$orderby
		) );
	}

	if ( empty( $attachments ) )
		return;

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link( $att_id, $size, true ) . "\n";
		return $output;
	}
	
	

	$itemtag	=	tag_escape( $itemtag );
	$captiontag	=	tag_escape( $captiontag );
	$columns	=	intval( min( array( 8, $columns ) ) );
	$float		=	(is_rtl()) ? 'right' : 'left';

	if ( 4 > $columns )
		$size = 'full';
	
	$selector	=	"gallery-{$instance}";
	$size_class	=	sanitize_html_class( $size );
	$output		=	"<ul id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class} thumbnails'>";

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {
		$comments = get_comments( array(
			'post_id'	=>	$id,
			'count'		=>	true,
			'type'		=>	'comment',
			'status'	=>	'approve'
		) );
		
		$link = wp_get_attachment_link( $id, $size, ! ( isset( $attr['link'] ) AND 'file' == $attr['link'] ) );
		$clear_class = ( 0 == $i++ % $columns ) ? ' clear' : '';
		$span = 'span' . floor( 8 / $columns );
		
		$output .= "<li class='{$span}{$clear_class}'><{$itemtag} class='gallery-item'>";
		$output .= "<{$icontag} class='gallery-icon'>{$link}</{$icontag}>\n";
			
		if ( $captiontag AND ( 0 < $comments OR trim( $attachment->post_excerpt ) ) ) {
			$comments	=	( 0 < $comments ) ? sprintf( _n('%d comment', '%d comments', $comments, 'the-bootstrap'), $comments ) : '';
			$excerpt	=	wptexturize( $attachment->post_excerpt );
			$out		=	($comments AND $excerpt) ? " $excerpt <br /> $comments " : " $excerpt$comments ";
			$output		.=	"<{$captiontag} class='wp-caption-text gallery-caption'>{$out}</{$captiontag}>\n";
		}
		$output .= "</{$itemtag}></li>\n";
	}
	$output .= "</ul>\n";
	
	return $output;
}
add_filter( 'post_gallery', 'the_bootstrap_post_gallery', 10, 2 );


/**
 * HTML 5 caption for pictures
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @param	string	$empty
 * @param	array	$attr
 * @param	string	$content
 *
 * @return	string
 */
function the_bootstrap_img_caption_shortcode( $empty, $attr, $content ) {

	extract( shortcode_atts( array(
		'id'		=>	'',
		'align'		=>	'alignnone',
		'width'		=>	'',
		'caption'	=>	''
	), $attr ) );

	if ( 1 > (int) $width OR empty( $caption ) ) {
		return $content;
	}

	if ( $id ) {
		$id = 'id="' . $id . '" ';
	}

	return '<figure ' . $id . 'class="wp-caption thumbnail ' . $align . '" style="width: '.$width.'px;">
				' . do_shortcode( str_replace( 'class="thumbnail', 'class="', $content ) ) . '
				<figcaption class="wp-caption-text">' . $caption . '</figcaption>
			</figure>';
}
add_filter( 'img_caption_shortcode', 'the_bootstrap_img_caption_shortcode', 10, 3 );


/**
 * Returns a password form which dispalys nicely with Bootstrap
 *
 * @author	Konstantin Obenland
 * @since	1.0.0 - 05.02.2012
 *
 * @param	string	$form
 *
 * @return	string	The Bootstrap password form
 */
function the_bootstrap_the_password_form( $form ) {
	return '<form class="post-password-form form-horizontal" action="' . home_url( 'wp-pass.php' ) . '" method="post"><legend>'. __( 'This post is password protected. To view it please enter your password below:', 'the-bootstrap' ) . '</legend><div class="control-group"><label class="control-label" for="post-password-' . get_the_ID() . '">' . __( 'Password:', 'the-bootstrap' ) .'</label><div class="controls"><input name="post_password" id="post-password-' . get_the_ID() . '" type="password" size="20" /></div></div><div class="form-actions"><button type="submit" class="post-password-submit submit btn btn-primary">' . __( 'Submit', 'the-bootstrap' ) . '</button></div></form>';
}
add_filter( 'the_password_form', 'the_bootstrap_the_password_form' );


/**
 * Modifies the category dropdown args for widgets on 404 pages
 *
 * @author	Konstantin Obenland
 * @since	1.5.0 - 19.05.2012
 *
 * @param	array	$args
 *
 * @return	array
 */
function the_bootstrap_widget_categories_dropdown_args( $args ) {
	if ( is_404() ) {
		$args	=	wp_parse_args( $args, array(
			'orderby'		=>	'count',
			'order'			=>	'DESC',
			'show_count'	=>	1,
			'title_li'		=>	'',
			'number'		=>	10
		) );
	}
	return $args;
}
add_filter( 'widget_categories_dropdown_args', 'the_bootstrap_widget_categories_dropdown_args' );


/**
 * Adds the .thumbnail class when images are sent to editor
 * 
 * @author	Konstantin Obenland
 * @since	2.0.0 - 29.08.2012
 * 
 * @param	string	$html
 * @param	int		$id
 * @param	string	$caption
 * @param	string	$title
 * @param	string	$align
 * @param	string	$url
 * @param	string	$size
 * @param	string	$alt
 * 
 * @return	string	Image HTML
 */
function the_bootstrap_image_send_to_editor( $html, $id, $caption, $title, $align, $url, $size, $alt ) {
	if ( $url ) {
		$html = str_replace( '<a ', '<a class="thumbnail" ', $html );
	} else {
		$html = str_replace( 'class="', 'class="thumbnail ', $html );
	}

	return $html;
}
add_filter( 'image_send_to_editor', 'the_bootstrap_image_send_to_editor', 10, 8 );


/**
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 *
 * @author	WordPress.org
 * @since	2.0.0 - 29.08.2012
 * 
 * @return	void
 */
function the_bootstrap_content_width() {
	if ( is_attachment() ) {
		global $content_width;
		$content_width = 940;
	}
}
add_action( 'template_redirect', 'the_bootstrap_content_width' );


/**
 * Returns the Theme version string
 *
 * @author	Konstantin Obenland
 * @since	1.2.4 - 07.04.2012
 * @access	private
 *
 * @return	string	The Bootstrap version
 */
function _the_bootstrap_version() {
	
	if ( function_exists( 'wp_get_theme' ) ) {
		$theme_version	=	wp_get_theme()->get( 'Version' );
	}
	else {
		$theme_data		=	get_theme_data( get_template_directory() . '/style.css' );
		$theme_version	=	$theme_data['Version'];
	}
	
	return $theme_version;
}

function contentTruncate($str, $len, $link, $link_content){
    $output = "";
    if(strlen($str) > $len){
        $output .= substr($str, 0, $len);
        $output .= "...<a href='".$link."' class='continue'>".$link_content."</a>";
    }else{
        $output .= $str;
    }
    return $output;
}
function stringTruncate($str, $len, $link){
    $output = "";
    if(strlen($str) > $len){
        $output .= substr($str, 0, $len);
        $output .= " <a href='".$link."' class='moreNews'>READ MORE ></a>";
    }else{
        $output .= $str;
    }
    return $output;
}

function call_api($url){
    $private_key = 'dbdaef09330dc4a05bd4d7b111d3cd6a';
    $unique_partner_name = 'WeboniseLab-Lecavalier';
    date_default_timezone_set("America/New_York");
    $utc = time() . '000';
    $authKey =  $unique_partner_name.'|'.$utc.'|'.sha1($unique_partner_name.$utc.$private_key);
    $url = $url.$authKey;
    $response = wp_remote_get($url,array( 'timeout' => 120));
    if ( is_wp_error($response)){
        return array();
    }
    $response = json_decode($response["body"],true);
    return $response;
}

function search_shedule($schedules,$location){

    $data = array();
    $index = 0;
    foreach($schedules as $schedule){
        if($schedule['location'] == $location){
            $index++;
            $data[$index]= $schedule;
        }
    }
    return $data;
}

function vinny_schedule($games, $location=""){
    $flag = false;
    $current_date = date("D M d Y G:i(worry) T");
    $current_month = "";
    $oneTime = true;
    $output = "";
    $games =  array_reverse($games);
    foreach($games as $game){
        $date = strtotime($game['date']);
        if(!$flag){
            if($location == ""){
                $flag = $date >= strtotime($current_date) ? true : false;
            }else{
                $flag = ($date >= strtotime($current_date) && $game['location'] == $location) ? true : false;}
        }
        if($flag){
            $month = date("M", $date);
            if($oneTime){
                $output .= '<h3 class="mediumHeading">'.date("F Y", $date).'</h3>';
                $output .= '<div class="'.date("F", $date).'"><table class="table listing table-striped table-hover"><thead><tr><th>DATE</th><th>visitor</th><th>home</th><th>TIME (ET)</th><th></th></tr></thead><tbody>';
                $current_month = $month;
                $oneTime = false;
            }
            if($month != $current_month){
                $output .= "</tbody></table></div>";
                $output .= '<h3 class="mediumHeading">'.date("F Y", $date).'</h3>';
                $output .= '<div class="'.date("F", $date).'"><table class="table listing table-striped table-hover"><thead><tr><th>DATE</th><th>visitor</th><th>home</th><th>TIME (ET)</th><th></th></tr></thead><tbody>';
                $current_month = $month;
            }
            if($location == ""){
                $output .= "<tr><td>";
                $output .= date('D, M d, Y',$date);
                $output .= "</td><td>";
                $output .= $game['location'] == "away" ? "Flyers" : $game['opponentTeamName'] ;
                $output .= "</td><td>";
                $output .= $game['location'] == "home" ? "Flyers" : $game['opponentTeamName'] ;
                $output .= "</td><td>";
                $output .= date('h:i a',$date);
                $output .= '</td><td><a href="http://flyers.nhl.com/club/page.htm?id=92386" class="grayBtn" target="_blank">Tickets</a></td></tr>';
            }else{
                if($game['location'] == $location){
                    $output .= "<tr><td>";
                    $output .= date('D, M d, Y',$date);
                    $output .= "</td><td>";
                    $output .= $game['location'] == "away" ? "Flyers" : $game['opponentTeamName'] ;
                    $output .= "</td><td>";
                    $output .= $game['location'] == "home" ? "Flyers" : $game['opponentTeamName'] ;
                    $output .= "</td><td>";
                    $output .= date('h:i a',$date);
                    $output .= '</td><td><a href="http://flyers.nhl.com/club/page.htm?id=92386" class="grayBtn" target="_blank">Tickets</a></td></tr>';
                }
            }
        }
    }
    if(!$oneTime){
        $output .= "</tbody></table></div>";
    }else{
        $output .= ' <h3 class="mediumHeading">'.date("F Y").'</h3>';
        $output .= '<div><table class="table listing table-striped table-hover"><thead><tr><th>DATE</th><th>visitor</th><th>home</th><th>TIME (ET)</th><th></th></tr></thead><tbody>';
        $output .= "<tr><td class='centerTd' colspan='5'>Data Not Found</td></tr>";
        $output .= "</tbody></table></div>";
    }
    return $output;
}
add_action( 'admin_head', 'admin_css' );
function admin_css()
{
    echo '<link rel="stylesheet" type="text/css" href="'.get_template_url().'/css/admin_custom.css">';
}
function lastGoalOrAssists($seasonGames,$keyValue){
    if(!empty($seasonGames)){
        foreach($seasonGames as $game){
            if($game[$keyValue]>0){
                $data =  date("M d'y",strtotime($game['date']))." ".$game['game']."(".$game[$keyValue].")";
                break;
            }
        }
    }else{
        $data = "Data Not Found";
    }
    return $data;
}

function get_month_week_details($seasonGames){
    $week_details = array(
        "Games Played" => array('sun'=> 0, 'mon' => 0, 'tue' => 0, 'wed' => 0, 'thu' => 0, 'fri' => 0, 'sat' => 0  ),
        "Goals" => array('sun'=> 0, 'mon' => 0, 'tue' => 0, 'wed' => 0, 'thu' => 0, 'fri' => 0, 'sat' => 0  ),
        "Assists" => array('sun'=> 0, 'mon' => 0, 'tue' => 0, 'wed' => 0, 'thu' => 0, 'fri' => 0, 'sat' => 0  ),
        "Points" => array('sun'=> 0, 'mon' => 0, 'tue' => 0, 'wed' => 0, 'thu' => 0, 'fri' => 0, 'sat' => 0  ),
        "Plus/Minus" => array('sun'=> 0, 'mon' => 0, 'tue' => 0, 'wed' => 0, 'thu' => 0, 'fri' => 0, 'sat' => 0  ),
        "Power Play Goals" => array('sun'=> 0, 'mon' => 0, 'tue' => 0, 'wed' => 0, 'thu' => 0, 'fri' => 0, 'sat' => 0  )
    );
    $month_details = array(
        "Games Played" => array('oct'=> 0, 'nov' => 0, 'dec' => 0, 'jan' => 0, 'feb' => 0, 'mar' => 0, 'apr' => 0  ),
        "Goals" => array('oct'=> 0, 'nov' => 0, 'dec' => 0, 'jan' => 0, 'feb' => 0, 'mar' => 0, 'apr' => 0  ),
        "Assists" => array('oct'=> 0, 'nov' => 0, 'dec' => 0, 'jan' => 0, 'feb' => 0, 'mar' => 0, 'apr' => 0  ),
        "Points" => array('oct'=> 0, 'nov' => 0, 'dec' => 0, 'jan' => 0, 'feb' => 0, 'mar' => 0, 'apr' => 0  ),
        "Plus/Minus" => array('oct'=> 0, 'nov' => 0, 'dec' => 0, 'jan' => 0, 'feb' => 0, 'mar' => 0, 'apr' => 0  ),
        "Power Play Goals" => array('oct'=> 0, 'nov' => 0, 'dec' => 0, 'jan' => 0, 'feb' => 0, 'mar' => 0, 'apr' => 0  )
    );

    foreach($seasonGames as $seasonGame){
        $mon = date("M",strtotime($seasonGame['date']));
        switch($mon){
            case "Oct":
                $month_details['Games Played']['oct'] += 1;
                $month_details['Goals']['oct'] += $seasonGame['goals'];
                $month_details['Assists']['oct'] += $seasonGame['assists'];
                $month_details['Points']['oct'] += $seasonGame['points'];
                $month_details['Plus/Minus']['oct'] += $seasonGame['plusMinus'];
                $month_details['Power Play Goals']['oct'] += $seasonGame['powerPlayGoals'];
                break;
            case "Nov":
                $month_details['Games Played']['nov'] += 1;
                $month_details['Goals']['nov'] += $seasonGame['goals'];
                $month_details['Assists']['nov'] += $seasonGame['assists'];
                $month_details['Points']['nov'] += $seasonGame['points'];
                $month_details['Plus/Minus']['nov'] += $seasonGame['plusMinus'];
                $month_details['Power Play Goals']['nov'] += $seasonGame['powerPlayGoals'];
                break;
            case "Dec":
                $month_details['Games Played']['dec'] += 1;
                $month_details['Goals']['dec'] += $seasonGame['goals'];
                $month_details['Assists']['dec'] += $seasonGame['assists'];
                $month_details['Points']['dec'] += $seasonGame['points'];
                $month_details['Plus/Minus']['dec'] += $seasonGame['plusMinus'];
                $month_details['Power Play Goals']['dec'] += $seasonGame['powerPlayGoals'];
                break;
            case "Jan":
                $month_details['Games Played']['jan'] += 1;
                $month_details['Goals']['jan'] += $seasonGame['goals'];
                $month_details['Assists']['jan'] += $seasonGame['assists'];
                $month_details['Points']['jan'] += $seasonGame['points'];
                $month_details['Plus/Minus']['jan'] += $seasonGame['plusMinus'];
                $month_details['Power Play Goals']['jan'] += $seasonGame['powerPlayGoals'];
                break;
            case "Feb":
                $month_details['Games Played']['feb'] += 1;
                $month_details['Goals']['feb'] += $seasonGame['goals'];
                $month_details['Assists']['feb'] += $seasonGame['assists'];
                $month_details['Points']['feb'] += $seasonGame['points'];
                $month_details['Plus/Minus']['feb'] += $seasonGame['plusMinus'];
                $month_details['Power Play Goals']['feb'] += $seasonGame['powerPlayGoals'];
                break;
            case "Mar":
                $month_details['Games Played']['mar'] += 1;
                $month_details['Goals']['mar'] += $seasonGame['goals'];
                $month_details['Assists']['mar'] += $seasonGame['assists'];
                $month_details['Points']['mar'] += $seasonGame['points'];
                $month_details['Plus/Minus']['mar'] += $seasonGame['plusMinus'];
                $month_details['Power Play Goals']['mar'] += $seasonGame['powerPlayGoals'];
                break;
            case "Apr":
                $month_details['Games Played']['apr'] += 1;
                $month_details['Goals']['apr'] += $seasonGame['goals'];
                $month_details['Assists']['apr'] += $seasonGame['assists'];
                $month_details['Points']['apr'] += $seasonGame['points'];
                $month_details['Plus/Minus']['apr'] += $seasonGame['plusMinus'];
                $month_details['Power Play Goals']['apr'] += $seasonGame['powerPlayGoals'];
                break;
        }

        $day = date("D",strtotime($seasonGame['date']));
        switch($day){
            case "Sun":
                $week_details["Games Played"]['sun'] += 1;
                $week_details["Goals"]['sun'] += $seasonGame['goals'];
                $week_details["Assists"]['sun'] += $seasonGame['assists'];
                $week_details["Points"]['sun'] += $seasonGame['points'];
                $week_details["Plus/Minus"]['sun'] += $seasonGame['plusMinus'];
                $week_details["Power Play Goals"]['sun'] += $seasonGame['powerPlayGoals'];
                break;
            case "Mon":
                $week_details["Games Played"]['mon'] += 1;
                $week_details["Goals"]['mon'] += $seasonGame['goals'];
                $week_details["Assists"]['mon'] += $seasonGame['assists'];
                $week_details["Points"]['mon'] += $seasonGame['points'];
                $week_details["Plus/Minus"]['mon'] += $seasonGame['plusMinus'];
                $week_details["Power Play Goals"]['mon'] += $seasonGame['powerPlayGoals'];
                break;
            case "Tue":
                $week_details["Games Played"]['tue'] += 1;
                $week_details["Goals"]['tue'] += $seasonGame['goals'];
                $week_details["Assists"]['tue'] += $seasonGame['assists'];
                $week_details["Points"]['tue'] += $seasonGame['points'];
                $week_details["Plus/Minus"]['tue'] += $seasonGame['plusMinus'];
                $week_details["Power Play Goals"]['tue'] += $seasonGame['powerPlayGoals'];
                break;
            case "Wed":
                $week_details["Games Played"]['wed'] += 1;
                $week_details["Goals"]['wed'] += $seasonGame['goals'];
                $week_details["Assists"]['wed'] += $seasonGame['assists'];
                $week_details["Points"]['wed'] += $seasonGame['points'];
                $week_details["Plus/Minus"]['wed'] += $seasonGame['plusMinus'];
                $week_details["Power Play Goals"]['wed'] += $seasonGame['powerPlayGoals'];
                break;
            case "Thu":
                $week_details["Games Played"]['thu'] += 1;
                $week_details["Goals"]['thu'] += $seasonGame['goals'];
                $week_details["Assists"]['thu'] += $seasonGame['assists'];
                $week_details["Points"]['thu'] += $seasonGame['points'];
                $week_details["Plus/Minus"]['thu'] += $seasonGame['plusMinus'];
                $week_details["Power Play Goals"]['thu'] += $seasonGame['powerPlayGoals'];
                break;
            case "Fri":
                $week_details["Games Played"]['fri'] += 1;
                $week_details["Goals"]['fri'] += $seasonGame['goals'];
                $week_details["Assists"]['fri'] += $seasonGame['assists'];
                $week_details["Points"]['fri'] += $seasonGame['points'];
                $week_details["Plus/Minus"]['fri'] += $seasonGame['plusMinus'];
                $week_details["Power Play Goals"]['fri'] += $seasonGame['powerPlayGoals'];
                break;
            case "Sat":
                $week_details["Games Played"]['sat'] += 1;
                $week_details["Goals"]['sat'] += $seasonGame['goals'];
                $week_details["Assists"]['sat'] += $seasonGame['assists'];
                $week_details["Points"]['sat'] += $seasonGame['points'];
                $week_details["Plus/Minus"]['sat'] += $seasonGame['plusMinus'];
                $week_details["Power Play Goals"]['sat'] += $seasonGame['powerPlayGoals'];
                break;
        }
    }
    return array($month_details, $week_details);
}
function getRegularSeason(){
    $m = date("m");
    $y = $m > 9 ? date("Y") + 1 : date("Y");
    for($i = $y; $i > 1998; $i--){
        if($i != 2005 ){
            echo "<option value='".($i-1).$i."'>".($i-1)."-".$i."</option>";}
    }
}

wp_enqueue_script('jquery');
add_action('wp_ajax_getSplit', 'getSplit');
add_action('wp_ajax_nopriv_getSplit', 'getSplit');
add_action('wp_ajax_getGameLog', 'getGameLog');
add_action('wp_ajax_nopriv_getGameLog', 'getGameLog');
add_action('wp_ajax_getStatistics', 'getStatistics');
add_action('wp_ajax_nopriv_getStatistics', 'getStatistics');
add_action('wp_ajax_addContact', 'addContact');
add_action('wp_ajax_nopriv_addContact', 'addContact');

function getSplit(){
    $seasonId = $_POST['season'];
    $regularSeasonStats = array();
    $seasonGames = array();
    $output = "";
    $SeasonStatastics = call_api("http://www.nhl.com/feed/nhl/playerdata/playercard.json?id=8467329&seasonid=$seasonId&auth=");
    if(!empty($SeasonStatastics)){
        $regularSeasonStats = $SeasonStatastics['regularseasonstats'][0];
        $seasonGames = $SeasonStatastics['gamebygame'];
    }
    $result = !empty($seasonGames) ? get_month_week_details($seasonGames) : array();
    $output = '<div id="statsTableInner4"><table class="table table-bordered statsTable normalCase"><thead><tr><th></th><th><span class="toolTip" title="GAMES PLAYED">GP</span></th><th>G</th><th>A</th><th>P</th><th>+ / -</th><th>PIM</th><th>PP</th><th>SH</th><th>GWG</th><th>S</th><th>Hits</th><th>Bks</th></tr></thead><tbody>';
    if(!empty($regularSeasonStats)){
        $output .= "<tr><td>REGULAR SEASON</td><td>".$regularSeasonStats['gp']."</td><td>".$regularSeasonStats['goals']."</td><td>".$regularSeasonStats['assists']."</td><td>".$regularSeasonStats['points']."</td><td>".$regularSeasonStats['plusMinus']."</td><td>".$regularSeasonStats['pim']."</td><td>".$regularSeasonStats['powerPlayGoals']."</td><td>".$regularSeasonStats['shortHandedGoals']."</td><td>".$regularSeasonStats['gameWinningGoals']."</td><td>".$regularSeasonStats['shots']."</td><td>".$regularSeasonStats['hits']."</td><td>".$regularSeasonStats['blockedShots']."</td></tr>";
    }else{
        $output .= "<tr><td colspan='13'>Data Not Found</td></tr>";
    }
    $output .= "</tbody></table></div>";
    $output .= '<h5 class="smallHeading withBg">LAST GOAL/ASSIST FOR SEASON</h5><div id="statsTableInner5"><table class="table table-bordered statsTable"><tbody><tr><td>LAST GOAL (GAMES PLAYED SINCE):</td><td>'.lastGoalOrAssists($seasonGames,"goals").'</td></tr><tr><td>LAST ASSIST (GAMES PLAYED SINCE):</td><td>'.lastGoalOrAssists($seasonGames,"assists").'</td></tr></tbody></table></div>';
    $output .= '<h5 class="smallHeading withBg">EVEN STRENGTH, POWER PLAY, SHORTHANDED</h5><div id="statsTableInner6"><table class="table table-bordered statsTable"></tbody>';
    if(!empty($regularSeasonStats)){
        $output .= '<tr><td>ES GOALS:</td><td>'.($regularSeasonStats["goals"]-($regularSeasonStats["powerPlayGoals"]+$regularSeasonStats["shortHandedGoals"])).'</td><td>PP GOALS:</td><td>'.$regularSeasonStats["powerPlayGoals"].'</td><td>SH GOALS:</td><td>'.$regularSeasonStats["shortHandedGoals"].'</td></tr>';
    }else{
        $output .= "<tr><td colspan='6'>Data Not Found</td></tr>";
    }
    $output .= "</tbody></table></div>";
    $output .= '<h5 class="smallHeading withBg">STATS BY MONTH</h5><div id="statsTableInner7"><table class="table table-bordered statsTable"><thead><tr><th></th><th>OCT</th><th>NOV</th><th>DEC</th><th>JAN</th><th>FEB</th><th>MAR</th><th>APR</th></tr></thead><tbody>';
    if(!empty($result)){
        foreach($result[0] as $key => $month_detail){
            $output .= "<tr>";
            $output .= "<td>".$key."</td>";
            $output .= "<td>".$month_detail['oct']."</td>";
            $output .= "<td>".$month_detail['nov']."</td>";
            $output .= "<td>".$month_detail['dec']."</td>";
            $output .= "<td>".$month_detail['jan']."</td>";
            $output .= "<td>".$month_detail['feb']."</td>";
            $output .= "<td>".$month_detail['mar']."</td>";
            $output .= "<td>".$month_detail['apr']."</td></tr>";
        }
    }else{
        $output .= "<tr><td colspan='8'>Data Not Found</td></tr>";
    }
    $output .= "</tbody></table></div>";
    $output .= '<h5 class="smallHeading withBg">STATS BY DAY OF WEEK</h5><div id="statsTableInner8"><table class="table table-bordered statsTable"><thead><tr><th></th><th>SUNDAY</th><th>MONDAY</th><th>TUESDAY</th><th>WEDNESDAY</th><th>THURSDAY</th><th>FRIDAY</th><th>SATURDAY</th></tr></thead><tbody>';
    if(!empty($result)){
        foreach($result[1] as $key => $week_detail){
            $output .= "<tr>";
            $output .= "<td>".$key."</td>";
            $output .= "<td>".$week_detail['sun']."</td>";
            $output .= "<td>".$week_detail['mon']."</td>";
            $output .= "<td>".$week_detail['tue']."</td>";
            $output .= "<td>".$week_detail['wed']."</td>";
            $output .= "<td>".$week_detail['thu']."</td>";
            $output .= "<td>".$week_detail['fri']."</td>";
            $output .= "<td>".$week_detail['sat']."</td></tr>";
        }
    }else{
        $output .= "<tr><td colspan='8'>Data Not Found</td></tr>";
    }
    $output .= "</tbody></table></div>";
    echo $output;
    echo '<script type="text/javascript"> if(jQuery(window).width()<=767){jQuery("#homeScheduleScrollbar, #statsTableInner1, #statsTableInner2, #statsTableInner3, #statsTableInner4, #statsTableInner5, #statsTableInner6, #statsTableInner7, #statsTableInner8, #statsTableInner9, .January, .February, .March, .April, .May, .June, .July, .August, .September, .October, .November, .December, #scheduleScrollbar, #statsScrollbar, #splitsScrollbar, #gameLogsScrollbar, #tweets, .patientTabs, .innerMenuInner").mCustomScrollbar("destroy");}</script>';
   exit;
}

function getGameLog(){
    $seasonId = $_POST['season'];
    $seasonGames = array();
    $output = "";
    $SeasonStatastics = call_api("http://www.nhl.com/feed/nhl/playerdata/playercard.json?id=8467329&seasonid=$seasonId&auth=");
    if(!empty($SeasonStatastics)){
        $seasonGames = $SeasonStatastics['gamebygame'];
    }
    if(!empty($seasonGames)){
        foreach($seasonGames as $key=>$game){
            $output .= "<tr>";
            $output .= "<td>".date("M d'y",strtotime($game['date']))." ".$game['game']."</td>";
            $output .= "<td>".$game['goals']."</td>";
            $output .= "<td>".$game['assists']."</td>";
            $output .= "<td>".$game['points']."</td>";
            $output .= "<td>".$game['plusMinus']."</td>";
            $output .= "<td>".$game['pim']."</td>";
            $output .= "<td>".$game['powerPlayGoals']."</td>";
            $output .= "<td>".$game['shortHandedGoals']."</td>";
            $output .= "<td>".$game['shots']."</td>";
            $output .= "<td>".$game['shotPct']."</td>";
            $output .= "<td>".$game['shifts']."</td>";
            $output .= "<td>".$game['timeOnIce']."</td>";
            $output .= "<td>".$game['faceoffPct']."</td>";
        }
    }else{
        $output .= "<tr><td colspan='13' class='tdText'>Data Not Found</td></tr>";
    }
    echo $output;
    echo '<script type="text/javascript"> if(jQuery(window).width()<=767){jQuery("#homeScheduleScrollbar, #statsTableInner1, #statsTableInner2, #statsTableInner3, #statsTableInner4, #statsTableInner5, #statsTableInner6, #statsTableInner7, #statsTableInner8, #statsTableInner9, .January, .February, .March, .April, .May, .June, .July, .August, .September, .October, .November, .December, #scheduleScrollbar, #statsScrollbar, #splitsScrollbar, #gameLogsScrollbar, #tweets, .patientTabs, .innerMenuInner").mCustomScrollbar("destroy");}</script>';
    exit;
}

function getStatistics(){
    $responses = call_api("http://www.nhl.com/feed/nhl/club/schedule.json?team=PHI&auth=");
    $games = !empty($responses) ? $responses["games"] : array();
    echo vinny_schedule($games, $_POST["place"]);
    echo '<script type="text/javascript"> if(jQuery(window).width()<=767){jQuery("#homeScheduleScrollbar, #statsTableInner1, #statsTableInner2, #statsTableInner3, #statsTableInner4, #statsTableInner5, #statsTableInner6, #statsTableInner7, #statsTableInner8, #statsTableInner9, .January, .February, .March, .April, .May, .June, .July, .August, .September, .October, .November, .December, #scheduleScrollbar, #statsScrollbar, #splitsScrollbar, #gameLogsScrollbar, #tweets, .patientTabs, .innerMenuInner").mCustomScrollbar("destroy");}</script>';
    exit;
}

function addContact(){
    global $wpdb;
    $table_name = $wpdb->prefix . "contacts";
    $dateTime = date('Y-m-d h:i:s', time());
    if($wpdb->insert($table_name ,array(
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'company' => $_POST['company'],
        'ph_no' => $_POST['phNo'],
        'message' => $_POST['message'],
        'submitted_on' => $dateTime,
    ))===FALSE){
        echo "Something went wrong";
    }
    else {
        if(getenv('env')=="development"){
            $to = "simanchala@weboniselab.com";}
        elseif(getenv('env')=="staging"){
            $to = "simanchala@weboniselab.com, mitali@weboniselab.com";
        }else{
            $to = "glecavalierbale@vinny40.org";
        }
        $headers = "MIME-Version: 1.0\n"."From: Vinny40 <vinny40.com>\n" ."Content-Type: text/html; charset=\"" .get_option('blog_charset') . "\"\n";
        $body = "<p>Name: ". $_POST['name']."</p><p>Email: ".$_POST['email']."</p> <p>Company: ".$_POST['company']."</p><p>Phone Number: ".$_POST['phNo']."</p><p>Message: ".$_POST['message']."</p><p>Thanks<p></p>Vinny40</p>";
        $subject = "Contact Form Submission";
        wp_mail( $to, $subject, $body, $headers);
        $subject = "Thank you";
        $headers= "MIME-Version: 1.0\n"."From: Vinny40 <vinny40.com>\n" ."Content-Type: text/html; charset=\"" .get_option('blog_charset') . "\"\n";
        $body = "<p>Thank you for contacting us, we will get in touch with you shortly.</p><p>Vinny40</p>";
        wp_mail( $_POST['email'], $subject, $body, $headers);
        echo "Thank you for filling out your information, we will be in contact shortly.";
    }
    exit;
}

function custom_pagination($total, $page_name, $per_page){
    if($total->number_of_rows > $per_page){
        $t = $total->number_of_rows/$per_page;
        if(intval($t)< $t){
            $pages=intval($t)+1;
        }else{
            $pages = $t;
        }
        $url = "admin.php?page=".$page_name."&page_no=";
        ?>
    <div class="pagination pagination-centered">
        <ul>
            <?php echo isset($_GET['page_no']) && $_GET['page_no']>=1 ?  "<li><a href='".$url.($_GET['page_no']-1)."'>Prev</a></li>" : ''; ?>
            <?php
            $e = isset($_GET['page_no']) ? ($_GET['page_no']+1) : 1;
            for($i=1;$i<=$pages;$i++){
                echo $i==$e ? "<li class='disabled'><a href='".$url.($i-1)."'>$i</a></li>" : "<li><a href='".$url.($i-1)."'>$i</a></li>" ;
            }
            echo isset($_GET['page_no']) && $_GET['page_no']<($t-1) ? "<li><a href='".$url.($_GET['page_no']+1)."'>Next</a></li>": '';
            echo !isset($_GET['page_no']) ? "<li><a href='".$url.($_GET['page_no']+1)."'>Next</a></li>": '';?>
        </ul>
    </div>
    <?php }
}

function get_current_page_name($name =  ""){
    static $current_page_name;
    if($name != ""){
    $current_page_name =  $name;}
    return $current_page_name;
}

function get_template_url(){
    $template = get_template();
    return site_url()."/wp-content/themes/".$template;

}
/* End of file functions.php */
/* Location: ./wp-content/themes/the-bootstrap/functions.php */