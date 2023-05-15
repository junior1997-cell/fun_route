var swiper = new Swiper(".bg-slider-thumbs", {
  spaceBetween: 0,
  slidesPerView: 0,
});

var swiper2 = new Swiper(".bg-slider", {
  spaceBetween: 0,
  
  thumbs: {
    swiper: swiper,
  },
});

window.addEventListener("scroll", function(){
  const header = document.querySelector("header");
  header.classList.toggle("sticky", window.scrollY > 0);
});


//Responsive main menu
const menuBtn = document.querySelector(".nav-menu-btn");
const closeBtn = document.querySelector(".nav-close-btn");
const navigation = document.querySelector(".navigation");

menuBtn.addEventListener("click", () => {
  navigation.classList.add(active);
});

closeBtn.addEventListener("click", () => {
  navigation.classList.remove(active);
});

/*let searchForm = document.querySelector(".search-form");

document.querySelector("#search-btn".onclick = () => {
  searchForm.classList.add(active);
});

document.querySelector("#close-search".onclick = () => {
  searchForm.classList.remove(active);
});*/


function openCity(cityName) {
  var i;
  var x = document.getElementsByClassName("tabcontent");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  document.getElementById(cityName).style.display = "block";
}


let listElements = document.querySelectorAll('.list__button--click');

listElements.forEach(listElement => {
    listElement.addEventListener('click', ()=>{
        
        listElement.classList.toggle('arrow');

        let height = 0;
        let menu = listElement.nextElementSibling;
        if(menu.clientHeight == "0"){
            height=menu.scrollHeight;
        }

        menu.style.height = `${height}px`;

    })
});


