<?php
$result = !empty($seasonGames) ? get_month_week_details($seasonGames) : array();
?>
<div class="tab innerTabs" id="tab2">
    <form class="scheduleForm clearfix" method="post" action="#" id="splitForm">
        <h4 class="smallHeading" id="splitSeason"><?php echo $season;?> SEASON STATISTICS</h4>
        <div class="fieldsWrapper clearfix">
            <div class="control-group">
                <select name="season" id="splitYear" onchange="split_form(this);">
                    <?php getRegularSeason();  ?>
                </select>
            </div>
            <div class="control-group">
                <select>
                    <option>Regular Season</option>
                </select>
            </div>
        </div>
    </form>
    <div id="splitsScrollbar">
        <div id="splitTable">
            <div id="statsTableInner4">
            <table class="table table-bordered statsTable normalCase">
                <thead>
                <tr>
                    <th></th>
                    <th><span class="toolTip" title="GAMES PLAYED">GP</span></th>
                    <th><span class="toolTip" title="GAME">G</span></th>
                    <th><span class="toolTip" title="ASSISTS">A</span></th>
                    <th><span class="toolTip" title="POINTS">P</span></th>
                    <th><span class="toolTip" title="PLUS-MINUS">+/-</span></th>
                    <th><span class="toolTip" title="PENALTIES IN MINUTES">PIM</th>
                    <th><span class="toolTip" title="POWER PLAY GOALS">PP</span></th>
                    <th><span class="toolTip" title="SHORTHANDED GOALS">SH</span></th>
                    <th><span class="toolTip" title="GAME WINNING GOALS">GWG</th>
                    <th><span class="toolTip" title="SHOTS ON GOAL">S</th>
                    <th>Hits</th>
                    <th><span class="toolTip" title="BLOCKED SHOTS">Bks</th>
                </tr>
                </thead>
                <tbody>
                <?php if(!empty($regularSeasonStats)){?>
                <tr>
                    <td>REGULAR SEASON</td>
                    <td><?php echo $regularSeasonStats['gp'];?></td>
                    <td><?php echo $regularSeasonStats['goals'];?></td>
                    <td><?php echo $regularSeasonStats['assists'];?></td>
                    <td><?php echo $regularSeasonStats['points'];?></td>
                    <td><?php echo $regularSeasonStats['plusMinus'];?></td>
                    <td><?php echo $regularSeasonStats['pim'];?></td>
                    <td><?php echo $regularSeasonStats['powerPlayGoals'];?></td>
                    <td><?php echo $regularSeasonStats['shortHandedGoals'];?></td>
                    <td><?php echo $regularSeasonStats['gameWinningGoals'];?></td>
                    <td><?php echo $regularSeasonStats['shots'];?></td>
                    <td><?php echo $regularSeasonStats['hits'];?></td>
                    <td><?php echo $regularSeasonStats['blockedShots'];?></td>
                </tr>
                <?php }else{
                    echo "<tr><td colspan='13'>Data Not Found</td></tr>";
                }?>
                </tbody>
            </table>
            </div>
            <h5 class="smallHeading withBg">LAST GOAL/ASSIST FOR SEASON</h5>
            <div id="statsTableInner5">
            <table class="table table-bordered statsTable">
                <tbody>
                <tr>
                    <td>LAST GOAL (GAMES PLAYED SINCE):</td>
                    <td><?php echo lastGoalOrAssists($seasonGames,"goals");?></td>
                </tr>
                <tr>
                    <td>LAST ASSIST (GAMES PLAYED SINCE):</td>
                    <td><?php echo lastGoalOrAssists($seasonGames,"assists");?></td>
                </tr>
                </tbody>
            </table>
                </div>
            <h5 class="smallHeading withBg">EVEN STRENGTH, POWER PLAY, SHORTHANDED</h5>
            <div id="statsTableInner6">
            <table class="table table-bordered statsTable">
                <tbody>
                <?php if(!empty($regularSeasonStats)){?>
                <tr>
                    <td>ES GOALS:</td>
                    <td><?php echo ($regularSeasonStats["goals"]-($regularSeasonStats["powerPlayGoals"]+$regularSeasonStats["shortHandedGoals"])) ?></td>
                    <td>PP GOALS:</td>
                    <td><?php echo $regularSeasonStats["powerPlayGoals"] ?></td>
                    <td>SH GOALS:</td>
                    <td><?php echo $regularSeasonStats["shortHandedGoals"] ?></td>
                </tr>
                    <?php } else{

                    echo "<tr><td colspan='6'>Data Not Found</td></tr>";
                }?>
                </tbody>
            </table>
            </div>
            <h5 class="smallHeading withBg">STATS BY MONTH</h5>
            <div id="statsTableInner7">
            <table class="table table-bordered statsTable">
                <thead>
                <tr>
                    <th></th>
                    <th>OCT</th>
                    <th>NOV</th>
                    <th>DEC</th>
                    <th>JAN</th>
                    <th>FEB</th>
                    <th>MAR</th>
                    <th>Apr</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(!empty($result)){
                    foreach($result[0] as $key => $month_detail){
                        echo "<tr>";
                        echo "<td>".$key.'</td>';
                        echo "<td>".$month_detail['oct'].'</td>';
                        echo "<td>".$month_detail['nov'].'</td>';
                        echo "<td>".$month_detail['dec'].'</td>';
                        echo "<td>".$month_detail['jan'].'</td>';
                        echo "<td>".$month_detail['feb'].'</td>';
                        echo "<td>".$month_detail['mar'].'</td>';
                        echo "<td>".$month_detail['apr'].'</td>';
                        echo "</tr>";
                    }
                }else{
                    echo "<tr><td colspan='8'>Data Not Found</td></tr>";
                }
                ?>
                </tbody>
            </table>
                </div>
            <h5 class="smallHeading withBg">STATS BY DAY OF WEEK</h5>
            <div id="statsTableInner8">
            <table class="table table-bordered statsTable">
                <thead>
                <tr>
                    <th></th>
                    <th>SUNDAY</th>
                    <th>MONDAY</th>
                    <th>TUESDAY</th>
                    <th>WEDNESDAY</th>
                    <th>THURSDAY</th>
                    <th>FRIDAY</th>
                    <th>SATURDAY</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(!empty($result)){
                    foreach($result[1] as $key => $week_detail){
                        echo "<tr>";
                        echo "<td>".$key.'</td>';
                        echo "<td>".$week_detail['sun'].'</td>';
                        echo "<td>".$week_detail['mon'].'</td>';
                        echo "<td>".$week_detail['tue'].'</td>';
                        echo "<td>".$week_detail['wed'].'</td>';
                        echo "<td>".$week_detail['thu'].'</td>';
                        echo "<td>".$week_detail['fri'].'</td>';
                        echo "<td>".$week_detail['sat'].'</td>';
                        echo "</tr>";
                    }
                }else{
                    echo "<tr><td colspan='8'>Data Not Found</td></tr>";
                }
                ?>
                </tbody>
            </table>
          </div>
          </div>
    </div>
    <img src="<?php echo get_template_url();?>/img/ajax-loader.gif" alt="loader" class="loadingImage" />
</div>