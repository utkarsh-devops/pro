<div class="tab innerTabs" id="tab1">
    <div id="statsScrollbar">
        <h5 class="smallHeading"><?php echo $season;?> SEASON STATISTICS</h5>
        <div id="statsTableInner1">
        <table class="table table-bordered statsTable">
            <thead>
            <tr>
                <th></th>
                <th><span class="toolTip" title="GAMES PLAYED">GP</span></th>
                <th><span class="toolTip" title="GAME">G</span></th>
                <th><span class="toolTip" title="ASSISTS">A</span></th>
                <th><span class="toolTip" title="POINTS">P</span></th>
                <th><span class="toolTip" title="PLUS-MINUS">+/-</span></th>
                <th><span class="toolTip" title="PENALTIES IN MINUTES">PIM</th>
                <th><span class="toolTip" title="POWER PLAY GOALS">PP</th>
                <th><span class="toolTip" title="SHORT-HANDED GOALS">SH</th>
                <th><span class="toolTip" title="GAME WINNING GOALS">GWG</th>
                <th><span class="toolTip" title="SHOTS ON GOAL">S</span></th>
                <th><span class="toolTip" title="SHOOTING PERCENTAGE">S%</span></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>REGULAR SEASON</td>
                <?php if(!empty($regularSeasonStats)){ ?>
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
                <td><?php echo $regularSeasonStats['shotPct'];?></td>
                <?php }else{
                echo "<td colspan='11' class='tdText'>Data Not Found</td>";
            }?>
            </tr>
            <tr>
                <td>LEAGUE RANK</td>
                <?php if(!empty($rank)){?>
                <td><?php echo $rank['gp'];?></td>
                <td><?php echo $rank['goals'];?></td>
                <td><?php echo $rank['assists'];?></td>
                <td><?php echo $rank['points'];?></td>
                <td><?php echo $rank['plusMinus'];?></td>
                <td><?php echo $rank['pim'];?></td>
                <td><?php echo $rank['powerPlayGoals'];?></td>
                <td><?php echo $rank['shortHandedGoals'];?></td>
                <td><?php echo $rank['gameWinnerGoals'];?></td>
                <td><?php echo $rank['shots'];?></td>
                <td><?php echo $rank['shotPct'];?></td>
                <?php } else{
                echo "<td colspan='11' class='tdText'>Data Not Found</td>";
            }?>
            </tr>
            </tbody>
        </table>
        </div>
        <h5 class="smallHeading">LAST 5 Games <?php echo $season;?></h5>
        <div id="statsTableInner2">
        <table class="table table-bordered statsTable">
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
                    <td><?php echo $game['pim'];?></td>
                    <td><?php echo $game['powerPlayGoals'];?></td>
                    <td><?php echo $game['shortHandedGoals'];?></td>
                    <td><?php echo $game['shots'];?></td>
                    <td><?php echo isset($game['shotPct']) ? $game['shotPct'] : '-';?></td>
                    <td><?php echo $game['shifts'];?></td>
                    <td><?php echo $game['timeOnIce'];?></td>
                    <td><?php echo $game['faceoffPct'];?></td>
                </tr>
                    <?php }
            }}else{
                echo "<tr><td colspan='13' class='tdText'>Data Not Found</td></tr>";
            }
            ?>
            </tbody>
        </table>
        </div>
        <?php  $seasons = !empty($SeasonStatastics) ? call_api("http://www.nhl.com/feed/nhl/playerdata/playercard.json?id=8467329&seasonid=$season_id&view=career&auth=") : array();?>
        <h5 class="smallHeading">CAREER REGULAR SEASON STATISTICS</h5>
        <div id="statsTableInner2">
        <table class="table table-bordered statsTable">
            <thead>
            <tr>
                <th>SEASON</th>
                <th>TEAM</th>
                <th><span class="toolTip" title="GAMES PLAYED">GP</span></th>
                <th><span class="toolTip" title="GAME">G</span></th>
                <th><span class="toolTip" title="ASSISTS">A</span></th>
                <th><span class="toolTip" title="POINTS">P</span></th>
                <th><span class="toolTip" title="PLUS-MINUS">+/-</span></th>
                <th><span class="toolTip" title="PENALTIES IN MINUTES">PIM</span></th>
                <th><span class="toolTip" title="POWER PLAY GOALS">PPG</span></th>
                <th><span class="toolTip" title="SHORTHANDED GOALS">SHG</span></th>
                <th><span class="toolTip" title="GAME WINNING GOALS">GWG</th>
                <th><span class="toolTip" title="SHOTS ON GOAL">S</span></th>
                <th><span class="toolTip" title="SHOOTING PERCENTAGE">S%</span></th>
            </tr>
            </thead>
            <tbody>
            <?php
            if(!empty($seasons)){
            foreach ($seasons['regularSeasonStatsBySeason'] as $pSeason) { ?>
            <tr>
                <td><?php echo $pSeason['season'];?></td>
                <td><?php echo $pSeason['teamname'];?></td>
                <td><?php echo $pSeason['gp'];?></td>
                <td><?php echo $pSeason['goals'];?></td>
                <td><?php echo $pSeason['assists'];?></td>
                <td><?php echo $pSeason['points'];?></td>
                <td><?php echo $pSeason['plusMinus'];?></td>
                <td><?php echo $pSeason['pim'];?></td>
                <td><?php echo $pSeason['powerPlayGoals'];?></td>
                <td><?php echo $pSeason['shortHandedGoals'];?></td>
                <td><?php echo $pSeason['gameWinningGoals'];?></td>
                <td><?php echo $pSeason['shots'];?></td>
                <td><?php echo $pSeason['shotPct'];?></td>
            </tr>
                <?php }
            $crs = $seasons['careerRegularSeasonTotals'][0];
            if (!empty($crs)) { ?>
            <tr class="boldFont">
                <td></td>
                <td>NHL TOTALS</td>
                <td><?php echo $crs['gp'];?></td>
                <td><?php echo $crs['goals'];?></td>
                <td><?php echo $crs['assists'];?></td>
                <td><?php echo $crs['points'];?></td>
                <td><?php echo $crs['plusMinus'];?></td>
                <td><?php echo $crs['pim'];?></td>
                <td><?php echo $crs['powerPlayGoals'];?></td>
                <td><?php echo $crs['shortHandedGoals'];?></td>
                <td><?php echo $crs['gameWinningGoals'];?></td>
                <td><?php echo $crs['shots'];?></td>
                <td><?php echo $crs['shotPct'];?></td>
            </tr>
                <?php }}else{
                echo "<tr><td colspan='13' class='tdText'>Data Not Found</td></tr>";
            } ?>
            </tbody>
        </table>
    </div>
    </div>
</div>