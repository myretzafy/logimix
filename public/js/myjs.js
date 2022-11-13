let bans = document.querySelectorAll('.x');
let nbelt = bans.length;
let gauche = document.querySelector('.left');
let droite = document.querySelector('.right');
let compteur = 0;

function desactiv() {
    for (let i = 0; i <= nbelt - 1; i++) {
        bans[i].classList.remove('active');
    }
}


droite.addEventListener("click", (e) => {
    console.log('bien clicke an');
    desactiv();
    compteur++;
    if (compteur >= nbelt - 1) {
        compteur = 0
    }
    console.log(compteur);
    bans[compteur].classList.add('active');

})
gauche.addEventListener("click", (e) => {
    console.log('bien clicke an');
    desactiv();
    compteur--;
    if (compteur < 0) {
        compteur = nbelt - 1;
    }
    console.log(compteur);
    bans[compteur].classList.add('active');

})

setInterval(() => {
    desactiv();
    compteur++;
    if (compteur > nbelt - 1) {
        compteur = 0;
    }
    bans[compteur].classList.add('active');

}, 8000)

/*****************carousel  owl */

$('.owl-carousel').owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    autoplay: true,

    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 3
        },
        1000: {
            items: 5
        }
    }
})