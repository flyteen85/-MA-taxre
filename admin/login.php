<?php
	include'loader.php';
	// if($param['has_data']){
	if (isset($param['has_data'])) {
		$config= getItem('site_configs');
		if($config['admin_password']==$param['password']&&$config['admin_id']==$param['id']){
			$_SESSION['login'] = $config['no'];
			getBack('config.php');
			exit;
		}
		else{
			printMessage('아이디 또는 비밀번호를 확인해주세요.');
		}
	exit;
	}
?>
<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.5
Version: 4.1.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<?php
include'loader.php';
$config = getItem('site_configs');
?>
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8">
<title>관리자</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport">
<meta content="" name="description">
<meta content="" name="author">


<link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
<link href="./styles/admin/default.css" rel="stylesheet" type="text/css" id="style_color">
<link href="./styles/admin/custom.css" rel="stylesheet" type="text/css">
<!-- 파비콘 -->
<link rel="shortcut icon" href="<?php echo $config['site_icon'] ? '/admin/files/favicon/'.$config['site_icon'] : '/admin/files/favicon/default.ico';?>">
<link rel="icon" href="<?php echo $config['site_icon'] ? '/admin/files/favicon/'.$config['site_icon'] : '/admin/files/favicon/default.ico';?>">
<!--[if lt IE 9]>
<script src="scripts/admin/respond.min.js"></script>
<script src="scripts/admin/excanvas.min.js"></script> 
<![endif]-->
<script src="./scripts/admin/jquery.min.js" type="text/javascript"></script>
<script src="./scripts/admin/jquery-migrate.min.js" type="text/javascript"></script>
<script src="./scripts/admin/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="./scripts/admin/jquery.blockui.min.js" type="text/javascript"></script>
<script src="./scripts/admin/jquery.cokie.min.js" type="text/javascript"></script>
<script src="./scripts/admin/jquery.uniform.min.js" type="text/javascript"></script>
<script src="./scripts/admin/metronic.js" type="text/javascript"></script>
<script src="./scripts/admin/layout.js" type="text/javascript"></script>
<script src="./scripts/admin/quick-sidebar.js" type="text/javascript"></script>
<script src="./scripts/admin/demo.js" type="text/javascript"></script>
<script src="./scripts/admin/index3.js" type="text/javascript"></script>
<script src="./scripts/admin/tasks.js" type="text/javascript"></script>

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->
<!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->
<body>

<div class="login active">
	<!-- BEGIN LOGIN -->
	<div class="content">
		<!-- BEGIN LOGIN FORM -->
		<form class="login-form" action="" method="post">
			<input type="hidden" name="has_data" value="1" />
			<h3 class="form-title">Login to your account</h3>
			<div class="form-group" style="text-align:center;">
				<input class="form-control"  type="text" autocomplete="off" placeholder="ID" name="id">
			</div>
			<div class="form-group">
				<input class="form-control" type="password" autocomplete="off" placeholder="PASSWORD" name="password">
			</div>
			<div class="form-actions" style="text-align:center">
				<button type="submit">Login</button>
			</div>
		</form>
		<!-- END LOGIN FORM -->
	</div>
	<!-- END LOGIN -->
</div>
</body>
</html>