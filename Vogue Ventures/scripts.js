let currentIndex = 0;
const images = document.querySelectorAll('.slider img');
const dots = document.querySelectorAll('.dot');

function showSlide(index) {
    images.forEach((img, i) => {
        img.style.display = i === index ? 'block' : 'none';
    });
    dots.forEach((dot, i) => {
        dot.classList.toggle('active', i === index);
    });
}

function nextSlide() {
    currentIndex = (currentIndex + 1) % images.length;
    showSlide(currentIndex);
}

setInterval(nextSlide, 3000);

var activeclass = document.querySelectorAll('ul li');
console.log(activeclass);
for(var i = 0; i < activeclass.length; i++){
    activeclass[i].addEventListener('click', activateClass);
}
function activateClass(){
    for(var i = 0; i < activeclass.length; i++){
        activeclass[i].classList.remove('active');
    }
    this.classList.add('active');
}

