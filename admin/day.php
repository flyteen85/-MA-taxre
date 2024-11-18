<?php
	include"loader.php";
	$page = "statistics";
	

$statistics = getListQuery('SELECT count(*) AS count, MID( create_date, 1, 10 ) date
FROM statistics
GROUP BY date');
	




	include"views/header.html";
?>

<div class="page-title">
	
			<a href="path.php" class="btn btn-default">
			유입 경로
			</a>
            <a href="weekly.php" class="btn btn-default">
                주간 통계
            </a>
			<a href="day.php" class="btn btn-primary">
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
					$currentYear = substr($statistics[0]['date'],0,4);;
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
						
						
						
							<th>
							 월
							</th>
							<th>방문수</th>
							<th>일별 방문수</th>
						
					
						</tr>
					</thead>
					<tbody>
				
				
					<?php
						for ($bora=0;$bora<$statistics["length"];$bora++ ) {
							$statisticsItem = $statistics[$bora];
							$year = substr($statisticsItem['date'],0,4);
							$month = substr($statisticsItem['date'],5,2);
					if($currentMonth!=$month){
						
						if($bora!=0){

							echo '</ul><input type="hidden" value="'.$monthTotal.'" class="monthly"></tr>';
						}
						
						$monthTotal =$statisticsItem ['count'];
					$currentMonth = $month;
					?>
					<tr>
							<td>
							<?=$month?>
							</td>
							<td>
							
							</td>
							<td>
								<a href="" class="btn btn-success check">확인</a>
							</td>
						</tr>
						<tr  style="display:none;">
						<td colspan="3" >
						<ul>
						<li>
						<?=dateFormat($statisticsItem['date'],'m/d')?>
						<span style="float:right;">
						<?=$statisticsItem['count']?>
						</span>
						</li>
					<?php
					}
					else{
							$monthTotal +=$statisticsItem['count'];
					?>
						<li>
						<?=dateFormat($statisticsItem['date'],'m/d')?>
						<span style="float:right;">
						<?=$statisticsItem['count']?>
						</span>
						</li>
					<?php
					}
						}
					?>
					</ul>
					<input type="hidden" value="<?=$monthTotal?>"  class="monthly">
					</td>
					</tr>
										
					</tbody>
				</table>
				<div id="buttons">

				<br>
				<br>
				<br>
				<br>
			</div>
			<style>
			ul li{
				list-style:none;
				height:22px;
				
			}
			</style>
			<script type="text/javascript">
			
			function number_format(number, decimals, dec_point, thousands_sep) {
  //  discuss at: http://phpjs.org/functions/number_format/
  // original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
  // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // improved by: davook
  // improved by: Brett Zamir (http://brett-zamir.me)
  // improved by: Brett Zamir (http://brett-zamir.me)
  // improved by: Theriault
  // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // bugfixed by: Michael White (http://getsprink.com)
  // bugfixed by: Benjamin Lupton
  // bugfixed by: Allan Jensen (http://www.winternet.no)
  // bugfixed by: Howard Yeend
  // bugfixed by: Diogo Resende
  // bugfixed by: Rival
  // bugfixed by: Brett Zamir (http://brett-zamir.me)
  //  revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
  //  revised by: Luke Smith (http://lucassmith.name)
  //    input by: Kheang Hok Chin (http://www.distantia.ca/)
  //    input by: Jay Klehr
  //    input by: Amir Habibi (http://www.residence-mixte.com/)
  //    input by: Amirouche
  //   example 1: number_format(1234.56);
  //   returns 1: '1,235'
  //   example 2: number_format(1234.56, 2, ',', ' ');
  //   returns 2: '1 234,56'
  //   example 3: number_format(1234.5678, 2, '.', '');
  //   returns 3: '1234.57'
  //   example 4: number_format(67, 2, ',', '.');
  //   returns 4: '67,00'
  //   example 5: number_format(1000);
  //   returns 5: '1,000'
  //   example 6: number_format(67.311, 2);
  //   returns 6: '67.31'
  //   example 7: number_format(1000.55, 1);
  //   returns 7: '1,000.6'
  //   example 8: number_format(67000, 5, ',', '.');
  //   returns 8: '67.000,00000'
  //   example 9: number_format(0.9, 0);
  //   returns 9: '1'
  //  example 10: number_format('1.20', 2);
  //  returns 10: '1.20'
  //  example 11: number_format('1.20', 4);
  //  returns 11: '1.2000'
  //  example 12: number_format('1.2000', 3);
  //  returns 12: '1.200'
  //  example 13: number_format('1 000,50', 2, '.', ' ');
  //  returns 13: '100 050.00'
  //  example 14: number_format(1e-8, 8, '.', '');
  //  returns 14: '0.00000001'

  number = (number + '')
    .replace(/[^0-9+\-Ee.]/g, '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + (Math.round(n * k) / k)
        .toFixed(prec);
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
    .split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '')
    .length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1)
      .join('0');
  }
  return s.join(dec);
}
			$('.check').click(function(){
				if($(this).parent().parent().next().is(':visible')){
					$(this).parent().parent().next().hide()

						return false;
				}
				$(this).parent().parent().next().show();
				return false;
			});
			
			var yearTotal = 0;
			$('.monthly').each(function(){
				var month = parseInt($(this).val());
				yearTotal+=month;
				$(this).parent().parent().prev().find('td').eq(1).text(number_format(month));
			});
			$('#year_total').text(number_format(yearTotal));
				
			</script>
<?php
	include"views/footer.html";
?>
				