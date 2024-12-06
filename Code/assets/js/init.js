jQuery(document).ready(function () {
	jQuery("ul li:first-child, dl dd:first-child").addClass("first");
	jQuery("ul li:last-child, dl dd:last-child").addClass("last");
	jQuery("input, textarea, select, button").uniform();
	jQuery("#get-a-quote .title").click(function () {
		var _slide = jQuery(this).siblings('div');
		var _content = jQuery(this).parent();
		if (jQuery(_slide).hasClass('hidden')) {
			jQuery(_content).animate({
				"left" : 0
			}, {
				queue : false,
				"easing" : "easeOutExpo",
				duration : 1000
			});
			jQuery(_slide).removeClass('hidden');
		} else {
			jQuery(_content).animate({
				"left" : "-523px"
			}, {
				queue : false,
				"easing" : "easeOutExpo",
				duration : 1000
			});
			jQuery(_slide).addClass('hidden');
		}
	});
	jQuery('#projects li li').hover(function () {
		jQuery(this).addClass('hover');
	}, function () {
		jQuery(this).removeClass('hover');
	});
	jQuery("#what-we-do ul > li, , ul#overview > li").hover(function () {
		jQuery(this).children('div').children('p').stop(true, true).slideDown('slow', 'easeOutExpo');
	}, function () {
		jQuery(this).children('div').children('p').stop(true, true).slideUp('slow', 'easeOutExpo');
	});
	function megaHoverOver() {
		$(this).find(".sub").stop().fadeTo('fast', 1).show();
		$(this).addClass('hover');
		var _parentWidth = $(this).width();
		(function ($) {
			jQuery.fn.calcSubWidth = function () {
				rowWidth = 0;
				$(this).find("ul").each(function () {
					rowWidth += $(this).width();
				});
			};
		})(jQuery);
		if ($(this).find(".row").length > 0) {
			var biggestRow = 0;
			$(this).find(".row").each(function () {
				$(this).calcSubWidth();
				if (rowWidth > biggestRow) {
					biggestRow = rowWidth;
				}
			});
			$(this).find(".sub").css({
				'width' : biggestRow,
				'left' :  - (biggestRow / 2) + (_parentWidth / 2) - 10 + 'px'
			});
			$(this).find(".row:last").css({
				'margin' : '0'
			});
		} else {
			$(this).calcSubWidth();
			$(this).find(".sub").css({
				'width' : rowWidth,
				'left' :  - (rowWidth / 2) + (_parentWidth / 2) - 10 + 'px'
			});
		}
	}
	function megaHoverOut() {
		$(this).find(".sub").stop().fadeTo('fast', 0, function () {
			$(this).hide();
		});
		$(this).removeClass('hover');
	}
	var config = {
		sensitivity : 2,
		interval : 100,
		over : megaHoverOver,
		timeout : 500,
		out : megaHoverOut
	};
	$("ul#topnav li .sub").css({
		'opacity' : '0'
	});
	$("ul#topnav li").hoverIntent(config);
	jQuery('.toggle').click(function (e) {
		e.preventDefault();
		var _panel = jQuery(this).parent().siblings('ul:first');
		if (jQuery(_panel).is(':visible')) {
			jQuery(_panel).slideUp('slow', 'easeOutQuad');
			jQuery(this).removeClass('collapse').addClass('expand').html('expand');
		} else {
			jQuery(_panel).slideDown('slow', 'easeOutQuad');
			jQuery(this).removeClass('expand').addClass('collapse').html('collapse');
		}
	});
	jQuery('a[rel="external"]').click(function () {
		this.target = "_blank";
	});
	jQuery('input[type="text"], textarea').each(function () {
		var default_value = this.value;
		jQuery(this).focus(function () {
			if (this.value == default_value) {
				this.value = '';
			}
		});
		jQuery(this).blur(function () {
			if (this.value == '') {
				this.value = default_value;
			}
		});
	});
});
jQuery("#slides").after('<div id="slide-nav">').cycle({
	fx : 'fade',
	timeout : 5000,
	speed : 2000,
	pause : 1,
	hover : 1,
	next : '.slide-next',
	prev : '.slide-prev',
	pager : '#slide-nav',
	easing : 'easeOutExpo'
});
jQuery("#projects").cycle({
	fx : 'scrollHorz',
	timeout : 0,
	pause : 1,
	next : '.project-next',
	prev : '.project-prev',
	easing : 'easeOutExpo'
});
jQuery("#clients").cycle({
	fx : 'scrollHorz',
	timeout : 0,
	pause : 1,
	next : '.clients-next',
	prev : '.clients-prev',
	easing : 'easeOutExpo'
});
