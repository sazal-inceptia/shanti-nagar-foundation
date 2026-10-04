

	function tm_animate_text(){
		"use strict";
		var animateSpan = jQuery('.animation_text_word');
		if (animateSpan.length && typeof animateSpan.typed === 'function') {
			var words = window.bannerAnimatedWords || [
				"Donate to changing the world. Be part of the good campaign...",
				"Service Above Self — Dedicated to Grassroots Welfare...",
				"100% Transparency and Direct Relief Across Bangladesh..."
			];
			animateSpan.typed({
				strings: words,
				loop: true,
				startDelay: 1e3,
				backDelay: 3e3
			});
		}
	}

	jQuery(document).on('ready', function () {
		(function ($) {
			tm_animate_text();
		})(jQuery);
	});