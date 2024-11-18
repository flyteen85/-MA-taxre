//콤마찍기
function comma(str) {
	str = String(str);
	return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
}

function count(target, num, unit) {
	var progressRate = num;
	$({percent: 0}).animate({percent:progressRate}, {
		duration:2000,
		progress:function(){
			var now = this.percent;
			return target.html(comma(Math.ceil(now)) + unit);
		}
	})
}

function countNum(){
	$('[data-count]').each(function(){
		if($(window).scrollTop() + $(window).height() > $(this).offset().top && $(this).offset().top + $(this).height() < $(window).scrollTop() + $(window).height()){
			if (!$(this).hasClass('on')){
				count($(this),$(this).data('count'),$(this).data('unit'));
			}
			$(this).addClass('on');
		} else {
			$(this).removeClass('on');
		}
	});
}
//숫자앞에 0 붙이기
function numberPad(n, width) {
    n = n + '';
    return n.length >= width ? n : new Array(width - n.length + 1).join('0') + n;
}

function extractVideoID(url){
	var regExp = /^(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/;
	var match = url.match(regExp);
	if(match && match[1]){
		return match[1];
	}else{
		return 'Invalid YouTube Link';
	}
}

//
function linkMoveScroll(){
	var sections = [];

	$('.container').children().each(function() {
		sections.push($(this).attr('id'));
	});

	for (var i = 0; i < sections.length; i++) {
		if (window.location.href.indexOf(sections[i]) > -1) {
			$('html, body').stop().animate({
				scrollTop: $('#' + sections[i]).offset().top
			}, 300);
			break;
		}
	}
}

function hiddenScroll() {
    var sectionTop = 0; // $('body').offset().top;
    var fixBarHeight = $('.fixedbar.top').outerHeight();
    var scrollTop = $(window).scrollTop();
    if (scrollTop >= sectionTop) {
        $('.fixedbar.top').removeClass('hidden');
    } else {
        $('.fixedbar.top').addClass('hidden');
    }
}

$(function(){

	//커스텀 팝업 열기/닫기
	$('.open_custom_popup').on('click',function(){
		$('.custom_popup_form').addClass('active');
	})
	$('.custom_popup_form .closebg, .custom_popup_form > div > button').on('click',function(){
		$('.custom_popup_form').removeClass('active');
	})
	$('.tabbtn > li').on('click', function(){
		$(this).addClass('active').siblings('li').removeClass('active');
		$(this).closest('.tabbtn').siblings('.tabcon').children('li').eq($(this).index()).addClass('active').siblings('li').removeClass('active');
	});
})


/* 페이지 요소들이 읽혔을 때 실행되는 스크립트 */
$(document).ready(function(){
	/* 페이지 로딩 그래프 */
	/*
	var $container = $('#progress'),
	$progressBar = $container.find('.progress-bar > em'),
	$progressText = $container.find('.progress-text'),
	imgLoad = imagesLoaded('body'),
	imgTotal = imgLoad.images.length,
	imgLoaded = 0, //로드한 이미지 수
	current = 0, //진행률
	progressTimer = setInterval(updateProgress, 1000/60);
	imgLoad.on('progress', function(){
		imgLoaded++;
	});
	function updateProgress(){
		//진행률 - > bar, 숫자
		var target = (imgLoaded / imgTotal) * 100;
		current += (target - current) * 0.1;
		$progressBar.css({width:current + '%'});
		$progressText.text(Math.round(current) + '%');
		if(current > 99.9){
			clearInterval(progressTimer);
			$container.addClass('progress-complete');
			$progressBar.add($progressText).delay(500).animate({  }, 250,
			function(){
				$container.fadeOut();
				//$container.animate({top:'-100%'}, 1000, 'easeInOutQuint');
				
			});
		}
	}//updateProgress
	*/
	linkMoveScroll();
	scroll_class();
	hiddenScroll();
	
	/* 마우스 스크롤 함수 */
	$(window).on('scroll', function() {
		scroll_class();
		hiddenScroll();
	});
	/* 따라다니는 사이드 메뉴 */
	var floatPosition = parseInt($(".floatMenu").css('top'));
	$(window).scroll(function() {
		var scrollTop = $(window).scrollTop();
		var newPosition = scrollTop + floatPosition + "px";
		$(".floatMenu").stop().animate({"top" : newPosition}, 500);
    countNum();
	});

	/* 아코디언 메뉴 클릭 */
	$('.accordion-item.active .answer img').load(function(){
		var imgH = $(this).height();
		$(this).closest('.answer').css({'height':imgH});
	})
	$(document).on('click','.accordion-item .question', function(){
		$(this).parents('.accordionbox').find('.accordion-item').removeClass('active');
		$(this).parents('.accordionbox').find('.answer').css({'height':'0'});
		$(this).closest('.accordion-item').addClass('active');
		var imgH = $(this).siblings('.answer').find('img').innerHeight();
		$(this).siblings('.answer').css({'height':imgH});
	})

	/* 모달박스 열기&닫기 */
	$('.modal_open').click(function(){
		$('.modal_dbbox').addClass('visible');
	});
	$('.modal_close').click(function(){
		$('.modal_dbbox').removeClass('visible');
	});

	/* 이용약관 열기&닫기 */
	$('.privacy-open, .privacy-close, .privacy-close-area').on('click', function(){
		$('.privacy-pop').toggleClass('active');
		$('body').toggleClass('fixed');
	});
	
	$('.tabbtn.more').on('click', function(){
		$(this).addClass('disabled');
		$(this).siblings('.menulist').find('li').removeClass('disabled');
	});
	
});

/* 스크롤 시 animation 클래스를 찾아서 active 클래스를 추가하면서 동시에 animation 클래스를 제거 */
function scroll_class(){
	$('[class*="layer"]').each(function() {
		var winHalf = $(window).height() * 1/9;
		if($(window).scrollTop() + $(window).height() >= $(this).offset().top + winHalf && $(this).offset().top + $(this).height() <= $(window).scrollTop() + $(window).height() + winHalf + $(this).height()) {
			$(this).addClass('active');
        } else {
			$(this).removeClass('active');
        }
    });
	$('[class*="section"] .content').each(function(){
		var win_half = $(window).height()*2/10;
		if($(window).scrollTop() >= $(this).offset().top - win_half) {
			var naviid = $(this).data('nav');
			$('[data-target*="section"]').parents('li').removeClass('active');
            $('[data-target="'+naviid+'"]').parents('li').addClass('active');
		}
	});
	/*
	$('.fixedbar.top').each(function(){
		if($(window).scrollTop() > 100){
			$('.fixedbar.top').addClass('active');
		} else {
			$('.fixedbar.top').removeClass('active');
		}
	});
	*/
};
$(window).load(function(){
	$(document).on('click', '[data-target]', function(){
		var Scolltarget = $(this).data("target");
		var outHeight = $('.fixedbar').height();
		var Scolltarget = $(Scolltarget).offset().top;
		$('body, html').animate({scrollTop : Scolltarget - outHeight}, 1000);
	});

	$('[class*=landing_form]').submit(function(){
		$(this).find('button').prop('disabled', true);
		
		if (!checktrue($(this))){
			$(this).find('button').prop('disabled', false);
			return false;
		}

		if (!validateForm($(this))){
			$(this).find('button').prop('disabled', false);
			return false;
		}

		var list = new Array();
		$(this).find("[name='phone[]']").each(function(index, item){
			list.push($(item).val());
		});

		var num = list.join();
		num = num.replace(/[\{\}\[\]\/?.,;:|\)*~`!^\-_+<>@\#$%&\\\=\(\'\"]/gi,'');

		if(num.substring(0,2) == "02"){
			if(num.length < 9){
				alert('전화번호가 올바르지 않습니다.');
				return false;
			}
		} else {
			if(num.length < 11){
				alert('전화번호가 올바르지 않습니다.');
				return false;
			}
		}

	
		return true;
	});

	function checktrue($formSelector){
		if(typeof($formSelector)=='string'){
			var $childForms = $($formSelector+' .agree');
		} else {
			var $childForms =$formSelector.find('.agree');
		}
		var result = true;
		$childForms.each(function(){
			var ischk =$(this).prop('checked')
			if(ischk == false){
				result = false;
				var message = $(this).data('message');
				alert(message);
				$(this).focus();
				return false;
			}
		});
		return result;
	}
	function validateForm($formSelector){
		if(typeof($formSelector)=='string'){
			var $childForms = $($formSelector+' .form');
		} else {
			var $childForms =$formSelector.find('.form');
		}
		var result = true;
		$childForms.each(function(){
			var type = $(this).data('type');
			var essential = $(this).data('essential');
			var message = $(this).data('message');
			var value = $.trim($(this).val());
			switch(type){
				default : 
					if(value==''){
						result = false;
						alert(message);
						$(this).focus();
						return false;
					}
					break;
				case 'email' :
					if(value==''){
						result = false;
						alert('이메일을 입력해주세요.');
						$(this).focus();
						return false;
					}
					var regex=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;   
					if(regex.test(value) === false) {  
						result = false;
						alert("잘못된 이메일 형식입니다.");
						$(this).focus();
						return false;  
					} 
					break;
				case 'id' :
					if(value==''){
						result = false;
						alert('아이디를 입력해주세요.');
						$(this).focus();
						return false;
					}
					var regex=  /^[a-z0-9_]{5,15}$/;

					if(regex.test(value) === false) { 
				
						result = false;
						alert("아이디는 소문자로 시작하는  5~15자 소문자, 숫자의 조합이어야 합니다.");
						$(this).focus();
						return false;  
					} 
					break;
				case 'password' :
					if(value==''){
						result = false;
						alert('아이디를 입력해주세요.');
						$(this).focus();
						return false;
					}
					var regex=  /^[a-z0-9_]{5,15}$/;

					if(regex.test(value) === false) { 
				
						result = false;
						alert("아이디는 소문자로 시작하는  5~15자 소문자, 숫자의 조합이어야 합니다.");
						$(this).focus();
						return false;  
					} 
					break;
				case 'number' :
					if(value==''){
						result = false;
						alert(message);
						$(this).focus();
						return false;
					}
					var regex=  /^[0-9]+$/;
					if(regex.test(value) === false) { 
				
						result = false;
						alert("숫자만 입력 가능합니다.");
						$(this).focus();
						return false;  
					} 
					break;
				case 'exception' :
					var exception = $(this).data('exception');
					var check = validation[exception](value);
					if(!check['result']){
						alert(check['message']);
						result = false;
					}
					break;
			}
		});

		return result;
	}
	

	$('[type="submit"]').each(function(){
		$(this).prop('disabled', false);
	});
	$('.lodingbox').addClass('hidden');
})

/* 자동으로 하이픈 넣기 */
$(function () {
	var areaCodes = ['02', '031', '032', '033', '041', '042', '043', '051', '052', '053', '054', '055', '061', '062', '063', '064'];
	$('[class*="phone_check"]').keyup(function() {
		var phone = '';
		var seoul = 0;
		var areaCode = false;
		var string = $(this).val();
		var regex =  /^[0-9\-]+$/;
		
		if(string){
			if(!regex.test(string)){
				alert('숫자만 입력 할 수 있습니다.');
				$(this).val('');
				return false;
			}
		}
		
		var value = string.replace(/[^0-9]/g, '');
		
		/* 서울 앞자리가 02 일때 */
		if(value.substring(0,2) == '02'){
			seoul = 1;
		}
		
		/* 자동으로 하이픈 삽입하기 */
		if(value.length > (3-seoul) && value.length <= 7){
			phone += value.substr(0, (3-seoul));
			phone += "-";
			phone += value.substr(3-seoul);
			$(this).val(phone);
		} else if(value.length > (7-seoul)){
			for (var i = 0; i < areaCodes.length; i++) {
	            if (value.startsWith(areaCodes[i])) {
					areaCode = true;
				}
			}
			if(areaCode == true){
				//지역번호라면
				if(value.substring(0,2) == '02'){
					$(this).attr({'maxlength':'11'});
					phone += value.substr(0, (3-seoul));
					phone += "-";
					phone += value.substr(3-seoul, 4-seoul);
					phone += "-";
					phone += value.substr(7-seoul-seoul);
					$(this).val(phone);		
				} else {
					$(this).attr({'maxlength':'12'});
					phone += value.substr(0, (3-seoul));
					phone += "-";
					phone += value.substr(3-seoul, 3-seoul);
					phone += "-";
					phone += value.substr(6-seoul-seoul);
					$(this).val(phone);				
				}
			} else {
				//010이라면
				$(this).attr({'maxlength':'13'});
				phone += value.substr(0, (3-seoul));
				phone += "-";
				phone += value.substr(3-seoul, 4-seoul);
				phone += "-";
				phone += value.substr(7-seoul-seoul);
				$(this).val(phone);
			}
		}
	});
});


$(window).on('load', function() {
	countNum();
	
	/**
	슬라이드
	*/
	$('.bannerslide, .interiorslide, .videoslide, .reviewslide').each(function(){
		var next = $(this).closest('.slideBox').find('.swiper-button-next');
		var prev = $(this).closest('.slideBox').find('.swiper-button-prev');
		var pagination = $(this).closest('.slideBox').find('.swiper-pagination');
		var bannerslide = new Swiper( $(this), {
			observer: true,
			observeParents: true,
			loop: true,
			navigation: {
				nextEl: next,
				prevEl: prev,
			},
			pagination:{
				el: pagination,
				clickable: true,
			},
			autoplay: {
				delay: 3000,
				disableOnInteraction: false,
			},
		});
	})
		
	$('.receiptslide').each(function(){
		var next = $(this).closest('.slideBox').find('.swiper-button-next');
		var prev = $(this).closest('.slideBox').find('.swiper-button-prev');
		var pagination = $(this).closest('.slideBox').find('.swiper-pagination');
		var receiptslide = new Swiper( $(this), {
			loop: true,
			loopAdditionalSlides : 1,
			navigation: {
				nextEl: next,
				prevEl: prev,
			},
			pagination:{
				el: pagination,
				clickable: true,
			},
			autoplay: {
				delay: 3000,
				disableOnInteraction: false,
			},
			breakpoints: {
				320: {
					slidesPerView: 1,
					spaceBetween: 10,
				},
				1100: {
					slidesPerView: 1,
					spaceBetween: 10,
				},
				4000: {
					slidesPerView: 6,
					spaceBetween: 50,
				},
			},
		});
	})
	

				
	/**
	자동 슬라이드
	*/
	$(".rolling_wraper").each(function() {
        var $rollingWrapper = $(this);
        var $img = $rollingWrapper.find("img");
        var direction = $rollingWrapper.data("direction") === "right" ? 1 : -1;
        var first = 1;
        var last;
        var imgCnt = 0;
        var gap = 20; // 이미지 간격

        // 이미지를 복제합니다.
        $img.each(function() {
            var $clone = $(this).clone(true); // 복제 및 이벤트 핸들러, 데이터 포함
            $rollingWrapper.append($clone); // 복제된 이미지를 rolling_wraper에 추가
        });

        var $allImg = $rollingWrapper.find("img"); // 복제된 모든 이미지 선택

        // 각 이미지의 left 위치 초기화
        var bannerLeft = 0;
        $allImg.each(function() {
            $(this).css("left", bannerLeft);
            bannerLeft += $(this).outerWidth() + gap; // 이미지 넓이와 여백을 고려하여 계산
            imgCnt++;
        });

        if (imgCnt > $allImg.length - 1) {
            last = imgCnt;
            setInterval(function() {
                $allImg.each(function() {
                    var $this = $(this);
                    var leftPos = parseInt($this.css("left"));
                    $this.css("left", leftPos + direction); // left 또는 right 방향으로 이동
                });

                var $first = $rollingWrapper.find("img:nth-child(" + first + ")");
                var $last = $rollingWrapper.find("img:nth-child(" + last + ")");

                if (direction === -1 && $first.position().left < -$first.outerWidth()) {
                    $first.css("left", $last.position().left + $last.outerWidth() + gap);
                    first++;
                    last++;

                    if (last > imgCnt) { last = 1; }
                    if (first > imgCnt) { first = 1; }
                } else if (direction === 1 && $last.position().left > $rollingWrapper.innerWidth()) {
                    $last.css("left", $first.position().left - $last.outerWidth() - gap);
                    first--;
                    last--;

                    if (first < 1) { first = imgCnt; }
                    if (last < 1) { last = imgCnt; }
                }
            }, 10);
        }
    });
	
	/**
	팝업비디오
	*/
	$(document).on('click', '.fixed_open_video', function(){
		var temp = '';
		var url = $(this).attr('data-link');
		temp = `
		<div class="fixed_video_box" aria-modal="true" aria-hidden="false">
			<div class="videowrap">
				<div class="videobox">
					<div>
						<iframe src="https://www.youtube.com/embed/${url}" title="YouTube video player" frameborder="0"></iframe>
					</div>
				</div>
			</div><div class="close"></div>
		</div>
		`;
		$('body').append(temp).addClass('fixed');
		
	});

	$(document).on('click', '.fixed_video_box .close', function(){
		$(this).closest('.fixed_video_box').remove();
		$('body').removeClass('fixed');
	});
	
});