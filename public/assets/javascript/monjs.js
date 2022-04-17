//Apparition et disparition du menu en fonction du clique

let iconemenu = document.getElementById('menuburger');
let menucache = document.getElementById('menucache');
let iconecroix = document.getElementById('fermeturemenu');





iconemenu.addEventListener('click', apparait);

function apparait(){




   menucache.style.opacity = '0.75';
    menucache.style.right ='0px';




}

iconecroix.addEventListener('click', disparait);

function disparait(){


  menucache.style.opacity = '0';


    menucache.style.right ='1000px';
}


