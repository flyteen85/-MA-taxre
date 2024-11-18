var component = {};
var method = {};

jQuery(document).ready(function($) {
    
    method.excelDownloadValidate = function() {
		component.date.data = component.date.map(date => date.val().toString());

		for (var i = 0; i < component.date.length; i++) {
			if (!component.date[i].val()) {
				alert("날짜를 선택해주세요.");
				component.date[i].click();
				return false;
			}
		}

		if (new Date(component.date[0].val()) >= new Date(component.date[1].val())) {
			alert("시작 날짜는 종료 날짜보다 이전이어야 합니다.");
			component.date[0].click();
			return false;
		}

		if (confirm(`${component.date.data[0]} 에서 ${component.date.data[1]} 까지\n자료를 다운로드 하시겠습니까?`)) {
			const href = `${component.excelDownload.attr("href")}?startDate=${component.date.data[0]}&endDate=${component.date.data[1]}`;
			window.location.href = href;
			return true;
		} else {
			return false;
		}
	};

    
    method.dateSettings = function() {
        $.datepicker.setDefaults({
            dateFormat: "yy-mm-dd",
            prevText: "이전",
            nextText: "다음",
            monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
            monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
            dayNames: ['일', '월', '화', '수', '목', '금', '토'],
            dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
            dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
            showMonthAfterYear: true,
            yearSuffix: '년',
            maxDate: 0
        });

        component.date = [$("#startDate"), $("#endDate")];
        component.date.forEach(dateField => dateField.datepicker());

        component.excelDownload = $("#excelDownload");
        component.excelDownload.on("click", method.excelDownloadValidate);
    };

    method.dateSettings();
});
