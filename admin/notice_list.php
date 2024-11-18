<?php
	include'loader.php';
	$page = 'notice';
	if($param['no']){
		deleteItem('notice',$param['no']);
		getBack();
		exit;
	}
	$notices = pageList('notice',$where,'',10,10,$param['page'],'?page=$page');
	include'views/header.html';
?>
<div class="page-container">
	<div class="container">
		<!-- BEGIN PAGE TITLE -->
		<div class="page-title flex col2 middle">
			<div>
				<h1 class="title"><span>공지사항</span></h1>
			</div>
			<div>
				
			</div>
		</div>

		<table class="table">
			<tbody>
				<?php for ($bora=0;$bora<$notices['length'];$bora++ ) { $notice= $notices[$bora]; ?>
				<tr>
					<td class="pc"><?=$notice['no']?></td>
					<td style="font-weight:bold;max-width:100%;overflow:hidden;"><?=$notice['title']?></td>
					<td><span class="mobile mobile_title">조회</span><?=$notice['hit']?></td>
					<td><?=$notice['create_date']?></td>
					<td class="admin_buttons">
						<a href="notice_view.php?no=<?=$notice['no']?>" class="btn">상세보기</a>
						<a href="notice_write.php?no=<?=$notice['no']?>" class="btn">수정</a> 
						<a href="?no=<?=$notice['no']?>" class="btn">삭제</a>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		<div id="buttons"><a href="notice_write.php" class="btn">등록</a></div>
	</div>
</div>
<?php
	include'views/footer.html';
?>
				