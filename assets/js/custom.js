(function ($) {
	
	"use strict";

	// Page loading animation
	$(window).on('load', function() {

        $('#js-preloader').addClass('loaded');

    });

	// WOW JS
	$(window).on ('load', function (){
        if ($(".wow").length) { 
            var wow = new WOW ({
                boxClass:     'wow',      // Animated element css class (default is wow)
                animateClass: 'animated', // Animation css class (default is animated)
                offset:       20,         // Distance to the element when triggering the animation (default is 0)
                mobile:       true,       // Trigger animations on mobile devices (default is true)
                live:         true,       // Act on asynchronously loaded content (default is true)
            });
            wow.init();
        }
    });

	$(window).scroll(function() {
	  var scroll = $(window).scrollTop();
	  var box = $('.header-text').height();
	  var header = $('header').height();

	  if (scroll >= box - header) {
	    $("header").addClass("background-header");
	  } else {
	    $("header").removeClass("background-header");
	  }
	});
	
	$('.filters ul li').click(function(){
        $('.filters ul li').removeClass('active');
        $(this).addClass('active');
          
          var data = $(this).attr('data-filter');
          $grid.isotope({
            filter: data
          })
        });

        var $grid = $(".grid").isotope({
          	itemSelector: ".all",
          	percentPosition: true,
          	masonry: {
            columnWidth: ".all"
        }
    })

	$(document).on("click", ".naccs .menu div", function() {
		var numberIndex = $(this).index();
	
		if (!$(this).is("active")) {
			$(".naccs .menu div").removeClass("active");
			$(".naccs ul li").removeClass("active");
	
			$(this).addClass("active");
			$(".naccs ul").find("li:eq(" + numberIndex + ")").addClass("active");
	
			var listItemHeight = $(".naccs ul")
				.find("li:eq(" + numberIndex + ")")
				.innerHeight();
			$(".naccs ul").height(listItemHeight + "px");
		}
	});

	$('.owl-cites-town').owlCarousel({
		items:4,
		loop:true,
		dots: false,
		nav: true,
		autoplay: true,
		margin:30,
		responsive:{
			  0:{
				  items:1
			  },
			  800:{
				  items:2
			  },
			  1000:{
				  items:4
			}
		}
	})

	$('.owl-weekly-offers').owlCarousel({
		items:3,
		loop:true,
		dots: false,
		nav: true,
		autoplay: false,
		margin:30,
		responsive:{
			  0:{
				  items:1
			  },
			  800:{
				  items:2
			  },
			  1100:{
				  items:3
			}
		}
	})

	

	$('.owl-paquetes-l').owlCarousel({
		loop:true,
		margin:8,
		responsiveClass:true,
		responsive:{
				0:{
						items:1,
						nav:true
				},
				600:{
						items:1,
						nav:false
				},
				1000:{
						items:4,
						nav:true,
						loop:false
				}
		}
	})

	$('.crsl-wrap').owlCarousel({
		items:1,
		loop:true,
		dots: false,
		nav: false,
		autoplay: true,
		margin:25,
		responsive:{
			  0:{
				  items:1
			  },
			  800:{
				  items:1
			  },
			  1100:{
				  items:1
			}
		}
	})

	$('.paquete-home1').owlCarousel({
		loop:true,
		margin:30,
		responsiveClass:true,
		responsive:{
				0:{
						items:1,
						nav:true
				},
				500:{
						items:2,
						nav:false
				},
				800:{
						items:3,
						nav:false
				},
				1000:{
						items:4,
						nav:true,
						loop:false
				},
				1200:{
						items:5,
						nav:true,
						loop:false
				},
				1500:{
						items:6,
						nav:true,
						loop:false
				}
		}
	})

	$('.owl-banner').owlCarousel({
		items:1,
		loop:true,
		dots: false,
		nav: true,
		autoplay: true,
		margin:30,
		responsive:{
			  0:{
				  items:1
			  },
			  600:{
				  items:1
			  },
			  1000:{
				  items:1
			}
		}
	})

	
	
	

	// Menu Dropdown Toggle
	if($('.menu-trigger').length){
		$(".menu-trigger").on('click', function() {	
			$(this).toggleClass('active');
			$('.header-area .nav').slideToggle(200);
		});
	}


	// Menu elevator animation
	$('.scroll-to-section a[href*=\\#]:not([href=\\#])').on('click', function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				var width = $(window).width();
				if(width < 991) {
					$('.menu-trigger').removeClass('active');
					$('.header-area .nav').slideUp(200);	
				}				
				$('html,body').animate({
					scrollTop: (target.offset().top) - 80
				}, 700);
				return false;
			}
		}
	});

	$(document).ready(function () {
	    $(document).on("scroll", onScroll);
	    
	    //smoothscroll
	    $('.scroll-to-section a[href^="#"]').on('click', function (e) {
	        e.preventDefault();
	        $(document).off("scroll");
	        
	        $('.scroll-to-section a').each(function () {
	            $(this).removeClass('active');
	        })
	        $(this).addClass('active');
	      
	        var target = this.hash,
	        menu = target;
	       	var target = $(this.hash);
	        $('html, body').stop().animate({
	            scrollTop: (target.offset().top) - 79
	        }, 500, 'swing', function () {
	            window.location.hash = target;
	            $(document).on("scroll", onScroll);
	        });
	    });
	});

	function onScroll(event){
	    var scrollPos = $(document).scrollTop();
	    $('.nav a').each(function () {
	        var currLink = $(this);
	        var refElement = $(currLink.attr("href"));
	        if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
	            $('.nav ul li a').removeClass("active");
	            currLink.addClass("active");
	        }
	        else{
	            currLink.removeClass("active");
	        }
	    });
	}


	// Page loading animation
	$(window).on('load', function() {
		if($('.cover').length){
			$('.cover').parallax({
				imageSrc: $('.cover').data('image'),
				zIndex: '1'
			});
		}

		$("#preloader").animate({
			'opacity': '0'
		}, 600, function(){
			setTimeout(function(){
				$("#preloader").css("visibility", "hidden").fadeOut();
			}, 300);
		});
	});

	

	const dropdownOpener = $('.main-nav ul.nav .has-sub > a');

    // Open/Close Submenus
    if (dropdownOpener.length) {
        dropdownOpener.each(function () {
            var _this = $(this);

            _this.on('tap click', function (e) {
                var thisItemParent = _this.parent('li'),
                    thisItemParentSiblingsWithDrop = thisItemParent.siblings('.has-sub');

                if (thisItemParent.hasClass('has-sub')) {
                    var submenu = thisItemParent.find('> ul.sub-menu');

                    if (submenu.is(':visible')) {
                        submenu.slideUp(450, 'easeInOutQuad');
                        thisItemParent.removeClass('is-open-sub');
                    } else {
                        thisItemParent.addClass('is-open-sub');

                        if (thisItemParentSiblingsWithDrop.length === 0) {
                            thisItemParent.find('.sub-menu').slideUp(400, 'easeInOutQuad', function () {
                                submenu.slideDown(250, 'easeInOutQuad');
                            });
                        } else {
                            thisItemParent.siblings().removeClass('is-open-sub').find('.sub-menu').slideUp(250, 'easeInOutQuad', function () {
                                submenu.slideDown(250, 'easeInOutQuad');
                            });
                        }
                    }
                }

                e.preventDefault();
            });
        });
    }


})(window.jQuery);

/** MENU PAQUETES CARDS**/

$(document).ready(function() {
	$('#boton-drop').click(function() {
		$('#boton-drop').toggleClass("drop-rotate");
		$('#drop-descripcion').toggleClass("drop-active")
	})
})

$(document).ready(function() {
	$('#boton-drop2').click(function() {
		$('#boton-drop2').toggleClass("drop-rotate");
		$('#drop-descripcion2').toggleClass("drop-active")
	})
})

$(document).ready(function() {
	$('#boton-drop3').click(function() {
		$('#boton-drop3').toggleClass("drop-rotate");
		$('#drop-descripcion3').toggleClass("drop-active")
	})
})

$(document).ready(function() {
	$('#boton-drop4').click(function() {
		$('#boton-drop4').toggleClass("drop-rotate");
		$('#drop-descripcion4').toggleClass("drop-active")
	})
})

$(document).ready(function() {
	$('#boton-drop5').click(function() {
		$('#boton-drop5').toggleClass("drop-rotate");
		$('#drop-descripcion5').toggleClass("drop-active")
	})
})

$(document).ready(function() {
	$('#boton-drop6').click(function() {
		$('#boton-drop6').toggleClass("drop-rotate");
		$('#drop-descripcion6').toggleClass("drop-active")
	})
})

$(document).ready(function() {
	$('#boton-drop7').click(function() {
		$('#boton-drop7').toggleClass("drop-rotate");
		$('#drop-descripcion7').toggleClass("drop-active")
	})
})

$(document).ready(function() {
	$('#boton-drop8').click(function() {
		$('#boton-drop8').toggleClass("drop-rotate");
		$('#drop-descripcion8').toggleClass("drop-active")
	})
})

$(document).ready(function() {
	$('#boton-drop9').click(function() {
		$('#boton-drop9').toggleClass("drop-rotate");
		$('#drop-descripcion9').toggleClass("drop-active")
	})
})

$(document).ready(function() {
	$('#boton-drop10').click(function() {
		$('#boton-drop10').toggleClass("drop-rotate");
		$('#drop-descripcion10').toggleClass("drop-active")
	})
})

$(document).ready(function() {
	$('#boton-drop11').click(function() {
		$('#boton-drop11').toggleClass("drop-rotate");
		$('#drop-descripcion11').toggleClass("drop-active")
	})
})

$(document).ready(function() {
	$('#boton-drop12').click(function() {
		$('#boton-drop12').toggleClass("drop-rotate");
		$('#drop-descripcion12').toggleClass("drop-active")
	})
})

$(document).ready(function() {
	$('#boton-drop13').click(function() {
		$('#boton-drop13').toggleClass("drop-rotate");
		$('#drop-descripcion13').toggleClass("drop-active")
	})
})

$(document).ready(function() {
	$('#boton-drop14').click(function() {
		$('#boton-drop14').toggleClass("drop-rotate");
		$('#drop-descripcion14').toggleClass("drop-active")
	})
})

/*$(function() {
	$('#one').ContentSlider({
	width : '800px',
	height : '260px',
	speed : 400,
	easing : 'easeOutSine'
	});
});*/


$(".tabLink").each(function(){
	$(this).click(function(){
		tabeId = $(this).attr('id');
		$(".tabLink").removeClass("activeLink");
		$(this).addClass("activeLink");
		$(".tabcontent").addClass("hide");
		$("#"+tabeId+"-1").removeClass("hide");
		return false;
	});
});


//Galleria paquetes generales
$(".tabContentImg").addClass("hiden");
$("#conta-1-2").removeClass("hiden");

$(".tab_btn").each(function(){
	$(this).click(function(){
		tabeIds = $(this).attr('id');
		$(".tab_btn").removeClass("activeTab");
		$(this).addClass("activeTab");
		$(".tabContentImg").addClass("hiden");
		$("#"+tabeIds+"-2").removeClass("hiden");
		return false;
	});
});

$(".option").click(function(){
	$(".option").removeClass("active");
	$(this).addClass("active");
	
});





