
	</div>
</div>

<script>
$(document).on('click', '.mobile_nav_open, .mobile_nav_close', function(){
	$('.mobile_nav_open').toggleClass('active');
	$('.page-header').toggleClass('active');
})
$(function(){
	$('.adminInfo').on('click', function(){
		$('.adminPopup').addClass('active');
	})
	$('.closebtn').on('click', function(){
		$(this).closest('[class*="Popup"]').removeClass('active');
	})
})
</script>

<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>