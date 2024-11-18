<?php
	include'loader.php';
	$page = 'notice';

	if($param['has_data']==1){
		$attach=simpleUpload($_FILES['attach'],'/admin/files');
		$param['attach'] = $attach['path'];

		if($param['no']){
			updateItem('notice',$param,$param['no']);
		}
		else{
			insertItem('notice',$param);
		}

		getBack('/admin/notice_list.php');
	}

	
	

	
if($param['no']){
		$notice = getItem('notice',$param['no']);
}
	include'views/header.html';
?>
<div class="page-container">
	<div class="container">
		<!-- BEGIN PAGE TITLE -->
		<div class="page-title flex col2 middle">
			<div>
				<h1 class="title"><span>공지사항</span></h1>
			</div>
			<div>
				
			</div>
		</div>
		<!-- END PAGE TITLE -->
		
		<form action="" method="post" name="board_form" enctype="multipart/form-data">
			<input type="hidden" name="has_data"  value="1"/>
			<input type="hidden" name="no"  value="<?=$param['no']?>"/>
			<table class="table detail">
				<tr>
					<th>제목</th>
					<td><input type="text" name="title" class="input-control" value="<?=$notice['title']?>"></td>
				</tr>
				<tr>
					<th>내용</th>
					<td>
						<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
						<textarea name="contents" class="ckeditor"><?=$notice['contents']?></textarea>
					</td>
				</tr>
				<tr>
					<th>첨부</th>
					<td><input type="file"  name="attach"/>		<?=attr($notice['attach'],'<a href="/admin/files/'.$notice['attach'].'">[첨부]</a>')?></td>
				</tr>
			</table>
		</form>
		<div id="pagination"><?=$notices['pagination']?></div>
		<div id="buttons"><a href="notice_write.php" class="btn btn-primary" onclick="document.board_form.submit();return false;">등록</a></div>
	</div>
</div>
<?php
	include'views/footer.html';
?>
				