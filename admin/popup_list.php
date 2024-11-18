<?php
	include 'loader.php';
	$page = 'popup';

	if (isset($param['no'])) {
		$dir = $_SERVER["DOCUMENT_ROOT"] . "/admin/files/popup/";

		// 데이터 조회
		$board = getItem('popup', $param['no']);

		if ($board) {
			// 이미지 파일 삭제
			if (isset($board['attach']) && $board['attach']) {
				$imgPath = $dir . $board['attach'];
				if (file_exists($imgPath)) {
					unlink($imgPath);
				}
			}

			// 데이터베이스에서 삭제
			deleteItem('popup', $param['no']);
		} else {
			echo '<strong>Error</strong>: Data not found for the given ID.';
		}

		getBack();
		exit;
	}

	$where = isset($where) ? $where : '';
	$page = isset($param['page']) ? $param['page'] : 1;
	$popups = pageList('popup', $where, '', 10, 10, $page, '?page=$page');
	include 'views/header.php';
?>
<div class="page-container">
	<div class="container">
		
		<div class="content-title">
			<div>
				<h3>팝업관리</h3>
			</div>
		</div>

		<div id="table_wrap">
			<table class="table need-result popuprlist-list">
				<thead class="pc">
					<tr>
						<th class="thum">
							이미지
						</th>
						<th class="title">
							제목
						</th>
						<th class="date">
							TOP
						</th>
						<th class="date">
							LEFT
						</th>
						<th class="date">
							Z-INDEX
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
					for ($i=0;$i<$popups['length'];$i++ ) {
						$popup= $popups[$i];
				?>
					<tr>
						<td class="thum"><?php echo $popup['attach'] ? "<img src=/admin/files/popup/".$popup['attach'].">" : "<img src='/img/noimg.png'>" ?></td>
						<td class="title"><?=$popup['title']?></td>
						<td class="date"><?=$popup['positiontop']?></td>
						<td class="date"><?=$popup['positionleft']?></td>
						<td class="date"><?=$popup['popupindex']?></td>
						<td class="date"><?=$popup['create_date']?></td>
						<td class="modify admin_buttons">
							<a href="popup_write.php?no=<?=$popup['no']?>" class="btn btn-sm btn-primary">수정 <i class="fa fa-pencil"></i></a>
							<a href="?no=<?=$popup['no']?>" class="btn btn-sm btn-danger delete-button">삭제 <i class="fa fa-trash-o"></i></a>
						</td>
					</tr>
				<?php
					};
				?>
									
				</tbody>
			</table>
		</div>
		
		<div class="pagination"><?=$popups['pagination']?></div>
		<div id="buttons">
			<a href="popup_write.php" class="btn btn-primary">등록</a>
		</div>
	</div>
</div>
<?php
	include'views/footer.php';
?>
				