let menu = document.getElementById('menuburger');
let didi = document.getElementById('menucache');
let bodydy = document.getElementById('bodydy');
let menucroix = document.getElementById('fermeturemenu');

menu.addEventListener('click', apparait);

function apparait(){

didi.style.height = '100%';
 didi.style.opacity = '0.70';
 bodydy.style.height = '0%';
 bodydy.style.opacity = '0';
}

menucroix.addEventListener('click', disparait);

function disparait(){
    didi.style.height = '0%';
    didi.style.opacity = '0';
    bodydy.style.height = '100%';
    bodydy.style.opacity = '1';
}