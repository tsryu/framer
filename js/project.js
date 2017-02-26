( function( $ ) {
	'use strict';

	function p_func() {
		// pc해상도에서 함수 실행

	}

	function m_func() {
		// 모바일 해상도에서 함수 실행
	}

	
	var standard = 768, // 모바일 분기점
			is_mobile = 0,  // 너비 ex)0 = 해상도 768 이상, 1 = 768 미만
			sign = 0;       // 1 = 한 번 만 실행 후 중복실행 방지

	$(window).on('load resize', function(){
		if( $(window).innerWidth() >= standard ){
				if(is_mobile === 1){ 
						is_mobile = 0;
						sign = 0;
				}

				if(is_mobile === 0 && sign === 0){ 
						sign = 0;
						p_func();
				}

		} else { 
				if(is_mobile === 0){
						is_mobile = 1;
						sign = 0;
				}

				if(is_mobile === 1 && sign === 0){ 
						sign = 1;
						m_func();
				}
		}
	});


	$(document).ready(function() {
		//앵커 스크롤 애니메이션
		$(".site-sidebar .anchor-link li a").live('click', function (event) {
			event.preventDefault();
			var elementClick = $(this).attr("href");
			var destination = $(elementClick).offset().top;
			$("html:not(:animated),body:not(:animated)").animate({ scrollTop: destination }, 200, 'swing', function() {
			  window.location.hash = elementClick;
			});
			return false;
	    })
		//스크롤 현위치 표시
	

		// 모바일 메뉴 토글
		$('.navbar-toggle').click(function(e) {
			e.preventDefault();
			$('body').toggleClass('menu-open');
		});

		// 셀렉트박스
		$('.js-select').each(function() {
			var selected;

			$(this).children('option').each(function() {
				if( $(this).is(':selected') ) {
					selected = $(this).text();
					// console.log(selected);
					$(this).parent().prev(".label").text(selected);
				}
			});

			$(this).on('change', function () {
				var selected = $(this).children('option:selected').text();
				$(this).prev(".label").text(selected);
				return false;
			});
		});

	});

} )( jQuery );