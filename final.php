<?php include 'header.php'; ?>

<div class="bg-image vh-100 ">
    <div class="col-12 ps-5 pt-3">
        <div class="circle" id="circle"></div>
        <p id="message"></p>
    </div>
    <div class="container-fluid d-flex align-items-center justify-content-center">
        <img src="img/logo.png" alt="Logo" class="logo">
        <div class="text-center">
        <h3 class="py-5"> Tak a je to za tebou </h3>
        <h1 class="fade-in">Běž prosím na <b>IAESTE stánek</b></h1>
        <p> *Nezapomeň vytrhnout stranu z průvodce a vyplnit znova tvé jméno a hlavně heslo veletrhu</p>
        <h1 class="fade-in">HESLO: KOBLÍŽEK </div> 
    </div>
</div>

<img id="map" src="img/mapa.svg">

<?php include 'footer.php'; ?>


<script>
function throwConfetti() {
    const confettiCount = 100;
    const confettiColors = ['red', 'green', 'blue', 'yellow', 'orange', 'pink', 'purple', 'white'];

    for (let i = 0; i < confettiCount; i++) {
        const confettiPiece = document.createElement('div');
        confettiPiece.classList.add('confetti-piece');
        document.body.appendChild(confettiPiece);

        confettiPiece.style.backgroundColor = confettiColors[Math.floor(Math.random() * confettiColors.length)];
        confettiPiece.style.left = `${Math.random() * window.innerWidth}px`;
        confettiPiece.style.animation = `fall ${Math.random() * 3 + 2}s linear forwards`;
        confettiPiece.addEventListener('animationend', () => {
            confettiPiece.remove();
        });
    }
}


document.head.insertAdjacentHTML('beforeend', `
<style>
@keyframes fall {
    0% { top: -10%; opacity: 1; }
    60% { opacity: 1; }
    100% { top: 110%; opacity: 0; }
}
</style>
`);

window.addEventListener('load', throwConfetti);
const circle = document.getElementById('circle');

let counter = 60;

const updateCircle = () => {
    if (counter < 0) {
        counter = 60;
        setTimeout(() => {
            message.textContent = '';
        }, 1000);
    } else {
        circle.textContent = counter;
    }
    counter--;
};

setInterval(updateCircle, 1000);

function animateScaleImage() {
    const img = document.getElementById('map');
    let scale = 1.0;
    const scaleTarget = 2.0;
    const increment = 0.01;
    let translateX = 0;

    const interval = setInterval(() => {
        if (scale >= scaleTarget) {
            clearInterval(interval);
        } else {
            scale += increment;
            translateX += 0.1;
            img.style.transform = `scale(${scale}) translateX(${translateX}px)`;
        }
    }, 50);
}


window.onload = animateScaleImage;
</script>
