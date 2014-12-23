<div class="tab innerTabs" id="tab3">
    <form class="scheduleForm clearfix" method="post" action="#">
        <h4 class="smallHeading">REGULAR SEASON GAME LOG</h4>
        <div class="fieldsWrapper clearfix">
            <div class="control-group">
                <select name="season" id="gameLogYear" onchange="game_log_form(this);">
                    <?php getRegularSeason();  ?>
                </select>
            </div>
        </div>
    </form>
    <div id="gameLogsScrollbar">
    <div id="statsTableInner9">
            <table class="table table-bordered statsTable normalCase" id="gamesLogTable">
                <thead>
                <tr>
                    <th></th>
                    <th><span class="toolTip" title="GAME">G</span></th>
                    <th><span class="toolTip" title="ASSISTS">A</span></th>
                    <th><span class="toolTip" title="POINTS">P</span></th>
                    <th><span class="toolTip" title="PLUS-MINUS">+/-</span></th>
                    <th><span class="toolTip" title="PENALTIES IN MINUTES">PIM</span></th>
                    <th><span class="toolTip" title="POWER PLAY GOALS">PPG</span></th>
                    <th><span class="toolTip" title="SHORTHANDED GOALS">SHG</span></th>
                    <th><span class="toolTip" title="SHOTS ON GOAL">S</span></th>
                    <th><span class="toolTip" title="SHOOTING PERCENTAGE">S%</span></th>
                    <th>SHIFTS</th>
                    <th><span class="toolTip" title="TIME ON ICE PER GAME">TOI</span></th>
                    <th><span class="toolTip" title="FACE OFF WITH PERCENTAGE">FO%</span></th>
                </tr>
                </thead>
                <tbody id="gameLogTableBody">
                <?php
                if(!empty($seasonGames)){
                foreach($seasonGames as $key=>$game){
                        ?>
                    <tr>
                        <td><?php echo date("M d'y",strtotime($game['date']))." ".$game['game'];?></td>
                        <td><?php echo $game['goals'];?></td>
                        <td><?php echo $game['assists'];?></td>
                        <td><?php echo $game['points'];?></td>
                        <td><?php echo $game['plusMinus'];?></td>
                        <td><?php echo $game['pim'];?></td>
                        <td><?php echo $game['powerPlayGoals'];?></td>
                        <td><?php echo $game['shortHandedGoals'];?></td>
                        <td><?php echo $game['shots'];?></td>
                        <td><?php echo isset($game['shotPct']) ? $game['shotPct'] : '-';?></td>
                        <td><?php echo $game['shifts'];?></td>
                        <td><?php echo $game['timeOnIce'];?></td>
                        <td><?php echo $game['faceoffPct'];?></td>
                    </tr>
                <?php
                }}else{
                    echo "<tr><td colspan='13' class='tdText'>Data Not Found</td></tr>";
                }
                ?>
                </tbody>
            </table>
    </div>
    </div>
    <img src="<?php echo get_template_url();?>/img/ajax-loader.gif" alt="loader" class="loadingImage" />
</div>