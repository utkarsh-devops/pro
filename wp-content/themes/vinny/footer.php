<?php
/** footer.php
 *
 * @author		Konstantin Obenland
 * @package		The Bootstrap
 * @since		1.0.0	- 05.02.2012
 */

				tha_footer_before(); ?>
<footer class="<?php if(is_page("philanthropist")){echo "foundationFooter";} ?>"">
<div class="vinnyLogo">
    <a href="/" title="Vinny40"><img src="<?php echo get_template_url(); ?>/img/vinny40.png" alt="Vinny 40"></a>
    <?php if(is_page("philanthropist")){ ?>
    <div class="logosHolder">
        <a href="http://www.deximaging.com/" target="_blank"><img src="<?php echo get_template_url(); ?>/img/dex-imaging-white.png" alt="DEX Imaging"></a>
        <a href="http://www.kanesfurniture.com/" target="_blank"><img src="<?php echo get_template_url(); ?>/img/kanes-furniture-white.png" alt="Kane's Furniture"></a>
        <a href="http://www.sntcenter.org/" target="_blank"><img src="<?php echo get_template_url(); ?>/img/the-centers-white.png" alt="The Centers"></a>
    </div>
    <?php } ?>
</div>

<div class="textureBg">
    <?php if(is_page("philanthropist")){ ?>
    <div class="logosHolder showIphone">
        <a href="http://www.deximaging.com/" target="_blank"><img src="<?php echo get_template_url(); ?>/img/dex-imaging-white.png" alt="DEX Imaging"></a>
        <a href="http://www.kanesfurniture.com/" target="_blank"><img src="<?php echo get_template_url(); ?>/img/kanes-furniture-white.png" alt="Kane's Furniture"></a>
        <a href="http://www.sntcenter.org/" target="_blank"><img src="<?php echo get_template_url(); ?>/img/the-centers-white.png" alt="The Centers"></a>
    </div>
    <?php } ?>
    <ul class="media">
        <li><a href="https://www.facebook.com/vinny4" target="_blank" class="facebook" title="Facebook"><i></i> Facebook</a></li>
        <li><a href="https://twitter.com/VLF40" target="_blank" class="twitter" title="Twitter"><i></i> Twitter</a></li>
        <li class="footerToolTip" title="Coming soon"><a href="javascript:void(0)" class="instagram"><i></i> Instagram</a></li>
    </ul>
</div>

    <div class="bottomBar">
        <div class="container">
    <i class="footerAddressIcon"></i> 1405 True Edward P.B./S.P. 8000  Hearst (Ontario)  P0L 1N0 Canada      <span>|</span>     <i class="footerPhoneIcon"></i> Tel: +32(0) 499 11 22 33     <span>|</span>     <i class="footerEmailIcon"></i> Email: <a href="mailto:info@vinny40.org">info@vinny40.org</a>
    <small>© 2014 Vinny Lecavalier.  All Right Reserved</small>
    </div>
    </div>
    </footer>

    <?php tha_footer_after();?>
<!--	 --><?php //printf( __( '%d queries. %s seconds.', 'the-bootstrap' ), get_num_queries(), timer_stop(0, 3) ); ?><!-- -->
	<?php wp_footer(); ?>
<script type="text/javascript" src="<?php echo get_template_url(); ?>/js/production.min.js"></script>
<?php if(get_current_page_name() == "Player" || get_current_page_name() == "Philanthropist"){?><script type="text/javascript" src="<?php echo get_template_url(); ?>/js/player.js"></script><?php }?>
</body>
</html>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-47324574-1', 'vinny40.org');
    ga('send', 'pageview');
</script>
<?php


/* End of file footer.php */
/* Location: ./wp-content/themes/the-bootstrap/footer.php */