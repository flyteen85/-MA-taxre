<?php
//===================================================================================//
// NAME		: lib.db.php
// MEMO		: 데이터베이스 기능
// AUTHOR	: June PARK
// EMAIL	: madosaja@nate.com
// Copyright (c) 2012, DEEPTALE Co., Ltd. All rights reserved.
//===================================================================================//

/**
 * 데이터베이스에 접속
 * @param mixed $db 데이터베이스 정보를 담은 객체
 */
function dbConnect($db=null)
{
	GLOBAL $melon;
	if($db==null){$db = &$melon['db'];}else if(is_string($db)){$db = $melon[$db];}
	else if(is_string($db)){$db = &$melon[$db];}
	$db['connect'] = mysqli_connect($db['host'], $db['id'], $db['pw'], $db['name']);
	if (!$db['connect'] ) {
	   echo mysqli_connect_error();
	   return false;
	}
	mysqli_set_charset($db['connect'], str_replace("-","",$melon['charset']));
}

/**
 * 데이터베이스 접속해제
 * @param mixed $db 데이터베이스 정보를 담은 객체
 */
function dbDisconnect($db=null)
{
	GLOBAL $melon;
	if($db==null){$db = &$melon['db'];}
	
	if($db['connect']){mysqli_close($db['connect']);}
	unset($db['connect']);
	unset($db['select']);

}

/**
 * 단순하게 쿼리만 실행합니다. SELECT 문을 작성해도 결과 값은 반환하지 않습니다. 데이터베이스에 직접 정의한 PROCEDURE나 FUNCTION을 호출하는 용도로 주로 사용되며 서버 효율을 위해 updateItem 또는 insertItem을 사용하지 않고 쿼리를 직접 사용하기 위해 사용합니다.
 * @param String $query 실행할 쿼리문
 * @param mixed $db 데이터베이스 정보를 담은 객체
 */
function sqlQuery($query,$db=null)
{
	GLOBAL $melon;
	if($db==null){$db = &$melon['db'];}else if(is_string($db)){$db = $melon[$db];}
	if(!$db['connect']){
		echo '<strong>MySql Error</strong>: database is not connected.';
		return false;
	}

	$result = mysqli_query($db['connect'], $query);
	if($result == 0){
		$mysqlError=  mysqli_error($db['connect']);
		if($mysqlError) {
			echo '<strong>MySql Error</strong>: '.$mysqlError.'<br><strong>Query : </strong>'.$query.'<br>';

		}
	}
	return $result;
	
}




/**
 * select 쿼리로 한 컬럼의 객체를 가져온다.
 * @param String $query 실행할 쿼리문
 * @param mixed $db 데이터베이스 정보를 담은 객체
 * @param Boolean $viewQuery 실행한 쿼리를 출력할지 여부
 * @return array 결과
 */
function getItemQuery($query, $db=null, $viewQuery=false)
{
	GLOBAL $melon;
	if($db==null){$db = &$melon['db'];}else if(is_string($db)){$db = $melon[$db];}
	if(!$db['connect']){
		echo '<strong>MySql Error</strong>: database is not connected.';
		return false;
	}
	if($viewQuery){echo $query;}
	try{
		$result = mysqli_query($db['connect'], $query);
		$data = mysqli_fetch_assoc($result);
	}catch (Exception $e){
		$data = array();
		$mysqlError=  mysqli_error($db['connect']);
		if($mysqlError) {
			echo '<strong>MySql Error</strong>: '.$mysqlError.'<br><strong>Query : </strong>'.$query.'<br>';

		}
	}
	
	return $data;
}

/**
 * select 쿼리로 목록을 가져온다. 현재 가져온 컬럼의 수를 length로 결과배열에 포함해서 반환한다.
 * @param String $query 실행할 쿼리문
 * @param mixed $db 데이터베이스 정보를 담은 객체
 * @param Boolean $viewQuery 실행한 쿼리를 출력할지 여부
 * @return array 결과
 */
function getListQuery($query, $db=null, $viewQuery=false)
{
	GLOBAL $melon;
	if($db==null){$db = &$melon['db'];}else if(is_string($db)){$db = $melon[$db];}
	if(!$db['connect']){
		echo '<strong>MySql Error</strong>: database is not connected.';
		return false;
	}
	
	$i = 0;
	if($viewQuery){echo $query;}
	try{
		$result = mysqli_query($db['connect'], $query);
		while($data = mysqli_fetch_assoc($result))
		{
			$row[$i] = $data;
			$i++;
		}
		$row['length'] = $i;
		
	}catch (Exception $e){
		$row = array();
		$mysqlError=  mysqli_error($db['connect']);
		if($mysqlError) {
			echo '<strong>MySql Error</strong>: '.$mysqlError.'<br><strong>Query : </strong>'.$query.'<br>';

		}
	}

	
	return $row;
}

/**
 * 한 컬럼의 객체를 가져온다.
 * @param String $table_name 테이블명
 * @param String $where 검색 조건
 * @param String $fields 가져올 데이터 필드 지정
 * @param mixed $db 데이터베이스 정보를 담은 객체
 * @return array 결과
 */
function getItem($table, $where="", $order="",$fields="*", $db=null, $viewQuery=false)
{
	GLOBAL $melon;
	if($db==null){$db = &$melon['db'];}else if(is_string($db)){$db = $melon[$db];}
	if(!$db['connect']){
		echo '<strong>MySql Error</strong>: database is not connected.';
		return false;
	}
	if(strpos($table,',viewQuery')){
		$table=str_replace(',viewQuery','',$table);
		$viewQuery=true;
	}
	
	$query = "SELECT ".getFieldSet($fields)." FROM ".$table;
	$query .= getWhere($where);
	if(trim($order)==""){$order = $melon['column']['index']." DESC";$query.=' ORDER BY '.$order;}
	else{$query .= " ORDER BY ".$order;}
	$query .= " LIMIT 1";
	
	if($viewQuery==true){echo $query;}
	try{
		$result = mysqli_query($db['connect'], $query);
		$data = mysqli_fetch_assoc($result);
	}catch (Exception $e){
		$data = array();
		$mysqlError=  mysqli_error($db['connect']);
		if($mysqlError) {
			echo '<strong>MySql Error</strong>: '.$mysqlError.'<br><strong>Query : </strong>'.$query.'<br>';

		}
	}
	return $data;
}

/**
 * 한 컬럼의 객체를 가져온다.
 * @param String $table_name 테이블명
 * @param String $where 검색 조건
 * @param String $fields 가져올 데이터 필드 지정
 * @param mixed $db 데이터베이스 정보를 담은 객체
 * @return array 결과
 */
function getItemJoin($table,$joins,$fields="*", $where="", $order="", $db=null, $viewQuery=false)
{
	GLOBAL $melon;
	if($db==null){$db = &$melon['db'];}else if(is_string($db)){$db = $melon[$db];}
	if(!$db['connect']){
		echo '<strong>MySql Error</strong>: database is not connected.';
		return false;
	}
	if(strpos($table,',viewQuery')){
		$table=str_replace(',viewQuery','',$table);
		$viewQuery=true;
	}
	
	$query = "SELECT ".getFieldSet($fields)." FROM ".$table;

	if(is_array($joins[0])){
		foreach ($joins as $join){
			$query.=' '.$join[0].' JOIN '.$join[1].' ON '.$join[2];
		}
	}
	else if($joins){
		$query.=' '.$joins[0].' JOIN '.$joins[1].' ON '.$joins[2];
	}

	$query .= getWhere($where);
	if(trim($order)==""){$order = $melon['column']['index']." DESC";$query.=' ORDER BY '.$order;}
	else{$query .= " ORDER BY ".$order;}
	$query .= " LIMIT 1";
	
	if($viewQuery==true){echo $query;}
	try{
		$result = mysqli_query($db['connect'], $query);
		$data = mysqli_fetch_assoc($result);
	}catch (Exception $e){
		$data = array();
		$mysqlError=  mysqli_error($db['connect']);
		if($mysqlError) {
			echo '<strong>MySql Error</strong>: '.$mysqlError.'<br><strong>Query : </strong>'.$query.'<br>';

		}
	}
	return $data;
}

/**
 * 지정한 조건의 목록을 가져온다. 현재 가져온 컬럼의 수를 length로 결과배열에 포함해서 반환한다.
 * @param String $table_name 테이블명
 * @param String $where 검색 조건
 * @param String $fields 가져올 데이터 필드 지정
 * @param String $order 정렬 순서
 * @param Number $start 시작번호
 * @param Number $len 길이
 * @param mixed $db 데이터베이스 정보를 담은 객체
 * @return mixed 결과
 */
function getList($table, $where="",  $start=null,$len="", $order="", $fields="*", $db=null, $viewQuery=false)
{
	GLOBAL $melon;
	if(strpos($table,',viewQuery')){
		$table=str_replace(',viewQuery','',$table);
		$viewQuery=true;
	}
	if($db==null){$db = &$melon['db'];}else if(is_string($db)){$db = $melon[$db];}
	if(!$db['connect']){
		echo '<strong>MySql Error</strong>: database is not connected.';
		return false;
	}
	$i=0;
	$query = "SELECT ".getFieldSet($fields)." FROM ".$table;
	$query .= getWhere($where);
	if(trim($order)!=""){$query .= " ORDER BY ".$order;}
	else{if(!empty($melon["column"]["index"])){$order = $melon['column']['index']." DESC";$query .= " ORDER BY ".$order;}else{$order="";}}
	if(isset($start)&&$start!==''){
		if($len==''){
			$query .= " LIMIT ".$start;
		}
		else{
			$query .= " LIMIT ".$start.",".$len;
		}
	}
	if($viewQuery){echo $query;}
	try{
		$result = mysqli_query($db['connect'], $query);
		while($data = mysqli_fetch_assoc($result))
		{
			$row[$i] = $data;
			$i++;
		}
		$row['length'] = $i;
	}catch (Exception $e){
		$row = array();
		$mysqlError=  mysqli_error($db['connect']);
		if($mysqlError) {
			echo '<strong>MySql Error</strong>: '.$mysqlError.'<br><strong>Query : </strong>'.$query.'<br>';

		}
	}
	
	return $row;
}


/**
 * 지정한 조건의 목록을 가져온다. 현재 가져온 컬럼의 수를 length로 결과배열에 포함해서 반환한다.
 * @param String $table_name 테이블명
 * @param String $where 검색 조건
 * @param String $fields 가져올 데이터 필드 지정
 * @param String $order 정렬 순서
 * @param Number $start 시작번호
 * @param Number $len 길이
 * @param mixed $db 데이터베이스 정보를 담은 객체
 * @return mixed 결과

 
 */


function getListJoin($table, $joins,$fields,$where="",  $start=null,$len="", $order="",  $db=null, $viewQuery=false)
{
	GLOBAL $melon;
	if(strpos($table,',viewQuery')){
		$table=str_replace(',viewQuery','',$table);
		$viewQuery=true;
	}
	if($db==null){$db = &$melon['db'];}else if(is_string($db)){$db = $melon[$db];}
	if(!$db['connect']){
		echo '<strong>MySql Error</strong>: database is not connected.';
		return false;
	}
	$i=0;
	$query = "SELECT ".getFieldSet($fields)." FROM ".$table;
	if(is_array($joins[0])){
		foreach ($joins as $join){
			$query.=' '.$join[0].' JOIN '.$join[1].' ON '.$join[2];
		}
	}
	else if($joins){
		$query.=' '.$joins[0].' JOIN '.$joins[1].' ON '.$joins[2];
	}
	$query .= getWhere($where);
	if(trim($order)!=""){$query .= " ORDER BY ".$order;}
	else{if(!empty($melon["column"]["index"])){$order = $melon['column']['index']." DESC";$query .= " ORDER BY ".$order;}else{$order="";}}
	if(isset($start)&&$start!==''){
		if($len==''){
			$query .= " LIMIT ".$start;
		}
		else{
			$query .= " LIMIT ".$start.",".$len;
		}
	}
	if($viewQuery){echo $query;}
	try{
		$result = mysqli_query($db['connect'], $query);
		while($data = mysqli_fetch_assoc($result))
		{
			$row[$i] = $data;
			$i++;
		}
		$row['length'] = $i;
	}catch (Exception $e){
		$row = array();
		$mysqlError=  mysqli_error($db['connect']);
		if($mysqlError) {
			echo '<strong>MySql Error</strong>: '.$mysqlError.'<br><strong>Query : </strong>'.$query.'<br>';

		}
	}
	
	return $row;
}

/**
 * 지정한 검색 조건의 컬럼을 수정한다.
 * @param String $table_name 테이블명
 * @param Array $param 컬럼으로 집어넣을 데이터를 정의한다. key가 필드명, value가 해당 필드에 입력할 데이터
 * @param String $where 검색 조건
 * @param mixed $db 데이터베이스 정보를 담은 객체
 * @return mixed 쿼리 결과
 */
function updateItem($table, &$param, $where, $db=null, $viewQuery=false)
{
    GLOBAL $melon;
    if ($db == null) {
        $db = &$melon['db'];
    } else if (is_string($db)) {
        $db = $melon[$db];
    }
    if (!$db['connect']) {
        echo '<strong>MySql Error</strong>: database is not connected.';
        return false;
    }
    if (strpos($table, ',viewQuery')) {
        $table = str_replace(',viewQuery', '', $table);
        $viewQuery = true;
    }
    if (!$where) {
        echo '<b>Query Error</b>: Undefined Where Clause';
        exit;
    }
    if ($where == "*") {
        $where = '';
    }
    if ($melon['column']['update'] != "") {
        $param[$melon['column']['update']] = "now()";
    }
    
    // 입력된 값들을 이스케이프 처리
    foreach ($param as $key => $value) {
        $param[$key] = mysqli_real_escape_string($db['connect'], $value);
    }
    
    $set = getSet($table, $param, $db);
    $query = "UPDATE " . $table . " SET " . $set;
    $query .= getWhere($where);

    if ($viewQuery) {
        echo $query;
    }
    $result = mysqli_query($db['connect'], $query);
    if ($result == 0) {
        $mysqlError = mysqli_error($db['connect']);
        if ($mysqlError) {
            echo '<strong>MySql Error</strong>: ' . $mysqlError . '<br><strong>Query : </strong>' . $query . '<br>';
        }
    }
    return $result;
}


/**
 * 지정한 검색 조건의 컬럼에 지정한만큼 더한다.
 * @param String $table_name 테이블명
 * @param Array $param 컬럼으로 집어넣을 데이터를 정의한다. key가 필드명, value가 해당 필드에 입력할 데이터
 * @param String $where 검색 조건
 * @param mixed $db 데이터베이스 정보를 담은 객체
 * @return mixed 쿼리 결과
 */
function calcItem($table, &$param, $where, $db=null, $viewQuery=false)
{
	GLOBAL $melon;
	if($db==null){$db = &$melon['db'];}else if(is_string($db)){$db = $melon[$db];}
	if(!$db['connect']){
		echo '<strong>MySql Error</strong>: database is not connected.';
		return false;
	}
	if(strpos($table,',viewQuery')){
		$table=str_replace(',viewQuery','',$table);
		$viewQuery=true;
	}
	if(!$where){
		echo "<b>Query Error</b>: Undefined Where Clause<br>";
		exit;
	}
	if($where=="*"){
		$where='';
	}

	if($melon['column']['update']!=""){$param[$melon['column']['update']]="now()";}
	$set = getSetCalc($table, $param, $db);
	$query = "UPDATE ".$table." SET ".$set;
	$query .= getWhere($where);
	
	if($viewQuery){echo $query;}
	$result = mysqli_query($db['connect'], $query);
	if($result==0){
		$mysqlError=  mysqli_error($db['connect']);
		if($mysqlError) {
			echo '<strong>MySql Error</strong>: '.$mysqlError.'<br><strong>Query : </strong>'.$query.'<br>';

		}
	}

}

/**
 * 테이블에 컬럼을 추가한다.
 * @param String $table_name 테이블명
 * @param Array $param 컬럼으로 집어넣을 데이터를 정의한다. key가 필드명, value가 해당 필드에 입력할 데이터
 * @return Number 입력한 컬럼의 시퀀스
 */
function insertItem($table, &$param, $db=null, $viewQuery=false)
{
	GLOBAL $melon;
	if($db==null){$db = &$melon['db'];}else if(is_string($db)){$db = $melon[$db];}
	if(!$db['connect']){
		echo '<strong>MySql Error</strong>: database is not connected.';
		return false;
	}
	if(strpos($table,',viewQuery')){
		$table=str_replace(',viewQuery','',$table);
		$viewQuery=true;
	}
	if(!$param){
		return false;
	}
	if($melon['column']['create']!=""){$param[$melon['column']['create']]="now()";}
	if($melon['column']['update']!=""){$param[$melon['column']['update']]="now()";}
	$set = getSet($table, $param, $db);
	$query = "INSERT INTO ".$table." SET ".$set;
	
	if($viewQuery){echo $query;}

	mysqli_query($db['connect'], $query);
	$result =  mysqli_insert_id($db['connect']);
	if($result==0){
		$mysqlError=  mysqli_error($db['connect']);
		if($mysqlError) {
			echo '<strong>MySql Error</strong>: '.$mysqlError.'<br><strong>Query : </strong>'.$query.'<br>';

		}
		return 0;
	}
	return $result;
}

/**
 * 지정한 검색 조건의 컬럼을 삭제한다.
 * @param String $table_name 테이블명
 * @param String $where 검색 조건
 * @param mixed $db 데이터베이스 정보를 담은 객체
 * @return mixed 쿼리 결과
 */
function deleteItem($table, $where, $db=null, $viewQuery=false)
{
	GLOBAL $melon;
	if($db==null){$db = &$melon['db'];}else if(is_string($db)){$db = $melon[$db];}
	if(!$db['connect']){
		echo '<strong>MySql Error</strong>: database is not connected.';
		return false;
	}
	if(strpos($table,',viewQuery')){
		$table=str_replace(',viewQuery','',$table);
		$viewQuery=true;
	}
	if(!$where){
		echo "<b>Query Error</b>: Undefined Where Clause<br>";
		exit;
	}
	if($where=="*"){
		$where='';
	}
	
	$query = "DELETE FROM ".$table;
	$query .= getWhere($where);
	
	if($viewQuery){echo $query;}
	$result =  mysqli_query($db['connect'], $query);
	if($result == 0){
		$mysqlError=  mysqli_error($db['connect']);
		if($mysqlError) {
			echo '<strong>MySql Error</strong>: '.$mysqlError.'<br><strong>Query : </strong>'.$query.'<br>';

		}
	}
	return $result;

}

/**
 * 지정한 조건의 목록의 총 수를 구한다.
 * @param String $table 테이블명
 * @param String $where 검색 조건
 * @param mixed $db 데이터베이스 정보를 담은 객체
 * @return Number 총 개수
 */
function getTotal($table, $where="", $db=null, $viewQuery=false)
{
	GLOBAL $melon;
	if($db==null){$db = &$melon['db'];}else if(is_string($db)){$db = $melon[$db];}
	if(!$db['connect']){
		echo '<strong>MySql Error</strong>: database is not connected.';
		return false;
	}
	if(strpos($table,',viewQuery')){
		$table=str_replace(',viewQuery','',$table);
		$viewQuery=true;
	}

	$query = "SELECT count(*) as total FROM ".$table;
	$query .= getWhere($where);
	
	if($viewQuery){echo $query;}
	try{
		$result = mysqli_query($db['connect'], $query);
		$data = mysqli_fetch_assoc($result);
		return $data["total"];
	}catch (Exception $e){
		$mysqlError=  mysqli_error($db['connect']);
		if($mysqlError) {
			echo '<strong>MySql Error</strong>: '.$mysqlError.'<br><strong>Query : </strong>'.$query.'<br>';

		}
		return false;
	}

}
/**
 * 지정한 조건의 목록의 총 수를 구한다.
 * @param String $table 테이블명
 * @param String $where 검색 조건
 * @param mixed $db 데이터베이스 정보를 담은 객체
 * @return Number 총 개수
 */
function getTotalJoin($table, $joins,$where="", $db=null, $viewQuery=false)
{
	GLOBAL $melon;
	if($db==null){$db = &$melon['db'];}else if(is_string($db)){$db = $melon[$db];}
	if(!$db['connect']){
		echo '<strong>MySql Error</strong>: database is not connected.';
		return false;
	}
	if(strpos($table,',viewQuery')){
		$table=str_replace(',viewQuery','',$table);
		$viewQuery=true;
	}

	$query = "SELECT count(*) as total FROM ".$table;

	if(is_array($joins[0])){
		foreach ($joins as $join){
			$query.=' '.$join[0].' JOIN '.$join[1].' ON '.$join[2];
		}
	}
	else if($joins){
		$query.=' '.$joins[0].' JOIN '.$joins[1].' ON '.$joins[2];
	}
	$query .= getWhere($where);
	
	if($viewQuery){echo $query;}
	try{
		$result = mysqli_query($db['connect'], $query);
		$data = mysqli_fetch_assoc($result);
		return $data["total"];
	}catch (Exception $e){
		$mysqlError=  mysqli_error($db['connect']);
		if($mysqlError) {
			echo '<strong>MySql Error</strong>: '.$mysqlError.'<br><strong>Query : </strong>'.$query.'<br>';

		}
		return false;
	}

}

/**
 * 지정한 조건의 총합을 구한다.
 * @param String $table 테이블명
 * @param String $where 검색 조건
 * @param String $fields 총합을 구할 필드
 * @param mixed $db 데이터베이스 정보를 담은 객체
 * @return Array 총 합 객체
 */
function getSum($table, $fields,$where="", $db=null, $viewQuery=false)
{
	GLOBAL $melon;
	if($db==null){$db = &$melon['db'];}else if(is_string($db)){$db = $melon[$db];}
	if(!$db['connect']){
		echo '<strong>MySql Error</strong>: database is not connected.';
		return false;
	}
	if(strpos($table,',viewQuery')){
		$table=str_replace(',viewQuery','',$table);
		$viewQuery=true;
	}
	
	$fields = explode(",", trim($fields));
	$fields_set = "";
	$len = count($fields);
	for($i=0;$i<$len;$i++)
	{
		$fields[$i] = explode(" as ", $fields[$i]);
		if($i>0){$fields_set .= ",";}
		$fields_set .= "sum(".$fields[$i][0].") as ".$fields[$i][count($fields[$i])>1?1:0];
	}
	$query = "select ".$fields_set." from ".$table;
	$query .= getWhere($where);
	
	if($viewQuery){echo $query;}
	try{
		$result = mysqli_query($db['connect'], $query);
		$data = mysqli_fetch_assoc($result);
		if($len==1){
			if(count($fields[0])==2){
				$data = $data [$fields[0][1]];
			}
			else{
				$data = $data [$fields[0][0]];
			}
		}
		return $data;
	}catch (Exception $e){
		$mysqlError=  mysqli_error($db['connect']);
		if($mysqlError) {
			echo '<strong>MySql Error</strong>: '.$mysqlError.'<br><strong>Query : </strong>'.$query.'<br>';

		}
		return array();
	}

}

/**
 * 지정한 조건의 평균을 구한다.
 * @param String $table 테이블명
 * @param String $where 검색 조건
 * @param String $fields 총합을 구할 필드
 * @param mixed $db 데이터베이스 정보를 담은 객체
 * @return Array 총 합 객체
 */
function getAverage($table, $fields, $where="", $db=null, $viewQuery=false)
{
	GLOBAL $melon;
	if($db==null){$db = &$melon['db'];}else if(is_string($db)){$db = $melon[$db];}
	if(!$db['connect']){
		echo '<strong>MySql Error</strong>: database is not connected.';
		return false;
	}
	if(strpos($table,',viewQuery')){
		$table=str_replace(',viewQuery','',$table);
		$viewQuery=true;
	}

	$fields = explode(",", trim($fields));
	$fields_set = "";
	$len = count($fields);
	for($i=0;$i<$len;$i++)
	{
		$fields[$i] = explode(" as ", $fields[$i]);
		if($i>0){$fields_set .= ",";}
		$fields_set .= "avg(".$fields[$i][0].") as ".$fields[$i][count($fields[$i])>1?1:0];
	}
	$query = "select ".$fields_set." from ".$table;
	$query .= getWhere($where);
	
	if($viewQuery){echo $query;}
	try{
		$result = mysqli_query($db['connect'], $query);
		$data = mysqli_fetch_assoc($result);
		if($len==1){
			if(count($fields[0])==2){
				$data = $data [$fields[0][1]];
			}
			else{
				$data = $data [$fields[0][0]];
			}
		}
		return $data;
	}catch (Exception $e){
		$mysqlError=  mysqli_error($db['connect']);
		if($mysqlError) {
			echo '<strong>MySql Error</strong>: '.$mysqlError.'<br><strong>Query : </strong>'.$query.'<br>';

		}
		return array();
	}
}
/**
 * 트랜잭션을 시작한다. 커밋을 하지않으면 자동으로 롤백된다.
 * @param mixed $db 데이터베이스 정보를 담은 객체
 */
function transaction($db=null)
{
	GLOBAL $melon;
	if($db==null){$db = &$melon['db'];}else if(is_string($db)){$db = $melon[$db];}
	if(!$db['connect']){
		echo '<strong>MySql Error</strong>: database is not connected.';
		return false;
	}
	mysqli_query($db['connect'], "SET AUTOCOMMIT=0");
	mysqli_query($db['connect'], "BEGIN");
}

/**
 * 트랜잭션을 시작 후 수행된 DB처리를 전부 커밋한다.
 * @param mixed $db 데이터베이스 정보를 담은 객체
 */
function commit($db=null)
{
	GLOBAL $melon;
	if($db==null){$db = &$melon['db'];}else if(is_string($db)){$db = $melon[$db];}
	if(!$db['connect']){
		echo '<strong>MySql Error</strong>: database is not connected.';
		return false;
	}
	mysqli_query($db['connect'], "COMMIT");	
}

/**
 * 트랜잭션을 시작 후 수행된 DB처리를 전부 취소한다.
 * @param mixed $db 데이터베이스 정보를 담은 객체
 */
function rollback($db=null)
{
	GLOBAL $melon;
	if($db==null){$db = &$melon['db'];}else if(is_string($db)){$db = $melon[$db];}
	if(!$db['connect']){
		echo '<strong>MySql Error</strong>: database is not connected.';
		return false;
	}
	mysqli_query($db['connect'], "ROLLBACK");
}
/**
 * 입력한 문자열로 필드에 대한 쿼리 문자열을 자동생성한다.
 * @param String $param 필드 정의
 * @return String 결과 쿼리
 */
function getFieldSet(&$param)
{
	if(trim($param)==""){return "*";}
	else if(is_string($param)){return $param;}
	else if(is_array($param)){
		$result = "";
		foreach($param as $key=>$value)
		{
			if(!is_numeric($key))
			{
				if($result!=""){$result.=",";}
				if(trim($value)==""){
					$result.=$key;
				}else{
					$result.=$value." as ".$key;
				}
			}
		}
		
		return $result;
	}
	else{return "*";}
}

/**
 * 입력한 문자열로 조건문에 대한 쿼리 문자열을 자동생성한다.
 * @param String $where 검색 조건
 * @return String 결과 쿼리
 */
function getWhere(&$where)
{
	GLOBAL $melon;
	
	$result = "";
	if(trim($where)==""){}
	else if(is_numeric($where)){$result .= " WHERE ".$melon['column']['index']."='".$where."'";}
	else if(!preg_match('/[^0-9,]/i',$where)){$result .= " WHERE ".$melon['column']['index']." in (".$where.")";}
	else if(!preg_match('/[^0-9a-zA-Z가-핳,]/i',$where))
	{$result .= " WHERE ".$melon['column']['index']." in ('".preg_replace("/,/","','",$where)."')";}
	else{$result .= " WHERE ".$where;}
	
	return $result;
}

/**
 * 입력한 문자열로 필드에 대한 쿼리 문자열을 자동생성한다.
 * @param String $table_name 테이블명
 * @param String $param 필드 정의
 * @return String 결과 쿼리
 */
function getSet($table, &$param, $db=null)
{
	GLOBAL $melon;
	if($db==null){$db = &$melon['db'];}else if(is_string($db)){$db = $melon[$db];}
	else if(is_string($db)){$db = &$melon[$db];}
	
	$columns = getTableColumns($table, $db);
	$set = "";
	$j = 0;
	foreach($param as $key=>$value)
	{
		if(array_key_exists($key, $columns) && $columns[$key]['name']!="" && !is_numeric($key))
		{
			if($j!=0){$set .= ",";}
			switch($value)
			{
			case "now()":
				$set .= $key."=".$value."";
			break;
			
			default:
				$set .= $key."='".$value."'";
			break;
			}
			$j++;
		}
	}
	
	return $set;
}


/**
 * 입력한 문자열로 필드에 대한 쿼리 문자열을 자동생성한다.
 * @param String $table 테이블명
 * @param String $param 필드 정의
 * @return String 결과 쿼리
 */
function getSetCalc($table, &$param, $db=null)
{
	GLOBAL $melon;
	if($db==null){$db = &$melon['db'];}else if(is_string($db)){$db = $melon[$db];}
	else if(is_string($db)){$db = &$melon[$db];}
	
	$columns = getTableColumns($table, $db);
	$set = "";
	$j = 0;
	
	foreach($param as $key=>$value)
	{
		if(array_key_exists($key, $columns) && $columns[$key]['name']!="" && !is_numeric($key))
		{
			if($j!=0){$set .= ",";}
			switch($key)
			{
			case $melon['column']['index']:
			case $melon['column']['create']:
			case $melon['column']['update']:
				$set .= $key."=".$value."";
			break;
			default:
				switch(substr($value,0,1)){
				case "+":
					$set .= $key."=".$key.$value;
				break;

				case "*":
				case "x";
				case "X";
					$set .= $key."=".$key."*".substr($value,1);
				break;

				case "/":
				case "÷";
					$set .= $key."=".$key."/".substr($value,1);
				break;
				case "." :
						$set .="$key = concat($key,'".substr($value,1)."')";
				break;
				default:
					if($value>=0){
						$set .= $key."=".$key."+".$value;
					}else{
						$set .= $key."=".$key.$value;
					}
				break;
				}
			break;
			}
			$j++;
		}
	}
	
	return $set;
}

function getTableColumns($table, $db=null,$viewQuery=false)
{
	GLOBAL $melon;
	if($db==null){$db = &$melon['db'];}else if(is_string($db)){$db = $melon[$db];}
	else if(is_string($db)){$db = &$melon[$db];}
	
	if(isset($melon['table'][$table]))
	{
		$row = $melon['table'][$table];
	}
	else
	{
		$i = 0;

		$query = "SHOW COLUMNS FROM ".$table;
		
		if($viewQuery){echo $query;}
		try{
			$result = mysqli_query($db['connect'], $query);
			while($data = mysqli_fetch_assoc($result))
			{
				$row[$data['Field']]['name'] = $data['Field'];
				$i++;
			}
		}catch (Exception $e){
			$row = array();
			$mysqlError=  mysqli_error($db['connect']);
			if($mysqlError) {
				echo '<strong>MySql Error</strong>: '.$mysqlError.'<br><strong>Query : </strong>'.$query.'<br>';

			}
		}

		
		$melon['table'][$table] = $row;
	}
	return $row;
}
?>