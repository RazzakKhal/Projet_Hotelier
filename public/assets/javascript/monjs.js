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


// je bloque le remplissag d'etablissement tant que les dates ne sont pas selectionner pour être sur de pouvoir les récupérer sur un evenement change plus tard


etablissement.setAttribute('disabled', 'disabled');

//si mon formulaire est soumis alors je debloque le champs pour que les informations soient retransmises

form.addEventListener('submit', desactivedisabledsubmit);
function desactivedisabledsubmit(){
    etablissement.removeAttribute('disabled');
}

//   si les champs de date de mon formulaire ne sont pas rempli alors je laisse etablissement disabled

let startj = document.getElementById('reservation_Start_day');
let startm = document.getElementById('reservation_Start_month');
let starty = document.getElementById('reservation_Start_year');
let endj = document.getElementById('reservation_End_day');
let endm = document.getElementById('reservation_End_month');
let endy = document.getElementById('reservation_End_year');
let valeurstartm= null;
let valeurstarty = null;
let valeurstartj = null;
let valeurendm = null;
let valeurendy = null;
let valeurendj = null;



startj.addEventListener('change', deblocageetab);
startm.addEventListener('change', deblocageetab);
starty.addEventListener('change', deblocageetab);
endj.addEventListener('change', deblocageetab);
endm.addEventListener('change', deblocageetab);
endy.addEventListener('change', deblocageetab);


// fonction qui permet de debloquer mon champ etablissement si toutes les dates sont remplies
function deblocageetab(){
  //je récupère le nouveau contenu text des options selectionnées
    valeurstartm = startm.querySelector("option:checked");
    valeurstarty = starty.querySelector("option:checked");
    valeurstartj = startj.querySelector("option:checked");
    valeurendm = endm.querySelector("option:checked");
    valeurendy = endy.querySelector("option:checked");
    valeurendj = endj.querySelector("option:checked");
    //
    if(valeurstartj.innerHTML !== 'Jour' && valeurstartm.innerHTML  !== 'Mois' && valeurstarty.innerHTML  !== 'Année' && valeurendj.innerHTML  !== 'Jour' && valeurendm.innerHTML  !== 'Mois' && valeurendy.innerHTML  !== 'Année'){
        etablissement.removeAttribute('disabled');

    }
    else{
        // rien
    }
}





