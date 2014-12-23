<?php
/** 404.php
 *
 * The template for displaying 404 pages (Not Found).
 *
 * @author		Konstantin Obenland
 * @package		The Bootstrap
 * @since		1.0.0 - 07.02.2012
 */

get_header();?>
<div class="philanthropistWrapper">
    <div class="container">
        <div class="notFoundErrorWrap">
            <img src="<?php echo get_template_url(); ?>/img/404NotFound.png" alt="404 Not Found">
            <h1 class="entry-title textCenter">Page not found :(</h1>
            <a href="/">&lt;&lt; Back to Home</a>
        </div>
    </div>
</div>

<?php get_footer();


/* End of file 404.php */
/* Location: ./wp-content/themes/the-bootstrap/404.php */