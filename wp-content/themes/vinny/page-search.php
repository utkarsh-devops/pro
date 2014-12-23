<?php
get_header();
?>

<header class="innerHeader">
    <div class="navbarWrapper">
        <div class="navbar navbar-inverse">
            <div class="container">
                <h1 class="logo" title="VINNY40"><a href="/player/" id="logo"></a></h1>
                <div class="navSearchWrapper">
                    <ul class="nav mainNav">
                        <li>
                            <a href="/player#meetVinny" title="Meet Vinny">MEET VINNY</a>
                        </li>
                        <li>
                            <a href="/player#stats" title="Stats">STATS</a>
                        </li>
                        <li>
                            <a href="/player#media" title="Media">MEDIA</a>
                        </li>
                        <li>
                            <a href="/player#schedule" title="Schedule">SCHEDULE</a>
                        </li>
                        <li class="active">
                            <a href="/player#news" title="News">NEWS</a>
                        </li>
                    </ul>
                    <form class="searchForm" title="Search" action="/search" method="get">
                        <input type="text" name="q">
                        <button type="submit" class="searchBtn"></button>
                        <button type="submit" class="searchBtnSmall"></button>
                        <span class="searchIcon"></span>
                    </form>
                </div>
                <div id="playerInnerMenu" class="innerMenu vsMenu clearfix">
                    <a href="#" class="toggleBtn responsiveButton"></a>
                    <div class="innerMenuWrapper">
                        <div class="innerMenuInner">
                        <form class="searchForm" title="Search" action="/search" method="get">
                            <input type="text" name="q">
                            <button type="submit" class="searchBtn"></button>
                            <button type="submit" class="searchBtnSmall"></button>
                            <span class="searchIcon"></span>
                        </form>
                        <ul class="nav">
                            <li>
                                <a href="/player#meetVinny" title="Meet Vinny">MEET VINNY</a>
                            </li>
                            <li>
                                <a href="/player#stats" title="Stats">STATS</a>
                            </li>
                            <li>
                                <a href="/player#media" title="Media">MEDIA</a>
                            </li>
                            <li>
                                <a href="/player#schedule" title="Schedule">SCHEDULE</a>
                            </li>
                            <li>
                                <a href="/player#news" title="News">NEWS</a>
                            </li>
                            <li>
                                <a href="http://www.vinny40.org/philanthropist/" target="_blank" class="vinnyOrgLink" title="visit vinny40.org">visit vinny40.org</a>
                            </li>
                        </ul>
                        <div class="whiteLinks">Tel: +32(0) 499 11 22 33 | Email: <a href="mailto:info@vinny40.org" title="info@vinny40.org">info@vinny40.org</a></div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<section id="news" class="newsPage moreNewsPage">
    <div class="container">
        <h2 class="heading">Search results</h2>
    <div class="searchWrapper">
        <div class="searchContainer">
            <form class="searchResultsForm" action="/search" method="get">
            <div class="input-append">
                <input class="span7" type="text" name="q">
                <button class="submitIcon" type="submit"></button>
            </div>
            </form>
            <?php
            $q = $_GET['q'];
            $newsList = !empty($q) ? $wpdb->get_results( "SELECT * FROM wp_posts where post_title LIKE '%".$q."%' and post_type='vinny_news' and post_status='publish'" ): "";
            ?>

            <ul class="vinnyNewsList">
                <?php
                if(!empty($newsList)){
                foreach($newsList as $news){?>
                <li>
                    <div class="lessNewsBlock">
                        <?php echo has_post_thumbnail($news->ID) ? get_the_post_thumbnail($news->ID,"thumbnail") :'<img src="'.get_template_url().'/img/vinny-news.jpg" alt="News">' ;?>
                        <h4 class="heading"><?php echo $news->post_title;?></h4>
                        <span class="by"> - <?php echo date("M d", strtotime($news->post_date));?> by <?php echo the_author_meta( 'display_name' , $news->post_author );?></span>
                        <p><?php echo stringTruncate(strip_tags($news->post_content),400,"#")?>
                        </p>
                    </div>
                    <div class="moreNewsBlock">
                        <h4 class="heading"><?php echo $news->post_title;?></h4>
                        <span class="by"> - <?php echo date("M d", strtotime($news->post_date));?> by <?php echo the_author_meta( 'display_name' , $news->post_author );?></span>
                        <?php echo wpautop($news->post_content);?>
                        <a href="#" class="nextBtn collapseBtn" title="Collapse"></a>
                    </div>
                </li>
                <?php }
                }else{
                    echo "<li>Sorry, but nothing matched your search criteria. Please try again with some different keywords.</li>";
                }
                    ?>
            </ul>
        </div>
        <div class="centerBtn"><a href="/player" class="orangeBtn">BACK TO HOME</a></div>
    </div>
    </div>
</section>

<?php
get_footer();
?>