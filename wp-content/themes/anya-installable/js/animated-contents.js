var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
};

var BrowserDetect = {
    init: function () {
        this.browser = this.searchString(this.dataBrowser) || "An unknown browser";
        this.version = this.searchVersion(navigator.userAgent) || this.searchVersion(navigator.appVersion) || "an unknown version";
        this.OS = this.searchString(this.dataOS) || "an unknown OS"
    },
    searchString: function (a) {
        for (var b = 0; b < a.length; b++) {
            var c = a[b].string;
            var d = a[b].prop;
            this.versionSearchString = a[b].versionSearch || a[b].identity;
            if (c) {
                if (c.indexOf(a[b].subString) != -1) return a[b].identity
            } else if (d) return a[b].identity
        }
    },
    searchVersion: function (a) {
        var b = a.indexOf(this.versionSearchString);
        if (b == -1) return;
        return parseFloat(a.substring(b + this.versionSearchString.length + 1))
    },
    dataBrowser: [{
        string: navigator.userAgent,
        subString: "Chrome",
        identity: "Chrome"
    }, {
        string: navigator.userAgent,
        subString: "OmniWeb",
        versionSearch: "OmniWeb/",
        identity: "OmniWeb"
    }, {
        string: navigator.vendor,
        subString: "Apple",
        identity: "Safari",
        versionSearch: "Version"
    }, {
        prop: window.opera,
        identity: "Opera",
        versionSearch: "Version"
    }, {
        string: navigator.vendor,
        subString: "iCab",
        identity: "iCab"
    }, {
        string: navigator.vendor,
        subString: "KDE",
        identity: "Konqueror"
    }, {
        string: navigator.userAgent,
        subString: "Firefox",
        identity: "Firefox"
    }, {
        string: navigator.vendor,
        subString: "Camino",
        identity: "Camino"
    }, {
        string: navigator.userAgent,
        subString: "Netscape",
        identity: "Netscape"
    }, {
        string: navigator.userAgent,
        subString: "MSIE",
        identity: "Explorer",
        versionSearch: "MSIE"
    }, {
        string: navigator.userAgent,
        subString: "Gecko",
        identity: "Mozilla",
        versionSearch: "rv"
    }, {
        string: navigator.userAgent,
        subString: "Mozilla",
        identity: "Netscape",
        versionSearch: "Mozilla"
    }],
    dataOS: [{
        string: navigator.platform,
        subString: "Win",
        identity: "Windows"
    }, {
        string: navigator.platform,
        subString: "Mac",
        identity: "Mac"
    }, {
        string: navigator.userAgent,
        subString: "iPhone",
        identity: "iPhone/iPod"
    }, {
        string: navigator.platform,
        subString: "Linux",
        identity: "Linux"
    }]
};
BrowserDetect.init();

$ = (jQuery);
/*portfolio items*/
function animateE($el, index, fw, remove) {
	if (fw){
		$('.'+fw).addClass('animated '+$('#anya_thumbnails_effect').html());
		$('.'+fw).css('opacity', '1');
		$('body > .fullwidth-section .'+fw).css({
			'animation':$('.everything .'+fw).css('animation'),
			'-webkit-animation':$('.everything .'+fw).css('-webkit-animation'),
			'-moz-animation':$('.everything .'+fw).css('-moz-animation'),
			'-ms-animation':$('.everything .'+fw).css('-ms-animation'),
			'-o-animation':$('.everything .'+fw).css('-o-animation')
		});
		if (window.BrowserDetect.browser === "Firefox" || window.BrowserDetect.browser === "Safari" || window.BrowserDetect.browser === "Explorer" || window.BrowserDetect.browser === "Chrome"){
			$('body > .fullwidth-section .'+fw).css({
				'animation-delay':$('.everything .'+fw).css('animation-delay'),
				'-moz-animation-delay':$('.everything .'+fw).css('-moz-animation-delay'),
			});
		}
		if ($('body').hasClass('page-template-template-projects1-php') || $('body').hasClass('page-template-template-projects2-php') || $('body').hasClass('archive')){
			var time = 2000 + ($('.'+fw).index() * 300);
			setTimeout(function(){
				$('.'+fw).removeClass('animated').removeClass($('#anya_thumbnails_effect').html());
			}, time);
		}
	} else { 
		$el.css('opacity', '1');
		if (window.BrowserDetect.browser === "Firefox" || window.BrowserDetect.browser === "Chrome"){
			if ($('body').hasClass('page-template-template-projects1-php') || $('body').hasClass('page-template-template-projects2-php') || $('body').hasClass('archive')){
				$('#da-thumbs > li').each(function(){
					$(this).addClass('animated').css('animation-name', $('#anya_thumbnails_effect').html());
					var time = 2000 + ($(this).index() * 300);
					setTimeout(function(){
						$('#projects-2 .da-thumbs > li').removeClass('animated').css('animation-name','basofias');
					}, time);
				});
			}
		} else {
			$el.addClass('animated '+$('#anya_thumbnails_effect').html());
		}
	}
}

/* BEGIN: ANIMATED CONTENTS */
(function($){

	"use strict";
	
	$(document).ready(function(){

		/* define if you want to display the contents animation (true|false) */
		var effectsOnMobiles = false;
		
		var doAnimations = false;
		if (isMobile.any() && effectsOnMobiles) doAnimations = true;
		if (isMobile.any() && !effectsOnMobiles) doAnimations = false;
		if (!isMobile.any()) doAnimations = true;
		
		if (doAnimations){
			/*
			-----------------------------------------------------------------------------
			  ANIMATE PORTFOLIO ITEMS
			-----------------------------------------------------------------------------
			*/
			
			window.currentParentID = "";
			if ($('.slides_item').length && $('#anya_thumbnails_effect').html() != "none"){
				var delay = 0;
				var scrollDelay = 0;
				var offset = 0;
				var currentParentID = "";
				$('.slides_item').each(function(e){
					if (window.currentParentID == ""){
						window.currentParentID = $(this).closest('section').attr('id');
					} else {
						if (window.currentParentID != $(this).closest('section').attr('id')){
							window.currentParentID = $(this).closest('section').attr('id');
							delay = 0;
							scrollDelay = 0;
						}
					}
					var fw = false;
					
					if (currentParentID != ""){
						if ($(this).closest('section').attr('id') != currentParentID){
							currentParentID = $(this).closest('section').attr('id');
							delay = 0;
						} else {
							delay += 0.3;
						}
						$(this).closest('.da-thumbs').parent().css('opacity',0);
						if ($(this).parents('.fullwidth-section')){
							$(this).closest('.da-thumbs').parent().addClass('fwProj-'+e);
							fw = 'fwProj-'+e;
						}
						$(this).waypoint({
							handler: function() {
								animateE($(this).closest('.da-thumbs').parent(), e, fw);
							},
							offset: '88%',
							triggerOnce: true
						}, function(){ $.waypoints("refresh"); });
						$(this).closest('.da-thumbs').parent().css({
							"-webkit-animation-delay": delay+'s',
						    "-moz-animation-delay": delay+'s',
						    "-ms-animation-delay": delay+'s',
						    "-o-animation-delay": delay+'s'
						});	
					} else {
						if ($(this).parents('.carousel-wrap').length){
							scrollDelay += 0.3;
							if ($(this).closest('.da-thumbs').length){
								/* style 2*/ 
								$(this).closest('.da-thumbs').parent().css('opacity',0);
								var el = $(this).closest('.da-thumbs').parent();
								if ($(this).parents('.fullwidth-section')){
									$(el).addClass('fwProj-'+e);
									fw = 'fwProj-'+e;
								}
								$(el).closest('.slides_container').waypoint({
									handler: function() {
										animateE($(el), e, fw);
									},
									offset: '88%',
									triggerOnce: true
								}, function(){ $.waypoints("refresh"); });
								$(this).closest('.da-thumbs').parent().css({
									"-webkit-animation-delay": scrollDelay+'s',
								    "-moz-animation-delay": scrollDelay+'s',
								    "-ms-animation-delay": scrollDelay+'s',
								    "-o-animation-delay": scrollDelay+'s'
								});	
							} else { 
								/* style 1*/
								$(this).parent().css('opacity',0);
								var el = $(this).parent();
								if ($(this).parents('.fullwidth-section')){
									$(el).addClass('fwProj-'+e);
									fw = 'fwProj-'+e;
								}
								$(el).closest('.slides_container').waypoint({
									handler: function() {
										animateE($(el), e, fw);
									},
									offset: '88%',
									triggerOnce: true
								}, function(){ $.waypoints("refresh"); });
								$(this).parent().css({
									"-webkit-animation-delay": scrollDelay+'s',
								    "-moz-animation-delay": scrollDelay+'s',
								    "-ms-animation-delay": scrollDelay+'s',
								    "-o-animation-delay": scrollDelay+'s'
								});	
							}
						} else {
							delay += 0.3;
							if ($('body').hasClass('page-template-template-projects1-php') || $('body').hasClass('page-template-template-projects2-php') || $('body').hasClass('archive')){ 
								/* style 1 & 2 project templates */
								$(this).css('opacity',0);
								var el = $(this);
								if ($(this).parents('.fullwidth-section').length){
									$(el).addClass('fwProj-'+e);
									fw = 'fwProj-'+e;
								}
								$(el).parents('.thumbnails_list').waypoint({
									handler: function() {
										animateE($(el), e, fw, true);
									},
									offset: '88%',
									triggerOnce: true
								}, function(){ $.waypoints("refresh"); });
								$(el).css({
									"-webkit-animation-delay": delay+'s',
								    "-moz-animation-delay": delay+'s',
								    "-ms-animation-delay": delay+'s',
								    "-o-animation-delay": delay+'s'
								});	
							} else {
								if ($(this).parents('.indproj2').length){
									/* style 2 */
									$(this).parents('.indproj2').css('opacity',0);
									var el = $(this).parents('.indproj2');
									if ($(this).parents('.fullwidth-section')){
										$(el).addClass('fwProj-'+e);
										fw = 'fwProj-'+e;
									}
									$(el).parents('.project_list_s4').waypoint({
										handler: function() {
											animateE($(el), e, fw);
										},
										offset: '88%',
										triggerOnce: true
									}, function(){ $.waypoints("refresh"); });
									$(el).css({
										"-webkit-animation-delay": delay+'s',
									    "-moz-animation-delay": delay+'s',
									    "-ms-animation-delay": delay+'s',
									    "-o-animation-delay": delay+'s'
									});	
								} else {
									/* style 1 */
									$(this).parent().css('opacity',0);
									var el = $(this).parent();
									if ($(this).parents('.fullwidth-section')){
										$(el).addClass('fwProj-'+e);
										fw = 'fwProj-'+e;
									}
									$(el).closest('.slides_container').waypoint({
										handler: function() {
											animateE($(el), e, fw);
										},
										offset: '88%',
										triggerOnce: true
									}, function(){ $.waypoints("refresh"); });
									$(this).parent().css({
										"-webkit-animation-delay": delay+'s',
									    "-moz-animation-delay": delay+'s',
									    "-ms-animation-delay": delay+'s',
									    "-o-animation-delay": delay+'s'
									});
								}		
							}
						}
					}
				});
			}				
			
			
			/*
			-----------------------------------------------------------------------------
			  ANIMATE SHORTCODE IMAGE
			-----------------------------------------------------------------------------
			*/
			$('.image-sh:not(.shortcode-img)').each(function(e){
				if (getEffect($(this)) != false){
					if (window.BrowserDetect.browser === "Firefox" || window.BrowserDetect.browser === "Explorer" || window.BrowserDetect.browser === "Chrome") $(this).addClass('animated').css('animation-name','fadjecas');
					$(this).css('opacity', '0');
					if ($(this).parents('.fullwidth-section')){
						$(this).addClass('fwImage-'+e);
						$(this).waypoint({
							handler: function() {
								imagesh(e, 'fwImage-'+e);
							},
							offset: '80%',
							triggerOnce: true
						}, function(){ $.waypoints("refresh"); });	
					} else {
						$(this).waypoint({
							handler: function() {
								imagesh(e);
							},
							offset: '80%',
							triggerOnce: true
						}, function(){ $.waypoints("refresh"); });	
					}	
				}
			});
			
			$('.shortcode-img.image-sh').each(function(e){
				if (getEffect($(this)) != false){
					if (window.BrowserDetect.browser === "Firefox" || window.BrowserDetect.browser === "Explorer" || window.BrowserDetect.browser === "Chrome") $(this).addClass('animated').css('animation-name','fadjecas');
					$(this).css('opacity', '0');		
					if ($(this).parents('.fullwidth-section')){
						$(this).addClass('fwImageS-'+e);
						$(this).waypoint({
							handler: function() {
								imagesh_new(e, 'fwImageS-'+e);
							},
							offset: '80%',
							triggerOnce: true
						}, function(){ $.waypoints("refresh"); });	
					} else {
						$(this).waypoint({
							handler: function() {
								imagesh_new(e);
							},
							offset: '80%',
							triggerOnce: true
						}, function(){ $.waypoints("refresh"); });	
					}	
				}
			});
			
			/*
			-----------------------------------------------------------------------------
			  ANIMATE SHORTCODE TESTIMONIALS - CLIENTS IMAGE
			-----------------------------------------------------------------------------
			*/

			$('.featured_image').each(function(e){
				if (!$(this).parents('.deswidget').length){
					if (getEffect($(this)) != false){
						if (window.BrowserDetect.browser === "Firefox" || window.BrowserDetect.browser === "Explorer" || window.BrowserDetect.browser === "Chrome") $(this).addClass('animated').css('animation-name','fadjecas');
						$(this).css('opacity', '0');
						if ($(this).parents('.fullwidth-section')){
							$(this).addClass('fwImageCT-'+e);
							$(this).waypoint({
								handler: function() {
									imagect(e, 'fwImageCT-'+e);
								},
								offset: '80%',
								triggerOnce: true
							}, function(){ $.waypoints("refresh"); });	
						} else {
							$(this).waypoint({
								handler: function(){
									imagect(e);
								},
								offset: '100%',
								triggerOnce: true
							}, function(){ $.waypoints("refresh"); });
						}	
					}	
				}	
			});
			
			/*
			-----------------------------------------------------------------------------
			  ANIMATE icons
			-----------------------------------------------------------------------------
			*/
			$('p.designare_icon').each(function(e){
				if (getEffect($(this)) != false){
					if (window.BrowserDetect.browser === "Firefox" || window.BrowserDetect.browser === "Explorer" || window.BrowserDetect.browser === "Chrome") $(this).addClass('animated').css('animation-name','fadjecas');
					$(this).css('opacity', '0');
					if ($(this).parents('.fullwidth-section')){
						$(this).addClass('fwIcon-'+e);
						$(this).waypoint({
							handler: function() {
								icon(e, 'fwIcon-'+e);
							},
							offset: '80%',
							triggerOnce: true
						}, function(){ $.waypoints("refresh"); });	
					} else {
						$(this).waypoint({
							handler: function(){
								icon(e);
							},
							offset: '100%',
							triggerOnce: true
						}, function(){ $.waypoints("refresh"); });
					}	
				}
			});
			
			/*
			-----------------------------------------------------------------------------
			  ANIMATE icon fa alone
			-----------------------------------------------------------------------------
			*/
			$('.iconfa').each(function(e){
				if (getEffect($(this)) != false){
					if (window.BrowserDetect.browser === "Firefox" || window.BrowserDetect.browser === "Explorer" || window.BrowserDetect.browser === "Chrome") $(this).addClass('animated').css('animation-name','fadjecas');
					$(this).css('opacity', '0');
					if ($(this).parents('.fullwidth-section')){
						$(this).addClass('fwIconFa-'+e);
						$(this).waypoint({
							handler: function() {
								iconfa(e, 'fwIconFa-'+e);
							},
							offset: '80%',
							triggerOnce: true
						}, function(){ $.waypoints("refresh"); });	
					} else {
						$(this).waypoint({
							handler: function(){
								iconfa(e);
							},
							offset: '100%',
							triggerOnce: true
						}, function(){ $.waypoints("refresh"); });
					}	
				}
			});
			
			/*
			-----------------------------------------------------------------------------
			  ANIMATE Button
			-----------------------------------------------------------------------------
			*/

			$('.des-sc-button.button').each(function(e){
				if (getEffect($(this)) != false){
					/* if (window.BrowserDetect.browser === "Firefox" || window.BrowserDetect.browser === "Explorer" || window.BrowserDetect.browser === "Chrome")*/ $(this).addClass('animated').css('animation-name','fadjecas').css('opacity',0); 
					if ($(this).parents('.fullwidth-section')){
						$(this).addClass('fwButton-'+e);
						$(this).waypoint({
							handler: function() {
								button(e, 'fwButton-'+e);
							},
							offset: '80%',
							triggerOnce: true
						}, function(){ $.waypoints("refresh"); });	
					} else {
						$(this).waypoint({
							handler: function(){
								button(e);
							},
							offset: '100%',
							triggerOnce: true
						}, function(){ $.waypoints("refresh"); });
					}	
				}
			});		
		}
	});
})(jQuery);
	
/*
---------------------------------------------------------------------------------
	FUNCTION TO ANIMATE ALL YOUR PROJECTS ITEMS
---------------------------------------------------------------------------------
*/
function imagesh(e, fw) {
	if (fw) {
		if(!Modernizr.csstransitions){
			$('.'+fw).animate({'opacity':1,'filter':'alpha(opacity=100)'}, 500);
		} else {
			$('.'+fw).addClass('animated');
			$('.'+fw).css('opacity', '1');
			$('body > .fullwidth-section .'+fw).css({
				'animation':$('.everything .'+fw).css('animation'),
				'-webkit-animation':$('.everything .'+fw).css('-webkit-animation'),
				'-moz-animation':$('.everything .'+fw).css('-moz-animation'),
				'-ms-animation':$('.everything .'+fw).css('-ms-animation'),
				'-o-animation':$('.everything .'+fw).css('-o-animation')
			});
			if (window.BrowserDetect.browser === "Firefox" || window.BrowserDetect.browser === "Explorer" || window.BrowserDetect.browser === "Chrome"){
				var effect = getEffect($('.'+fw));
				$('.'+fw).css('animation-name',effect);
				$('body > .fullwidth-section .'+fw).css({
					'animation-delay':$('.everything .'+fw).css('animation-delay'),
					'-moz-animation-delay':$('.everything .'+fw).css('-moz-animation-delay'),
				});
			}	
		}
	} else {
		$('.image-sh:not(.shortcode-img)').eq(e).addClass('animated');
	}
}

function imagesh_new(e, fw) {
	if (fw){

		if(!Modernizr.csstransitions){
			$('.'+fw).animate({'opacity':1,'filter':'alpha(opacity=100)'}, 500);
		} else {
			$('.'+fw).addClass('animated');
			$('.'+fw).css('opacity', '1');
			$('body > .fullwidth-section .'+fw).css({
				'animation':$('.everything .'+fw).css('animation'),
				'-webkit-animation':$('.everything .'+fw).css('-webkit-animation'),
				'-moz-animation':$('.everything .'+fw).css('-moz-animation'),
				'-ms-animation':$('.everything .'+fw).css('-ms-animation'),
				'-o-animation':$('.everything .'+fw).css('-o-animation')
			});
			if (window.BrowserDetect.browser === "Firefox" || window.BrowserDetect.browser === "Explorer" || window.BrowserDetect.browser === "Chrome"){
				var effect = getEffect($('.'+fw));
				$('.'+fw).css('animation-name',effect);
				$('body > .fullwidth-section .'+fw).css({
					'animation-delay':$('.everything .'+fw).css('animation-delay'),
					'-moz-animation-delay':$('.everything .'+fw).css('-moz-animation-delay'),
				});
			}	
		}
	} else {
		$('.shortcode-img.image-sh').eq(e).addClass('animated');
	}
}

function imagect(e, fw) {
	if (fw){
		if(!Modernizr.csstransitions){
			$('.'+fw).animate({'opacity':1,'filter':'alpha(opacity=100)'}, 500);
		} else {
			$('.'+fw).addClass('animated');
			$('.'+fw).css('opacity', '1');
			$('body > .fullwidth-section .'+fw).css({
				'animation':$('.everything .'+fw).css('animation'),
				'-webkit-animation':$('.everything .'+fw).css('-webkit-animation'),
				'-moz-animation':$('.everything .'+fw).css('-moz-animation'),
				'-ms-animation':$('.everything .'+fw).css('-ms-animation'),
				'-o-animation':$('.everything .'+fw).css('-o-animation')
			});
			if (window.BrowserDetect.browser === "Firefox" || window.BrowserDetect.browser === "Explorer" || window.BrowserDetect.browser === "Chrome"){
				var effect = getEffect($('.'+fw));
				$('.'+fw).css('animation-name',effect);
				$('body > .fullwidth-section .'+fw).css({
					'animation-delay':$('.everything .'+fw).css('animation-delay'),
					'-moz-animation-delay':$('.everything .'+fw).css('-moz-animation-delay'),
				});
			}	
		}		
	} else {
		$('.featured_image').eq(e).addClass('animated');
	}
}

function icon(e, fw) {
	if (fw){
		if(!Modernizr.csstransitions){
			$('.'+fw).animate({'opacity':1,'filter':'alpha(opacity=100)'}, 500);
		} else {
			$('.'+fw).addClass('animated');
			$('.'+fw).css('opacity', '1');
			$('body > .fullwidth-section .'+fw).css({
				'animation':$('.everything .'+fw).css('animation'),
				'-webkit-animation':$('.everything .'+fw).css('-webkit-animation'),
				'-moz-animation':$('.everything .'+fw).css('-moz-animation'),
				'-ms-animation':$('.everything .'+fw).css('-ms-animation'),
				'-o-animation':$('.everything .'+fw).css('-o-animation')
			});
			if (window.BrowserDetect.browser === "Firefox" || window.BrowserDetect.browser === "Explorer" || window.BrowserDetect.browser === "Chrome"){
				var effect = getEffect($('.'+fw));
				$('.'+fw).css('animation-name',effect);
				$('.'+fw).css('animation-name',effect);
				$('body > .fullwidth-section .'+fw).css({
					'animation-delay':$('.everything .'+fw).css('animation-delay'),
					'-moz-animation-delay':$('.everything .'+fw).css('-moz-animation-delay'),
				});
				
				if(!Modernizr.csstransitions){
					$('.'+fw).animate({'opacity':1,'filter':'alpha(opacity=100)'}, 1000);
				}
			}	
		}
	} else {
		$('p.designare_icon').eq(e).addClass('animated');	
	}
}

function iconfa(e, fw) {
	if (fw){
		if(!Modernizr.csstransitions){
			$('.'+fw).animate({'opacity':1,'filter':'alpha(opacity=100)'}, 500);
		} else {
			$('.'+fw).addClass('animated');
			$('.'+fw).css('opacity', '1');
			$('body > .fullwidth-section .'+fw).css({
				'animation':$('.everything .'+fw).css('animation'),
				'-webkit-animation':$('.everything .'+fw).css('-webkit-animation'),
				'-moz-animation':$('.everything .'+fw).css('-moz-animation'),
				'-ms-animation':$('.everything .'+fw).css('-ms-animation'),
				'-o-animation':$('.everything .'+fw).css('-o-animation')
			});
			if (window.BrowserDetect.browser === "Firefox" || window.BrowserDetect.browser === "Explorer" || window.BrowserDetect.browser === "Chrome"){
				var effect = getEffect($('.'+fw));
				$('.'+fw).css('animation-name',effect);
				$('body > .fullwidth-section .'+fw).css({
					'animation-delay':$('.everything .'+fw).css('animation-delay'),
					'-moz-animation-delay':$('.everything .'+fw).css('-moz-animation-delay'),
				});
			}	
		}
	} else {
		$('.iconfa').eq(e).addClass('animated');
	}
}

function button(e, fw) {
	if (fw){
		if(!Modernizr.csstransitions){
			$('.'+fw).animate({'opacity':1,'filter':'alpha(opacity=100)'}, 500);
		} else {
			$('.'+fw).addClass('animated');
			$('.'+fw).css('opacity', '1');
			$('body > .fullwidth-section .'+fw).css({
				'animation':$('.everything .'+fw).css('animation'),
				'-webkit-animation':$('.everything .'+fw).css('-webkit-animation'),
				'-moz-animation':$('.everything .'+fw).css('-moz-animation'),
				'-ms-animation':$('.everything .'+fw).css('-ms-animation'),
				'-o-animation':$('.everything .'+fw).css('-o-animation')
			});
			if (window.BrowserDetect.browser === "Firefox" || window.BrowserDetect.browser === "Explorer" || window.BrowserDetect.browser === "Chrome"){
				var effect = getEffect($('.'+fw));
				$('.'+fw).css('animation-name',effect);
				$('body > .fullwidth-section .'+fw).css({
					'animation-delay':$('.everything .'+fw).css('animation-delay'),
					'-moz-animation-delay':$('.everything .'+fw).css('-moz-animation-delay'),
				});
			}	
		}
	} else {
		$('.des-sc-button.button').eq(e).addClass('animated');
	}
}

function getEffect(el){
	var effects = ['flip', 'flipInX', 'bounceIn', 'bounceInDown', 'bounceInUp', 'bounceInLeft', 'bounceInRight', 'fadeIn', 'fadeInUp', 'fadeInDown', 'fadeInLeft', 'fadeInRight', 'fadeInUpBig', 'fadeInDownBig', 'fadeInLeftBig', 'fadeInRightBig', 'rotateIn', 'rotateInDownLeft', 'rotateInDownRight', 'rotateInUpLeft', 'rotateInUpRight', 'lightSpeedIn', 'lightSpeedOut', 'hinge', 'rollIn', 'rollOut'];
	var effect = false;
	for (var i=0; i<effects.length; i++){
		if (el.hasClass(effects[i])) {
			effect = effects[i];
		} 
	}
	effect = effect.toString();
	return effect;
}
