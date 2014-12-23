<?php
/** header.php
 *
 * Displays all of the <head> section and everything up till </header>
 *
 * @author		Konstantin Obenland
 * @package		The Bootstrap
 * @since		1.0 - 05.02.2012
 */
//global $team;
?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
	<head>
		<?php tha_head_top(); ?>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<title><?php wp_title( '&laquo;', true, 'right' ); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="shortcut icon" href="<?php echo get_template_url(); ?>/img/favicon1.ico">
        <link rel="apple-touch-icon" href="<?php echo get_template_url(); ?>/img/apple-touch-icon.png" />
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_url(); ?>/img/apple-touch-icon-57x57.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_url(); ?>/img/apple-touch-icon-72x72.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_url(); ?>/img/apple-touch-icon-114x114.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_url(); ?>/img/apple-touch-icon-144x144.png" />
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_url(); ?>/img/apple-touch-icon-60x60.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_url(); ?>/img/apple-touch-icon-120x120.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_url(); ?>/img/apple-touch-icon-76x76.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_url(); ?>/img/apple-touch-icon-152x152.png" />

        <meta name="msapplication-square70x70logo" content="<?php echo get_template_url(); ?>/img/smalltile.png" />
        <meta name="msapplication-square150x150logo" content="<?php echo get_template_url(); ?>/img/mediumtile.png" />
        <meta name="msapplication-wide310x150logo" content="<?php echo get_template_url(); ?>/img/widetile.png" />
        <meta name="msapplication-square310x310logo" content="<?php echo get_template_url(); ?>/img/largetile.png" />

        <?php tha_head_bottom(); ?>
		<?php wp_head();
        get_current_page_name(get_the_title());
        ?>
        <link type="text/css" rel="stylesheet" href="<?php echo get_template_url(); ?>/css/production.min.css">
    </head>

    <body <?php if(is_page("philanthropist")){body_class("philanthropistPage");} if(is_page("news") || is_page("search") ? body_class("bodyTopPadding"): body_class()); ?> >
		        <?php
				tha_header_after();

/* End of file header.php */
/* Location: ./wp-content/themes/the-bootstrap/header.php */