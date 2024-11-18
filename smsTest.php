<?php
	include'loader.php';
	$config = getItem('site_configs');
	$param['location'] = '서울';
	sendSMS($config['site_name'].'[고객문의 도착]김이현회사이름(01028898589), 지역:'.$param['location'], '01028898589',trim($config['sms_id']),trim($config['certif_key']),$config['sender']);
	
?>