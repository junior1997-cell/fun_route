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

//SLIDER PAQUETES IMAGENES
var swiper = new Swiper(".swiper-hero", {
	effect: "coverflow",
	grabCursor:true,
	centeredSlides:true,
	slidesPerView: "auto",
	coverflowEffect: {
		rotate:15,
		strech:0,
		depth:300,
		modifier:1,
		slideShadows:true,
	},
	loop:true,
});

const sliderContainer = document.querySelector('.slider-container');
const slideRight = document.querySelector('.right-slide');
const slideLeft = document.querySelector('.left-slide');
const upButton = document.querySelector('.up-button');
const downButton = document.querySelector('.down-button');
const slidesLength = slideRight.querySelectorAll('div').length;

let activeSlideIndex = 0;

slideLeft.style.top = `-${(slidesLength - 1) * 100}vh`;

upButton.addEventListener('click', () => changeSlide('up'));
downButton.addEventListener('click', () => changeSlide('down'));

const changeSlide = (direction) => {
    const sliderHeight = sliderContainer.clientHeight;
    if(direction === 'up') {
        activeSlideIndex++;
        if(activeSlideIndex > slidesLength - 1) {
            activeSlideIndex = 0;
        }
    } else if (direction === 'down') {
        activeSlideIndex--;
        if(activeSlideIndex < 0) {
            activeSlideIndex = slidesLength - 1;
        }
    }
    slideRight.style.transform = `translateY(-${activeSlideIndex * sliderHeight}px)`;
    slideLeft.style.transform = `translateY(${activeSlideIndex * sliderHeight}px)`;
}

