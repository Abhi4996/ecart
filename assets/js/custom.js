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

	hideFlashMessage();
});


function hideFlashMessage() {
	if ($(".alert-customized").length) {
		$(".alert-customized").fadeOut(2000);
	}
}

/*function common() {
	console.log("Common called");
}*/

function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}



function getCookie(cookie_name) {
    var cookies = document.cookie.split("; ");
    
    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i].split("=");
        var cname = cookie[0];
        var cval = cookie[1];

        if (cookie_name == cname) {
            return cval;
        }
    }
}

