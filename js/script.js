$(document).ready(function($){	
	var owl = $(".owl-carousel-slider");
	  	owl.owlCarousel({
	  		margin:0, 							
	  		loop:true, 							
	  		nav:true, 							
	  		navText:['<i class="fa fa-caret-left"></i>','<i class="fa fa-caret-right"></i>'], 
	  		autoplay:false, 						
	  		autoplayTimeout:1500,
			autoplayHoverPause:true,
			autoplaySpeed: 2000,
			responsiveClass:true, 				
		    responsive:{
		        0:{
		            items:1,									            									            
		        },
		        600:{
		            items:1,          
		        },
		        1000:{
		            items:1,  
		        }
		    }
		});

		
	    $('.slider-for').slick({
		  	slidesToShow: 1,
		  	slidesToScroll: 1,
		  	arrows: false,
		  	fade: true,
		  	asNavFor: '.slider-nav'
		});
		$('.slider-nav').slick({
		  	slidesToShow: 8,
		  	slidesToScroll: 1,
		  	asNavFor: '.slider-for',
		  	dots: true,
		  	centerMode: true,
		  	focusOnSelect: true,
		  	responsive: [{
	            breakpoint: 992,
	            settings: {
	                slidesToShow: 3,
	            }

	        },
            {
                breakpoint: 568,
                settings: {
                    slidesToShow: 3,
                }

            },
            {
                breakpoint: 320,
                settings: {
                    slidesToShow: 3,
                }

            }
            ]
		});

});

var MobileMenu = function () {
        var mobileMenu = $("#menu");

        if (mobileMenu.length) {
            mobileMenu.mmenu({
                "extensions": [
                    // "fx-panels-zoom",
                    "pagedim-black",
                    // "theme-dark"
                ],
                "offCanvas": {
                    // "position": "right"
                },
                "navbars": [
                    {
                        "position": "top",
                        "content": [
                            "<a class='fa fa-envelope' href='#/'></a>",
                            "<a class='fa fa-twitter' href='#/'></a>",
                            "<a class='fa fa-facebook' href='#/'></a>"
                        ]
                    }
                ]
            });
        }

};
