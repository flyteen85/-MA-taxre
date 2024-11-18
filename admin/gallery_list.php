<?php
	include'loader.php';
	$page = 'gallery';

	if(isset($param['no'])){

		$dir = $_SERVER["DOCUMENT_ROOT"]."/admin/files/gallery/";
		$board['delete'] = getItem('gallery',$param['no']);

		if($board['delete']['imgpc']){
			unlink($dir.$board['delete']['imgpc']);
		}

		deleteItem('gallery',$param['no']);
		getBack();
		exit;
	}
	$where = isset($where) ? $where : '';
	$page = isset($param['page']) ? $param['page'] : 1;
	$gallerys = pageList('gallery',$where,'',10,10,$page,'?page=$page');
	include'views/header.php';
?>
<div class="page-container">
	<div class="container">
		<!-- BEGIN PAGE TITLE -->
		<div class="page-title flex col2 middle">
			<div>
				<h1 class="title"><span>슬라이드 갤러리</span></h1>
			</div>
			<div>
				
			</div>
		</div>
		<!-- END PAGE TITLE -->

		<div id="table_wrap">
		<table class="table gallerytable">
				<thead>
					<tr>
						<th class="thum">
							이미지
						</th>
						<th class="title">
							제목
						</th>
						<th class="cate">
							카테고리
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
					for ($bora=0;$bora<$gallerys['length'];$bora++ ) {
						$gallery= $gallerys[$bora];
				?>
					<tr>
						<td class="thum"><?php echo $gallery['imgpc'] ? "<img src='/admin/files/gallery/".$gallery['imgpc']."'>" : "<img src='/img/noimg.png'>" ?></td>
						<td class="title"><?=$gallery['title']?></td>
						<td class="cate"><?=$gallery['cate']?></td>
						<td class="date"><?=$gallery['create_date']?></td>
						<td class="modify">
							<a href="gallery_write.php?no=<?=$gallery['no']?>" class="btn btn-sm btn-primary">수정</a>
							<a href="?no=<?=$gallery['no']?>" class="btn btn-sm btn-danger delete-button">삭제</a>
						</td>
					</tr>
				<?php
					}
				?>
									
				</tbody>
			</table>
		</div>
		<div class="pagination"><?=$gallerys['pagination']?></div>
		<div id="buttons"><a href="gallery_write.php" class="btn">등록</a></div>
	</div>
</div>
<?php
	include'views/footer.php';
?>
				