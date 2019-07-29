$(document).ready(function(){
	if ($('#back-to-top').length) {
		var scrollTrigger = 100,
			backToTop = function () {
				var scrollTop = $(window).scrollTop();
				if (scrollTop > scrollTrigger) {
					$('#back-to-top').addClass('show');
				} else {
					$('#back-to-top').removeClass('show');
				}
			};
		backToTop();
		$(window).on('scroll', function () {
			backToTop();
		});
		$('#back-to-top').on('click', function (e) {
			e.preventDefault();
			$('html,body').animate({
				scrollTop: 0
			}, 700);
		});
	}
	
	$(window).scroll(function() {    
		var scroll = $(window).scrollTop();  
		if (scroll > 50 && $(window).width() > 767) {
			$(".header").addClass("sticky");
		}else{
			$(".header").removeClass("sticky");	
		}
	});
});