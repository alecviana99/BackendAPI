(function($) { 

	"use strict";
	
	/* ==============================================
	Browser detact 
	=============================================== */	
	$.browser.chrome = $.browser.webkit && !!window.chrome;
	$.browser.safari = $.browser.webkit && !window.chrome;

	var	mobileTest;
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
		mobileTest = true;
		$('body').addClass('mobile');
	}else {
        mobileTest = false;
        $("body").addClass("no-mobile");
    }
	
	if ($.browser.chrome) {
		$('body').addClass('chrome');		
	}
	
	if ($.browser.safari) {
		$('body').addClass('safari');
	}
	
	if( $('body').hasClass('safari') ) {
		/* section image repeat */

	}	
	
	/* ==============================================
	window on load  
	=============================================== */	
	$(window).load(function(){
                
        $(window).trigger("scroll");
        $(window).trigger("resize");
        
    });
	
	/* ==============================================
	document ready fucntion
	=============================================== */	
	 $(document).ready(function(){        
		
		/* ==============================================
		navigation 
		=============================================== */		
        $(window).trigger("resize");            
        init_menu();       
		
		/* ==============================================
		Scroll reveal
		=============================================== */	
		
		window.scrollReveal = new scrollReveal();
		
		/* ==============================================
		smooth scroll
		=============================================== */	
		
		init_smoothScroll();		
	
		/* ==============================================
		Height 100%
		=============================================== */		
		js_hight_fullscreen();
		
		/* ==============================================
		Parallax
		=============================================== */
		
		init_parallax();
		
		/* ==============================================
		Lightbox
		=============================================== */
	
		init_lightbox2();
		/* ==============================================
		Counter
		=============================================== */
		init_counters();
		
		/* ==============================================
		Gallery slider initialization 
		=============================================== */
		
		//init_gallery_slider();		

		/* ==============================================
		Scroll top
		=============================================== */		
       
        init_scrolltop();      
		init_scrollbottom();  
		/* ==============================================
		Process Animated item block
		=============================================== */	
		
		init_services();
		service_height_init();
		
		$(".slidingDiv1").hide();
		$(".show_hide_section").show(800);
		$('.show_hide_section').click(function() {
			$('.slidingDiv1').slideToggle('slow', function() {  });
		});
		/* ==============================================
		Home latest project slider
		=============================================== */	
		
		$("#owl-latest-project").owlCarousel({
			navigation: true,
			pagination: false,
			autoPlay:5000,
			items: 3,
			itemsDesktop: [1199, 3],
            itemsTabletSmall: [768, 2],
            itemsMobile: [480, 1],
			navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
		});
		
		/* ==============================================
		Service slider
		=============================================== */	
		
		$("#owl-services").owlCarousel({
			navigation: true,
			pagination: true,
			autoPlay:5000,
			items: 3,
			itemsDesktop: [3000,3],
			itemsDesktopSmall: [1440,3],
			itemsTablet:[1024,2],
			itemsTabletSmall: [768,1],
			itemsMobile: [480,1],
			
			navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
		});
		
		/* ==============================================
		Home latest Product shop
		=============================================== */	
		
		$("#owl-product-shop").owlCarousel({
			navigation: true,
			pagination: false,
			autoPlay:5000,
			items: 3,
			itemsDesktop: [1199, 3],
            itemsTabletSmall: [768, 2],
            itemsMobile: [480, 1],
			navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
		});
		
		
		/* ==============================================
		Home Gallery slider
		=============================================== */	
		
		$("#owl-gallery-slider").owlCarousel({
			navigation: true,
			pagination: false,
			autoPlay:5000,
			items: 3,
			itemsDesktop : [1000,2], //5 items between 1000px and 901px
			itemsDesktopSmall : [900,2], // betweem 900px and 601px
			itemsTablet: [600,1], //2 items between 600 and 0
			navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
		});
		
		$("#owl-gallery-slider2").owlCarousel({
 
			navigation : true, // Show next and prev buttons
			slideSpeed : 300,
			paginationSpeed : 400,
			singleItem:true,
			navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"] 
			// "singleItem:true" is a shortcut for:
			// items : 1,
			// itemsDesktop : false,
			// itemsDesktopSmall : false,
			// itemsTablet: false,
			// itemsMobile : false
			 
		});
		
		/* ==============================================
		Content slider
		=============================================== */	
		$(".owl-content-slider").owlCarousel({
 
			navigation : true, // Show next and prev buttons
			slideSpeed : 300,
			paginationSpeed : 400,
			singleItem:true,
			navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"] 			
			 
		});
		
		
		/*=================================================================
		Index parallax-7 Header text slider
		===================================================================*/ 
	
		$("#index7-slider").owlCarousel({
			navigation: false,
			pagination: true,			
			items: 1,
			navigationText: false,
			autoPlay:4000,
			itemsDesktop: [3000,1],
			itemsDesktopSmall: [1440,1],
			itemsTablet:[1024,1],
			itemsTabletSmall: [600,1],
			itemsMobile: [360,1],
			transitionStyle : "fadeUp"			
		});

		/*=================================================================
		Service slider
		===================================================================*/ 
	
		$("#owl-service-slider").owlCarousel({
			navigation: false,
			pagination: true,
			responsive: true,
			touchDrag: true,
			mouseDrag: true,
			autoHeight: true,
			items: 1,
			autoPlay:false,
			itemsDesktop: [3000,1],
			itemsDesktopSmall: [1440,1],
			itemsTablet:[1024,1],
			itemsTabletSmall: [600,1],
			itemsMobile: [360,1],
			transitionStyle : "fade"
		});
		/* ==============================================
		Parallax section slider
		=============================================== */	
		
		$("#owl-ps-slider").owlCarousel({
			pagination: true,
			autoPlay:4000,
			items: 1,
			itemsDesktop: [1199, 1],
            itemsTabletSmall: [768, 1],
            itemsMobile: [480, 1],
			navigation: false
		});
		
		/* ==============================================
		Parallax section slider
		=============================================== */	
		
		$("#owl-ps-slider2").owlCarousel({
			pagination: true,
			autoPlay:4000,
			items: 5,
			itemsDesktop: [1199, 3],
            itemsTabletSmall: [768, 2],
            itemsMobile: [480, 1],
			navigation: false
		});
		
		/* ==============================================
		Parallax section slider
		=============================================== */	
		
		$("#owl-client-slider").owlCarousel({
			pagination: true,
			autoPlay:4000,
			items: 5,
			itemsDesktop: [1199, 3],
            itemsTabletSmall: [768, 2],
            itemsMobile: [480, 1],
			navigation: false,
			navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
		});
		
		/* ==============================================
		Showcase slider
		=============================================== */	
        $('.home-showcase-carousel').owlCarousel({
			
			navigation: true,
			pagination: false,
			autoPlay:5000,
			items: 2,
			itemsDesktop: [1199, 2],
            itemsTabletSmall: [768, 2],
            itemsMobile: [480, 1],
			navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
			
        })
		
		/* ==============================================
		Testimonial slider
		=============================================== */	
		
		$("#owl-testimonial-slider").owlCarousel({
			pagination: true,
			autoPlay:4000,
			items: 1,
			itemsDesktop : [1000,1], //5 items between 1000px and 901px
			itemsDesktopSmall : [900,1], // betweem 900px and 601px
			itemsTablet: [600,1], //2 items between 600 and 0
			navigation: false
			
		});
		
		/* ==============================================
		History slider
		=============================================== */	
		
		$("#owl-history-slider").owlCarousel({
			pagination: true,
			autoPlay:4000,
			items: 1,
			itemsDesktop : [1000,1], //5 items between 1000px and 901px
			itemsDesktopSmall : [900,1], // betweem 900px and 601px
			itemsTablet: [600,1], //2 items between 600 and 0
			navigation:false			
		});
		
		/* ==============================================
		About Quote slider
		=============================================== */	
		
		$("#owl-quote-slider").owlCarousel({
			pagination: false,
			autoPlay:4000,
			items: 1,
			itemsDesktop : [1000,1], //5 items between 1000px and 901px
			itemsDesktopSmall : [900,1], // betweem 900px and 601px
			itemsTablet: [600,1], //2 items between 600 and 0
			navigation:false,
			transitionStyle : "fade"			
		});
		
		/* ==============================================
		Quotes slider
		=============================================== */	
		
		$("#quotes-slider").owlCarousel({
			pagination:false,
			autoPlay:4000,
			items: 1,
			itemsDesktop : [1000,1], //5 items between 1000px and 901px
			itemsDesktopSmall : [900,1], // betweem 900px and 601px
			itemsTablet: [600,1], //2 items between 600 and 0
			navigation: true,
			navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
		});		
				
		$("#quotes-slider-style2").owlCarousel({
			pagination: true,
			autoPlay:5000,
			items: 1,
			itemsDesktop : [1000,1], //5 items between 1000px and 901px
			itemsDesktopSmall : [900,1], // betweem 900px and 601px
			itemsTablet: [600,1], //2 items between 600 and 0
			navigation: true,
			navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
		});
		
		/* ==============================================
		Lightbox gallery slider
		=============================================== */	
		
		$("#owl-lightbox-gallery").owlCarousel({
			navigation: false,
			pagination: false,
			autoPlay:5000,
			items: 3,
			itemsDesktop: [1199, 3],
            itemsTabletSmall: [768, 2],
            itemsMobile: [480, 1],
			navigationText: false
		});
		
		/* ==============================================
		Team slider
		=============================================== */	
		
		$("#owl-team-slider").owlCarousel({
			navigation: true,
			pagination: true,
			autoPlay:5000,
			items: 3,
			itemsDesktop: [1199, 3],
            itemsTabletSmall: [768, 2],
            itemsMobile: [480, 1],
			navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
		});
		
		/* ==============================================
		Portfolio sliders
		=============================================== */	
		$("#owl-portfolio-slider").owlCarousel({							 
			navigation: false, 
			slideSpeed : 300,
			autoPlay : 5000,
			singleItem:true						 
		});
		$("#owl-portfolio-slider2").owlCarousel({							 
			navigation: false, 
			slideSpeed : 300,
			autoPlay : 5000,
			singleItem:true					 
		});
		$("#owl-blockquotes").owlCarousel({		 
			navigation: false,
			pagination:false, 
			slideSpeed : 300,
			autoPlay : 5000,
			singleItem:true	 
		});
		
		
		// Subscribe
		jQuery('#subscribe-submit').on("click",function(event){	
			$('.subscribe-error-field').hide();

			var emailReg = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
			var emailVal = $('#subscribe-email').val();

			if (emailVal == "" || emailVal == "Email Address *") {
				$('.subscribe-error-field').html('<i class="fa fa-exclamation"></i>Your email address is required.').fadeIn();
				return false;

			} else if (!emailReg.test(emailVal)) {
				$('.subscribe-error-field').html('<i class="fa fa-exclamation"></i>Invalid email address.').fadeIn();
				return false;
			}

			var data_string = $('.subscribe-form').serialize();

			$('.btn-subscribe').hide();
			$('#subscribe-loading').fadeIn();
			$('.subscribe-error-field').fadeOut();

			$.ajax({
				type: "POST",
				url: "subscribe.php",
				data: data_string,

				//success
				success: function (data) {
					$('.subscribe-empty').hide();
					$('.subscribe-message').html('<i class="fa fa-check contact-success"></i><div>Thank you! You have been subscribed.<div>').fadeIn();
				},
				error: function (data) {
					$('.subscribe-empty').hide();
					$('.subscribe-message').html('<i class="fa fa-exclamation contact-error"></i><div>Something went wrong, please try again later.<div>').fadeIn();
				}

			}) //end ajax call
			return false;
		});
	
    });
    
	/* ==============================================
	window resize fucntion
	=============================================== */	
    $(window).resize(function(){        
        init_menu_resize();
		js_hight_fullscreen();
		service_height_init();
		/* ==============================================
		Showcase slider
		=============================================== */	
        $('.home-showcase-carousel').owlCarousel({
			
			navigation: true,
			pagination: false,
			autoPlay:5000,
			items: 2,
			itemsDesktop : [1000,2], //5 items between 1000px and 901px
			itemsDesktopSmall : [900,1], // betweem 900px and 601px
			itemsTablet: [600,1], //2 items between 600 and 0
			navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
			
        })

		
    });
	
	
	/* ==============================================
	Sections background
	=============================================== */
	var pageSection = $(".page-section, .gallery-slider .slide, .home-showcase-carousel .item, .blog-section, .swiper-slide, .home-flexslider2 .top_slider .slide1");
	pageSection.each(function(indx){			
		if ($(this).attr("data-background")){
			$(this).css("background-image", "url(" + $(this).data("background") + ")");
		}
	});
		
    /* ==============================================
	Navigation classic
	=============================================== */	
	
    var mobile_nav = $(".mobile-nav");
    var desktop_nav = $(".large-nav");
    
	/* ==============================================
	Navigation resize
	=============================================== */	
    function init_menu_resize(){
        
        // Mobile menu max height
        $(".small-device-menu .large-nav > ul").css("max-height", $(window).height() - $(".main-nav").height() - 20 + "px");
        
        // Mobile menu style toggle
        if ($(window).width() <= 1024) {
            $(".main-nav").addClass("small-device-menu");
			$(".hide_menu_item").css("display","none");
        }
        else 
            if ($(window).width() > 1024) {
                $(".main-nav").removeClass("small-device-menu");				
				$(".hide_menu_item").css("display","block");
                desktop_nav.show();
            }
    }
    
	/* ---------------------------------------------
     Some facts section
     --------------------------------------------- */
    
     function init_counters(){
        $(".counter").appear(function(){
            var count = $(this);
            count.countTo({
                from: 0,
                to: count.html(),
                speed: 1300,
                refreshInterval: 60,
            });
            
        });
    }
	
	/* ==============================================
	Nav line height
	=============================================== */		
    function menu_line(height_object, height_donor){
        height_object.height(height_donor.height());
        height_object.css({
            "line-height": height_donor.height() + "px"
        });
    }
	
	/* ==============================================
	Nav initialization
	=============================================== */		
    function init_menu(){
    
		// Navbar sticky
        
        $(".js-stick").sticky({
            topSpacing: 0
        });
		
		menu_line($(".nav-wrapper ul > li > a"), $(".main-nav"));
        menu_line(mobile_nav, $(".main-nav"));
        
        mobile_nav.css({
            "width": $(".main-nav").height() + "px"
        });
        
        // Transpaner menu
        
        if ($(".main-nav").hasClass("transparent")){
           $(".main-nav").addClass("stick-visible"); 
        }
        
        $(window).scroll(function(){        
			if ($(window).scrollTop() > 10) {
				$(".stick-visible").removeClass("transparent");
				$(".main-nav, .header-logo-wrap .logo, .mobile-nav").addClass("small-height");
			}
			else {
				$(".stick-visible").addClass("transparent");
				$(".main-nav, .header-logo-wrap .logo, .mobile-nav").removeClass("small-height");
			}                        
        });
        
        // Mobile menu toggle
        
		mobile_nav.on("click",function(){
     
            if (desktop_nav.hasClass("menu-opened")) {
                desktop_nav.slideUp("slow", "easeOutExpo").removeClass("menu-opened");
                $(this).removeClass("active");
            }
            else {
                desktop_nav.slideDown("slow", "easeOutQuart").addClass("menu-opened");
                $(this).addClass("active");
            }
            
        });
        
        desktop_nav.find("a:not(.menu-down)").click(function(){
            if (mobile_nav.hasClass("active")) {
                desktop_nav.slideUp("slow", "easeOutExpo").removeClass("menu-opened");
                mobile_nav.removeClass("active");
            }
        });
        
        
        /* ==============================================
		Sub menu
		=============================================== */		
                
        var menuSub = $(".menu-down");
        var menulist;
        
        $(".small-device-menu .menu-down").find(".fa:first").removeClass("fa-angle-right").addClass("fa-angle-down");
        
		menuSub.on("click",function(){
            if ($(".main-nav").hasClass("small-device-menu")) {
                menulist = $(this).parent("li:first");
                if (menulist.hasClass("menu-opened")) {
                    menulist.find(".nav-sub:first").slideUp(function(){
                        menulist.removeClass("menu-opened");
                        menulist.find(".menu-down").find(".fa:first").removeClass("fa-angle-up").addClass("fa-angle-down");
                    });
                }
                else {
                    $(this).find(".fa:first").removeClass("fa-angle-down").addClass("fa-angle-up");
                    menulist.addClass("menu-opened");
                    menulist.find(".nav-sub:first").slideDown();
                }
                
                return false;
            }
            else {
                return false;
            }
            
        });
        
        menulist = menuSub.parent("li");
        menulist.hover(function(){        
            if (!($(".main-nav").hasClass("small-device-menu"))) {            
                $(this).find(".nav-sub:first").stop(true, true).slideToggle(300,"linear");
            }            
        }, function(){        
            if (!($(".main-nav").hasClass("small-device-menu"))) {            
                $(this).find(".nav-sub:first").stop(true, true).slideToggle(300,"linear");
			}            
        });        
    }
    
	function init_scrolltop(){
		
		var offset = 450;
		var duration = 500;
		
		jQuery('.scroll-to-top').on("click",function(event){
			event.preventDefault();
			jQuery('html, body').animate({scrollTop: 0}, duration);
			
			return false;
		})
	}
function init_scrollbottom(){
		
		var offset = 450;
		var duration = 500;
		
		jQuery('.scroll-to-bottom').on("click",function(event){
			event.preventDefault();
		
			jQuery('html, body').animate({scrollTop:$(document).height()}, duration);
			return false;
		})
	}		
	
	function init_parallax(){
		
		if (($.browser.safari)||($.browser.chrome)) {
		}
		else
		{
			if (($(window).width() >= 1024) && (mobileTest == false)) {
				
				$(".parallax-1").parallax("50%", 0.1);
				$(".parallax-2").parallax("50%", 0.2);
				$(".parallax-3").parallax("50%", 0.3);
				$(".parallax-4").parallax("50%", 0.4);
				$(".parallax-5").parallax("50%", 0.5);
				$(".parallax-6").parallax("50%", 0.6);
				$(".parallax-7").parallax("50%", 0.7);
				$(".parallax-8").parallax("50%", 0.8);
				$(".parallax-9").parallax("50%", 0.9);
				$(".parallax-10").parallax("50%", 0.5);
				$(".parallax-11").parallax("50%", 0.05);
				
			}
		}
	}
	
	function init_lightbox2(){
		// Works Item Lightbox				
        $(".work-lightbox").magnificPopup({
            gallery: {
                enabled: true
            },
            mainClass: "mfp-fade"
        });
		
		// gallery Item Lightbox				
        $(".gallery-lightbox").magnificPopup({
            gallery: {
                enabled: true
            },
            mainClass: "mfp-fade"
        });
		
		$(".lightbox").magnificPopup();
	}
	

	function init_smoothScroll(){		
		smoothScroll.init({
			speed: 400,
			easing: 'easeInOutCubic',
			offset: 40,
			updateURL: false,
			callbackBefore: function ( toggle, anchor ) {},
			callbackAfter: function ( toggle, anchor ) {}
		});
	}
	
	function js_hight_fullscreen(){
		(function($){
			$(".home").height($(window).height());        
			$(".fullheight").height($(window).height());	
		})(jQuery);
	}

	function init_gallery_slider(){
	
		$('.gallery-slider').cycle({fx:'scrollHorz',pager:'.slider-control-nav',pause:1,speed:300,slides:'.slide',swipe:true,timeout:3500});
		
		jQuery('.gpre').on("click",function(){
			$('.gallery-slider').cycle('prev');
		});
		jQuery('.gnext').on("click",function(){
			$('.gallery-slider').cycle('next');
		});
	}
	
	/*Animated Item block  */
	var service_item = $(".animated-item");
	var service_descr = service_item.find(".ai-descr");
	var service_descr_top;

	function init_services(){
		(function($){
			if (($(window).width() >= 1024) && (mobileTest == false)) {	
			$(".animated-item").each(function(){
				$(this).find(".ai-descr").prepend($(this).find(".ai-intro").html());
			});
			
			// Hover       
			service_item.on("click",function(){	
				if ($("html").hasClass("mobile")) {
					if ($(this).hasClass("js-active")) {
						$(this).removeClass("js-active");
					}
					else {
						$(this).addClass("js-active");
					}
				}
			});
			}
		})(jQuery);
	}
	
	function service_height_init(){
		(function($){
			
			var service_max_height = 0;
			if ($(window).width() >= 767) {
				service_item.each(function(index){
					$(this).css("height", "auto");
					if ($(this).height() > service_max_height) {
						service_max_height = $(this).height();
					}
				});
				
				if (service_max_height > service_item.width() * 0.9) {
					service_item.height(service_max_height);
				}
				else {
					service_item.height(service_item.width() * 0.9);
				}
			}
			
			var service_descr_offset;
			var service_intro_offset;
			service_descr.each(function(){
				service_descr_offset = $(this).height() / 2;
				service_intro_offset = $(this).parent(".ai-inner").find(".ai-intro").height() / 2;
				$(this).parent(".ai-inner").find(".ai-intro").css("top", service_descr_offset + "px");
				$(this).parent(".ai-inner").find(".ai-descr").css("top", -service_intro_offset + "px");
				
			});
			
			// Split sections	
			$(".split-section-content").css("height", "auto");
			if ($(window).width() > 992) {
				$(".split-section-content").equalHeights();
			}
			
		})(jQuery);
	}
	
	// Function equal height
    !function(a){
        a.fn.equalHeights = function(){
            var b = 0, c = a(this);
            return c.each(function(){
                var c = a(this).innerHeight();
                c > b && (b = c)
            }), c.css("height", b)
        }, a("[data-equal]").each(function(){
            var b = a(this), c = b.data("equal");
            b.find(c).equalHeights()
        })
    }(jQuery);
	
  })(jQuery); 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 





	