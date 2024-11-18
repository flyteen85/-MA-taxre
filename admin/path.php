<?php
	include"loader.php";
	$page = "statistics";
	

$statistics = getListQuery('SELECT refferer, COUNT( * ) AS count, SUBSTRING_INDEX( SUBSTRING_INDEX( REPLACE( REPLACE( LOWER( refferer ) ,  "https://",  "" ) ,  "http://",  "" ) ,  "/", 1 ) ,  "?", 1 ) AS domain
FROM statistics
WHERE refferer !=  ""
GROUP BY domain
ORDER BY count DESC LIMIT 30 ');
	




	include"views/header.html";
?>

<div class="page-title">
	
			<a href="path.php" class="btn btn-primary">
			유입 경로
			</a>
            <a href="weekly.php" class="btn btn-default">
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
			
			
			<table class="table need-result">
					<thead>
						<tr>
						
						
						
							<th>
							 유입 경로
							</th>
							<th>유입 수</th>
						
					
						</tr>
					</thead>
					<tbody>
					<?php
						for ($bora=0;$bora<$statistics["length"];$bora++ ) {
							$statisticsItem = $statistics[$bora];

					

					?>
					<tr>
							<td>
							<?=$statisticsItem['domain']?>
							</td>
							<td>
							<?=$statisticsItem['count']?>
							</td>
						</tr>
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
				