<?php
	include'loader.php';
	$domain = $_SERVER['HTTP_HOST']; // 현재 도메인 가져오기
	$url = 'http://' . $domain . '/complete.php'; //신청 후 이동할 URL, 공백시 이전페이지로
	$config = getItem('site_configs');
	$maplist = getList('map');
	$bannerlist = getList('banner','', null,'','no ASC');
	$message = '';

	if (isset($param['representative'])) {

		$mobile_str = 'phone|samsung|lgtel|mobile|[^A]skt|nokia|blackberry|android|sony';
		if(preg_match('/'.$mobile_str.'/i', $_SERVER['HTTP_USER_AGENT'])){
			// Mobile
			$param['page'] = 'M';
		} else {
			// PC
			$param['page'] = 'PC';
		}
		// form 검사
		if(isset($param['has_data'])){
			$config = getItem('site_configs');
			
			// 휴대전화 검사
			if(is_array($param['phone'])){
				$param['phone'] = implode('-',$param['phone']);
					
				if(strlen($param['phone']) > 13){
					printMessage("잘못된 번호입니다. 다시 확인해주세요", "/");
					echo "<script>$('[class*=landing_form]').find('button').prop('disabled', false);</script>";
					exit;
				}
			};

			$param['ip'] = $_SERVER['REMOTE_ADDR'];
			unset($param['has_data']);
			$param['contents'] = jsonEncode($param);

			$excluded_numbers = ['010-5855-3890']; // 수신거부 번호 ['번호', '번호'] 이런형태로 추가

			if (!in_array($param['phone'], $excluded_numbers)) {
				if(isset($config['sms_id'])){
					$receivers = explode(',',$config['admin_contact']);
					foreach($receivers as $receiver) {
						sendSMS($config['site_name'].'[고객문의 도착]'.$param['representative'].'('.$param['phone'].'), 지역'.$param['location'], str_replace('-','',$receiver), trim($config['sms_id']), trim($config['certif_key']), $config['sender']);
					}
				}
				insertItem('applicants',$param); // DB 입력
				// printMessage($message, $url); // 알림메세지 띄운후 화면이동
				header('Location: ' . $url);
				include 'send_mail.php';
				exit;
			}
			// printMessage($message, $url); // 알림메세지 띄운후 화면이동
			header('Location: ' . $url);
			exit;
		}
	}
?>