//Apparition et disparition du menu en fonction du clique

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

// Envoi du formulaire lorsque le champs etablisement est modifié


let etablissement = document.getElementById('reservation_Etablissement');
let form = etablissement.closest('form');

etablissement.addEventListener('change', envoi);

function envoi() {
    if (document.getElementById('reservation_Room')) {

        let room = document.getElementById('reservation_Room');
        let label = document.getElementsByClassName('form-label');
room.remove();
alert('Veuillez re-sélectionner un etablissement ou appuyer sur Envoyer pour pouvoir séléctionner les suites');


    } else {
        form.submit();

    }
}
//   si la le select suite existe et que je choisi une suite je peux plus modifier l'etablissement




