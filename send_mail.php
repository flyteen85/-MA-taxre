<?php
// 받는 사람이 여럿일 경우 , 로 늘려준다.

// 제목
$subject = '고객문의 메일 도착';

$contents = '';

foreach($melon['fields'] as $key => $field){
	if(isset($param[$key])){
		$contents .= '<span style="display:inline-block;vertical-align:middle;color:#999;">'.$field.'</span> <span style="display:inline-block;vertical-align:middle;">:</span> <span style="display:inline-block;vertical-align:middle;color:#000;font-weight:700;">'.$param[$key]."</span><br>";
	}
}

// 내용
$message = '<div style="max-width:710px;width:100%;margin:0 auto;text-align:center;"><div style="padding:20px; text-align:center;box-sizing:border-box;font-size:16px;font-weight:700;background:#f7f7f7;border:1px solid #eee;">'.$config['site_name'].'에서 고객문의가 도착했습니다'.'</div><div style="display:inline-block;border:1px solid #eee;background:#f7fcfe;padding:50px;text-align:left;max-width:710px;width:100%;box-sizing:border-box;">'.$contents.'</div><div style="padding:20px; text-align:center;box-sizing:border-box;background:#f7f7f7;border:1px solid #eee;">관리자 발신 전용입니다.</div></div>';

// HTML 내용을 메일로 보낼때는 Content-type을 설정해야한다
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// 보내는 사람
if(strpos($config['email'], ',') !== false){
    $to_emails = explode(',', $config['email']);
    // From 헤더와 Content-Type 헤더를 결합하여 설정
    $headers .= 'From: '.$config['site_name'].'<'.$to_emails[0].'>'."\r\n";
} else {
    $to_emails = array($config['email']);
    // From 헤더와 Content-Type 헤더를 결합하여 설정
    $headers .= 'From: '.$config['site_name'].'<'.$config['email'].'>'."\r\n";
}

// 각 이메일 주소에 대해 메일 보내기
foreach ($to_emails as $to_email) {
    mail($to_email, $subject, $message, $headers);
}
?>
