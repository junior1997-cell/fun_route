
//itinerario
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
});

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

