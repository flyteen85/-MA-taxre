<?php
	include'loader.php';
	$page = 'gallery';

	$gallery = getItem('gallery',$param['no']);
	
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
		<!-- 
		<div id="search_form" style="clear:both;padding:20px 0;">
			<form action="" class="form-inline" role="form">
				<div class="form-group">
					<select name="category_no"  class="form-control">
						<option value="">전체</option>
						<?php
							for ($bora=0;$bora<$categories['length'];$bora++){
								$category=  $categories[$bora];
						?>
						<option value="<?=$category['no']?>" <?=attr($param['category_no']==$category['no'])?>>
							<?=$category['name']?>
						</option>
						<?php
							}
						?>
				</select>
				
				</div>
				<div class="form-group">
				<select name="search_type" class="form-control">
				<?php
					foreach($melon['fields'] as $key => $field){
				
				?>
					<option value="<?=$key?>" <?=attr($param['search_type']==$key)?>><?=$field?></option>
					<?php
				}	
				?>
				</select>	
					<input type="text" name="search_keyword" value="" class="form-control" placeholder="검색어 입력">
				</div>
			
				<button type="submit" class="btn btn-default">검색</button>
			</form>
		</div> -->
		<form action="" method="post" name="board_form" enctype="multipart/form-data">
			<input type="hidden" name="has_data"  value="1"/>
			<input type="hidden" name="no"  value="<?=$param['no']?>"/>
			<table class="table">
				<tr>
					<th style="width:100px;">제목</th>
					<td>
					<?=$gallery['title']?>
					</td>
				</tr>
				<tr>
					<th>내용</th>
					<td>
				
						<?=$gallery['contents']?>
					</td>


				</tr>
				<tr>
					<th>첨부</th>
					<td>
						<?=attr($gallery['attach'],'<a href="/admin/files/'.$gallery['attach'].'">[첨부]</a>')?>
					</td>
				</tr>
			</table>
		</form>
		<div id="pagination"><?=$gallerys['pagination']?></div>
		<div id="buttons"><a href="gallery_list.php" class="btn btn-success">목록</a></div>
	</div>
</div>
<?php
	include'views/footer.php';
?>
				