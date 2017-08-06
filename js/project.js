( function( $ ) {
	'use strict';

	function p_func() {
		// pc해상도에서 함수 실행

	}

	function m_func() {
		// 모바일 해상도에서 함수 실행
	}


	$(window).on("load", function () {
		if (location.hash.length !== 0) {
			var withoutHash = location.hash.substr(1);
	    	var idOffsettop = document.getElementById(withoutHash).offsetTop;
	        window.scrollTo(0, idOffsettop);
	    }
	});
	
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
		if($('.page-docs').length){
			var $sidebar = $('.site-sidebar .anchor-link');
			$('.page-content .section').each(function(){
				var sectionText = $(this).children('h1').text();
				var sectionId = $(this).attr('id');
				$sidebar.append('<li><a href="#'+sectionId+'">'+sectionText+'</a></li>');
				if($(this).find('h3').length){
					$('.site-sidebar a[href="#'+sectionId+'"]').parent().addClass('accordion').append('<ul id="list-'+sectionId+'"></ul>');
					$(this).find('h3').each(function(){
						// var h3Text = $(this).text().replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
						var h3Text = $(this).text().replace(/&/g,'&amp;').replace(/(<([^>]+)>)/ig, '').replace(/ *\([^)]*\) */g, "()");
						var h3Id = $(this).attr('id');
						$('#list-'+sectionId).append('<li><a href="#'+h3Id+'">'+h3Text+'</a></li>');
					})
				}
				
			})
		}
		if($('.page-docs').length){
			$('a[href^="#"]').click(function(e){
				e.preventDefault();
				var withoutHash = $(this).attr('href').substr(1);
		    	var idOffsettop = document.getElementById(withoutHash).offsetTop;
		        window.location.hash = $(this).attr('href');
		        window.scrollTo(0, idOffsettop);
			});
		}
		if($('.page-template-template-document').length){
			var $pre = $('.site-content pre');
			$pre.children('code').addClass('language-coffeescript code-embed-code');
			$pre.wrap('<div class="code-embed-wrapper">').addClass('line-numbers code-embed-pre');
			$pre.each(function(){
				// 앞 뒤로 여백 삭제하기
				var pure_code = $(this).text().replace(/^\s+|\s+$/g, "");
				$(this).children('code').text(pure_code);
			})
		}
		//앵커 스크롤 애니메이션
		$(".scroll-animate").live('click', function (event) {
			event.preventDefault();
			var elementClick = $(this).attr("href").substr(1);
			// var destination = $(elementClick).offset().top;
			var elementClickId = document.getElementById(elementClick);
			var destination = elementClickId.offsetTop;
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

		$('.accordion > a').live('click', function() {
			// e.preventDefault();
			if($(this).parent().hasClass('opened')){
				$(this).siblings('ul').slideUp('fast');
				$(this).parent().removeClass('opened');
			}else{
				$(this).siblings('ul').slideDown('fast');
				$(this).parent().addClass('opened');
			}
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