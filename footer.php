<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package kite
 */
?>
<?php get_template_part('kite','footer' ); ?>
    <script type="text/javascript">
    	 $(function(){
		    $('#portfolio-items').mixItUp();  
		});
    </script>
    <!-- WOW JS: Plugin JavaScript  -->
    <script type="text/javascript">
    	 wow = new WOW(
    	 		{
					animation: {
						duration: 400,
						effects: 'fade stagger(34ms) translateZ(-360px) translateY(10%)',
						easing: 'ease'
					}
				}
		    );
		    wow.init();
    </script>
    <script type="text/javascript">
		// jQuery to collapse the navbar on scroll
		$(window).scroll(function() {
		    if ($(".navbar").offset().top > 50) {
		        $(".navbar-fixed-top").addClass("top-nav-collapse");
		    } else {
		        $(".navbar-fixed-top").removeClass("top-nav-collapse");
		    }
		});
		// jQuery for page scrolling feature - requires jQuery Easing plugin
		$(function() {
		    $('a.page-scroll').bind('click', function(event) {
		        var $anchor = $(this);
		        $('html, body').stop().animate({
		            scrollTop: $($anchor.attr('href')).offset().top
		        }, 1500, 'easeInOutExpo');
		        event.preventDefault();
		    });
		});
		// Closes the Responsive Menu on Menu Item Click
		$('.navbar-collapse ul li a').click(function() {
		    $('.navbar-toggle:visible').click();
		});
    </script>
    <!-- Script to Activate the Site Carousel -->
    <script>
	    $('#myCarousel').carousel({
	        interval: 5000 //changes the speed
	    })
    </script>        
    <!-- Script to Activate the Testimonial Carousel -->
    <script>
	    $('#carousel-testimonial').carousel({
	        interval: 5000 //changes the speed
	    })
    </script>
<?php wp_footer(); ?>

</body>
</html>
