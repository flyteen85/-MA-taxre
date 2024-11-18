<?php
	include'loader.php';
	$page = 'gallery';

	$banner = getItem('banner',$param['no']);
	
	include'views/header.php';
?>
<div class="page-container">
	<div class="container">
		<!-- BEGIN PAGE TITLE -->
		<div class="page-title flex col2 middle">
			<div>
				<h1 class="title"><span>포트폴리오</span></h1>
			</div>
			<div>
				
			</div>
		</div>
		<form action="" method="post" name="board_form" enctype="multipart/form-data">
			<input type="hidden" name="has_data"  value="1"/>
			<input type="hidden" name="no"  value="<?=$param['no']?>"/>
			<table class="table">
				<tr>
					<th style="width:100px;">제목</th>
					<td>
					<?=$banner['title']?>
					</td>
				</tr>
				<tr>
					<th>내용</th>
					<td>
				
						<?=$banner['contents']?>
					</td>


				</tr>
				<tr>
					<th>첨부</th>
					<td>
						<?=attr($banner['attach'],'<a href="/admin/files/'.$banner['attach'].'">[첨부]</a>')?>
					</td>
				</tr>
			</table>
		</form>
		<div id="pagination"><?=$banners['pagination']?></div>
		<div id="buttons"><a href="banner_list.php" class="btn btn-success">목록</a></div>
	</div>
</div>
<?php
	include'views/footer.php';
?>
				