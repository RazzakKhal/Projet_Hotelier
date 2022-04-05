let menu = document.getElementById('menuburger');
let didi = document.getElementById('menucache');
let bodydy = document.getElementById('bodydy');
let menucroix = document.getElementById('fermeturemenu');

menu.addEventListener('click', apparait);

function apparait(){



    bodydy.style.transition = '1s';
    bodydy.style.opacity = '0';
    bodydy.style.display = 'none';

    didi.style.opacity = '1';
    didi.style.transition = '1s';
    didi.style.display = 'block';


}

menucroix.addEventListener('click', disparait);

function disparait(){

    didi.style.transition = '1s';
    didi.style.display = 'none';
    didi.style.opacity = '0';

    bodydy.style.display = 'block';
    bodydy.style.opacity = '1';

}