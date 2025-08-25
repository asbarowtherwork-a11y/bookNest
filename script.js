
let userBox =document.querySelector('.header .header-2 .user-box');

document.querySelector('#user-btn').onclick = () =>{
    userBox.classList.toggle('active');
    
}

let navbar =document.querySelector('.header .header-2 .navbar');

document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('active');
    
}

var slideIndex = 0;
showSlides();

function plusSlides(n){
    showSlides(slideIndex += n, false); // Disable auto transition for manual navigation
}

function currentSlide(n){
    showSlides(slideIndex = n, false); // Disable auto transition for manual navigation
}

function showSlides(n = slideIndex, auto = true){
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    
    // If manual navigation was used, prevent the slideIndex from being incremented automatically
    if (n > slides.length) { slideIndex = 1; }
    if (n < 1) { slideIndex = slides.length; }
    
    // Hide all slides
    for (i = 0; i < slides.length; i++){
        slides[i].style.display = "none";
    }
    
    // Reset dots
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
    
    // Only allow automatic transitions if auto is true
    if(auto) {
        slideIndex++;
        if(slideIndex > slides.length) {
            slideIndex = 1;
        }
        setTimeout(function(){ showSlides(slideIndex); }, 4000); // Auto transition every 4 seconds
    }
}
