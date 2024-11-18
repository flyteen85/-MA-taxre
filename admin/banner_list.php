<?php
	include'loader.php';
	$page = 'banner';

	if(isset($param['no'])){

		$dir = $_SERVER["DOCUMENT_ROOT"]."/admin/files/banner/";
		$board['delete'] = getItem('banner',$param['no']);

		if($board['delete']['imgpc']){
			unlink($dir.$board['delete']['imgpc']);
		}

		deleteItem('banner',$param['no']);
		getBack();
		exit;
	}
	$where = isset($where) ? $where : '';
	$page = isset($param['page']) ? $param['page'] : 1;
	$banners = pageList('banner',$where,'',10,10,$page,'?page=$page');
	include'views/header.php';
?>
<div class="page-container">
	<div class="container">
		<!-- BEGIN PAGE TITLE -->
		<div class="page-title flex col2 middle">
			<div>
				<h1 class="title"><span>포트폴리오</span></h1>
			</div>
			<div>
				
			</div>
		</div>
		<!-- END PAGE TITLE -->

		<div id="table_wrap">
		<table class="table gallerytable">
				<thead class="pc">
					<tr>
						<th class="thum">
							이미지
						</th>
						<th class="title">
							제목
						</th>
						<th class="date">
							등록일
						</th>
						<th class="modify">
							관리
						</th>
					</tr>
				</thead>
				<tbody>
				<?php
					for ($bora=0;$bora<$banners['length'];$bora++ ) {
						$banner= $banners[$bora];
				?>
					<tr>
						<td class="thum"><?php echo $banner['imgpc'] ? "<img src='/admin/files/banner/".$banner['imgpc']."'>" : "<img src='/img/noimg.png'>" ?></td>
						<td class="title"><?=$banner['title']?></td>
						<td class="date"><?=$banner['create_date']?></td>
						<td class="modify">
							<a href="banner_write.php?no=<?=$banner['no']?>" class="btn btn-sm btn-primary">수정</a>
							<a href="?no=<?=$banner['no']?>" class="btn btn-sm btn-danger delete-button">삭제</a>
						</td>
					</tr>
				<?php
					}
				?>
									
				</tbody>
			</table>
		</div>
		<div class="pagination"><?=$banners['pagination']?></div>
		<div id="buttons"><a href="banner_write.php" class="btn">등록</a></div>
	</div>
</div>
<?php
	include'views/footer.php';
?>
				