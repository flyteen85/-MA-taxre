<?php
	//ini_set('error_reporting', E_ALL & ~E_NOTICE);
	session_start();
	ob_start();
	@header("Content-Type: text/html; charset=utf-8");
	$gmnow = gmdate("D, d M Y H:i:s") . " GMT";
	@header("Expires: 0"); // rfc2616 - Section 14.21
	@header("Last-Modified: " . $gmnow);
	@header("Cache-Control: no-store, no-cache, must-revalidate"); 
	@header("Cache-Control: pre-check=0, post-check=0, max-age=0"); 
	@header("Pragma: no-cache"); // HTTP/1.0
	@ini_set("allow_url_fopen" ,"1");//fopen을위한 처리

	require_once $_SERVER["DOCUMENT_ROOT"]."/_lib/class/database/mysql.php";
	require_once $_SERVER["DOCUMENT_ROOT"]."/_lib/class/comm/comm.php";
	require_once $_SERVER["DOCUMENT_ROOT"]."/_lib/class/comm/date.php";
	require_once $_SERVER["DOCUMENT_ROOT"]."/_lib/class/comm/js.php";
	require_once $_SERVER["DOCUMENT_ROOT"]."/_lib/class/comm/file.php";
	require_once $_SERVER["DOCUMENT_ROOT"]."/_lib/class/comm/auth.php";
	require_once $_SERVER["DOCUMENT_ROOT"]."/_lib/class/comm/xml.php";
	require_once $_SERVER["DOCUMENT_ROOT"]."/_lib/class/comm/api.php";

	require_once $_SERVER["DOCUMENT_ROOT"]."/_lib/class/user/user_data.php";
	require_once $_SERVER["DOCUMENT_ROOT"]."/_lib/class/user/user.php";

	//FORMTAG
	require_once $_SERVER["DOCUMENT_ROOT"]."/_lib/class/comm/form.php";

	require_once $_SERVER["DOCUMENT_ROOT"]."/_lib/class/comm/log.php";
	require_once $_SERVER["DOCUMENT_ROOT"]."/_lib/class/comm/img.php";

	require_once $_SERVER["DOCUMENT_ROOT"]."/_lib/class/shop/shop_data.php";
	require_once $_SERVER["DOCUMENT_ROOT"]."/_lib/class/shop/shop.php";


	require_once $_SERVER["DOCUMENT_ROOT"]."/_lib/class/shop/goods_data.php";
	require_once $_SERVER["DOCUMENT_ROOT"]."/_lib/class/shop/goods.php";


	require_once $_SERVER["DOCUMENT_ROOT"]."/_lib/class/shop/category.php";
	//require_once $_SERVER["DOCUMENT_ROOT"]."/_lib/class/shop/payment.php";

	//php version 처리 확인
	$php_version=explode('.', phpversion());
	if($php_version[0]<4 || ($php_version[0]==4 && $php_version[1]<1)) {
		$_GET=&$HTTP_GET_VARS;
		$_POST=&$HTTP_POST_VARS;
		$_COOKIE=&$HTTP_COOKIE_VARS;
		$_SESSION=&$HTTP_SESSION_VARS;
		$_FILES=&$HTTP_POST_FILES;
		$_ENV=&$HTTP_ENV_VARS;
		$_SERVER=&$HTTP_SERVER_VARS;
	}
	if($_GET) extract($_GET);  
	if($_POST) extract($_POST); 
	if($_FILES) extract($_FILES); 
	if($_SERVER) extract($_SERVER); 
	if($_ENV) extract($_ENV); 
	if($_COOKIE) extract($_COOKIE); 
	if($_SESSION) extract($_SESSION); 


	define("_charset_","UTF-8"); //확장자
	define("_title_","리얼랜딩"); //타이틀설정
	define("_adm_title_",":::리얼랜딩 관리자 시스템 :::");
	define("_js_path_" , "/_js");
	define("_jquery_path_" , "/_js/_jquery");
	define("_jquery_plugin_path_" , _jquery_path_."/plugin");

	define("_lib_" , "/_lib");
	define("_component_path_" , "/_lib/component");
	define("_module_path_" , "/_lib/module");
	define("_zipcode_" , "/_lib/component/search/post");
	define("_id_" , "/_lib/component/search/user");

	define("_ip_" , "");	
	define("_config_auth_" , 99); //해당 등급 처리의 기본 처리 하는 부분
	define("_super_auth_" , 99); //해당 등급 처리의 기본 처리 하는 부분
	define("_password_enc_" , true);
	define("_include_" , $_SERVER["DOCUMENT_ROOT"]);

	//사용할 전화번호 설정 부분 입니다 | 구분자로 넣어주시면 됩니다.
	/*define("_tel_","02|031|032|033|041|042|043|051|052|053|054|055|061|062|063|064|070");
	define("_phone_","010|011|016|017|018|019");
	define("_all_tel_","02|031|032|033|041|042|043|051|052|053|054|055|061|062|063|064|070|010|011|016|017|018|019");
	define("_email_","직접입력|daum.net|hanmail.net|nate.com|lycos.co.kr|hanafos.com|paran.com|naver.com|hotmail.com|dreamwiz.com|empal.com|yahoo.co.kr|korea.com");
	*/

	define("_file_exp_","jpg,gif,png,hwp,xls,xlsx,doc,txt,ppt,pptx,pdf,avi,mp3,mp4,swf");
	define("_word_filter_" , "8억|새끼|개새끼|소새끼|병신|지랄|씨팔|십팔|니기미|찌랄|지랄|쌍년|쌍놈|빙신|좆까|니기미|좆같은게|잡놈|벼엉신|바보새끼|씹새끼|씨발|시벌|씨벌|떠그랄|좆밥|추천인|추천id|추천아이디|추천id|추천아이디|추/천/인|쉐이|등신|싸가지|미친놈|미친넘|찌랄|죽습니다|님아|님들아|씨밸넘|개세끼|관리자|운영자
	");
	define("_adm_path_","/admin");
	define("_adm_inc_","/admin/inc_file");
	define("_adm_img_","/admin/img");
	define("_attach_file_",$_SERVER["DOCUMENT_ROOT"]."/upfile");
	define("_search_path_",$_SERVER["DOCUMENT_ROOT"]."/_lib/component/search");
	define("_upload_path_","/upfile");
	define("_img_","/img");
	define("_board_img_","/board/img");
	define("_board_path_","/board");
	define("_upload_",_root_."/upfile");
	define("_banner_",_root_."/upfile/banner");
	define("_file_maxsize_" , 999999);
	define("_byte_" , 1048576);

	define("_bravod_" , true);
	define("_pay_id_" , "INIpayTest");

	$tel_cfg = array(
		""=>"선택",
		"02"=>"서울(02)",
		"031"=>"경기(031)",
		"032"=>"인천(032)",
		"033"=>"강원(033)",
		"041"=>"충남(041)",
		"042"=>"대전(042)",
		"043"=>"충북(043)",
		"044"=>"세종시(044)",
		"051"=>"부산(051)",
		"052"=>"울산(052)",
		"053"=>"대구(053)",
		"054"=>"경북(054)",
		"055"=>"경남(055)",
		"061"=>"전남(061)",
		"062"=>"광주(062)",
		"063"=>"전북(063)",
		"070"=>"인터넷(070)",
		"1588"=>"대표전화(1588)"
	);

	$phone_cfg = array(
		""=>"선택",
		"010"=>"010",
		"011"=>"011",
		"016"=>"016",
		"017"=>"017",
		"018"=>"018",
		"019"=>"019",
	);

	$all_num_cfg = array(
		""=>"선택",
		"02"=>"서울(02)",
		"031"=>"경기(031)",
		"032"=>"인천(032)",
		"033"=>"강원(033)",
		"041"=>"충남(041)",
		"042"=>"대전(042)",
		"043"=>"충북(043)",
		"044"=>"세종시(044)",
		"051"=>"부산(051)",
		"052"=>"울산(052)",
		"053"=>"대구(053)",
		"054"=>"경북(054)",
		"055"=>"경남(055)",
		"061"=>"전남(061)",
		"062"=>"광주(062)",
		"063"=>"전북(063)",
		"070"=>"인터넷(070)",
		"1588"=>"대표전화(1588)",
		"010"=>"010",
		"011"=>"011",
		"016"=>"016",
		"017"=>"017",
		"018"=>"018",
		"019"=>"019",
	);

	//직접입력|daum.net|hanmail.net|nate.com|lycos.co.kr|hanafos.com|paran.com|naver.com|hotmail.com|dreamwiz.com|empal.com|yahoo.co.kr|korea.com
	$email_cfg = array(
		"직접입력"=>"직접입력",
		"daum.net"=>"다음메일",
		"hanmail.net"=>"한메일",
		"nate.com"=>"네이트",
		"lycos.co.kr"=>"라이코스",
		"hanafos.com"=>"하나포스",
		"paran.com"=>"파란",
		"naver.com"=>"네이버",
		"hotmail.com"=>"핫메일",
		"dreamwiz.com"=>"드림위즈",
		"empal.com"=>"엠팔",
		"yahoo.co.kr"=>"야후",
		"korea.com"=>"코리아"
	);
	$_log->conn_log();
?>