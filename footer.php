			<!-- VISIT US
			================================================== -->
			<section id="footer" class="page-section grey-section sp-top-bottom50">
				
				<div class="container">					
					<div class="eight columns" style="text-align:center">						
						<a href="#"><img src="images/google.png" /></a>
					</div>
					
					<div class="eight columns" style="text-align:center">		
						<a href="#"><img src="images/apple.png" /></a>
					</div>	
					
							
						
						<div class="nav-wrapper " style="float:none; display:table; margin:auto">
							<ul class="clearlist">
							   <li><a href="about.php" class="active" >About</a></li>
							   <li><a href="terms.php" class="active">Terms</a></li>
							   <li><a href="privacy.php" class="active" >Privacy Policy</a></li>
							   <li><a href="contact.php" class="active">Contact Us</a></li>
						
					 </ul>
				</div>
									
				</div>
						
				
			</section>
				
				
			
	
		</main>		
		
	</div>
	
	<!-- JAVASCRIPT
    ================================================== -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/materialPreloader.js"></script>
<script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="js/modernizr.custom.js"></script> 
<script type="text/javascript" src="js/jquery.sticky.js"></script>
<script type="text/javascript" src="js/jquery.countTo.js"></script>
<script type="text/javascript" src="js/jquery.appear.js"></script>
<script type="text/javascript" src="js/jquery.easing.js"></script>	
<script type="text/javascript" src='js/smooth-scroll.js'></script>
<script type="text/javascript" src="js/owl.carousel.min.js"></script>
<script type='text/javascript' src="js/jquery.magnific-popup.min.js"></script>
<script type="text/javascript" src="js/jquery.parallax-1.1.3.js"></script>
<script type="text/javascript" src="js/scrollReveal.min.js"></script>
<script type="text/javascript" src="js/TweenMax.min.js"></script>
<script type="text/javascript" src="js/share.js"></script>
<script type="text/javascript" src="js/jquery.animsition.min.js"></script>

<script type="text/javascript">
(function($) { "use strict";
	$(document).ready(function() {
	  
	  $(".animsition").animsition({
	  
		inClass               :   'fade-in',
		outClass              :   'fade-out',
		inDuration            :    1500,
		outDuration           :    800,
		linkElement           :   '.animsition-link', 
		// e.g. linkElement   :   'a:not([target="_blank"]):not([href^=#])'
		loading               :    true,
		loadingParentElement  :   'body', //animsition wrapper element
		loadingClass          :   'animsition-loading',
		unSupportCss          : [ 'animation-duration',
								  '-webkit-animation-duration',
								  '-o-animation-duration'
								],
		//"unSupportCss" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser. 
		//The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
		
		overlay               :   false,
		
		overlayClass          :   'animsition-overlay-slide',
		overlayParentElement  :   'body'
	  });
	});  
})(jQuery);
</script>
<script type="text/javascript" src="js/cycle2.js"></script>
<script type="text/javascript" src="js/jquery.hoverdir.js"></script> 
<script type="text/javascript" src="js/isotope.js"></script>
<script type="text/javascript" src="js/imagesloaded.pkgd.min.js"></script> 
<script type="text/javascript" src="js/masonry.pkgd.min.js"></script>
<script type="text/javascript" src="js/jquery.backstretch.min.js"></script>
<script type="text/javascript" src="js/script.js"></script> 
<script type="text/javascript">
(function($) {
	"use strict";
	$(document).ready(function() {
		
		/*-----------------------------------------------------------------------------------*/
		/*	HOME SECTION MOVE BACKGROUND IMAGE 
		/*-----------------------------------------------------------------------------------*/
		if (($(window).width() >= 1024) && ($('body').hasClass('no-mobile'))) {
			var bg = $(".move-image");
			bg.mousemove(function(event) {
				var xPos = event.pageX;
				TweenLite.to(bg, .5, {css:{backgroundPosition:xPos + "px"}});
			});
		}
		
		//Gallery Slider
		$('.gallery-slider').cycle({fx:'scrollHorz',pager:'.slider-control-nav',pause:1,speed:300,slides:'.slide',swipe:true,timeout:3500});
	
		jQuery('.gpre').on("click",function(){
			$('.gallery-slider').cycle('prev');
		});
		jQuery('.gnext').on("click",function(){
			$('.gallery-slider').cycle('next');
		});
		
		/* Service hoverdir
		================================================= */		
		$('.about-bx8').each( function() { $(this).hoverdir(); } );
		
		//Mesonry Service Block
		init_masonry();
		
		//PORTFOLIO FILTER 
		
		var $container = $('.projects-wrapper');
		var $filter = $('#filter');
		// Initialize isotope 
		$container.isotope({
			filter: '*',
			layoutMode: 'masonry',
			animationOptions: {
				duration: 750,
				easing: 'linear'
			}
		});
		// Filter items when filter link is clicked
		$filter.find('a').click(function () {
			var selector = $(this).attr('data-filter');
			$filter.find('a').removeClass('current');
			$(this).addClass('current');
			$container.isotope({
				filter: selector,
				animationOptions: {
					animationDuration: 750,
					easing: 'linear',
					queue: false,
				}
			});
			return false;
		});	
		/*END*/
		
		
	});  
	
	function init_masonry(){
		(function($){    
		
			$(".masonry").imagesLoaded(function(){
				$(".masonry").masonry();
			});
			
		})(jQuery);
	}

})(jQuery);

</script>

<!-- End Document
================================================== -->

</body>
</html>