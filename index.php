<?php include('./top_function.php'); ?>
<!DOCTYPE html>
<html lang="ko">
<?php include ("./head.php"); ?>
<body class="AD">

<?php // include ("./loading.php"); ?>

<div class="privacy-pop">
	<div class="privacy-close-area"></div>
	<div class="privacybox">
		<div class="title">개인정보처리방침<a class="privacy-close"></a></div>
		<div class="content"><?=nl2br($config['site_agree']); ?></div>
	</div>
</div>

<?php
	$popupCount = getList('popup','open_yn = \'Y\'','','','','count(*) AS count');
	if($popupCount[0]['count'] > 0){
		include('./popup.php'); 
	}
	$lat = 36.4965569936987; // 초기 및 리셋 중심좌표
	$lng = 127.242297055683; // 초기 및 리셋 중심좌표
?>


<!--

<-/start/

-->

	<div class="fixedbar top hidden">
		<div>
			<a class="layerbtn01" href="/" title="홈으로이동링크"></a>
			<ul class="mainmenulist">
				<li><a data-target=".section02">고용채움이란?</a></li>
				<li><a data-target=".section03">고용제도</a></li>
				<li><a data-target=".section04">고용장려금</a></li>
				<li><a data-target=".section06">4대보험환급</a></li>
				<li><a data-target=".section08">신청절차</a></li>
			</ul>
			<a class="layerbtn02" href="https://taxreturn.etaxmate.co.kr/TAX_CFR_010000" target="_blank" title="고용장려금 무료 조회하기"><img src="/img/homepagebutton.png"></a>
			<img src="/img/m/section__fixed_top.png" class="conM">
		</div>
	</div>
	
	<?php // include('./floatMenu.php');?>
	<div class="container">
		<div id="section01" class="section01">
			<div class="content" data-nav=".section02">
				<h3 class="only">바로 찾고 돌려 받는 대한민국 No.1 고용 장려금 플랫폼 고용체음</h3>
				
				<div class="layer01"><div class="fade slide-in-blurred-bottom"><img src="/img/section__01-layer01.png" class="conPC"><img src="/img/m/section__01-layer01.png" class="conM"></div></div>
				<div class="layer02"><div class="fade rotate-in-hor delay04s"><img src="/img/section__01-layer02.png"></div></div>
				<div class="layer03"><div class="fade slide-in-blurred-bottom"><img src="/img/section__01-layer03.png"></div></div>
				<div class="layer04"><div class="fade slide-in-blurred-right delay04s"><img src="/img/section__01-layer04.png"></div></div>
				
				<a class="layerlink" href="https://taxreturn.etaxmate.co.kr/TAX_CFR_010000" target="_blank"></a>

				<img src="/img/m/section__01.png" class="conM">
			</div>
		</div>
		<div id="section02" class="section02">
			<div class="content" data-nav=".section02">
				<h3 class="only">기업을 위한 고용은 계속되어야 하기에, 고용노동부의 지원은 2024년에도 계속됩니다</h3>
				
				<div class="layer01"><div class="fade slide-in-blurred-bottom"><img src="/img/section__02-layer01.png" class="conPC"><img src="/img/m/section__02-layer01.png" class="conM"></div></div>
				<div class="layer02"><div class="fade slide-in-blurred-right"><img src="/img/section__02-layer02.png"></div></div>
				<div class="layer03"><div class="fade slide-in-blurred-left delay04s"><img src="/img/section__02-layer03.png"></div></div>
				
				<img src="/img/m/section__02.png" class="conM">
			</div>
		</div>
		<div id="section03" class="section03">
			<div class="content" data-nav=".section03">
				<h3 class="only">인건비 때문에 신규 채용이 부담이라구요? 여기, 다양한 고용장려금과 지원제도가 있습니다</h3>
				
				<div class="layer01"><div class="fade slide-in-blurred-bottom"><img src="/img/section__03-layer01.png" class="conPC"><img src="/img/m/section__03-layer01.png" class="conM"></div></div>
				<div class="layer02"><div class="fade slide-in-blurred-bottom"><img src="/img/section__03-layer02.png" class="conPC"><img src="/img/m/section__03-layer02.png" class="conM"></div></div>
				<div class="layer03"><div class="fade slide-in-blurred-bottom"><img src="/img/section__03-layer03.png" class="conPC"><img src="/img/m/section__03-layer03.png" class="conM"></div></div>
				<div class="layer04"><div class="fade slide-in-blurred-bottom"><img src="/img/section__03-layer04.png" class="conPC"><img src="/img/m/section__03-layer04.png" class="conM"></div></div>
				
				<img src="/img/m/section__03.png" class="conM">
			</div>
		</div>
		<div id="section04" class="section04">
			<div class="content" data-nav=".section04">
				<h3 class="only">고용지원금 및 4대보험 진단 서비스 여러분의 사업장은 고용지원금을 잘 관리하고 계신가요? 고용지원금 진단 서비스를 통해 노락된 지원금을 찾아 보세요</h3>
				
				<div class="layer01"><div class="fade slide-in-blurred-bottom"><img src="/img/section__04-layer01.png" class="conPC"><img src="/img/m/section__04-layer01.png" class="conM"></div></div>
				<div class="layer02"><div class="fade slide-in-blurred-right"><img src="/img/section__04-layer02.png"></div></div>
				<div class="layer03"><div class="fade slide-in-blurred-left delay04"><img src="/img/section__04-layer03.png"></div></div>
				
				<img src="/img/m/section__04.png" class="conM">
			</div>
		</div>
		<div id="section05" class="section05">
			<div class="content" data-nav=".section04">
				<h3 class="only">개인사업자부터 법인사업자까지 이제 시간 낭비는 그만! 다양한 고용 장려금과 지원제도 잘 모르셔도 괜찮습니다</h3>
				
				<div class="layer01"><div class="fade slide-in-blurred-bottom"><img src="/img/section__05-layer01.png" class="conPC"><img src="/img/m/section__05-layer01.png" class="conM"></div></div>
				<div class="layer02"><div class="fade slide-in-blurred-bottom"><img src="/img/section__05-layer02.png" class="conPC"><img src="/img/m/section__05-layer02.png" class="conM"></div></div>
				<div class="layer03"><div class="fade slide-in-blurred-bottom"><img src="/img/section__05-layer03.png" class="conPC"><img src="/img/m/section__05-layer03.png" class="conM"></div></div>
				<div class="layer04"><div class="fade slide-in-blurred-bottom"><img src="/img/section__05-layer04.png" class="conPC"><img src="/img/m/section__05-layer04.png" class="conM"></div></div>
				<div class="layer05"><div class="fade slide-in-blurred-bottom"><img src="/img/section__05-layer05.png" class="conPC"><img src="/img/m/section__05-layer05.png" class="conM"></div></div>
				
				<img src="/img/m/section__05.png" class="conM">
			</div>
		</div>
		<div id="section06"class="section06">
			<div class="content" data-nav=".section06">
				<h3 class="only"> 4대 보험 환급 공단이 부과한 보험료 그대로 납부하세요? 우리 회사가 내고 있는 보험료, 적정한지 무료로 진단 받아보세요!</h3>
				
				<div class="layer01"><div class="fade slide-in-blurred-bottom"><img src="/img/section__06-layer01.png" alt="직원채용을 하는 개인/법인사업자" class="conPC"><img src="/img/m/section__06-layer01.png" class="conM"></div></div>
				<div class="layer02"><div class="fade slide-in-blurred-bottom"><img src="/img/section__06-layer02.png" alt="고용장려금을 한번도 신청하지 못한 기업" class="conPC"><img src="/img/m/section__06-layer02.png" class="conM"></div></div>
				<div class="layer03"><div class="fade slide-in-blurred-right"><img src="/img/section__06-layer03.png" alt="직원의 입/퇴사가 일정하지 않은 기업"></div></div>
				<div class="layer04"><div class="fade slide-in-blurred-left"><img src="/img/section__06-layer04.png" alt="직원급여가 부담되는 기업"></div></div>
				
				<img src="/img/m/section__06.png" class="conM">
			</div>
		</div>
		<div id="section07" class="section07">
			<div class="content" data-nav=".section06">
				<h3 class="only">보험료를 납부한지 3년이 경과하면 불필요하게 납부한 보험료를 돌려받을 수 없게 됩니다</h3>
				
				<div class="layer01"><div class="fade slide-in-blurred-bottom"><img src="/img/section__07-layer01.png" alt="4대 보험 환급 사례A 근로자:2,50명 대기업 A사(제조업) 약 6억 8천만원 환급" class="conPC"><img src="/img/m/section__07-layer01.png" class="conM"></div></div>
				<div class="layer02"><div class="fade slide-in-blurred-bottom"><img src="/img/section__07-layer02.png" alt="4대 보험 환급 사례B 근로자:70명 B사(서비스업) 약 1억 3천 5백만원 환급" class="conPC"><img src="/img/m/section__07-layer02.png" class="conM"></div></div>
				
				<img src="/img/m/section__07.png" class="conM">
			</div>
		</div>
		<div id="section08" class="section08">
			<div class="content" data-nav=".section08">
				<h3 class="only"></h3>
				
				<div class="layer01"><div class="fade slide-in-blurred-bottom"><img src="/img/section__08-layer01.png" class="conPC"><img src="/img/m/section__08-layer01.png" class="conM"></div></div>
				<div class="layer02"><div class="fade slide-in-blurred-bottom"><img src="/img/section__08-layer02.png" class="conPC"><img src="/img/m/section__08-layer02.png" class="conM"></div></div>
				<div class="layer03"><div class="blinkbutton"><a href="https://taxreturn.etaxmate.co.kr/TAX_CFR_010000" target="_blank" title="고용장려금 무료 조회하기"><img src="/img/section__08-layer03.png" alt="고용장려금 무료 조회하기"></a></div></div>
				
				<img src="/img/m/section__08.png" class="conM">
			</div>
		</div>
		<div id="section09" class="section09">
			<div class="content" data-nav=".section08">
				<h3 class="only">주식회사 택스리턴, 고양특례시 일산동구 무궁화로 20-38, 513호 | 대표자:전병권 / 개인정보보호책임자:유경미 / 사업자등록번호:588-87-03100 / 대표전화:1522-2247 / 이메일tax-return@naver.com</h3>
				
				<img src="/img/m/section__09.png" class="conM">
			</div>
		</div>
	</div>
</div>

</body> 
</html>