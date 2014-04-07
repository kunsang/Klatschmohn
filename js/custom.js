/* -------------------------------------------------------------------------------

	Custom JS

	1.  Main Slider (Flexslider)
	2.  Image Slider (Flexslider)
	3.  Main Navigation
	4.  Project Carousel
	5.  Responsive Video
	6.  Black & White Hover Effect
	7.  Accordion
	8.  Tabs
	9.  Isotope
	10. Fancybox
	11. Back to Top
	12. Twitter Feed
	13. Flickr Feed
	14. Google Maps
	15. Setting height for Header wrapper
	16. Add img class to links that contain images
	17
	18. Bio Siegel page accordion
	17. geht height of headings for hover effect

---------------------------------------------------------------------------------- */

// Global scope containers
var googlemaps = new Array();

jQuery(document).ready(function() {

/* --------------------------------------------------------------------------- */
/*  1.  Empty P Tag
/* --------------------------------------------------------------------------- */

	jQuery('p:empty').remove();
	jQuery('p').each(function() {
		if (jQuery.trim(jQuery(this)) === "") {
			jQuery(this).remove(); // $(item).remove();
		}
	});

/* --------------------------------------------------------------------------- */
/*  7.  Page Scroller (Smooth Scrolling)
/* --------------------------------------------------------------------------- */

	jQuery("html").niceScroll({
		styler: "fb",
		cursorcolor: '#616b74',
		cursorborder: '0',
		zindex: 9999,
		mousescrollstep: 50
	});

/* --------------------------------------------------------------------------- */
/*  15.  Setting height for Header wrapper
/* --------------------------------------------------------------------------- */

	if (jQuery('#stickyheader').length != 0) {
		jQuery('#stickyheader-wrapper').height(jQuery('#stickyheader').height());
	}

/* --------------------------------------------------------------------------- */
/*  7.  Page Scroller (Smooth Scrolling)
/* --------------------------------------------------------------------------- */
	jQuery(window).scroll(function(e){
	//   console.log('called');
			$el = jQuery('#stickyheader');

			var stickyHeaderTop = jQuery('#stickyheader').offset().top -20;
			stickyHeaderTop = stickyHeaderTop + 24;

			if	(jQuery(this).scrollTop() > 24 && $el.css('position') != 'fixed'){
				if (jQuery(window).width() > 995) {
					if( jQuery(window).scrollTop() > 24 ) {
						jQuery('#stickyheader').css({'position': 'fixed', 'top': '0px', 'opacity':'1'});
						// jQuery('#stickyheader').css({'position': 'fixed', 'top': '0px', 'opacity':'0'}).animate({opacity:1},300);
						jQuery('#stickyheader').addClass("sticky").removeClass("nostick");
						jQuery('body').addClass("stickyheader");
					} else {
						jQuery('#stickyheader').removeClass("sticky");
						jQuery('body').removeClass("stickyheader");
					}

				}else{
					jQuery('#stickyheader').removeClass("sticky").addClass("nostick");
					jQuery('#stickyheader').css({'position': 'relative', 'top': '0px'});
					jQuery('body').removeClass("stickyheader");
				}

		}
		if	(jQuery(this).scrollTop() < 24 && $el.css('position') == 'fixed'){
			jQuery('#stickyheader').css({'position': 'relative', 'top': '0px'});
			jQuery('#stickyheader').removeClass("sticky").addClass("nostick");
			jQuery('body').removeClass("stickyheader");
		}
	});

	// jQuery(window).scroll(function(e) {
	// 	//console.log('called');
	// 	$el = jQuery('#stickyheader');

	// 	var stickyHeaderTop = jQuery('#stickyheader').offset().top;
	// 	stickyHeaderTop = stickyHeaderTop + 40;

	// 	if (jQuery(this).scrollTop() > 100 && $el.css('position') != 'fixed') {
	// 		if (jQuery(window).width() > 995) {
	// 			if (jQuery(window).scrollTop() > stickyHeaderTop) {
	// 				jQuery('#stickyheader').css({
	// 					'position': 'fixed',
	// 					'top': '0px',
	// 					'opacity': '0'
	// 				}).animate({
	// 					opacity: 1
	// 				}, 300);
	// 				jQuery('#stickyheader').addClass("sticky");
	// 			} else {
	// 				jQuery('#stickyheader').removeClass("sticky");
	// 			}

	// 		} else {
	// 			jQuery('#stickyheader').removeClass("sticky");
	// 			jQuery('#stickyheader').css({
	// 				'position': 'relative',
	// 				'top': '0px'
	// 			});
	// 		}

	// 	}
	// 	if (jQuery(this).scrollTop() < 80 && $el.css('position') == 'fixed') {
	// 		jQuery('#stickyheader').css({
	// 			'position': 'relative',
	// 			'top': '0px'
	// 		});
	// 		jQuery('#stickyheader').removeClass("sticky");
	// 	}
	// });

/* --------------------------------------------------------------------------- */
/*  1.  Main Slider (Flexslider)
/* --------------------------------------------------------------------------- */

	jQuery('.flexslider').flexslider({
		namespace: "flex-",             //{NEW} String: Prefix string attached to the class of every element generated by the plugin
		selector: ".slides > li",       //{NEW} Selector: Must match a simple pattern. '{container} > {slide}' -- Ignore pattern at your own peril
		animation: "slide",             //String: Select your animation type, "fade" or "slide"
		easing: "easeInOutCubic",       //{NEW} String: Determines the easing method used in jQuery transitions. jQuery easing plugin is supported!
		direction: "horizontal",        //String: Select the sliding direction, "horizontal" or "vertical"
		reverse: false,                 //{NEW} Boolean: Reverse the animation direction
		animationLoop: true,            //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
		smoothHeight: false,            //{NEW} Boolean: Allow height of the slider to animate smoothly in horizontal mode
		startAt: 0,                     //Integer: The slide that the slider should start on. Array notation (0 = first slide)
		slideshow: true,                //Boolean: Animate slider automatically
		slideshowSpeed: 3000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
		animationSpeed: 600,            //Integer: Set the speed of animations, in milliseconds
		initDelay: 0,                   //{NEW} Integer: Set an initialization delay, in milliseconds
		randomize: false,               //Boolean: Randomize slide order

		// Usability features
		pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
		pauseOnHover: false,            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
		useCSS: true,                   //{NEW} Boolean: Slider will use CSS3 transitions if available
		touch: true,                    //{NEW} Boolean: Allow touch swipe navigation of the slider on touch-enabled devices
		video: false,                   //{NEW} Boolean: If using video in the slider, will prevent CSS3 3D Transforms to avoid graphical glitches

		// Primary Controls
		controlNav: false,              //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
		directionNav: true,             //Boolean: Create navigation for previous/next navigation? (true/false)
		prevText: "Previous",           //String: Set the text for the "previous" directionNav item
		nextText: "Next",               //String: Set the text for the "next" directionNav item

		// Secondary Navigation
		keyboard: true,                 //Boolean: Allow slider navigating via keyboard left/right keys
		multipleKeyboard: false,        //{NEW} Boolean: Allow keyboard navigation to affect multiple sliders. Default behavior cuts out keyboard navigation with more than one slider present.
		mousewheel: false,              //{UPDATED} Boolean: Requires jquery.mousewheel.js (https://github.com/brandonaaron/jquery-mousewheel) - Allows slider navigating via mousewheel
		pausePlay: false,               //Boolean: Create pause/play dynamic element
		pauseText: "Pause",             //String: Set the text for the "pause" pausePlay item
		playText: "Play",               //String: Set the text for the "play" pausePlay item
	});

/* --------------------------------------------------------------------------- */
/*  2.  Image Slider (Flexslider)
/* --------------------------------------------------------------------------- */

	jQuery('.image-slider').flexslider({
		namespace           : "flex-",           //{NEW} String: Prefix string attached to the class of every element generated by the plugin
		selector            : ".slides > li",    //{NEW} Selector: Must match a simple pattern. '{container} > {slide}' -- Ignore pattern at your own peril
		animation           : "slide",           //String: Select your animation type, "fade" or "slide"
		easing              : "swing",           //{NEW} String: Determines the easing method used in jQuery transitions. jQuery easing plugin is supported!
		direction           : "horizontal",      //String: Select the sliding direction, "horizontal" or "vertical"
		reverse             : false,             //{NEW} Boolean: Reverse the animation direction
		animationLoop       : true,              //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
		smoothHeight        : false,             //{NEW} Boolean: Allow height of the slider to animate smoothly in horizontal mode
		startAt             : 0,                 //Integer: The slide that the slider should start on. Array notation (0 = first slide)
		slideshow           : false,             //Boolean: Animate slider automatically
		slideshowSpeed      : 5000,              //Integer: Set the speed of the slideshow cycling, in milliseconds
		animationSpeed      : 600,               //Integer: Set the speed of animations, in milliseconds
		initDelay           : 0,                 //{NEW} Integer: Set an initialization delay, in milliseconds
		randomize           : false,             //Boolean: Randomize slide order

		// Usability features
		pauseOnAction       : true,              //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
		pauseOnHover        : false,             //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
		useCSS              : true,              //{NEW} Boolean: Slider will use CSS3 transitions if available
		touch               : true,              //{NEW} Boolean: Allow touch swipe navigation of the slider on touch-enabled devices
		video               : false,             //{NEW} Boolean: If using video in the slider, will prevent CSS3 3D Transforms to avoid graphical glitches

		// Primary Controls
		controlNav          : false,             //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
		directionNav        : true,              //Boolean: Create navigation for previous/next navigation? (true/false)
		prevText            : "Previous",        //String: Set the text for the "previous" directionNav item
		nextText            : "Next",            //String: Set the text for the "next" directionNav item

		// Secondary Navigation
		keyboard            : true,              //Boolean: Allow slider navigating via keyboard left/right keys
		multipleKeyboard    : false,             //{NEW} Boolean: Allow keyboard navigation to affect multiple sliders. Default behavior cuts out keyboard navigation with more than one slider present.
		mousewheel          : false,             //{UPDATED} Boolean: Requires jquery.mousewheel.js (https://github.com/brandonaaron/jquery-mousewheel) - Allows slider navigating via mousewheel
		pausePlay           : false,             //Boolean: Create pause/play dynamic element
		pauseText           : 'Pause',           //String: Set the text for the "pause" pausePlay item
		playText            : 'Play',            //String: Set the text for the "play" pausePlay item

		// Special properties
		controlsContainer   : "",                //{UPDATED} Selector: USE CLASS SELECTOR. Declare which container the navigation elements should be appended too. Default container is the FlexSlider element. Example use would be ".flexslider-container". Property is ignored if given element is not found.
		manualControls      : "",                //Selector: Declare custom control navigation. Examples would be ".flex-control-nav li" or "#tabs-nav li img", etc. The number of elements in your controlNav should match the number of slides/tabs.
		sync                : "",                //{NEW} Selector: Mirror the actions performed on this slider with another slider. Use with care.
		asNavFor            : "",                //{NEW} Selector: Internal property exposed for turning the slider into a thumbnail navigation for another slider
	});

/* --------------------------------------------------------------------------- */
/*  2.  Testimonials Slider (Flexslider)
/* --------------------------------------------------------------------------- */

	jQuery('.testimonials-carousel').flexslider({
		namespace           : "flex-",           //{NEW} String: Prefix string attached to the class of every element generated by the plugin
		//  selector            : ".slides > li",    //{NEW} Selector: Must match a simple pattern. '{container} > {slide}' -- Ignore pattern at your own peril
		animation           : "slide",           //String: Select your animation type, "fade" or "slide"
		easing              : "swing",           //{NEW} String: Determines the easing method used in jQuery transitions. jQuery easing plugin is supported!
		direction           : "horizontal",      //String: Select the sliding direction, "horizontal" or "vertical"
		reverse             : false,             //{NEW} Boolean: Reverse the animation direction
		animationLoop       : true,              //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
		smoothHeight        : true,              //{NEW} Boolean: Allow height of the slider to animate smoothly in horizontal mode
		startAt             : 0,                 //Integer: The slide that the slider should start on. Array notation (0 = first slide)
		slideshow           : false,             //Boolean: Animate slider automatically
		slideshowSpeed      : 7000,              //Integer: Set the speed of the slideshow cycling, in milliseconds
		animationSpeed      : 600,               //Integer: Set the speed of animations, in milliseconds
		initDelay           : 0,                 //{NEW} Integer: Set an initialization delay, in milliseconds
		randomize           : false,             //Boolean: Randomize slide order

		// Usability features
		pauseOnAction       : true,              //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
		pauseOnHover        : false,             //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
		useCSS              : true,             //{NEW} Boolean: Slider will use CSS3 transitions if available
		touch               : true,              //{NEW} Boolean: Allow touch swipe navigation of the slider on touch-enabled devices
		video               : false,             //{NEW} Boolean: If using video in the slider, will prevent CSS3 3D Transforms to avoid graphical glitches

		// Primary Controls
		controlNav          : false,             //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
		directionNav        : true,              //Boolean: Create navigation for previous/next navigation? (true/false)
		prevText            : "Previous",        //String: Set the text for the "previous" directionNav item
		nextText            : "Next",            //String: Set the text for the "next" directionNav item

		// Secondary Navigation
		keyboard            : true,              //Boolean: Allow slider navigating via keyboard left/right keys
		multipleKeyboard    : false,             //{NEW} Boolean: Allow keyboard navigation to affect multiple sliders. Default behavior cuts out keyboard navigation with more than one slider present.
		mousewheel          : false,             //{UPDATED} Boolean: Requires jquery.mousewheel.js (https://github.com/brandonaaron/jquery-mousewheel) - Allows slider navigating via mousewheel
		pausePlay           : false,             //Boolean: Create pause/play dynamic element
		pauseText           : 'Pause',           //String: Set the text for the "pause" pausePlay item
		playText            : 'Play',            //String: Set the text for the "play" pausePlay item

		// Special properties
		controlsContainer   : "",                //{UPDATED} Selector: USE CLASS SELECTOR. Declare which container the navigation elements should be appended too. Default container is the FlexSlider element. Example use would be ".flexslider-container". Property is ignored if given element is not found.
		manualControls      : "",                //Selector: Declare custom control navigation. Examples would be ".flex-control-nav li" or "#tabs-nav li img", etc. The number of elements in your controlNav should match the number of slides/tabs.
		sync                : "",                //{NEW} Selector: Mirror the actions performed on this slider with another slider. Use with care.
		asNavFor            : "",                //{NEW} Selector: Internal property exposed for turning the slider into a thumbnail navigation for another slider
	});

/* --------------------------------------------------------------------------- */
/*  2.  Tweets bar at footer (flexslider)
/* --------------------------------------------------------------------------- */

	// jQuery('.tweets').flexslider({
	// 	controlNav: true,
	// 	directionNav: false,
	// 	smoothHeight: true,
	// 	auto: false,
	// 	animation: "fade",
	// 	animationSpeed: 700,
	// 	slideshowSpeed: 5000,
	// });

/* --------------------------------------------------------------------------- */
/*  3.  Main Navigation
/* --------------------------------------------------------------------------- */

	var navigation = jQuery('#nav');
	// Regular nav
	navigation.on('mouseenter', 'li', function() {
		var target = jQuery(this),
			subMenu = target.children('ul');
		if (subMenu.length) target.addClass('hover');
		subMenu.hide().stop(true, true).delay(300).slideDown(150);
	}).on('mouseleave', 'li', function() {
		jQuery(this).delay(300).removeClass('hover').children('ul').stop(true, true).slideUp(70);
	});

	// Responsive nav
	selectnav('nav', {
		label: 'Navigation...',
		autoselect: false,
		nested: true,
		indent: '–-'
	});

/* --------------------------------------------------------------------------- */
/*  4.  Project Carousel
/* --------------------------------------------------------------------------- */

	(function() {
		var carousel = jQuery('.project-carousel');
		if (carousel.length) {
			var scrollCount;

			function getWindowWidth() {
				if (jQuery(window).width() < 480) {
					scrollCount = 1;
				} else if (jQuery(window).width() < 768) {
					scrollCount = 2;
				} else if (jQuery(window).width() < 980) {
					scrollCount = 3;
				} else {
					scrollCount = 4;
				}
			}


			function initCarousel(carousel) {
				jQuery('.jcarousel-control a').bind('click', function() {
					carousel.scroll(jcarousel.intval((this).text()));
					return false;
				});
				jQuery('#project-next').bind('click', function() {
					carousel.next();
					return false;
				});
				jQuery('#project-prev').bind('click', function() {
					carousel.prev();
					return false;
				});

				carousel.each(function() {
					jQuery(this).jcarousel({
						animation: 600,
						easing: 'easeOutCubic',
						scroll: scrollCount,
						buttonNextHTML: null,
						buttonPrevHTML: null
					});
				});
			}


			function adjustCarousel() {
				carousel.each(function() {
					var target = jQuery(this),
						lis = target.children('li');
					newWidth = lis.length * lis.first().outerWidth(true) + 100;
					getWindowWidth();

					if (target.width() !== newWidth) {
						target.css('width', newWidth)
							.data('resize', 'true');
						initCarousel(target);
						target.jcarousel('scroll', 1);
						var timer = window.setTimeout(function() {
							window.clearTimeout(timer);
							target.data('resize', null);
						}, 600);
					}
				});
			}


			getWindowWidth();
			initCarousel(carousel);


			// Window resize
			jQuery(window).on('resize', function() {
				var timer = window.setTimeout(function() {
					window.clearTimeout(timer);
					adjustCarousel();
				}, 30);
			});

		}

	})();

/* --------------------------------------------------------------------------- */
/*  5.  Responsive Video
/* --------------------------------------------------------------------------- */

	// jQuery('#content').fitVids();

/* --------------------------------------------------------------------------- */
/*  6.  Accordion
/* --------------------------------------------------------------------------- */

	// jQuery('.accordion').accordion({
	// 	collapsible: true,
	// 	autoHeight: false
	// });

	// //Accordion Refresh when window resize
	// jQuery(window).resize(function() {
	// 	jQuery(".accordion").accordion("refresh");
	// });

/* --------------------------------------------------------------------------- */
/*  7.  Tabs
/* --------------------------------------------------------------------------- */

	// jQuery('.tabs').tabs({
	// 	fx: {
	// 		opacity: 'toggle',
	// 		duration: 'fast'
	// 	}
	// });

/* --------------------------------------------------------------------------- */
/*  9. Fancybox
/* --------------------------------------------------------------------------- */

	// jQuery('.folio').fancybox({
	//     closeBtn        : false,
	//     padding         : 0,
	//     openEffect      : 'fade',
	//     closeEffect     : 'fade',
	//     nextEffect      : 'fade',
	//     prevEffect      : 'fade',
	//     helpers : {
	//         overlay : {
	//             css : {
	//                 'background' : 'rgba(51, 51, 51, 0.8)'
	//             }
	//         },
	//         title : {
	//             type : 'over'
	//         }
	//     }
	// });

/* --------------------------------------------------------------------------- */
/*  9. Isotope
/* --------------------------------------------------------------------------- */

	// disable isotop positioning with css transforms because fixed backgrounds are buggy when using css transforms in webkit

	jQuery('.post-block-feed').isotope({
		animationEngine: 'jquery'
		// transformsEnabled: false
	});

	(function() {

		// modified Isotope methods for gutters in masonry
		jQuery.Isotope.prototype._getMasonryGutterColumns = function() {
			var gutter = this.options.masonry && this.options.masonry.gutterWidth || 0;
			containerWidth = this.element.width();

			this.masonry.columnWidth = this.options.masonry && this.options.masonry.columnWidth ||
			// or use the size of the first item
			this.$filteredAtoms.outerWidth(true) ||
			// if there's no items, use size of container
			containerWidth;

			this.masonry.columnWidth += gutter;

			this.masonry.cols = Math.floor((containerWidth + gutter) / this.masonry.columnWidth);
			this.masonry.cols = Math.max(this.masonry.cols, 1);
		};

		jQuery.Isotope.prototype._masonryReset = function() {
			// layout-specific props
			this.masonry = {};
			// FIXME shouldn't have to call this again
			this._getMasonryGutterColumns();
			var i = this.masonry.cols;
			this.masonry.colYs = [];
			while (i--) {
				this.masonry.colYs.push(0);
			}
		};

		jQuery.Isotope.prototype._masonryResizeChanged = function() {
			var prevSegments = this.masonry.cols;
			// update cols/rows
			this._getMasonryGutterColumns();
			// return if updated cols/rows is not equal to previous
			return (this.masonry.cols !== prevSegments);
		};

		// Set Gutter width
		var gutterSize;

		function getWindowWidth() {
			if (jQuery(window).width() < 480) {
				gutterSize = 0;
			} else if (jQuery(window).width() < 768) {
				gutterSize = 10;
			} else if (jQuery(window).width() < 980) {
				gutterSize = 14;
			} else {
				gutterSize = 20;
			}
		}

		// Portfolio settings
		var container = jQuery('.project-feed');
		var filter = jQuery('.project-feed-filter');

		jQuery(window).smartresize(function() {
			getWindowWidth();
			container.isotope({
				filter: '*',
				resizable: true,
				// set columnWidth to a percentage of container width
				masonry: {
					gutterWidth: gutterSize
				}
			});
		});

		container.imagesLoaded(function() {
			jQuery(window).smartresize();
		});

		// Filter items when filter link is clicked
		filter.find('a').click(function() {
			var selector = jQuery(this).attr('data-filter');
			filter.find('a').removeClass('current');
			jQuery(this).addClass('current');
			container.isotope({
				filter: selector,
				animationOptions: {
					animationDuration: 750,
					easing: 'linear',
					queue: false,
				}
			});
			return false;
		});

		// Blog with Infinite Scroll settings
		var blogContainer = jQuery('.post-block-feed');

		jQuery(window).smartresize(function() {
			getWindowWidth();
			blogContainer.isotope({
				resizable: true,
				itemSelector: '.post-block',
				// set columnWidth to a percentage of container width
				masonry: {
					gutterWidth: gutterSize
				}
			});
		});

		blogContainer.imagesLoaded(function() {
			jQuery(window).smartresize();
		});

		blogContainer.infinitescroll({
				navSelector: '#page-nav', // selector for the paged navigation
				nextSelector: '#page-nav a', // selector for the NEXT link (to page 2)
				itemSelector: '.post-block', // selector for all items you'll retrieve
				loading: {
					loadingText: 'Loading new posts...',
					finishedMsg: 'No more pages to load'
				}
			},
			// call Isotope as a callback

			function(newElements) {
				var newElems = jQuery(newElements).css({
					opacity: 0
				});
				// ensure that images load before adding to masonry layout
				newElems.imagesLoaded(function() {
					// show elems now they're ready
					newElems.animate({
						opacity: 1
					});
					blogContainer.isotope('appended', newElems, true);
				});
			}
		);
	})();

/* --------------------------------------------------------------------------- */
/*  10. Back to Top
/* --------------------------------------------------------------------------- */

	var backToTop = jQuery('#back-to-top');
	backToTop.hide();
	jQuery(window).scroll(function() {
		if (jQuery(this).scrollTop() > 150) {
			backToTop.css('display', 'block');
		} else {
			backToTop.css('display', 'none');
		}
	});
	backToTop.click(function() {
		jQuery('body, html').animate({
			scrollTop: 0
		}, 600);
		return false;
	});

/* --------------------------------------------------------------------------- */
/*  11. Twitter Feed
/* --------------------------------------------------------------------------- */

	// jQuery('.twitter-feed').each(
	// 	function(i, val) {
	// 		uid = jQuery(val).attr('data-uid');
	// 		cnt = parseInt(jQuery(val).attr('data-count'));
	// 		if (isNaN(cnt)) {
	// 			cnt = 2;
	// 		}
	// 		jQuery(val).jTweetsAnywhere({
	// 			username: uid,
	// 			count: cnt,
	// 			showTweetFeed: {
	// 				showProfileImages: false,
	// 				showUserScreenNames: false,
	// 				showUserFullNames: false,
	// 				showInReplyTo: false,
	// 				showActionReply: false,
	// 				showActionRetweet: false,
	// 				showActionFavorite: false
	// 			}
	// 		});
	// 	}
	// );

/* --------------------------------------------------------------------------- */
/*  12. Flickr Feed
/* --------------------------------------------------------------------------- */

	// jQuery('.photo-stream').each(
	// 	function(i, val) {
	// 		uid = jQuery(val).attr('data-uid');
	// 		cols = parseInt(jQuery(val).attr('data-cols'));
	// 		if (isNaN(cols)) {
	// 			cols = 8;
	// 		}
	// 		jQuery(val).flickrfeed(uid, '', {
	// 			limit: cols,
	// 			title: false,
	// 			date: false,
	// 			imagesize: 'square'
	// 		});
	// 	}
	// );

/* --------------------------------------------------------------------------- */
/*  13. Skills
/* --------------------------------------------------------------------------- */

	// jQuery('.skillbar').each(function() {
	// 	dataperc = jQuery(this).attr('data-perc'),
	// 	jQuery(this).find('.skill-progress').animate({
	// 		"width": dataperc + "%"
	// 	}, dataperc * 20);
	// });

/* --------------------------------------------------------------------------- */
/*  14. Google Maps
/* --------------------------------------------------------------------------- */
	var gmaps = jQuery('.google-map');
	if (gmaps.length > 0) {
		jQuery.getScript("https://www.google.com/jsapi", function() {
			google.load('maps', '3', {
				other_params: 'sensor=false',
				callback: function() {
					gmaps.each(function() {
						var target = jQuery(this);
						var lat = target.attr('data-lat');
						var lng = target.attr('data-lng');
						var zoom = parseInt(target.attr("data-zoom"), 10) || 10;
						var title = target.attr('data-title');
						var map = null;
						var roadAtlasStyles = [{
							featureType: 'road.highway',
							elementType: 'geometry',
							stylers: [{
								hue: '#ff0022'
							}, {
								saturation: 60
							}, {
								lightness: -20
							}]
						}, {
							featureType: 'road.arterial',
							elementType: 'all',
							stylers: [{
								hue: '#2200ff'
							}, {
								lightness: -40
							}, {
								visibility: 'simplified'
							}, {
								saturation: 30
							}]
						}, {
							featureType: 'road.local',
							elementType: 'all',
							stylers: [{
								hue: '#f6ff00'
							}, {
								saturation: 50
							}, {
								gamma: 0.7
							}, {
								visibility: 'simplified'
							}]
						}, {
							featureType: 'road.local',
							elementType: 'labels',
							stylers: [{
								hue: '#0000ff'
							}, {
								saturation: 50
							}, {
								gamma: 0.9
							}, {
								visibility: 'simplified'
							}]
						}, {
							featureType: 'water',
							elementType: 'geometry',
							stylers: [{
								saturation: 40
							}, {
								lightness: 40
							}]
						}, {
							featureType: 'road.highway',
							elementType: 'labels',
							stylers: [{
								visibility: 'on'
							}, {
								saturation: 98
							}]
						}, {
							featureType: 'administrative.locality',
							elementType: 'labels',
							stylers: [{
								hue: '#0022ff'
							}, {
								saturation: 50
							}, {
								lightness: -10
							}, {
								gamma: 0.90
							}]
						}, {
							featureType: 'transit.line',
							elementType: 'geometry',
							stylers: [{
								hue: '#ff0000'
							}, {
								visibility: 'on'
							}, {
								lightness: -70
							}]
						}];

						var styledMap = new google.maps.StyledMapType(roadAtlasStyles, {
							name: "Styled Map"
						});
						latlng = new google.maps.LatLng(lat, lng),
						mapOptions = {
							zoom: zoom,
							center: latlng,
							panControl: false,
							zoomControl: true,
							scaleControl: false,
							mapTypeControl: true,
							mapTypeControlOptions: {
								mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
							}
						};
						map = new google.maps.Map(this, mapOptions);
						map.mapTypes.set('map_style', styledMap);
						map.setMapTypeId('map_style');
						var contentString = '<div id="google-map-marker"><h5 style="font-size:23px;color:#d0002e;margin-bottom: 12px;"><span style="font-size:28px;font-weight:400; color:#138f00">Klatschmohn</span><br>Naturkost GmbH</h5><p style="font-size: 20px; color: #525252;">Neuen Bäue 16<br>35390 Gießen<br><a target="_blank" style="color: #0032D0; font-size: 20px;" href="http://goo.gl/VCeET2">Route berechnen</a></p></div>';
						var infowindow = new google.maps.InfoWindow({
							content: contentString
						});
						var marker = new google.maps.Marker({
							position: latlng,
							map: map,
							title: title
						});
						google.maps.event.addListener(marker, 'click', function() {
							infowindow.open(map, marker);
						});
						googlemaps.push(map);
					});
				}
			});
		});
	}




/* --------------------------------------------------------------------------- */
/*  16. img class
/* --------------------------------------------------------------------------- */

	jQuery('a').has('img').addClass('img');

/* --------------------------------------------------------------------------- */
/*  17. get height of headings for hover effect
/* --------------------------------------------------------------------------- */

	var h2height = jQuery('.post-h2').height();
	h2height = h2height - 3;

	jQuery('.post-h2-link').hover(
		function() {
			jQuery(this).css('height', h2height);
		},
		function() {
			jQuery(this).css('height', '0px');
		}
	);

	var $item1Height = jQuery('.posts li:nth-child(1) .entry').height();
	var $item2Height = jQuery('.posts li:nth-child(2) .entry').height();
	var $item3Height = jQuery('.posts li:nth-child(3) .entry').height();
	var $item4Height = jQuery('.posts li:nth-child(4) .entry').height();
	var $item5Height = jQuery('.posts li:nth-child(5) .entry').height();

	jQuery('li:nth-child(1) > div > a.post-h4-link').hover(function() {
		jQuery(this).css('height', $item1Height - 3);
		jQuery('li:nth-child(1) > h4  > a.post-h4-link').addClass("hover");
	}, function() {
		jQuery('li:nth-child(1) > div > a.post-h4-link').css('height', '0px');
		jQuery('li:nth-child(1) > h4  > a.post-h4-link').removeClass("hover");
	});
	jQuery('li:nth-child(2) > div > a.post-h4-link').hover(function() {
		jQuery(this).css('height', $item2Height - 3);
		jQuery('li:nth-child(2) > h4  > a.post-h4-link').addClass("hover");
	}, function() {
		jQuery('li:nth-child(2) > div > a.post-h4-link').css('height', '0px');
		jQuery('li:nth-child(2) > h4  > a.post-h4-link').removeClass("hover");
	});
	jQuery('li:nth-child(3) > div > a.post-h4-link').hover(function() {
		jQuery(this).css('height', $item3Height - 3);
		jQuery('li:nth-child(3) > h4  > a.post-h4-link').addClass("hover");
	}, function() {
		jQuery('li:nth-child(3) > div > a.post-h4-link').css('height', '0px');
		jQuery('li:nth-child(3) > h4  > a.post-h4-link').removeClass("hover");
	});
	jQuery('li:nth-child(4) > div > a.post-h4-link').hover(function() {
		jQuery(this).css('height', $item4Height - 3);
		jQuery('li:nth-child(4) > h4  > a.post-h4-link').addClass("hover");
	}, function() {
		jQuery('li:nth-child(4) > div > a.post-h4-link').css('height', '0px');
		jQuery('li:nth-child(4) > h4  > a.post-h4-link').removeClass("hover");
	});
	jQuery('li:nth-child(5) > div > a.post-h4-link').hover(function() {
		jQuery(this).css('height', $item5Height - 3);
		jQuery('li:nth-child(5) > h4  > a.post-h4-link').addClass("hover");
	}, function() {
		jQuery('li:nth-child(5) > div > a.post-h4-link').css('height', '0px');
		jQuery('li:nth-child(5) > h4  > a.post-h4-link').removeClass("hover");
	});

/* --------------------------------------------------------------------------- */
/*  18. Bio Siegel page accordion
/* --------------------------------------------------------------------------- */

	var tabHeight = jQuery("div[style*='block']").height()

	jQuery('.biosiegel-tab').click(function() {
		jQuery('.biosiegel-tab').removeClass('on');
		jQuery('.biosiegel-content').slideUp('normal');
		if (jQuery(this).next().is(':hidden') === true) {
			jQuery(this).addClass('on');
			jQuery(this).next().slideDown('normal');
				jQuery('html, body').animate({
				scrollTop: jQuery("div[style*='block']").offset().top - 160
				}, 1000);
		}
	});
	jQuery('.biosiegel-tab').mouseover(function() {
		jQuery(this).addClass('over');
	}).mouseout(function() {
		jQuery(this).removeClass('over');
	});
	jQuery('.biosiegel-content').hide();

/* --------------------------------------------------------------------------- */
/* 19. Search input
/* --------------------------------------------------------------------------- */

	jQuery("#s").before("<i id='ss' class='icon-search'></i>");

	var sS = jQuery('#ss');

	jQuery('#s').focus(function() {
		sS.addClass('focussed');
	});

	jQuery('#s').blur(function() {
		sS.removeClass('focussed');
	});

/* --------------------------------------------------------------------------- */
/* 20. Hacks
/* --------------------------------------------------------------------------- */

	if (!Modernizr.csstransitions){

		jQuery("#footer > div > div > div > ul, #footer > div > div:nth-child(1) > div > div, #footer #speiseplan").hover(
			function() {
				jQuery(this).animate({'border-radius': '4px'},              300)
							.animate({'top': '81px','height': '290px'},     300)
							.animate({'box-shadow': 'none'},  300)
							.animate({'background-color': 'rgba(255.255.255.0.1)'}, 500);
			}, function() {
				jQuery(this).animate({'top': '120px','height': '216px'},	500)
							.animate({'border-radius': '50%'},				500)
							.animate({'box-shadow': 'inset 0 0 0 67px #54BC43'},500);
			}
		);


		// jQuery('.animation').fadeOut();
		jQuery('.animation').waypoint( {
			offset: '67%',
			handler: function() {
				jQuery(this).animate({'opacity': '1'}, 500);
			}
		});

		jQuery(window).load(function() {
			jQuery('h1.page-title').animate({'opacity': '1','letter-spacing': '-2px'},500);
		});


	}



/* --------------------------------------------------------------------------- */
/* 21. Waypoints
/* --------------------------------------------------------------------------- */

	if (Modernizr.csstransitions){
		jQuery('#content').addClass('icanhas-transitions');

		jQuery('.animation').waypoint( {
			offset: '83%',
			handler: function() {
				jQuery(this).addClass('animated');
			}
		});
	}

/* --------------------------------------------------------------------------- */
/* Closes the Global Scope Container
/* --------------------------------------------------------------------------- */



});


jQuery(window).load(function(){
	jQuery("h1.page-title").addClass('loaded');
})