<?php
	include'loader.php';

	$no=uploadFile($_FILES["upload"],"/admin/files");
	echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction('{$param['CKEditorFuncNum']}', '/admin/files/{$no['path']}', '업로드 완료');if(parent.$('input[name=\"image_no\"]').val()==''){parent.$('input[name=\"image_no\"]').val({$no['no']});}</script>";
?>