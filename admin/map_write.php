<?php
	include'loader.php';
	$page = 'map';
	$config = getItem('site_configs');

	if($param['has_data']==1){
		$attach=simpleUpload($_FILES['attach'],'/admin/files');
		$param['attach'] = $attach['path'];

		if($param['no']){
			updateItem('map',$param,$param['no']);
		} else {
			insertItem('map',$param);
		}
		getBack('/admin/map_list.php');
	}

	if($param['no']){
		$map = getItem('map',$param['no']);
	}
	include'views/header.php';

	$lat = $map['lat'] ? $map['lat'] : 36.4965569936987; // 초기 및 리셋 중심좌표
	$lng = $map['lng'] ? $map['lng'] : 127.242297055683; // 초기 및 리셋 중심좌표
?>
<style>body{font-size:0;}</style>
<div class="page-container">
	<div class="container">
		<!-- BEGIN PAGE TITLE -->
		<div class="page-title flex col2 middle">
			<div>
				<h1 class="title"><span>매장 등록/수정</span></h1>
			</div>
			<div>
				
			</div>
		</div>
		<!-- END PAGE TITLE -->
		
		<form action="" method="post" name="board_form" enctype="multipart/form-data">
			<input type="hidden" name="has_data"  value="1"/>
			<input type="hidden" name="no"  value="<?=$param['no']?>"/>
			<table class="table detail">
				<tr>
					<th>매장 이름</th>
					<td><input type="text" name="title" class="input-control" value="<?=$map['title']?>"></td>
				</tr>
				<tr>
					<th>우편번호</th>
					<td><input type="text" name="addr3" class="input-control" id="postcode" style="max-width:100px;" value="<?=$map['addr3']?>" readonly><button type="button" class="btn btn-primary DaumPostcode">검색</button></td>
				</tr>
				<tr>
					<th>검색주소</th>
					<td><input type="text" name="addr1" class="input-control" id="address" value="<?=$map['addr1']?>" readonly></td>
				</tr>
				<tr>
					<th>상세주소</th>
					<td><input type="text" name="addr2" class="input-control" id="detailAddress" value="<?=$map['addr2']?>"></td>
				</tr>
				<tr>
					<th>연락처</th>
					<td><input type="text" name="tel" class="input-control" id="tel" value="<?=$map['tel']?>"></td>
				</tr>
				<tr>
					<th>지도보기</th>
					<td>
						<div style="background-color:#f9f9f9; width:100%; margin-top:5px; height:200px; border-radius:4px;" id="map"></div>
					</td>
				</tr>
				<tr>
					<th>영업시간</th>
					<td><input type="text" name="time" class="input-control" id="time" value="<?=$map['time']?>"></td>
				</tr>
				<tr>
					<th>위도/경도</th>
					<td>
						<input type="text" name="lat" class="input-control harf" id="lat" value="<?=$map['lat']?>" readonly>
						<input type="text" name="lng" class="input-control harf" id="lng" value="<?=$map['lng']?>" readonly>
					</td>
				</tr>
				<!--
				<tr>
					<th>첨부</th>
					<td><input type="file"  name="attach"/>		<?=attr($map['attach'],'<a href="/admin/files/'.$map['attach'].'">[첨부]</a>')?></td>
				</tr>
				-->
			</table>
		</form>
		<div id="buttons"><a href="map_write.php" class="btn btn-primary" onclick="document.board_form.submit();return false;">등록</a></div>
	</div>
</div>

<script type="text/javascript" src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=<?=$config['javascriptkey']?>&libraries=services"></script>

<script>
var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
	mapOption = {
		center: new daum.maps.LatLng(<?php echo $lat;?>, <?php echo $lng;?>), // 지도의 중심좌표
		level: 3 // 지도의 확대 레벨
	};
// 지도를 생성
var map = new daum.maps.Map(mapContainer, mapOption);
// 주소-좌표 변환 객체 생성
var geocoder = new daum.maps.services.Geocoder();
// 마커
var marker = new daum.maps.Marker({
	map: map,
	// 지도 중심좌표에 마커를 생성
	position: map.getCenter()
});



// 주소검색 API (주소 > 좌표변환처리)
$(function() {
	$(".DaumPostcode").on("click", function() {
		new daum.Postcode({
			oncomplete: function(data) {
				console.log(data);
				$("#address").val(data.address);
				$("#postcode").val(data.zonecode);
				geocoder.addressSearch(data.address, function(results, status) {
					// 정상적으로 검색이 완료됐으면
					if (status === daum.maps.services.Status.OK) {

						//첫번째 결과의 값을 활용
						var result = results[0];

						// 해당 주소에 대한 좌표를 받아서
						var coords = new daum.maps.LatLng(result.y, result.x);

						// 지도를 보여준다.
						map.relayout();

						// 지도 중심을 변경한다.
						map.setCenter(coords);

						// 좌표값을 넣어준다.
						document.getElementById('lat').value = coords.getLat();
						document.getElementById('lng').value = coords.getLng();

						// 마커를 결과값으로 받은 위치로 옮긴다.
						marker.setPosition(coords);
					}
				});

			}
		}).open();
	});
});
	
//마커를 기준으로 가운데 정렬이 될 수 있도록 추가
var markerPosition = marker.getPosition(); 
map.relayout();
map.setCenter(markerPosition);

//브라우저가 리사이즈될때 지도 리로드
$(window).on('resize', function () {
	var markerPosition = marker.getPosition(); 
	map.relayout();
	map.setCenter(markerPosition)
});

</script>
<?php
	include'views/footer.php';
?>
				