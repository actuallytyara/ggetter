const navbar =
document.getElementById("navbar");

window.addEventListener("scroll",()=>{

navbar.classList.toggle(
"scrolled",
window.scrollY > 50
);

});

const counter =
document.getElementById("counter");

let count = 0;

function animateCounter(){

if(count < 200){

count += 2;

counter.innerText =
count + "+";

requestAnimationFrame(
animateCounter
);

}

}

animateCounter();

const cards =
document.querySelectorAll(
".goal-card,.testimonial-card,.step"
);

const observer =
new IntersectionObserver(entries=>{

entries.forEach(entry=>{

if(entry.isIntersecting){

entry.target.style.opacity="1";
entry.target.style.transform=
"translateY(0)";

}

});

});

cards.forEach(card=>{

card.style.opacity="0";
card.style.transform=
"translateY(50px)";
card.style.transition=".6s";

observer.observe(card);

});