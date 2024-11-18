<?php
	include'loader.php';
	$page = 'applicant';
	if(isset($param['search_keyword'])){
		if($where!=''){$where.=' AND ';}
		if(!$param['search_type']){
			$where .= 'contents like "%'.$param['search_keyword'].'%"';
		} else{
			$where .= 'SUBSTRING_INDEX(SUBSTRING_INDEX(contents,\'"'.$param['search_type'].'":"\',-1),\'"\',1) like "%'.$param['search_keyword'].'%"';
		}
	}
	if(isset($param['category_no'])){
		if($where!=''){$where.=' AND ';}
		$where .= 'category_no = "'.$param['category_no'].'"';
	}
	$where = isset($where) ? $where : '';
	$applicant = getItem('applicants',$param['no']);
	$data = jsonDecode($applicant['contents']);
	$where = '';
	include'views/header.php';
?>
<div class="page-container">
	<div class="container">
		<div class="content-title">
			<div>
				<h3>정보</h3>
			</div>
		</div>
			
		<table class="table detail col2">
		
			<?php foreach($melon['fields'] as $key => $field){ ?>
			<tr>
				<th><?=$field?></th>	
				<td><?=$data[$key]?></td>	
			</tr>
			<?php }?>
			<tr>
				<th>아이피</th>
				<td>
					<?=$applicant['ip']?>
				</td>
			</tr>
		</table>
		<button type="submit" class="btn green" onclick="history.back();">뒤로가기</button>
	</div>
</div>
<?php
	include'views/footer.php';
?>
				