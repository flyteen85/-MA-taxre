<?php
	include'loader.php';
	$page = 'video';

	if($param['has_data']==1){
		if($param['no']){
			updateItem('video',$param,$param['no']);
		}
		else{
			insertItem('video',$param);
		}
		getBack('/admin/video_list.php');
	}
	
	if($param['no']){
		$video = getItem('video',$param['no']);
	}
	include'views/header.php';
?>
<div class="page-container">
	<div class="container">
		<!-- BEGIN PAGE TITLE -->
		<div class="page-title flex col2 middle">
			<div>
				<h1 class="title"><span>동영상</span></h1>
			</div>
			<div>
				
			</div>
		</div>
		<!-- END PAGE TITLE -->

		<form action="" method="post" name="board_form" enctype="multipart/form-data">
			<input type="hidden" name="has_data"  value="1"/>
			<input type="hidden" name="no"  value="<?=$param['no']?>"/>
			<table class="table gallyerwrite">
				<tr>
					<th>제목</th>
					<td>
						<input type="text" name="title" class="input-control" value="<?=$video['title']?>">
					</td>
				</tr>
				<tr>
					<th>카테고리</th>
					<td>
						<input type="text" name="cate" class="input-control" value="<?=$video['cate']?>">
					</td>
				</tr>
				<tr>
					<th>링크</th>
					<td>
						<input type="text" name="url" class="input-control" value="<?=$video['url']?>">
					</td>
				</tr>
				<tr>
					<th>설명</th>
					<td>
						<input type="text" name="contents" class="input-control" value="<?=$video['contents']?>">
					</td>
				</tr>
			</table>
		</form>
		<div id="pagination"><?=$video['pagination']?></div>
		<div id="buttons"><a href="video_write.php" class="btn" onclick="document.board_form.submit();return false;">등록</a></div>
	</div>
</div>
<script>
$(document).on('change','.upload_image_input',function(){
	var input = this;
	var filename = $(this)[0].files[0].name;
	$(this).next('span.icon').html(filename);
	$(this).addClass('hasfile');
});
</script>
<?php
	include'views/footer.php';
?>
				