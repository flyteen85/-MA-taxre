<?php
	if(!$_SESSION['login']){
		getBack('login.php');
		exit;
	}

	include'loader.php';
	$config = getItem('site_configs');
	if(isset($param['admin_data'])){
		updateItem('site_configs',$param,'*');
		printMessage('적용되었습니다.');
	}
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8">
<title>MAKER AD ADMIN</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport">
<!-- OG태그 -->
<meta name="Author" content="메이커애드">
<meta name="description" CONTENT="<?=$config['site_desc'];?>">
<meta name="keywords" content="<?=$config['site_keyword'];?>">

<meta property="og:url" content="<?=$_SERVER['HTTP_HOST'];?>">
<meta property="og:type" content="WEBSITE">
<meta property="og:site_name" content="<?=$config['site_name'];?>">
<meta property="og:title" content="<?=$config['site_name'];?>">
<meta property="og:description" content="<?=$config['site_desc'];?>">
<!-- BEGIN PAGE STYLES -->
<link rel="stylesheet" type="text/css" href="/font/font.css">
<link href="./styles/admin/default.css" rel="stylesheet" type="text/css" id="style_color">
<link href="./styles/admin/custom.css" rel="stylesheet" type="text/css">
<link href="//code.jquery.com/ui/1.9.1/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css">
<script src="./scripts/admin/jquery.min.js" type="text/javascript"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
<script src="./scripts/admin/jin-dev.js" type="text/javascript"></script>
</head>

<body>
	<div class="adminPopup">
		<div class="content-title"><div><h3>관리자 정보</h3><button type="button" class="closebtn"></button></div></div>
		<form action="" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
			<input type="hidden" name="admin_data" value="1">
			<table class="table admin">
				<tr>
					<td>관리자 ID</td>
					<td><input type="text" name="admin_id" class="input-control" value="<?=$config['admin_id']?>"></td>
				</tr>
				<tr>
					<td>관리자 PW</td>
					<td><input type="text" name="admin_password" class="input-control" value="<?=$config['admin_password']?>"></td>
				</tr>
			</table>
			<div class="center">
				<button type="submit" class="btn">저장</button>
			</div>
		</form>
	</div>
	<div class="header">
		<h3>
			<button type="button" class="menuBtn active"><hr><hr><hr></button>
			<a href="/admin/">ADMIN</a>
		</h3>
		<div>
			<div class="adminInfo">
				<span class="icon"><img src="<?php echo $config['site_icon'] ? '/admin/files/favicon/'.$config['site_icon'] : '/admin/files/favicon/user.ico';?>"></span><span><?=$config['site_name'];?></span>
			</div>
		</div>
	</div>
	<script>
		$(function(){
			$('.menuBtn').on('click',function(){
				$(this).toggleClass('active');
				$('.layoutcontainer').toggleClass('active');
			})
		});
	</script>
	<div class="layoutcontainer active">
		<div class="layoutsidebar">
			<ul class="navlist">
				<!-- <li <?=attr($page=='applicant','class="active"')?>>
					<a href="index.php"><span class="icon"><img src="/admin/images/adminList.png"></span><span class="text">DB리스트</span></a>
				</li> -->
				<li <?=attr($page=='config','class="active"')?>>
					<a href="config.php"><span class="icon"><img src="/admin/images/adminSetup.png"></span><span class="text"><span>설정</span></a>
				</li>
				<li <?=attr($page=='popup','class="active"')?>>
					<a href="popup_list.php"><span class="icon"><img src="/admin/images/adminPopup.png"></span><span class="text"><span>팝업</span></a>
				</li>
				<!-- <li <?=attr($page=='video','class="active"')?>>
					<a href="video_list.php"><span class="icon"><img src="/admin/images/adminVideo.png"></span><span class="text"><span>동영상</span></a>
				</li> -->
				<!-- <li <?=attr($page=='banner','class="active"')?>>
					<a href="banner_list.php"><span class="icon"><img src="/admin/images/adminGalery.png"></span><span class="text"><span>배너</span></a>
				</li> -->
				<!-- <li <?=attr($page=='gallery','class="active"')?>>
					<a href="gallery_list.php"><span class="icon"><img src="/admin/images/adminGalery.png"></span><span class="text"><span>갤러리</span></a>
				</li> -->
				<!-- <li <?=attr($page=='map','class="active"')?>>
					<a href="map_list.php"><span class="icon"><img src="/admin/images/adminMap.png"></span><span class="text"><span>매장</span></a>
				</li> -->
			</ul>
		</div>

		<div class="layoutcontent">
			

