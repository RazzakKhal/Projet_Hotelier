/////////////////////////////////////////////////////////////////////////////
// TRAITEMENT DU FORMULAIRE RESERVATION GENERAL
////////////////////////////////////////////////////////////////////
// Envoi du formulaire lorsque le champs etablisement est modifié




let etablissement = document.getElementById('reservation_Etablissement');

let form = document.getElementById('form_perso1');


etablissement.addEventListener('change', envoi);
etablissement.setAttribute('disabled', 'disabled');




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
        // requetes mes dates en ajax
        let url = '/reserv/resa/';
        let dates;
        axios.get(url).then(function (response) {
            dates = response.data;
            // je récupère ma valeur date début et date fin entré ( parse les met en timestamp milliseconde et je les converti en seconde pour comparer par la suite)
            let datedebutmili = Date.parse(valeurstartm.innerHTML + ' '+ valeurstartj.innerHTML + ','+ valeurstarty.innerHTML);
            let datedebut = datedebutmili / 1000;
            let datefinmili = Date.parse(valeurendm.innerHTML + ' '+ valeurendj.innerHTML + ','+ valeurendy.innerHTML);
            let datefin = datefinmili / 1000;
            let aujourdhui = new Date();
            let maintenant = aujourdhui.getTime();
            let maintenants = maintenant / 1000;
            // Pour chaque valeur dans dates si elles sont comprise entre datedebut et datefin alors alert
            if((datedebut < maintenants) || (datefin < datedebut)){
                alert("Les dates selectionnées ne doivent pas être antérieur à aujourd'hui ou/et la date de sortie ne peut-être apres celle d'entrée");
                etablissement.setAttribute('disabled', 'disabled');
            }else {
                dates.forEach(function (date) {
                    // je récupère toutes les dates de mon fichier json, je les converti en timestamp, et compare avec les dates du client
                    let dateentremili = Date.parse(date.Start);
                    let datesortiemili = Date.parse(date.End);
                    let dateentre = dateentremili / 1000;
                    let datesortie = datesortiemili / 1000;

                    if ((dateentre <= datedebut && datefin <= datesortie) || (dateentre <= datedebut && datedebut <= datesortie) || (dateentre <= datedebut && datefin <= datesortie) || (dateentre >= datedebut && datefin >= dateentre)) {
//
                        etablissement.setAttribute('disabled', 'disabled');

                        alert(" \n Période non disponible car réservée de : \n Entrée : " + date.Start + " \n Sortie : " + date.End);



                    } else {

                    }

                }); // fin foreach
            } // fin else


        }); // fin axios




        etablissement.removeAttribute('disabled');

    } // fin if
    else{
        // rien
    }

}// fin fonction


