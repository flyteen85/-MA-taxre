<?php
	include'loader.php';
	$page = 'banner';
	if(isset($param['has_data'])){
		$imgpc = simpleUpload($_FILES['imgpc'],'/admin/files/banner/');
		$imgm = simpleUpload($_FILES['imgm'],'/admin/files/banner/');
		$dir = $_SERVER["DOCUMENT_ROOT"]."/admin/files/banner/";
		if(isset($imgpc)) { 
			if(isset($param['old_imgpc'])) {
			   $board['delete']=getItem('banner',$param['no']);
			   unlink($dir.$board['delete']['imgpc']);
			}
			
			$param['imgpc'] = $imgpc['path']; 
		} else { 
			$param['imgpc'] = $param['old_imgpc']; 
		}
		
		if(isset($imgm)) { 
			if(isset($param['old_imgm'])) {
			   $board['delete']=getItem('banner',$param['no']);
			   unlink($dir.$board['delete']['imgm']);
			}

			$param['imgm'] = $imgm['path']; 
		} else {
			
			$param['imgm'] = $param['old_imgm']; 
		}
		if(isset($param['no'])){
			updateItem('banner', $param, $param['no']);
		} else {
			insertItem('banner', $param);
		}
		getBack('/admin/banner_list.php');
	}
	
	if(isset($param['no'])) {
		$banner = getItem('banner',$param['no']);
	}
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
		<!-- END PAGE TITLE -->

		<form action="" method="post" name="board_form" enctype="multipart/form-data">
			<input type="hidden" name="has_data"  value="1"/>
			<input type="hidden" name="no"  value="<?=$param['no']?>"/>
			<table class="table gallyerwrite">
				<tr>
					<th>제목</th>
					<td>
						<input type="text" name="title" class="input-control" value="<?=$banner['title']?>">
					</td>
				</tr>
				<tr>
					<th>링크</th>
					<td>
						<input type="text" name="href" class="input-control" value="<?=$banner['href']?>">
					</td>
				</tr>
				<tr>
					<th>설명</th>
					<td>
						<input type="text" name="contents" class="input-control" value="<?=$banner['contents']?>">
					</td>
				</tr>
				<tr>
					<th>PC 이미지</th>
					<td>
						<label>
							<input type="file" class="upload_image_input <?=attr($banner['imgpc'],'hasfile')?>" name="imgpc">
							<span class="icon"><?php echo $banner['imgpc'] ? $banner['imgpc'] : '이미지 첨부' ?></span>
							<input type="hidden" class="upload_image_input" value="<?php echo $banner['imgpc']; ?>" name="old_imgpc">
						</label>
					</td>
				</tr>
				<tr>
					<th>M 이미지</th>
					<td>
						<label>
							<input type="file" class="upload_image_input <?=attr($banner['imgm'],'hasfile')?>" name="imgm">
							<span class="icon"><?php echo $banner['imgm'] ? $banner['imgm'] : '이미지 첨부' ?></span>
							<input type="hidden" class="upload_image_input" value="<?php echo $banner['imgm']; ?>" name="old_imgm">
						</label>
					</td>
				</tr>
			</table>
		</form>
		<div id="buttons"><button type="button" class="btn" onclick="document.board_form.submit();return false;">등록</button></div>
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
				