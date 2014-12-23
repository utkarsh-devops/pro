<ul class="vinnyNewsList">
    <?php  if ( have_posts() ) {
    while ( have_posts() ) { the_post();
    ?>
    <li>
        <div class="lessNewsBlock">
            <?php echo has_post_thumbnail($post->ID) ? get_the_post_thumbnail($post->ID,"thumbnail") :'<img src="'.get_template_url().'/img/vinny-news.jpg" alt="News">' ;?>
            <h4 class="heading"><?php echo $post->post_title;?></h4>
            <span class="by"> - <?php echo date("M d", strtotime($post->post_date));?> by <?php echo the_author_meta( 'display_name' , $post->post_author );?></span>
            <p><?php echo stringTruncate(strip_tags($post->post_content),450,"#")?>
            </p>
        </div>
        <div class="moreNewsBlock">
<!--            <img src="--><?php //echo get_template_url(); ?><!--/img/vinny-news.jpg" alt="News" class="moreNewsBlockImg">-->
            <h4 class="heading"><?php echo $post->post_title;?></h4>
            <span class="by"> - <?php echo date("M d", strtotime($post->post_date));?> by <?php echo the_author_meta( 'display_name' , $post->post_author );?></span>
            <?php echo wpautop($post->post_content);?>
            <a href="#" class="nextBtn collapseBtn" title="Collapse"></a>
        </div>
    </li>
    <?php }} ?>
</ul>
