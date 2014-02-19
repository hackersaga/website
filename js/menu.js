$(function(){
	$(".dropdown").mouseenter(function(){
		$('.sub_menu').stop(false, true).hide();

		var dropdown = $(this).children(".sub_menu");
		
		dropdown.slideDown(50,'easeOutQuint');

		dropdown.mouseleave(function(){
			dropdown.slideUp();
		});
	});
	
	$(".menu").mouseleave(function(){
		$('.sub_menu').stop(false, true).hide();
	});
});
