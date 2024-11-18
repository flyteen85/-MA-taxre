<?php
	include'loader.php';
	$page = 'statistics';
    $startDate = trim($param["startDate"]);
    $endDate = trim($param["endDate"]);

    if($startDate !=="" && $endDate !==""){
        $where = "DATE(create_date) >= '{$startDate}'";
        if($endDate !==""){
            $where.=" AND DATE(create_date) <= '{$endDate}'";
        }
    }else{
        $where = "";
    }

$statistics = pageList('statistics',$where,'',10,10,$param['page'],'?startDate='.$startDate.'&endDate='.$endDate.'&page=$page');
	
	include'views/header.html';
?>

<div class="page-title">
		
			<a href="path.php" class="btn btn-default">
			유입 경로
			</a>
            <a href="weekly.php" class="btn btn-default">
                주간 통계
            </a>
			<a href="day.php" class="btn btn-default">
			월별 통계
			</a>
			<a href="statistics.php" class="btn btn-primary">
			실시간 접속자 현황 
			</a>
</div>

			<!-- BEGIN PAGE TITLE -->
			<div class="page-title" style="clear:both;">
				<h1>접속자 통계 (총 <?=$statistics['item_total']?>건)</h1>
			</div>
			<!-- END PAGE TITLE -->
            <form action="" class="form-inline" role="form">
			<div class="excel_download_wrap" style="margin-top:70px;">
				<span>조회 시작일</span>
				<label>
					<input type="text" name="startDate" id="startDate" class="form-control" value="<?=$param['startDate'];?>" readonly />
				</label>
				<span>~</span>
				<label>
					<input type="text" name="endDate" id="endDate" class="form-control" value="<?=$param['endDate'];?>" readonly />
				</label>
				<span>까지</span>
                <button type="submit" class="btn btn-default">검색</button>
            	<a href="excel2.php" id="excelDownload" class="btn btn-default">엑셀 다운로드</a>
            </div>
            </form>
			
			<div id="table_wrap">
			<table class="table need-result" style="table-layout:fixed;">
					<thead class="pc">
						<tr>
							<th>
								No
							</th>
						
							<th>접속자 아이피</th>
							<th style="width:100px;">
							 접속경로
							</th>
							<th style="width:500px;">상세 경로</th>
						
							<th>
								접속일
							</th>
						
						
						</tr>
					</thead>
					<tbody>
					<?php
						for ($bora=0;$bora<$statistics['length'];$bora++ ) {
							$statisticsItem = $statistics[$bora];
$refferer ='';
						if(strpos($statisticsItem['refferer'],'naver')!==FALSE){
							$refferer = '네이버';

						}
						if(strpos($statisticsItem['refferer'],'daum')!==FALSE){
							$refferer = '다음';
						}
						if(strpos($statisticsItem['refferer'],'facebook')!==FALSE){
							$refferer = '페이스북';
						}
						if(strpos($statisticsItem['refferer'],'google')!==FALSE){
							$refferer = '구글';
						}
						if(strpos($statisticsItem['refferer'],'nate')!==FALSE){
							$refferer = '네이트';
						}

						
						

					?>
					<tr>
							<td class="pc">
								<?=$statisticsItem['no']?>							</td>
							
							<td>
								<?=$statisticsItem['user_ip']?>							</td>
							<td>
								<?=$refferer?>							</td>
							
							<td>
							
								<div style="overflow:hidden;width:400px;text-overflow:ellipsis;" id="dk"><a href="<?=$statisticsItem['refferer']?>" target="_blank"><?=$statisticsItem['refferer']?></a></div>

								</td>
							
					
							
							<td>
								<?=$statisticsItem['create_date']?>									</td>
							
						
						</tr>
					<?php
						}
					?>
										
					</tbody>
				</table>
			</div>
			
				<div id="pagination">
				<?=$statistics['pagination']?>
				</div>
<style type="text/css">
#pagination{
	text-align:center;
}
#pagination a{
	margin:2px;
}
#pagination a.active{
	color:red;
}
</style>

				
				<div id="buttons">

				<br>
				<br>
				<br>
				<br>
			</div>
<?php
	include'views/footer.html';
?>
				