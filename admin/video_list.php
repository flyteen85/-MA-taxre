<?php
	include'loader.php';
	$page = 'video';

	if($param['no']){

		$dir = $_SERVER["DOCUMENT_ROOT"]."/admin/files/video/";
		$board['delete'] = getItem('video',$param['no']);

		if($board['delete']['imgpc']){
			unlink($dir.$board['delete']['imgpc']);
		}

		deleteItem('video',$param['no']);
		getBack();
		exit;
	}
	
	function get_youtubeid($url) {
		$id = str_replace("https://youtu.be/", "", $url);
		$id = str_replace("http://youtu.be/", "", $id);
		$id = str_replace("&feature=youtu.be","", $id);
		$id = str_replace("https://www.youtube.com/watch?v=", "", $id);
		$id = str_replace("http://www.youtube.com/watch?v=", "", $id);
		$id = strtok($id, '?');
		return $id;
	}
	
	$videos = pageList('video',$where,'',10,10,$param['page'],'?page=$page');
	include'views/header.php';
?>
<div class="page-container">
	<div class="container">
		<!-- BEGIN PAGE TITLE -->
		<div class="page-title flex col2 middle">
			<div>
				<h1 class="title"><span>동영상</span></h1>
			</div>
			<div>
				
			</div>
		</div>
		<!-- END PAGE TITLE -->

		<div id="table_wrap">
		<table class="table gallerytable">
				<thead class="pc">
					<tr>
						<th class="title">
							제목
						</th>
						<th class="url">
							비디오 아이디
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
					for ($bora=0;$bora<$videos['length'];$bora++ ) {
						$video= $videos[$bora];
						
						
						

				?>
					<tr>
						<td class="title"><?=$video['title']?></td>
						<td class="url"><?=get_youtubeid($video['url'])?></td>
						<td class="cate"><?=$video['cate']?></td>
						<td class="date"><?=$video['create_date']?></td>
						<td class="modify">
							<a href="video_write.php?no=<?=$video['no']?>" class="btn btn-sm btn-primary">수정</a>
							<a href="?no=<?=$video['no']?>" class="btn btn-sm btn-danger delete-button">삭제</a>
						</td>
					</tr>
				<?php
					}
				?>
									
				</tbody>
			</table>
		</div>
		<div class="pagination"><?=$gallerys['pagination']?></div>
		<div id="buttons"><a href="./video_write.php" class="btn">등록</a></div>
	</div>
</div>
<?php
	include'views/footer.php';
?>
				