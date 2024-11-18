<?php
	include'loader.php';
	$page = 'applicant';
	if(isset($param['status'])){
		updateItem('applicants',$param,$param['no']);
		getBack();
		exit;
	}
	if(isset($param['no'])){
		deleteItem('applicants',$param['no']);
		getBack();
		exit;
	}
	
	if(isset($param['search_keyword'])){
		if($where!=''){ $where.=' AND '; }
		if(!$param['search_type']){
			$where .= 'contents like "%'.$param['search_keyword'].'%"';
		} else {
			$where .= 'SUBSTRING_INDEX(SUBSTRING_INDEX(contents,\'"'.$param['search_type'].'":"\',-1),\'"\',1) like "%'.$param['search_keyword'].'%"';
		}
	}
	
	if(isset($param['category_no'])){
		if($where!=''){ $where.=' AND '; }
		$where .= 'category_no = "'.$param['category_no'].'"';
	}
	$where = isset($where) ? $where : '';
	$page = isset($param['page']) ? $param['page'] : 1;
	$applicants = pageList('applicants',$where,'',10,10,$page,'?page=$page');
	$where = '';
	include'views/header.php';
?>
<div class="page-container">
	<div class="container">
		<div class="content-title">
			<h3>DB리스트</h3>
			<div class="topformbox">
				<div class="excel_download_wrap">
					<label><input type="text" name="startDate" id="startDate" class="form-control" readonly placeholder="시작일"></label>
					<label><input type="text" name="endDate" id="endDate" class="form-control" readonly placeholder="종료일"></label>
					<a href="excel.php" id="excelDownload">엑셀 다운로드</a>
				</div>
				<form action="" class="form-inline searchform" role="form">
					<div class="selectbox">
						<select name="category_no"  class="input-control">
							<option value="">전체</option>
							<?php for ($bora=0;$bora<$categories['length'];$bora++){ $category=  $categories[$bora]; ?>
							<option value="<?=$category['no']?>" <?=attr($param['category_no']==$category['no'])?>>
								<?=$category['name']?>
							</option>
							<?php } ?>
						</select>
					</div>
					<div class="selectbox">
						<select name="search_type" class="input-control">
							<?php foreach($melon['fields'] as $key => $field){ ?>
								<option value="<?=$key?>" <?=attr($param['search_type']==$key)?>><?=$field?></option>
							<?php }	?>
						</select>
					</div>
					<div>
						<input type="text" name="search_keyword" value="" class="input-control" placeholder="검색어 입력">
					</div>
					<div>
						<button type="submit" class="btn full">검색</button>
					</div>
				</form>
			</div>
		</div>
		
		<div id="table_wrap">
			<table class="table" cellpadding="0" cellpadding="0">
				<thead>
					<tr>
						<th class="Num">No</th>
						
						<?php foreach ($melon['fields'] as $field=>$fieldName){ ?>
						<th class="<?=$field?>"><?=$fieldName?></th>
						<?php } ?>

						<th class="Status">상태</th>
						<th class="Day">날짜/아이피</th>
						<th class="btnblock">관리</th>
					</tr>
				</thead>
				<tbody>
					<?php
						for ($bora=0;$bora<$applicants['length'];$bora++ ) {
							$applicant = $applicants[$bora];
							$data = jsonDecode($applicant['contents']);
					?>
					<tr>
						<td class="Num"><?=$applicant['no']?></td>
						<?php foreach ($melon['fields'] as $field=>$fieldName){ ?>
						<td class="<?=$field?>"><span class="viewM inline list"><?=$fieldName?></span><?=getSummary($data[$field],30)?></td>
						<?php } ?>
						<td class="Status">
							<span class="viewM inline list">상태</span>
              <div class="selectbox">
                <select name="status" class="select-status" onchange="handleChange(this, <?=$applicant['no']?>)">
                  <option value="0" <?= $applicant['status'] == 0 ? 'selected' : '' ?>>상태변경</option>
                  <option value="1" <?= $applicant['status'] == 1 ? 'selected' : '' ?>>상담대기</option>
                  <option value="2" <?= $applicant['status'] == 2 ? 'selected' : '' ?>>상담완료</option>
                  <option value="3" <?= $applicant['status'] == 3 ? 'selected' : '' ?>>발송완료</option>
                </select>
              </div>
						</td>
						<td class="Day">
							<span class="viewM inline list">날짜/아이피</span>
							<?=$applicant['create_date']?><br><strong><?=$applicant['ip']?></strong>
						</td>
						<td class="btnblock">
							<a href="detail.php?no=<?=$applicant['no']?>" class="btn" title="상세보기">상세보기</a> 
							<button type="button"  class="btn del" title="삭제" onclick="del('<?=$applicant['no']?>')">삭제</button>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<div class="pagination"><?=$applicants['pagination']?></div>
	</div>
</div>

<!-- 삭제하시겠습니까? confirm 스크립트 -->
<script>
  function handleChange(select, no) {
    var status = select.value;
    window.location.href = `?status=${status}&no=${no}`;
  }

	function del(no){
		if (confirm("정말 삭제하시겠습니까??") == true){
			location.href = "?no="+no;
		}
	}
</script>

<?php
	include'views/footer.php';
?>
				