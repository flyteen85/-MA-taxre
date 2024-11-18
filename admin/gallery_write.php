<?php
	include'loader.php';
	$page = 'gallery';

	if($param['has_data']==1){
		$imgpc=simpleUpload($_FILES['imgpc'],'/admin/files/gallery/');
		$imgm=simpleUpload($_FILES['imgm'],'/admin/files/gallery/');
		$dir = $_SERVER["DOCUMENT_ROOT"]."/admin/files/gallery/";
		if(isset($imgpc)) { 
			if($param['old_imgpc']) {
			   $board['delete']=getItem('gallery',$param['no']);
			   unlink($dir.$board['delete']['imgpc']);
			}
			
			$param['imgpc'] = $imgpc['path']; 
		}else{ 
			$param['imgpc'] = $param['old_imgpc']; 
		}
		
		if(isset($imgm)) { 
			if($param['old_imgm']) {
			   $board['delete']=getItem('gallery',$param['no']);
			   unlink($dir.$board['delete']['imgm']);
			}

			$param['imgm'] = $imgm['path']; 
		}else{ 
			$param['imgm'] = $param['old_imgm']; 
		}

		if($param['no']){
			updateItem('gallery',$param,$param['no']);
		}
		else{
			insertItem('gallery',$param);
		}
		getBack('/admin/gallery_list.php');
	}

	

	
if($param['no']){
	$gallery = getItem('gallery',$param['no']);
}
	include'views/header.php';
?>
<div class="page-container">
	<div class="container">
		<!-- BEGIN PAGE TITLE -->
		<div class="page-title flex col2 middle">
			<div>
				<h1 class="title"><span>슬라이드 갤러리</span></h1>
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
						<input type="text" name="title" class="input-control" value="<?=$gallery['title']?>">
					</td>
				</tr>
				<tr>
					<th>링크</th>
					<td>
						<input type="text" name="href" class="input-control" value="<?=$gallery['href']?>">
					</td>
				</tr>
				<tr>
					<th>카테고리</th>
					<td>
						<input type="text" name="cate" class="input-control" value="<?=$gallery['cate']?>">
					</td>
				</tr>
				<tr>
					<th>설명</th>
					<td>
						<input type="text" name="contents" class="input-control" value="<?=$gallery['contents']?>">
					</td>
				</tr>
				<tr>
					<th>PC 이미지</th>
					<td>
						<label>
							<input type="file" class="upload_image_input <?=attr($gallery['imgpc'],'hasfile')?>" name="imgpc">
							<span class="icon"><?php echo $gallery['imgpc'] ? $gallery['imgpc'] : '이미지 첨부' ?></span>
							<input type="hidden" class="upload_image_input" value="<?php echo $gallery['imgpc']; ?>" name="old_imgpc">
						</label>
					</td>
				</tr>
				<tr>
					<th>M 이미지</th>
					<td>
						<label>
							<input type="file" class="upload_image_input <?=attr($gallery['imgm'],'hasfile')?>" name="imgm">
							<span class="icon"><?php echo $gallery['imgm'] ? $gallery['imgm'] : '이미지 첨부' ?></span>
							<input type="hidden" class="upload_image_input" value="<?php echo $gallery['imgm']; ?>" name="old_imgm">
						</label>
					</td>
				</tr>
			</table>
		</form>
		<div id="pagination"><?=$gallerys['pagination']?></div>
		<div id="buttons"><a href="gallery_write.php" class="btn" onclick="document.board_form.submit();return false;">등록</a></div>
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
				