<?php
	include'loader.php';
	$page = 'popup';
	if(isset($param['has_data'])){
		$attach = simpleUpload($_FILES['attach'],'/admin/files/popup/');
		$dir = $_SERVER["DOCUMENT_ROOT"]."/admin/files/popup/";
	    $param['create_date'] = date('Y-m-d H:i:s');
		if(isset($attach)) {
			if($param['old_attach']){
				unlink($dir.$param['old_attach']);
			}
			$param['attach'] = $attach['path'];
		}else{
			$param['attach'] = $param['old_attach'];
		}

		if($param['no']){
			$param['modify_date'] = date('Y-m-d H:i:s');
			updateItem('popup',$param,$param['no']);
		}
		else{
			insertItem('popup',$param);
		}
		getBack('/admin/popup_list.php');
	}

	if(isset($param['no'])){
		$popup = getItem('popup',$param['no']);
	}
	include'views/header.php';
?>
<div class="page-container">
	<div class="container">
		<div class="content-title">
			<div>
				<h3>팝업 등록</h3>
			</div>
		</div>

		<form action="" method="post" name="board_form" enctype="multipart/form-data" class="table">
			<input type="hidden" name="has_data" value="1"/>
			<input type="hidden" name="no" value="<?= isset($param['no']) ? $param['no'] : '' ?>"/>
			<input type="hidden" name="imgW" value="<?= isset($popup['imgW']) ? $popup['imgW'] : '' ?>">
			<table class="table detail" cellpadding="0" cellspacing="0">
				<tr>
					<td>제목</td>
					<td><input type="text" name="title" class="input-control" value="<?= isset($popup['title']) ? $popup['title'] : '' ?>"></td>
				</tr>
				<tr>
					<td>링크</td>
					<td><input type="text" name="hurl" class="input-control" value="<?= isset($popup['hurl']) ? $popup['hurl'] : '' ?>"></td>
				</tr>
				<tr>
					<td>내용</td>
					<td><textarea name="contents" class="input-control"><?= isset($popup['contents']) ? $popup['contents'] : '' ?></textarea></td>
				</tr>
				<tr>
					<td>위치TOP</td>
					<td><input type="text" name="positiontop" class="input-control" value="<?= isset($popup['positiontop']) ? $popup['positiontop'] : '' ?>" placeholder="숫자만 입력해주세요 ex)100"></td>
				</tr>
				<tr>
					<td>위치 LEFT</td>
					<td><input type="text" name="positionleft" class="input-control" value="<?= isset($popup['positionleft']) ? $popup['positionleft'] : '' ?>" placeholder="숫자만 입력해주세요 ex)300"></td>
				</tr>
				<tr>
					<td>옵션</td>
					<td>
						<label class="jellybox">
							<input type="radio" name="target" value="_blank" <?= isset($popup['target']) && $popup['target'] == '_blank' ? "checked" : "" ;  echo !isset($popup['target']) ? "checked" : "" ;?>>
							<span class="icon"></span>
							<span class="text">_blank</span>
						</label>
						<label class="jellybox">
							<input type="radio" name="target" value="_self" <?= isset($popup['target']) && $popup['target'] == '_self' ? "checked" : "" ;?>>
							<span class="icon"></span>
							<span class="text">_self</span>
						</label>
					</td>
				</tr>
				<tr>
					<td>팝업 순서</td>
					<td>
						<input type="text" name="popupindex" class="input-control" value="<?= isset($popup['popupindex']) ? $popup['popupindex'] : '' ?>" placeholder="높은숫자가 위로 올라옵니다">
					</td>
				</tr>
				<tr>
					<td>사용여부</td>
					<td>
						<label class="jellybox">
							<input type="radio" name="open_yn" value="Y" <?= isset($popup['open_yn']) && $popup['open_yn'] == 'Y' ? "checked" : "" ; echo !isset($popup['open_yn']) ? "checked" : "" ; ?>>
							<span class="icon"></span>
							<span class="text">사용</span>
						</label>
						<label class="jellybox">
							<input type="radio" name="open_yn" value="N" <?= isset($popup['open_yn']) && $popup['open_yn'] == 'N' ? "checked" : "" ;?>>
							<span class="icon"></span>
							<span class="text">미사용</span>
						</label>
					</td>
				</tr>
				<tr>
					<td>썸네일</td>
					<td>
						<label class="uploadbox">
							<input type="file" class="upload_image_input <?= isset($popup['attach']) ? 'hasfile' : '' ?>" name="attach">
							<span class="icon"><?= isset($popup['attach']) ? $popup['attach'] : '이미지 첨부' ?></span>
							<input type="hidden" class="upload_image_input" value="<?= isset($popup['attach']) ? $popup['attach'] : '' ?>" name="old_attach">
						</label>
					</td>
				</tr>
			</table>
		</form>
		<div id="buttons">
			<a href="popup_write.php" class="btn btn-primary" onclick="document.board_form.submit();return false;">등록</a>
		</div>
	</div>
</div>

	<script>
	$(document).on('change','.upload_image_input',function(){
		var fileattr = $(this).val().split(".").pop().toLowerCase();
		if($.inArray(fileattr,["gif","jpg","jpeg","png"]) == -1){
			alert("gif, jpg, jpeg, png 파일만 업로드 해주세요.");
			$('.uploadbox input[type="file"]').removeClass('hasfile').val("");
			$('.uploadbox .icon').html("이미지첨부");
			return;
		}

		var fileSize = this.files[0].size;
		var maxSize = 1024 * 1024;
		if(fileSize > maxSize){
			alert("파일용량을 초과하였습니다.(max:1M)");
			$('.uploadbox input[type="file"]').removeClass('hasfile').val("");
			$('.uploadbox .icon').html("이미지첨부");
			return;
		}
		var file = this.files[0];
		var _URL = window.URL || window.webkitURL;
		var img = new Image();
		img.src = _URL.createObjectURL(file);
		img.onload = function(){
			if(img.width > 720){
				alert("이미지 최대 가로사이즈는 720px입니다.");
				$('.uploadbox input[type="file"]').removeClass('hasfile').val("");
				$('.uploadbox .icon').html("이미지첨부");
				return false;
			}
			console.log(img.width);
			$('[name="imgW"]').val(img.width);
		}
		var input = this;
		var filename = $(this)[0].files[0].name;
		$(this).next('span.icon').html(filename);
		$(this).addClass('hasfile');
	});
	</script>
<?php
	include'views/footer.php';
?>
				