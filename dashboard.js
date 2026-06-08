let score = 0;

const scoreElement =
document.getElementById("score");

function animateScore(){

if(score <= 87){

scoreElement.innerHTML =
score + "%";

score++;

requestAnimationFrame(
animateScore
);

}

}

animateScore();

const habits =
document.querySelectorAll(
'.habit input'
);

habits.forEach(item=>{

item.addEventListener(
'change',
()=>{

let checked =
document.querySelectorAll(
'.habit input:checked'
).length;

let total =
habits.length;

let percentage =
Math.round(
(checked/total)*100
);

scoreElement.innerHTML =
percentage + "%";

}
);

});