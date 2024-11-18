<?php
	include"loader.php";
	$page = "statistics";
	

$statistics = getListQuery('SELECT DATE_FORMAT(DATE_SUB(`create_date`, INTERVAL (DAYOFWEEK(`create_date`)-1) DAY), \'%Y-%m-%d\') as start,
       DATE_FORMAT(DATE_SUB(`create_date`, INTERVAL (DAYOFWEEK(`create_date`)-7) DAY), \'%Y-%m-%d\') as end,
       DATE_FORMAT(`create_date`, \'%Y%U\') AS `date`,
       COUNT(*) AS cnt
  FROM statistics
 GROUP BY DATE ORDER BY END DESC;');
	



	include"views/header.html";
?>

<div class="page-title">
	
			<a href="path.php" class="btn btn-default">
			유입 경로
			</a>
            <a href="weekly.php" class="btn btn-primary">
                주간 통계
            </a>
			<a href="day.php" class="btn btn-default">
			월별 통계
			</a>
			<a href="statistics.php" class="btn btn-default">
			실시간 접속자 현황 
			</a>
</div>

			<!-- BEGIN PAGE TITLE -->
			<div class="page-title" style="clear:both;">
				<h1>유입 경로</h1>
			</div>
			<!-- END PAGE TITLE -->
				<?php
					$currentMonth = '';
					$currentYear = substr($statistics[0]['date'],0,4);
					$monthTotal = 0;
					?>
			
			<table class="table need-result">
                <thead>
                    <tr>
					    <td colspan="3">
					        <a href="">
					        <?=$currentYear?>년
					        </a>
                        </td>
					</tr>
					<tr>
						<th>시작날짜</th>
						<th>마지막날짜</th>
						<th>방문수</th>
                    </tr>
				</thead>
				<tbody>
			    <?php
				    for ($bora=0;$bora<$statistics["length"];$bora++ ) {
						$statisticsItem = $statistics[$bora];
						$year = substr($statisticsItem['start'],0,4);
						$month = substr($statisticsItem['end'],5,2);
				?>
					<tr>
                        <td><?=$statisticsItem['start'];?></td>
						<td><?=$statisticsItem['end'];?></td>
						<td><?=$statisticsItem['cnt'];?></td>
				<?php
					}
				?>
				</tbody>
			</table>
				<div id="buttons">

				<br>
				<br>
				<br>
				<br>
			</div>


<?php
	include"views/footer.html";
?>
				