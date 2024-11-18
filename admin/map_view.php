<?php
	include'loader.php';
	$page = 'map';
	$map = getItem('map',$param['no']);
	include'views/header.php';
?>
<div class="page-container">
	<div class="container">
		<!-- BEGIN PAGE TITLE -->
		<div class="page-title flex col2 middle">
			<div>
				<h1 class="title"><span>매장 보기</span></h1>
			</div>
			<div>
				
			</div>
		</div>
		<!-- END PAGE TITLE -->
			
		<form action="" method="post" name="board_form" enctype="multipart/form-data">
			<input type="hidden" name="has_data"  value="1"/>
			<input type="hidden" name="no" value="<?=$param['no']?>"/>
			<table class="table detail">
				<tr>
					<th>매장이름</th>
					<td><?=$map['title']?></td>
				</tr>
				<tr>
					<th>주소</th>
					<td><?=$map['addr1'].$map['addr2']?><br><?.$map['addr3']?></td>
				</tr>
			</table>
		</form>
		<div id="buttons"><a href="map_list.php" class="btn btn-success">목록</a></div>
	</div>
</div>
<?php
	include'views/footer.php';
?>
				