<?php
/** index.php
 *
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @author		Konstantin Obenland
 * @package		The Bootstrap
 * @since		1.0.0 - 05.02.2012
 */

get_header(); ?>
<?php
if(getenv('env')=="development"){
    $site_url = "http://vinny40.webonise.com/player/";
    $site_url1 = "http://vinny40.weboniselab.com/philanthropist/";
}
elseif(getenv('env')=="staging"){
    $site_url = "http://vinny40.weboapps.com/player/";
    $site_url1 = "http://vinny40org.weboapps.com/philanthropist/";
}
else{
    $site_url = "http://vinny40.com/player/";
    $site_url1 = "http://vinny40.org/philanthropist/";
}
?>
<div class="wrapper">
    <img src="<?php echo get_template_url(); ?>/img/vinny-left-active.jpg" class="hidden">
    <img src="<?php echo get_template_url(); ?>/img/vinny-right-active.jpg" class="hidden">

    <div class="homeImageWrapper clearfix showDesktop">
        <div class="leftSide">
            <img id="Image-Maps_6201311280606165" src="<?php echo get_template_url(); ?>/img/vinny-left.jpg" usemap="#Image-Maps_6201311280606165" border="0" width="800" height="758" alt="" />
            <map id="_Image-Maps_6201311280606165" name="Image-Maps_6201311280606165">
                <area
                    shape="poly"
                    coords="250,757,276,700,309,650,351,614,378,601,409,584,443,565,482,542,528,519,569,497,608,480,631,474,660,436,663,419,520,419,520,391,665,389,666,366,661,315,647,319,633,311,624,289,622,254,620,224,623,194,630,186,616,164,619,133,626,94,639,42,648,21,650,8,658,1,799,1,799,757,255,757,"
                    href="<?php echo $site_url; ?>"
                    alt="The Player" title="The Player"
                    onmouseover="if(document.images) document.getElementById('Image-Maps_6201311280606165').src= '<?php echo get_template_url(); ?>/img/vinny-left-active.jpg';"
                    onmouseout="if(document.images) document.getElementById('Image-Maps_6201311280606165').src= '<?php echo get_template_url(); ?>/img/vinny-left.jpg';">
                <area shape="rect" coords="798,756,800,758" href="<?php echo $site_url?>" alt="Image Map" title="Image Map" />
            </map>
            <span class="leftSideSpan">The Player</span>
        </div>
        <div class="rightSide">
            <img id="Image-Maps_6201311280606166" src="<?php echo get_template_url(); ?>/img/vinny-right.jpg" usemap="#Image-Maps_6201311280606166" border="0" width="800" height="758" alt="" />
            <map id="_Image-Maps_6201311280606166" name="Image-Maps_6201311280606166">
                <area shape="poly" coords="0,1,152,0,172,18,181,39,201,73,205,108,199,140,198,168,201,210,196,209,189,222,192,248,193,276,189,301,165,320,151,342,144,351,144,395,396,397,400,416,146,420,166,442,186,480,221,502,298,539,368,573,433,604,491,643,516,681,534,725,539,757,0,757,2,9,"
                      href="<?php echo $site_url1; ?>" alt="The Philanthropist" title="The Philanthropist"
                      onmouseover="if(document.images) document.getElementById('Image-Maps_6201311280606166').src= '<?php echo get_template_url(); ?>/img/vinny-right-active.jpg';"
                      onmouseout="if(document.images) document.getElementById('Image-Maps_6201311280606166').src= '<?php echo get_template_url(); ?>/img/vinny-right.jpg';">
                <area shape="rect" coords="798,756,800,758" href="<?php echo $site_url1; ?>" alt="Image Map" title="Image Map" />
            </map>
            <span class="rightSideSpan">The Philanthropist</span>
        </div>
    </div>

    <div class="homeIphoneImageWrapper clearfix showIpad">
        <div class="leftSide">
            <a href="<?php echo $site_url; ?>"><img src="<?php echo get_template_url(); ?>/img/vinny-home-iphone-left.jpg" alt="" title="The Player" /></a>
        </div>
        <div class="rightSide">
            <a href="<?php echo $site_url1; ?>"><img src="<?php echo get_template_url(); ?>/img/vinny-home-iphone-right.jpg" alt="" title="The Philanthropist" /></a>
        </div>
    </div>
</div>

<?php
//get_sidebar();
get_footer();


/* End of file index.php */
/* Location: ./wp-content/themes/the-bootstrap/index.php */