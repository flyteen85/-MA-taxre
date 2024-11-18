<?php
	include'loader.php';
	$page = 'category';
	if($param['no']){
		deleteItem('categories',$param['no']);
	}
	$categories = getList('categories');

	include'views/header.html';
?>

			<!-- BEGIN PAGE TITLE -->
			<div class="page-title">
				<h1>카테고리 관리</h1>
			</div>
			<!-- END PAGE TITLE -->
			<table class="table need-result">
					<thead>
						<tr>
							<th>
								No
							</th>
							
							<th>
								 이름
							</th>
					
							
							<th>
								 정렬 우선순위
							</th>
					
							<th>
								등록일
							</th>
						
							<th>
								관리
							</th>
						
						</tr>
					</thead>
					<tbody>
					<?php
						for ($bora=0;$bora<$categories['length'];$bora++ ) {
							$category = $categories[$bora];
					?>
					<tr>
							<td>
								<?=$category['no']?>							</td>
							<td>
								 <?=$category['name']?>									</td>
							<td>
								 <?=$category['priority']?>									</td>
							
							<td>
								<?=$category['create_date']?>									</td>
							<td class="admin_buttons">
								<a href="category.add.php?no=<?=$category['no']?>" class="btn btn-sm green">
								수정 <i class="fa fa-pencil"></i>
								</a>
								<a href="?no=<?=$category['no']?>" class="btn btn-sm btn-danger delete-button">
								삭제 <i class="fa fa-trash-o"></i>
								</a>
				
							</td>
						
						
						</tr>
					<?php
						}
					?>
										<!-- 			 -->
					</tbody>
				</table>
				<div id="buttons">
				<a href="category.add.php" class="btn btn-primary right">등록</a>
				<br>
				<br>
				<br>
				<br>
			</div>
<?php
	include'views/footer.html';
?>
				