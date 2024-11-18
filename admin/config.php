<?php
	include'loader.php';
	$page = 'config';
	
	if(isset($param['has_data'])){
		$site_icon = simpleUpload($_FILES['site_icon'],'/admin/files/favicon/');
		if(isset($site_icon)){$param['site_icon'] = $site_icon['path'];}else{$param['site_icon'] = $param['old_site_icon'];}
		$site_metaimage = simpleUpload($_FILES['site_metaimage'],'/admin/files/meta/');
		if(isset($site_metaimage)){ $param['site_metaimage'] = $site_metaimage['path']; } else { $param['site_metaimage'] = $param['old_site_metaimage']; }

		//console($param,1);exit;

        //exit;
		updateItem('site_configs',$param,'*');
		printMessage('적용되었습니다.');
		exit;
	}
	$config = getItem('site_configs');
	include'views/header.php';
?>
<div class="page-container sub">
	<div class="container">
		<div class="portlet-body form">
			<form action="" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
				<input type="hidden" name="has_data" value="1">
        <input type="hidden" name="has_config" value="1">
				
				<div class="content-title">
					<div>
						<h3>사이트 정보</h3>
					</div>
				</div>

				<table class="table detail">
					<tr>
						<td>사이트 이름</td>
						<td><input type="text" name="site_name" class="input-control" value="<?=$config['site_name']?>"></td>
					</tr>
					<tr>
						<td>Description(설명)</td>
						<td><input type="text" name="site_desc" class="input-control" value="<?=$config['site_desc']?>"></td>
					</tr>
					<tr>
						<td>Keyword(키워드)</td>
						<td><input type="text" name="site_keyword" class="input-control" value="<?=$config['site_keyword']?>"></td>
					</tr>
					<tr>
						<td>사이트 아이콘</td>
						<td>
							<label>
								<input type="file" class="upload_image_input <?=attr($config['site_icon'],'hasfile')?>" name="site_icon" accept=".ico">
								<span class="icon"><?php echo $config['site_icon'] ? $config['site_icon'] : '파비콘 등록' ?></span>
								<input type="hidden" class="upload_image_input" value="<?php echo $config['site_icon']; ?>" name="old_site_icon">
							</label>
						</td>
					</tr>
					<tr>
						<td>메타이미지</td>
						<td>
							<label>
								<input type="file" class="upload_image_input <?=attr($config['site_metaimage'],'hasfile')?>" name="site_metaimage">
								<span class="icon"><?php echo $config['site_metaimage'] ? $config['site_metaimage'] : '메타이미지 등록' ?></span>
								<input type="hidden" class="upload_image_input" value="<?php echo $config['site_metaimage']; ?>" name="old_site_metaimage">
							</label>
						</td>
					</tr>
					<tr>
						<td>개인정보보호정책</td>
						<td>
							<textarea type="text" name="site_agree" wrap="physical" class="input-control"><?=$config['site_agree']?></textarea>
						</td>
					</tr>
					<!-- 
					<tr>
						<td>마케팅활용</td>
						<td>
							<textarea type="text" name="site_marketing" wrap="physical" class="input-control"><?=$config['site_marketing']?></textarea>
						</td>
					</tr>
					-->
				</table>


				<div class="content-title">
					<div>
						<h3>카카오맵</h3>
					</div>
				</div>
				<table class="table detail">
					<tr>
						<td>JavaScript 키</td>
						<td><input type="text" name="javascriptkey" class="input-control" value="<?=$config['javascriptkey']?>"></td>
					</tr>
				</table>


				<div class="content-title">
					<div>
						<h3>부가서비스</h3>
					</div>
				</div>

				<table class="table detail">
					<tr>
						<td>발신자연락처</td>
						<td><input type="text" name="sender" class="input-control phone_check" value="<?=$config['sender']?>"></td>
					</tr>
					<tr>
						<td>연락처<br>(문자수신, 콤마로 구분)</td>
						<td><input type="text" name="admin_contact" class="input-control" value="<?=$config['admin_contact']?>"></td>
					</tr>
					<tr>
						<td> SMS 아이디(카페 24)</td>
						<td><input type="text" name="sms_id" class="input-control" value="<?=$config['sms_id']?>"></td>
					</tr>
					<tr>
						<td> SMS 키(카페 24)</td>
						<td><input type="text" name="certif_key" class="input-control" value="<?=$config['certif_key']?>"></td>
					</tr>
					<tr>
						<td>이메일(수신)</td>
						<td><input type="text" name="email" class="input-control" value="<?=$config['email']?>"></td>
					</tr>
				</table>

				<button type="submit" class="btn">수정</button>
			</form>
		</div>
	</div>
</div>

<script>
$(document).on('change','.upload_image_input',function(){
	var input = this;
	var filename = $(this)[0].files[0].name;
	var ext = filename.split(".").pop().toLowerCase();
	if($(this).attr('accept')){
		if($.inArray(ext, ["ico"]) == -1){
			alert("ico파일만 업로드 해주세요");
			$(this).val("");
			return false;
		}
	} else {
		if($.inArray(ext, ["jpg","png"]) == -1){
			alert("이미지 파일만 업로드 해주세요");
			$(this).val("");
			return false;
		}
	}
	$(this).next('span.icon').html(filename);
	$(this).addClass('hasfile');
});
var areaCodes = ['02', '031', '032', '033', '041', '042', '043', '051', '052', '053', '054', '055', '061', '062', '063', '064'];
$('[class*="phone_check"]').keyup(function() {
	var phone = '';
	var seoul = 0;
	var areaCode = false;
	var string = $(this).val();
	var regex =  /^[0-9\-]+$/;
	
	if(string){
		if(!regex.test(string)){
			alert('숫자만 입력 할 수 있습니다.');
			$(this).val('');
			return false;
		}
	}
	
	var value = string.replace(/[^0-9]/g, '');
	
	/* 서울 앞자리가 02 일때 */
	if(value.substring(0,2) == '02'){
		seoul = 1;
	}
	
	/* 자동으로 하이픈 삽입하기 */
	if(value.length > (3-seoul) && value.length <= 7){
		phone += value.substr(0, (3-seoul));
		phone += "-";
		phone += value.substr(3-seoul);
		$(this).val(phone);
	} else if(value.length > (7-seoul)){
		for (var i = 0; i < areaCodes.length; i++) {
			if (value.startsWith(areaCodes[i])) {
				areaCode = true;
			}
		}
		if(areaCode == true){
			//지역번호라면
			if(value.substring(0,2) == '02'){
				$(this).attr({'maxlength':'11'});
				phone += value.substr(0, (3-seoul));
				phone += "-";
				phone += value.substr(3-seoul, 4-seoul);
				phone += "-";
				phone += value.substr(7-seoul-seoul);
				$(this).val(phone);		
			} else {
				$(this).attr({'maxlength':'12'});
				phone += value.substr(0, (3-seoul));
				phone += "-";
				phone += value.substr(3-seoul, 3-seoul);
				phone += "-";
				phone += value.substr(6-seoul-seoul);
				$(this).val(phone);				
			}
		} else {
			//010이라면
			$(this).attr({'maxlength':'13'});
			phone += value.substr(0, (3-seoul));
			phone += "-";
			phone += value.substr(3-seoul, 4-seoul);
			phone += "-";
			phone += value.substr(7-seoul-seoul);
			$(this).val(phone);
		}
	}
});
</script>

<?php
	include'views/footer.php';
?>
				
