<!--팝업배너-->
<script type="text/javascript">
	$(function(){ 
		$('[class*="close"').on('click', function(){
			var index = $(this).data('index');
			$('.popup'+index).css('display', 'none');
		 });

		$('.ccheckbox').on('click', function(){
			var index = $(this).data('index');
			$('.popup'+index).css('display', 'none');
			//var date = new Date();
			//date.setTime(date.getTime() + 5000);
			$.cookie('popup'+index, index, { expires: 1, path : '/' });
		});
	});
	$(document).ready(function() {
		$.each($.cookie(),function(index,item){
			if(index.indexOf( 'popup' ) >= 0){
				$('.popup'+item).css('display', 'none');
			}
		});

	});

	$(window).on('load', function(){
		$('.site_popup_container').css('display', 'block');
	});
</script>
<?php
	$popuplist = getList('popup','open_yn = \'Y\'','','','');
?>


<!-- /시작/ -->
<div class="site_popup_container">
	<?php for($i=0; $i < $popuplist['length']; $i++){ ?>
	<div id="layer_popup" class="popup<?=$popuplist[$i]['no']?>" style="transform:translateX(-50%);top:<?=$popuplist[$i]['positiontop']?>px;left:<?=$popuplist[$i]['positionleft']?>px;z-index:<?=$popuplist[$i]['popupindex']?>;"><!-- style="display:none;" -->
		<button type="button" class="closebtn" data-index="<?=$popuplist[$i]['no']?>"></button>
		<a href="<?=$popuplist[$i]['hurl']?>" target="<? echo $popuplist[$i]['target'] ? $popuplist[$i]['target'] : '_blank' ;?>" title="<?=$popuplist[$i]['title']?>"><img src="/admin/files/popup/<?=$popuplist[$i]['attach']?>" style="min-width:<?=$popuplist[$i]['imgW']?>px;" alt="<?=$popuplist[$i]['contents']?>"></a>
		<div class="close">
			<form name="pop_form">
				<label class="session customcheck">
					<input type="checkbox" name="chkbox" class="ccheckbox" value="checkbox" data-index="<?=$popuplist[$i]['no']?>">
					<span class="icon"></span>
					<span class="text">오늘 하루동안 보지 않기</span>
				</label>
				<div class="closebtn"><button type="button" data-index="<?=$popuplist[$i]['no']?>" class="close">닫기</button></div>
			</form>
		</div>
	</div>
	<?php } ?>
</div>


<style>
.site_popup_container {position:relative;z-index:90;}
.AD .customcheck {display:inline-block;vertical-align:middle;}
.AD .customcheck input {display:none;}
.AD .customcheck input ~ .icon {display:inline-block;vertical-align:middle;width:20px;height:20px;border:2px solid #fff;margin-right:5px;position:relative;}
.AD .customcheck input ~ .text {vertical-align:middle;font-size:16px;color:#fff;margin-left:10px!important;}
.AD .customcheck input:checked ~ .icon::after {content:'';display:block;width:14px;height:6px;border-left:2px solid #fff;border-bottom:2px solid #fff;position:absolute;top:30%;left:50%;transform:translate(-50%,-50%) rotate(-45deg);}

/* popup --------------------------------------- */
#layer_popup {font-size:0;transform:none;background:#FFF;}
#layer_popup * {padding:0;margin:0;}
#layer_popup {max-width:800px;text-align:center; position:absolute; z-index: 9999; top:200px; left: 50%;transform:translate(-50%,0);-webkit-transform:translate(-50%,0); -moz-transform:translate(-50%,0);font-size:0;}
#layer_popup img {max-width:100%;min-width:280px;}
#layer_popup > a { display: block;width:auto;}
#layer_popup > .closebtn {width:42px;height:42px;border:0;background:url('/img/close.png') center center / 24px no-repeat;position:absolute;top:10px;right:10px;z-index:100;}
#layer_popup form {font-size:0;}
#layer_popup form .session {width:calc(100% - 80px);text-align:left;}
#layer_popup form .closebtn {display:inline-block;vertical-align:middle;width:80px;padding:10px;border-radius:3px;box-sizing:border-box;text-align:center;}
#layer_popup form .closebtn button {display:block;width:auto;color:#fff;font-weight:900;font-size:16px;background:#000;}
#layer_popup .close { background:#333; padding:5px 10px;box-sizing:border-box;}
#layer_popup .close div {display:inline-block;vertical-align:middle;}


@media screen and (max-width:996px){
	/* popup --------------------------------------- */
	#layer_popup {width:90%!important;top:8vw!important;left:50%!important;transform:translatex(-50%)!important;}
	#layer_popup img {width:100%;min-width:auto!important;}
	#layer_popup form .session {width:calc(100% - 20vw);}
	#layer_popup form .session.customcheck .text {font-size:4vw;margin-left:2vw;}
	#layer_popup form .closebtn {width:20vw;padding:2vw;}
	#layer_popup form .closebtn a {font-size:4vw;}
	#layer_popup .close {padding:1vw 3vw;}
}
</style>