<?php
	include'loader.php';
	$page = 'category';
	
	if($param['has_data']){
		if(!$param['no']){
			insertItem('categories',$param);
		}
		else{
			updateItem('categories',$param,$param['no']);
		}
		getBack('category.php');
	}
	if($param['no']){
		$category = getItem('categories',$param['no']);
	}
	include'views/header.html';
?>

			<!-- BEGIN PAGE TITLE -->
			<div class="page-title">
				<h1>카테고리 관리</h1>
			</div>
			<!-- END PAGE TITLE -->
		<br style="clear:both;">
<div class="portlet-body form">
		<form action="" method="post" class="form-horizontal form-bordered ">
			<input type="hidden" name="has_data" value="1">
			<input type="hidden" name="no" value="<?=$param['no']?>">
			<div class="form-body ">
				<div class="form-group">
					<label class="control-label col-md-3">카테고리명</label>
					<div class="col-md-4">
						
						<input type="text" name="name" class="form-control" value="<?=$category['name']?>">
						<!-- <span class="help-block">
						Maxlength is 25 chars. The badge will show up by default when the remaining chars are 10 or less. </span> -->
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3">정렬 우선순위</label>
					<div class="col-md-4">
						<input type="text" name="priority" class="form-control" value="<?=$category['priority']?>">
						<!-- <span class="help-block">
						Maxlength is 25 chars. The badge will show up by default when the remaining chars are 10 or less. </span> -->
					</div>
				</div>

								
			</div><br><br>
			<button type="submit" class="btn green">
						수정						
						<i class="fa fa-pencil"></i>
						</button>
						<br><br>
		</form>
	</div>
<?php
	include'views/footer.html';
?>
				
