<?php
	include'loader.php';
	$page = 'map';
	if($param['no']){
		deleteItem('map',$param['no']);
		getBack();
		exit;
	}
	$maps = pageList('map',$where,'',10,10,$param['page'],'?page=$page');
	include'views/header.php';
?>
<div class="page-container">
	<div class="container">
		<!-- BEGIN PAGE TITLE -->
		<div class="page-title flex col2 middle">
			<div>
				<h1 class="title"><span>매장 리스트</span></h1>
			</div>
			<div>
				
			</div>
		</div>

		<ul class="list body">
				<?php for ($bora=0;$bora<$maps['length'];$bora++ ) { $map= $maps[$bora]; ?>
				<li class="item">
					<div class="num"><?=$map['no']?></div>
					<div class="title"><?=$map['title']?></div>
					<div class="addr">
						<span class="mobile mobile_title"><?=$map['addr1']?></span></div>
					<div class="date"><?=$map['create_date']?></div>
					<div class="buttons">
						<!-- <a href="map_view.php?no=<?=$map['no']?>" class="btn">상세보기</a> -->
						<a href="map_write.php?no=<?=$map['no']?>" class="btn">수정</a> 
						<a href="?no=<?=$map['no']?>" class="btn">삭제</a>
					</div>
				</li>
				<?php } ?>
			</tbody>
		</table>
		<div class="pagination"><?=$maps['pagination']?></div>
		<div id="buttons"><a href="map_write.php" class="btn">등록</a></div>
	</div>
</div>
<style>
.list {display:flex;flex-direction:column;gap:10px;margin:20px auto;}
.item {display:flex;flex-direction:row;list-style:none;gap:10px;border-radius:4px;background:#fff;}
.item > div {flex:auto;padding:10px 0;}
.item .num {width:80px;text-align:center;}
.item .title {width:130px;}
.item .addr {width:calc(100% - 630px);}
.item .date {width:200px;}
.item .buttons {width:120px;}
@media screen and (max-width:640px){
	.item {flex-direction:column;}
	.item .num {text-align:left;}
	.item > div {width:100%!important;padding:10px 20px;}
}
</style>
<?php
	include'views/footer.php';
?>
				