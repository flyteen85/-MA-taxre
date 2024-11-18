<?php
	include'loader.php';
	$page = 'notice';
	$notice = getItem('notice',$param['no']);
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
		<!-- END PAGE TITLE -->
			
		<form action="" method="post" name="board_form" enctype="multipart/form-data">
			<input type="hidden" name="has_data"  value="1"/>
			<input type="hidden" name="no" value="<?=$param['no']?>"/>
			<table class="table detail">
				<tr>
					<th>제목</th>
					<td><?=$notice['title']?></td>
				</tr>
				<tr>
					<th>내용</th>
					<td><?=$notice['contents']?></td>
				</tr>
				<tr>
					<th>첨부</th>
					<td><?=attr($notice['attach'],'<a href="/admin/files/'.$notice['attach'].'">[첨부]</a>','-')?></td>
				</tr>
			</table>
		</form>
		<div id="buttons"><a href="notice_list.php" class="btn btn-success">목록</a></div>
	</div>
</div>
<?php
	include'views/footer.html';
?>
				