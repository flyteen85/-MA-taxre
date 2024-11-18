<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, target-densitydpi=medium-dpi" />
	<title><?=$config['site_name']?></title>

	<!-- OG태그 -->
	<meta name="Author" content="메이커애드">
	<meta name="description" CONTENT="<?=$config['site_desc'];?>">
   	<meta name="keywords" content="<?=$config['site_keyword'];?>">
	
	<meta property="og:url" content="<?=$_SERVER['HTTP_HOST'];?>">
	<meta property="og:type" content="WEBSITE">
	<meta property="og:site_name" content="<?=$config['site_name'];?>">
	<meta property="og:title" content="<?=$config['site_name'];?>">
	<meta property="og:description" content="<?=$config['site_desc'];?>">
	
	<!-- OG 메타태그 -->
	<meta property="og:image" content="<?php echo $config['site_metaimage'] ? '/admin/files/meta/'.$config['site_metaimage'] : '/admin/files/meta/default.png';?>">
	<meta property="og:image:secure_url" content="<?php echo $config['site_metaimage'] ? '/admin/files/meta/'.$config['site_metaimage'] : '/admin/files/meta/default.png';?>">
	<meta property="og:image:type" content="image/png">
	<meta property="og:image:width" content="660">
	<meta property="og:image:height" content="350">

	<!-- 파비콘 -->
	<link rel="shortcut icon" href="<?php echo $config['site_icon'] ? '/admin/files/favicon/'.$config['site_icon'] : '/admin/files/favicon/default.ico';?>">
	<link rel="icon" href="<?php echo $config['site_icon'] ? '/admin/files/favicon/'.$config['site_icon'] : '/admin/files/favicon/default.ico';?>">

	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="./css/swiper.css">
	<link rel="stylesheet" type="text/css" href="./css/reset.css">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<link rel="stylesheet" type="text/css" href="./css/common.css">
	<link rel="stylesheet" type="text/css" href="./css/animation.css">
	<link rel="stylesheet" type="text/css" href="./font/font.css">

	<!-- JS -->
	<script type="text/javascript" src="./js/jquery.min.js"></script>
	<script type="text/javascript" src="./js/jquery.cookie.js"></script>
	<script type="text/javascript" src="./js/swiper.js"></script>
	<script type="text/javascript" src="./js/player.js"></script>
	<script type="text/javascript" src="./js/common.js"></script>

</head>