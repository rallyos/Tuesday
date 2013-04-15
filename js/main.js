jQuery(document).ready(function($) {

// instantiate FastClick
	window.addEventListener('load', function() {
	    new FastClick(document.body);
	}, false);

// Get tag count and show it
	$('.wp-tag-cloud a').each(function(){
		var tag_count = $(this).attr('title');
		var stripped_tag_count = tag_count.replace(/[^0-9]/g, '');
		$('<span class="tag-count">' + stripped_tag_count + '</span>').appendTo(this);
	});

// Mobile sidebar show/hide
	$('#menu-button').toggle( function() {
		var sidebar_width = $('#sidebar').width();
		$('#sidebar').css({
			'-webkit-transform': 'translateX(0)',
			'-ms-transform': 'translateX(0)',
			'transform': 'translateX(0)'
		});
		$('#content, #footer').css({ 
			'-webkit-transform': 'translateX('+ sidebar_width +'px)',
			'-ms-transform': 'translateX('+ sidebar_width +'px)',
			'transform': 'translateX('+ sidebar_width +'px)'
		});
			}, function () {
		$('#sidebar, #content, #footer').css({ 
			'-webkit-transform': '',
			'-ms-transform': '',
			'transform': ''
		});
	});
// Mobile menu show/hide 
	$('#toggle-menu').toggle( function() {
		$('.top-nav').css( 'display', 'block');
			}, function () {
		$('.top-nav').css( 'display','');
	});
// Fast scroll to top
	$('#scroll-top').on('click',function() {
		$('html, body').animate({scrollTop: 0}, 700);
	});

// Social icons
	$('.social-links').on('mouseenter', function() {
		$(this).siblings().css('opacity','0.2');
	});
	$('.social-links').on('mouseleave', function() {
		$(this).siblings().css('opacity','1');
	});
});
