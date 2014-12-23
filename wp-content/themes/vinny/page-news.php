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
        <h2 class="heading">VINNY’s news</h2>
        <?php
        $args = array(
            'paged'            => $paged,
            'posts_per_page'   => get_option('posts_per_page'),
            'post_type'        => 'vinny_news',
            'post_status'      => 'publish'
        );
        query_posts($args);
        require_once("news.php");?>
        <div class="clearfix">
            <div class="pagination customPagination">
                <?php
                the_bootstrap_content_nav( 'nav-below' );?>
            </div>
        </div>
        <a href="#" class="topBtn" title="Back to Home"></a>
    </div>
</section>

<?php
get_footer();
?>