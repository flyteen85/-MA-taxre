<?php	
	$melon['debug']						= "DEBUG";
	$melon['charset']					= 'utf-8';		//Default Encoding
	$melon['column']['index']			= 'no';		//Sequence field name
	$melon['column']['create']			= 'create_date';	//Create date field name
	$melon['column']['update']			= 'modify_date';		//Update date field name
	$melon['upload']['filter']			= "php|htm|html";
	$melon['db']['type']				= 'mysqli';		//Database Type
	$melon['db']['host']				= 'localhost';	//Database Host
	$melon['db']['id']					= 'flyteen';	//Database Connection ID
	$melon['db']['pw']					= '1q2w3e';	//Database Connection Password
	$melon['db']['name']				= 'flyteen';	//Database Name
	$melon['helper']['pagination'] = array(
		'first'=>'<a href="[url]"><span>&lt;&lt;</span></a>',
		'prev'=>'<a href="[url]"><span>&lt;</span></a>',
		'number'=>'<a href="[url]"><span>$page</span></a>',
		'next'=>'<a href="[url]"><span>&gt;</span></a>',
		'last'=>'<a href="[url]"><span>&gt;&gt;</span></a>',
		'current'=>'<a href="[url]" class="active"><span>$page</span></a>'
	);

	/*
		Segment URI Setting
	*/
	
	$melon['helper']['uri'] = false;

	$melon['fields'] = array(
		'page'=>'구분',
		'representative'=>'이름',
		'phone' =>'연락처',
		'location'=>'희망지역',
		'funnels'=>'유입경로',
	); //필드를 한글로 전환할 목록을 작성하세요.


//db 에러는 500에러로 돌리는것 개선
?>