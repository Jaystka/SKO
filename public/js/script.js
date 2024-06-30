// Navbar Fixed
window.onscroll = function(){
    const header = document.querySelector('nav');
    const fixedNav = header.offsetTop;

    if(window.pageYOffset > fixedNav){
        header.classList.add('navbar-fixed');
    }else{
        header.classList.remove('navbar-fixed');
    }
}

//Menu Button
const btn = document.querySelector("button.mobile-menu-button");
const menu = document.getElementById("nav-menu");
btn.addEventListener("click", () => {
	menu.classList.toggle("hidden");
});

//Scroll Shopp

const cardScroll = document.getElementById("card-scroll");
let isDragStart = false, isDragging = false, prevPageX, prevScrollLeft, positionDiff;

cardScroll.addEventListener('wheel', (event) => {
  event.preventDefault();

  cardScroll.scrollBy({
    left: event.deltaY < 0 ? -30 : 30,
    
  });
});

const dragStart = (e) => {
    // updatating global variables value on mouse down event
    isDragStart = true;
    prevPageX = e.pageX || e.touches[0].pageX;
    prevScrollLeft = cardScroll.scrollLeft;
}
const dragging = (e) => {
    // scrolling images/carousel to left according to mouse pointer
    if(!isDragStart) return;
    e.preventDefault();
    isDragging = true;
    cardScroll.classList.add("dragging");
    positionDiff = (e.pageX || e.touches[0].pageX) - prevPageX;
    cardScroll.scrollLeft = prevScrollLeft - positionDiff;
}
const dragStop = () => {
    isDragStart = false;
  cardScroll.classList.remove("dragging");
    if(!isDragging) return;
    isDragging = false;
}

cardScroll.addEventListener("mousedown", dragStart);
cardScroll.addEventListener("touchstart", dragStart);

document.addEventListener("mousemove", dragging);
cardScroll.addEventListener("touchmove", dragging);

document.addEventListener("mouseup", dragStop);
cardScroll.addEventListener("touchend", dragStop);