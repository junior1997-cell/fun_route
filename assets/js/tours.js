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

//POLITICAS PAQUETES
$(".tabLinkP").each(function(){
	$(this).click(function(){
		tabeIdes = $(this).attr('id');
		$(".tabLinkP").removeClass("activeLinkP");
		$(this).addClass("activeLinkP");
		$(".tabcontentP").addClass("hide");
		$("#"+tabeIdes+"-1").removeClass("hide");
		return false;
	});
})

$(".tabLinkPo").each(function(){
	$(this).click(function(){
		tabeIdes = $(this).attr('id');
		$(".tabLinkPo").removeClass("activeLinkPo");
		$(this).addClass("activeLinkPo");
		$(".tabcontentPo").addClass("hide");
		$("#"+tabeIdes+"-1").removeClass("hide");
		return false;
	});
})


/* zoom de imagenes de galeria */
var fullImgBox = document.getElementById("fullImgBox");
var fullImg = document.getElementById("fullImg");

function openFullImg(pic) {
	fullImgBox.style.display = "flex";
	fullImg.src = pic;
}

function closeFullImg() {
	fullImgBox.style.display = "none";
}