<?php
$table_name = $wpdb->prefix . "sliders";
$sql_query = "SELECT * FROM $table_name where type='home_slider';";
$slider_images = $wpdb->get_results($sql_query);
$url = site_url()."/wp-content";
?>
<div class="sliderOuter" id="playerSlider">
    <div class="slider playerImageSlider cycle-slideshow"
         data-cycle-fx="scrollHorz"
         data-cycle-timeout="6000"
         data-cycle-slides=".slide"
         data-cycle-swipe="true"
         data-cycle-pager="#homeSlider"
         data-cycle-loader="wait">
        <?php
        if(!empty($slider_images)){
            foreach($slider_images as $slider_image){?>

                <div class="slide">
                    <img src="<?php echo $url."/uploads/".$slider_image->image; ?>" alt="Vinny40">
                </div>
                <?php }
        }else{ ?>
            <div class="slide">
                <img src="<?php echo get_template_url(); ?>/img/slider1.jpg" alt="Vinny40">
            </div>
            <?php  } ?>
    </div>
    <div class="container">
        <div class="statsBoxOuter hidden-phone">
            <div class="statsBox">
                <?php
                $season = !empty($regularSeasonStats) ? $regularSeasonStats['season'] : date("Y");?>
                <h2>Vinny’s Stats - <?php echo $season;?></h2>
                <div class="vinnyStats clearfix">
                    <img src="<?php echo get_template_url(); ?>/img/vinny-profile-pic.jpg" alt="Vinny">
                    <div class="vinnyInfo">
                        <span><?php echo$season;?> NHL SEASON</span>
                        <h3>vinny lecavalier</h3>
                        <table class="table">
                            <thead>
                            <tr>
                                <th><span class="toolTip" title="GAMES PLAYED">GP</span></th>
                                <th><span class="toolTip" title="GAME">G</span></th>
                                <th><span class="toolTip" title="ASSISTS">A</span></th>
                                <th><span class="toolTip" title="PLUS-MINUS">+ / -</span></th>
                                <th><span class="toolTip" title="POINTS">PTS</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <?php if(!empty($regularSeasonStats)){?>
                                <td><?php echo $regularSeasonStats['gp']; ?></td>
                                <td><?php echo $regularSeasonStats['goals']; ?></td>
                                <td><?php echo $regularSeasonStats['assists']; ?></td>
                                <td><?php echo $regularSeasonStats['plusMinus']; ?></td>
                                <td><?php echo $regularSeasonStats['points']; ?></td>
                                <?php }else{
                                echo "<td>N/A</td><td>N/A</td><td>N/A</td><td>N/A</td><td>N/A</td>";
                            }?>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="plainText"><?php echo !empty($regularSeasonStats) ? $regularSeasonStats['points']." PTS" : "N/A"; ?>   <span>|</span> <?php echo $season;?> Regular Season</div>
                <div class="lastGames">
                    <h2 class="normalText">LAST 5 Games <?php echo $season;?></h2>
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th></th>
                            <th><span class="toolTip" title="GAME">G</span></th>
                            <th><span class="toolTip" title="ASSISTS">A</span></th>
                            <th><span class="toolTip" title="POINTS">P</span></th>
                            <th><span class="toolTip" title="PLUS-MINUS">+ / -</span></th>
                            <th><span class="toolTip" title="FACE OFF WITH PERCENTAGE">FO%</span></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            if(!empty($seasonGames)){
                                foreach($seasonGames as $key=>$game){
                                    if($key < 5){
                                        ?>
                                    <tr>
                                        <td><?php echo date("M d'y",strtotime($game['date']))." ".$game['game'];?></td>
                                        <td><?php echo $game['goals'];?></td>
                                        <td><?php echo $game['assists'];?></td>
                                        <td><?php echo $game['points'];?></td>
                                        <td><?php echo $game['plusMinus'];?></td>
                                        <td><?php echo $game['faceoffPct'];?></td>
                                    </tr>
                                    <?php }
                                }}else{
                                echo "<tr><td colspan='6' class='tdText'>Data Not Found</td></tr>";
                            }?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="statsShadow">
            </div>
        </div>
        <?php if(count($slider_images) > 1){?>
        <div class="example-pager clearfix" id="homeSlider"></div>
        <?php }?>
    </div>
</div>
<div class="statsBoxOuter smallerView">
    <div class="statsBox">
        <?php
        $season = !empty($regularSeasonStats) ? $regularSeasonStats['season'] : date("Y");?>
        <div class="vinnyStatsContainer">
        <h2>Vinny’s Stats - <?php echo $season;?></h2>
        <div class="vinnyStats clearfix">
            <img src="<?php echo get_template_url(); ?>/img/vinny-profile-pic.jpg" alt="Vinny">
            <div class="vinnyInfo">
                <span><?php echo$season;?> NHL SEASON</span>
                <h3>vinny lecavalier</h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th><span class="toolTip" title="GAMES PLAYED">GP</span></th>
                        <th><span class="toolTip" title="GAME">G</span></th>
                        <th><span class="toolTip" title="ASSISTS">A</span></th>
                        <th><span class="toolTip" title="PLUS-MINUS">+ / -</span></th>
                        <th><span class="toolTip" title="POINTS">PTS</span></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?php if(!empty($regularSeasonStats)){?>
                        <td><?php echo $regularSeasonStats['gp']; ?></td>
                        <td><?php echo $regularSeasonStats['goals']; ?></td>
                        <td><?php echo $regularSeasonStats['assists']; ?></td>
                        <td><?php echo $regularSeasonStats['plusMinus']; ?></td>
                        <td><?php echo $regularSeasonStats['points']; ?></td>
                        <?php }else{
                        echo "<td>N/A</td><td>N/A</td><td>N/A</td><td>N/A</td><td>N/A</td>";
                    }?>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="plainText"><?php echo !empty($regularSeasonStats) ? $regularSeasonStats['points']." PTS" : "N/A"; ?>   <span>|</span> <?php echo $season;?> Regular Season</div>
        </div>
            <div class="lastGames">
            <h2 class="normalText">LAST 5 Games <?php echo $season;?></h2>
            <table class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th></th>
                    <th><span class="toolTip" title="GAME">G</span></th>
                    <th><span class="toolTip" title="ASSISTS">A</span></th>
                    <th><span class="toolTip" title="POINTS">P</span></th>
                    <th><span class="toolTip" title="PLUS-MINUS">+ / -</span></th>
                    <th><span class="toolTip" title="FACE OFF WITH PERCENTAGE">FO%</span></th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(!empty($seasonGames)){
                    foreach($seasonGames as $key=>$game){
                        if($key < 5){
                            ?>
                        <tr>
                            <td><?php echo date("M d'y",strtotime($game['date']))." ".$game['game'];?></td>
                            <td><?php echo $game['goals'];?></td>
                            <td><?php echo $game['assists'];?></td>
                            <td><?php echo $game['points'];?></td>
                            <td><?php echo $game['plusMinus'];?></td>
                            <td><?php echo $game['faceoffPct'];?></td>
                        </tr>
                            <?php }
                    }}else{
                    echo "<tr><td colspan='6' class='tdText'>Data Not Found</td></tr>";
                }?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="statsShadow">
    </div>
</div>
<div class="blackTexture">
    <div class="homeTopBg">
        <div class="container">
            <h2 class="heading">VINNY’s schedule</h2>
            <div id="homeScheduleScrollbar">
            <table class="table listing">
                <thead>
                <tr>
                    <th>DATE</th>
                    <th>visitor</th>
                    <th>home</th>
                    <th>TIME (ET)</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(!empty($games)){
                    $count = 1;
                    $current_date = date("D M d Y G:i:s T");
                    foreach($games as $game){
                        $date = strtotime($game['date']);
                        if($date >= strtotime($current_date)){
                            echo "<tr><td>";
                            echo date('D, M d, Y',$date);
                            echo "</td><td>";
                            echo $game['location'] == "away" ? "Flyers" : $game['opponentTeamName'] ;
                            echo "</td><td>";
                            echo $game['location'] == "home" ? "Flyers" : $game['opponentTeamName'] ;
                            echo "</td><td>";
                            echo date('h:i a',$date);
                            echo '</td><td><a href="http://flyers.nhl.com/club/page.htm?id=92386" class="grayBtn" target="_blank">Tickets</a></td></tr>';
                            if($count >= 5){
                                break;
                            }
                            $count++;
                        }
                    }
                }else{
                    echo "<tr><td class='centerTd' colspan='5'>Data Not Found</td></tr>";
                }
                ?>
                </tbody>
            </table>
            </div>
            <div class="centerBtn"><a href="#schedule" class="orangeBtn" id="seeMore">See More</a></div>

            <div class="boxesWrapper vinnyNews">
                <div class="row">
                    <div class="span4">
                        <h3 class="mediumHeading">Vinny’s News</h3>
                        <?php $posts_array = get_posts( array('post_type'=>'vinny_news', 'posts_per_page'   => 3,) ); ?>
                        <ul class="newsList">
                            <?php foreach($posts_array as $post){ ?>
                            <li><h5><?php echo contentTruncate($post->post_title,30,"#",""); ?></h5>
                                <p><?php echo contentTruncate(strip_tags($post->post_content), 100,"#news","Continue");?>
                                    <em>- <?php echo date("M.d,Y",strtotime($post->post_date_gmt));?></em></p>
                            </li>
                            <?php } ?>
                        </ul>
                        <a href="#" class="orangeLink readMore">Read More &raquo;</a>
                    </div>
                    <div class="span4">
                        <div class="btmLine">
                        <i class="mediatext facebook"></i>
                        </div>
                        <div class="getConnected">
                            GET CONNECTED THOUGH  vinny lecavalier’s
                            <a href="https://www.facebook.com/vinny4" target="_blank" class="orangeLink">facebook page</a>
                        </div>
                        <div class="visible-desktop"><?php dynamic_sidebar("facebook_like_box");?></div>
                        <div class="visible-tablet"><?php dynamic_sidebar("facebook_like_box_ipad");?></div>
                    </div>
                    <div class="span4">
                        <div class="btmLine">
                        <i class="mediatext twitter"></i>
                        </div>
                        <div id="tweets">
                            <?php dynamic_sidebar("vinny_tweets");?>
                        </div>
                        <a href="https://twitter.com/VLF40" target="_blank" class="followBtn"></a>
                    </div>
                </div>
            </div>
            <a href="#" class="nextBtn firstBtn" title="Meet Vinny"></a>

            <div class="bottomBorder"></div>
        </div>

    </div>
</div>