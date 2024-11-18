<?php
// 시간대 설정
date_default_timezone_set("Asia/Seoul");
function sendSMS($message, $number, $id, $key, $sender) {
    // 초기화
    $param['rdate'] = isset($param['rdate']) ? $param['rdate'] : null;
    $param['rtime'] = isset($param['rtime']) ? $param['rtime'] : null;
    $param['returnurl'] = isset($param['returnurl']) ? $param['returnurl'] : null;
    $param['testflag'] = isset($param['testflag']) ? $param['testflag'] : null;
    $param['destination'] = isset($param['destination']) ? $param['destination'] : null;
    $param['repeatFlag'] = isset($param['repeatFlag']) ? $param['repeatFlag'] : null;
    $param['repeatNum'] = isset($param['repeatNum']) ? $param['repeatNum'] : null;
    $param['repeatTime'] = isset($param['repeatTime']) ? $param['repeatTime'] : null;
    $param['nointeractive'] = isset($param['nointeractive']) ? $param['nointeractive'] : null;

    $sender = explode('-', $sender);

    /******************** 인증정보 ********************/
    $sms_url = "http://sslsms.cafe24.com/sms_sender.php"; // 전송요청 URL
    $sms['user_id'] = base64_encode($id); //SMS 아이디.
    $sms['secure'] = base64_encode($key); // 인증키
    $sms['msg'] = base64_encode(stripslashes($message));
    $sms['rphone'] = base64_encode($number);
    $sms['sphone1'] = base64_encode($sender[0]);
    $sms['sphone2'] = base64_encode($sender[1]);
    $sms['sphone3'] = base64_encode($sender[2]);
    $sms['rdate'] = base64_encode($param['rdate']);
    $sms['rtime'] = base64_encode($param['rtime']);
    $sms['mode'] = base64_encode("1"); // base64 사용시 반드시 모드값을 1로 주셔야 합니다.
    $sms['returnurl'] = base64_encode($param['returnurl']);
    $sms['testflag'] = base64_encode($param['testflag']);
    $sms['destination'] = base64_encode($param['destination']);
    $sms['repeatFlag'] = base64_encode($param['repeatFlag']);
    $sms['repeatNum'] = base64_encode($param['repeatNum']);
    $sms['repeatTime'] = base64_encode($param['repeatTime']);
    $nointeractive = $param['nointeractive'];

    $host_info = explode("/", $sms_url);
    $host = $host_info[2];
    $path = implode("/", array_slice($host_info, 3));

    srand((double)microtime() * 1000000);
    $boundary = "---------------------" . substr(md5(rand(0, 32000)), 0, 10);

    // 헤더 생성
    $header = "POST /" . $path . " HTTP/1.0\r\n";
    $header .= "Host: " . $host . "\r\n";
    $header .= "Content-type: multipart/form-data, boundary=" . $boundary . "\r\n";

    // 본문 생성
    $data = '';
    foreach ($sms as $index => $value) {
        $data .= "--$boundary\r\n";
        $data .= "Content-Disposition: form-data; name=\"" . $index . "\"\r\n";
        $data .= "\r\n" . $value . "\r\n";
        $data .= "--$boundary\r\n";
    }
    $header .= "Content-length: " . strlen($data) . "\r\n\r\n";

    $fp = fsockopen($host, 80);

    if ($fp) {
        fputs($fp, $header . $data);
        $rsp = '';
        while (!feof($fp)) {
            $rsp .= fgets($fp, 8192);
        }
        fclose($fp);
        $msg = explode("\r\n\r\n", trim($rsp));
        $rMsg = explode(",", $msg[1]);
        $Result = $rMsg[0]; // 발송결과
        $Count = $rMsg[1]; // 잔여건수

        // 발송결과 알림
        if ($Result == "success") {
            $alert = $_SESSION['certif_code'];
            $param["tel"] = $param["sphone1"] . $param["sphone2"] . $param["sphone3"];
            if (strlen($param["birth_month"]) == 1) {
                $param["birth_month"] = "0" . $param["birth_month"];
            }
            if (strlen($param["birth_date"]) == 1) {
                $param["birth_date"] = "0" . $param["birth_date"];
            }
            $param["birth"] = $param["birth_year"] . $param["birth_month"] . $param["birth_date"];

            // 아이라이크클릭 실적 저장 끝
        } elseif ($Result == "reserved") {
            $alert = "성공적으로 예약되었습니다.";
            $alert .= " 잔여건수는 " . $Count . "건 입니다.";
        } elseif ($Result == "3205") {
            $alert = "잘못된 번호형식입니다.";
        } elseif ($Result == "0044") {
            $alert = "스팸문자는 발송되지 않습니다.";
        } else {
            echo $Result;
        }
    } else {
        $alert = "Connection Failed";
    }
}

function sendSMS1($obj) {
    // 초기화
    $obj['rdate'] = isset($obj['rdate']) ? $obj['rdate'] : null;
	$obj['rtime'] = isset($obj['rtime']) ? $obj['rtime'] : null;
	$obj['returnurl'] = isset($obj['returnurl']) ? $obj['returnurl'] : null;
	$obj['testflag'] = isset($obj['testflag']) ? $obj['testflag'] : null;
	$obj['destination'] = isset($obj['destination']) ? $obj['destination'] : null;
	$obj['repeatFlag'] = isset($obj['repeatFlag']) ? $obj['repeatFlag'] : null;
	$obj['repeatNum'] = isset($obj['repeatNum']) ? $obj['repeatNum'] : null;
	$obj['repeatTime'] = isset($obj['repeatTime']) ? $obj['repeatTime'] : null;
	$obj['nointeractive'] = isset($obj['nointeractive']) ? $obj['nointeractive'] : null;


    $obj['action'] = 'go';

    /******************** 인증정보 ********************/
    $sms_url = "http://sslsms.cafe24.com/sms_sender.php"; // 전송요청 URL
    $sms['user_id'] = base64_encode("magicsms"); //SMS 아이디.
    $sms['secure'] = base64_encode("c5b586394f5ed42a406338c9c824ed40"); // 인증키
    $sms['msg'] = base64_encode(stripslashes($obj['message']));
    $sms['rphone'] = base64_encode($obj['phone']);
    $sms['sphone1'] = base64_encode('010');
    $sms['sphone2'] = base64_encode('2814');
    $sms['sphone3'] = base64_encode('7637');
    $sms['rdate'] = base64_encode($obj['rdate']);
    $sms['rtime'] = base64_encode($obj['rtime']);
    $sms['mode'] = base64_encode("1"); // base64 사용시 반드시 모드값을 1로 주셔야 합니다.
    $sms['returnurl'] = base64_encode($obj['returnurl']);
    $sms['testflag'] = base64_encode($obj['testflag']);
    $sms['destination'] = base64_encode($obj['destination']);
    $sms['repeatFlag'] = base64_encode($obj['repeatFlag']);
    $sms['repeatNum'] = base64_encode($obj['repeatNum']);
    $sms['repeatTime'] = base64_encode($obj['repeatTime']);
    $nointeractive = $obj['nointeractive'];

    $host_info = explode("/", $sms_url);
    $host = $host_info[2];
    $path = implode("/", array_slice($host_info, 3));

    srand((double)microtime() * 1000000);
    $boundary = "---------------------" . substr(md5(rand(0, 32000)), 0, 10);

    // 헤더 생성
    $header = "POST /" . $path . " HTTP/1.0\r\n";
    $header .= "Host: " . $host . "\r\n";
    $header .= "Content-type: multipart/form-data, boundary=" . $boundary . "\r\n";

    // 본문 생성
    $data = '';
    foreach ($sms as $index => $value) {
        $data .= "--$boundary\r\n";
        $data .= "Content-Disposition: form-data; name=\"" . $index . "\"\r\n";
        $data .= "\r\n" . $value . "\r\n";
        $data .= "--$boundary\r\n";
    }
    $header .= "Content-length: " . strlen($data) . "\r\n\r\n";

    $fp = fsockopen($host, 80);

    if ($fp) {
        fputs($fp, $header . $data);
        $rsp = '';
        while (!feof($fp)) {
            $rsp .= fgets($fp, 8192);
        }
        fclose($fp);
        $msg = explode("\r\n\r\n", trim($rsp));
        $rMsg = explode(",", $msg[1]);
        $Result = $rMsg[0]; // 발송결과
        $Count = $rMsg[1]; // 잔여건수

        // 발송결과 알림
        if ($Result == "success") {
            $alert = $_SESSION['certif_code'];
            $obj["tel"] = $obj["sphone1"] . $obj["sphone2"] . $obj["sphone3"];
            if (strlen($obj["birth_month"]) == 1) {
                $obj["birth_month"] = "0" . $obj["birth_month"];
            }
            if (strlen($obj["birth_date"]) == 1) {
                $obj["birth_date"] = "0" . $obj["birth_date"];
            }
            $obj["birth"] = $obj["birth_year"] . $obj["birth_month"] . $obj["birth_date"];

            // 아이라이크클릭 실적 저장 끝
        } elseif ($Result == "reserved") {
            $alert = "성공적으로 예약되었습니다.";
            $alert .= " 잔여건수는 " . $Count . "건 입니다.";
        } elseif ($Result == "3205") {
            $alert = "잘못된 번호형식입니다.";
        } elseif ($Result == "0044") {
            $alert = "스팸문자는 발송되지 않습니다.";
        } else {
            echo $Result;
            exit;
        }
    } else {
        $alert = "Connection Failed";
    }
}
