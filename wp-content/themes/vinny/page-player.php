<?php
$site = site_url();
if($site != "http://www.vinny40.com" && $site != "http://vinny40.webonise.com" && $site != "http://10.0.0.85" &&  $site != "http://vinny40.weboapps.com" && $site != "http://vinny40.com" ){
    wp_redirect("/404/");}
get_header();
/*$mon_no = date('n');
if($mon_no > 4 && $mon_no <10 ){
    $seasonId = date('Y',time()).date('Y',time()) + 1;
    $season = (date('Y',time())-1)."-".(date('Y',time()));
}else{
   if($mon_no > 4){
       $seasonId = date('Y',time()).date('Y',time()) + 1;
       $season = date('Y',time())."-".(date('Y',time())+1);
   }else{
       $seasonId = (date('Y',time())-1).date('Y',time()) ;
       $season = (date('Y',time())-1)."-".(date('Y',time()));
   }
}*/
$regularSeasonStats = array();
$rank = array();
$seasonGames = array();
$SeasonStatastics = call_api("http://www.nhl.com/feed/nhl/playerdata/playercard.json?id=8467329&auth=");
if(!empty($SeasonStatastics)){
    $regularSeasonStats = $SeasonStatastics['regularseasonstats'][0];
    $season_id = str_replace("-","",$regularSeasonStats['season']);
    $rank =  $SeasonStatastics['regularseasonrankings'][0];
    $seasonGames = $SeasonStatastics['gamebygame'];
}
$responses = call_api("http://www.nhl.com/feed/nhl/club/schedule.json?team=PHI&auth=");
$games = !empty($responses) ? $responses["games"] : array();
?>

<header>
    <div class="topBarWrapper clearfix" id="topBanner">
        <div class="topBar">
                <script type="text/javascript" src="http://network.nhl.com/nhlnetnav.js"></script>
        </div>
    </div>

    <div class="navbarWrapper">
    <div class="navbar navbar-inverse" id="playerNavbar">
        <div class="container">
            <h1 class="logo" title="VINNY40"><a href="#home" id="logo"></a></h1>
            <div class="navSearchWrapper">
            <ul class="nav mainNav">
                <li>
                    <a href="#meetVinny" title="Meet Vinny">MEET VINNY</a>
                </li>
                <li>
                    <a href="#stats" title="Stats">STATS</a>
                </li>
                <li>
                    <a href="#media" title="Media">MEDIA</a>
                </li>
                <li>
                    <a href="#schedule" title="Schedule">SCHEDULE</a>
                </li>
                <li>
                    <a href="#news" title="News">NEWS</a>
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
                        <a href="#meetVinny" title="Meet Vinny">MEET VINNY</a>
                    </li>
                    <li>
                        <a href="#stats" title="Stats">STATS</a>
                    </li>
                    <li>
                        <a href="#media" title="Media">MEDIA</a>
                    </li>
                    <li>
                        <a href="#schedule" title="Schedule">SCHEDULE</a>
                    </li>
                    <li>
                        <a href="#news" title="News">NEWS</a>
                    </li>
                    <li>
                        <a href="http://vinny40.org/philanthropist/" class="vinnyOrgLink" title="Visit vinny40.org">visit vinny40.org</a>
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
<section id="home">
    <?php require_once('homepage.php');?>
</section>

<section id="meetVinny" class="meetVinny">
    <a href="#" class="contentToggleBtn">Meet Vinny <i></i></a>
    <div class="pageContentWrapper">
    <div class="container">
        <?php dynamic_sidebar("meet_vinny");?>
        <img src="<?php echo get_template_url(); ?>/img/vinnyPic.png" class="vinnyPic" alt="Vinny40">
        <a href="#" class="nextBtn" title="Career Statistics"></a>
    </div>
    <div class="topTexture"></div>
    <div class="bottomTexture"></div>
    <div class="rightTexture"></div>
    <div class="leftTexture"></div>
  </div>
</section>

<section id="stats" class="blackTexture stats">
    <a href="#" class="contentToggleBtn">Stats <i></i></a>
    <div class="pageContentWrapper">
<div class="container">
    <h2 class="heading">Career Statistics</h2>
</div>
<div class="subNavWrapper" id="statsSubNavWrapper">
    <ul class="nav nav-pills">
        <li><a href="#tab1" title="Stats">Stats</a></li>
        <li><a href="#tab2" title="Splits">Splits</a></li>
        <li><a href="#tab3" title="Game Logs">Game Logs</a></li>
    </ul>
</div>
<div class="container">

    <?php
    require_once('stats.php');
    require_once('splits.php');
    require_once('gamesLog.php');
    ?>
<a href="#" class="nextBtn" title="Media"></a>
</div>
    </div>
</section>

<section id="media" class="mediaPage">
    <a href="#" class="contentToggleBtn">Media <i></i></a>
    <div class="pageContentWrapper">
    <div class="aboveTexture">
        <div class="container">
            <h2 class="heading">Media</h2>
        </div>
        <div class="subNavWrapper" id="mediaSubNavWrapper">
            <ul class="nav nav-pills">
                <li><a href="#mediaTab1" title="Photos">Photos</a></li>
                <li><a href="#mediaTab2" title="Videos">Videos</a></li>
            </ul>
        </div>
        <?php
        $table_name = $wpdb->prefix . "media_sliders";
        $sql_query = "SELECT * FROM $table_name where type='media_slider' ORDER BY id desc;";
        $slider_images = $wpdb->get_results($sql_query);
        $url = site_url()."/wp-content";
        ?>

        <div class="container">
            <div class="mediaTab" id="mediaTab1">
                <div class="photoGallery">
                    <ul class="cycle-slideshow"
                        data-cycle-fx="scrollHorz"
                        data-cycle-timeout="0"
                        data-cycle-slides="li"
                        data-cycle-swipe="true"
                        data-cycle-pager="#mediaSlider">
                        <?php
                        foreach($slider_images as $slider_image){
                            ?>
                            <li class="clearfix">
                                <div>
                                    <a class="fancybox" rel="gallery1" title="<?php echo $slider_image->caption1;?>" href="<?php echo $url."/uploads/".$slider_image->image1; ?>"><img src="<?php echo $url."/uploads/resize/".$slider_image->image1; ?>" class="height205" alt="Vinny40"></a>
                                    <a class="fancybox" rel="gallery1" title="<?php echo $slider_image->caption2;?>" href="<?php echo $url."/uploads/".$slider_image->image2; ?>"><img src="<?php echo $url."/uploads/resize/".$slider_image->image2;?>" class="height293" alt="Vinny40"></a>
                                    <a class="fancybox" rel="gallery1" title="<?php echo $slider_image->caption3;?>" href="<?php echo $url."/uploads/".$slider_image->image3; ?>"><img src="<?php echo $url."/uploads/resize/".$slider_image->image3 ?>" class="height120" alt="Vinny40"></a>
                                </div>
                                <div class="middleColumn">
                                    <a class="fancybox" rel="gallery1" title="<?php echo $slider_image->caption4;?>" href="<?php echo $url."/uploads/".$slider_image->image4; ?>"><img src="<?php echo $url."/uploads/resize/".$slider_image->image4; ?>" class="height419" alt="Vinny40"></a>
                                    <a class="fancybox" rel="gallery1" title="<?php echo $slider_image->caption5;?>" href="<?php echo $url."/uploads/".$slider_image->image5; ?>"><img src="<?php echo $url."/uploads/resize/".$slider_image->image5; ?>" class="height208" alt="Vinny40"></a>
                                </div>
                                <div>
                                    <a class="fancybox" rel="gallery1" title="<?php echo $slider_image->caption6;?>" href="<?php echo $url."/uploads/".$slider_image->image6; ?>"><img src="<?php echo $url."/uploads/resize/".$slider_image->image6; ?>" class="height208" alt="Vinny40"></a>
                                    <a class="fancybox" rel="gallery1" title="<?php echo $slider_image->caption7;?>" href="<?php echo $url."/uploads/".$slider_image->image7; ?>"><img src="<?php echo $url."/uploads/resize/".$slider_image->image7; ?>" class="height202" alt="Vinny40"></a>
                                    <a class="fancybox" rel="gallery1" title="<?php echo $slider_image->caption8;?>" href="<?php echo $url."/uploads/".$slider_image->image8; ?>"><img src="<?php echo $url."/uploads/resize/".$slider_image->image8; ?>" class="height208" alt="Vinny40"></a>
                                </div>
                            </li>
                            <?php } ?>
                    </ul>
                    <?php if(count($slider_images) > 1){?>
                    <div class="example-pager example-pager2 clearfix" id="mediaSlider"></div>
                    <?php }?>
                </div>
            </div>

            <?php dynamic_sidebar("player_video")?>

            <a href="#" class="nextBtn" title="Vinny's Schedule"></a>
        </div>
        <div class="topSideTexture"></div>
        <div class="bottomSideTexture"></div>
    </div>
    </div>
</section>

<section id="schedule" class="blackTexture">
    <a href="#" class="contentToggleBtn">Schedule <i></i></a>
    <div class="pageContentWrapper">
    <div class="scheduleTopBg">
        <div class="container scheduleContainer">
            <h2 class="heading">VINNY’s Schedule</h2>
            <form class="scheduleForm clearfix" action="void:javascript(0);" id="scheduleForm" method="post">
                <div class="control-group">
                    <label class="control-label" for="season">Season</label>
                    <select id="season" name="season" >
                        <option>2013-2014</option>
                    </select>
                </div>
                <div class="control-group">
                    <label class="control-label" for="gameType">Game Type</label>
                    <select id="gameType" name="gameType" >
                        <option>Regular Season</option>
                    </select>
                </div>
                <div class="control-group">
                    <label class="control-label" for="homeAway">Home/Away</label>
                    <select id="homeAway" name="place">
                        <option value="">All Games</option>
                        <option value="home">Home</option>
                        <option value="away">Away</option>
                    </select>
                </div>
                <button type="submit" class="orangeBtn small">Search</button>
            </form>
            <div class="tableWrapper" id="scheduleScrollbar">
                <div id="statisticsTable">
                        <?php
                           echo vinny_schedule($games);
                        ?>
                </div>
            </div>
            <a href="#" class="nextBtn" title="Vinny's News"></a>
            <img src="<?php echo get_template_url();?>/img/ajax-loader.gif" alt="loader" class="loadingImage" />
        </div>
    </div>
    </div>
</section>

<section id="news" class="newsPage">
    <a href="#" class="contentToggleBtn">News <i></i></a>
    <div class="pageContentWrapper">
    <div class="container">
        <h2 class="heading">VINNY’s news</h2>
    <?php
        $args = array(
            'posts_per_page'   => 3,
            'post_type'        => 'vinny_news',
            'post_status'      => 'publish'
        );
        query_posts($args);
        require_once("news.php");?>
        <div class="centerBtn"><a href="/news/" class="orangeBtn">See More</a></div>
        <div class="bottomBorder"></div>

    </div>
    <div class="topTexture"></div>
    <div class="bottomTexture"></div>
    <div class="rightTexture"></div>
    <div class="leftTexture"></div>
    </div>

</section>
<a href="#" class="topBtn" title="Back to Home"></a>
<div class="faceToggle" id="playerFaceToggle">
<div class="relativeDiv">
    <?php
    if(getenv('env')=="development"){
        $site_url = "http://vinny40.weboniselab.com/philanthropist/";}
    elseif(getenv('env')=="staging"){
        $site_url = "http://vinny40org.weboapps.com/philanthropist/"; }
    else{
        $site_url = "http://vinny40.org/philanthropist/";
    }
    ?>
<img src="<?php echo get_template_url(); ?>/img/player-left-vinny.png" class="playerLeftSideImg" usemap="#playerLeftSideImgMap" alt="Player">
<img src="<?php echo get_template_url(); ?>/img/player-left-vinny-active.png" class="playerLeftSideImgActive" usemap="#playerLeftSideImgMap" alt="Player">
<map name="playerLeftSideImgMap" id="playerLeftSideImgMap">
    <area shape="poly" coords="1,47,23,47,56,63,73,82,83,113,84,153,81,182,79,207,70,212,63,208,60,228,60,250,67,261,75,271,86,287,101,295,132,307,156,321,184,335,207,350,222,369,227,384,229,402,165,398,2,399,0,257,1,133,2,48" alt="Player" href="<?php echo $site_url;?>" />
</map>
</div>
</div>

<div class="ipadLeftVinny clearfix">
    <a href="http://vinny40.org/philanthropist/" title="Visit vinny40.org" class="vinnyOrgLink"></a>
    <a href="javascript:void(0)" class="vinnyOrgLinkToggle"></a>
</div>

<!--<img src="--><?php //echo get_template_directory_uri(); ?><!--/img/player-right-vinny.png" class="faceToggle playerRightSideImg" usemap="#playerRightSideImgMap" alt="Player">-->
<!--<map name="playerRightSideImgMap" id="playerRightSideImgMap">-->
<!--    <area shape="poly" coords="230,42,218,43,210,45,197,48,190,43,182,45,186,52,180,59,169,70,165,80,159,97,157,113,155,129,156,141,157,149,154,154,154,170,156,184,154,195,161,205,171,206,172,219,173,255,161,260,158,271,153,281,133,290,111,299,87,312,59,324,41,335,31,342,18,350,10,365,7,376,2,384,1,399,52,399,232,401,235,392,230,313,230,44,228,43" alt="Player" />-->
<!--</map>-->

<?php
get_footer();
?>
