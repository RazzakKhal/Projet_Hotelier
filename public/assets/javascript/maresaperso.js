/////////////////////////////////////////////////////////////////////////////
// TRAITEMENT DU FORMULAIRE RESERVATION PERSONNALISE PRE REMPLI
////////////////////////////////////////////////////////////////////



let form = document.getElementById('form_perso');
let bouton = document.getElementById('bouton-submit-perso');
bouton.setAttribute('disabled', 'disabled');

//   si les champs de date de mon formulaire ne sont pas rempli alors je laisse etablissement disabled

let startj = document.getElementById('etab_room_resa_Start_day');
let startm = document.getElementById('etab_room_resa_Start_month');
let starty = document.getElementById('etab_room_resa_Start_year');
let endj = document.getElementById('etab_room_resa_End_day');
let endm = document.getElementById('etab_room_resa_End_month');
let endy = document.getElementById('etab_room_resa_End_year');
let etab = document.getElementById('etab_room_resa_Etablissement');
let roomm = document.getElementById('etab_room_resa_Room');
let valeurstartm= null;
let valeurstarty = null;
let valeurstartj = null;
let valeurendm = null;
let valeurendy = null;
let valeurendj = null;
let valeuretab = null;
let valeurroom = null;



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
    valeuretab = etab.querySelector("option:checked").innerHTML;
    valeurroom = roomm.querySelector("option:checked").innerHTML;

    //
    if(valeurstartj.innerHTML !== 'Jour' && valeurstartm.innerHTML  !== 'Mois' && valeurstarty.innerHTML  !== 'Année' && valeurendj.innerHTML  !== 'Jour' && valeurendm.innerHTML  !== 'Mois' && valeurendy.innerHTML  !== 'Année'){

        etab.setAttribute('disabled', 'disabled');
        roomm.setAttribute('disabled', 'disabled');

        // requetes mes dates en ajax
        let url = '/reserv/resa' + '/' + valeuretab + '/' + valeurroom;
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

                dates.forEach(function (date) {
                    console.log(date);
                    // je récupère toutes les dates de mon fichier json, je les converti en timestamp, et compare avec les dates du client
                    let dateentremili = Date.parse(date.Start);
                    let datesortiemili = Date.parse(date.End);
                    let dateentre = dateentremili / 1000;
                    let datesortie = datesortiemili / 1000;

                    if((datedebut < maintenants) || (datefin < datedebut)){
                        alert("Les dates selectionnées ne doivent pas être antérieur à aujourd'hui ou/et la date de sortie ne peut-être apres celle d'entrée");

                    }else {
                       // bouton.removeAttribute('disabled');
                    } // fin else



                    if ((dateentre <= datedebut && datefin <= datesortie) || (dateentre <= datedebut && datedebut <= datesortie) || (dateentre <= datedebut && datefin <= datesortie) || (dateentre >= datedebut && datefin >= dateentre)) {
//
                    //    etablissement.setAttribute('disabled', 'disabled');

                        alert(" \n Période non disponible car réservée de : \n Entrée : " + date.Start + " \n Sortie : " + date.End);
                        bouton.setAttribute('disabled', 'disabled');


                    } else {

                        bouton.removeAttribute('disabled');
                        etab.setAttribute('disabled', 'disabled');
                        roomm.setAttribute('disabled', 'disabled');
                    }


                }); // fin foreach





        }); // fin axios






    } // fin if
    else{
        // rien
    }

}// fin fonction

form.addEventListener('submit', recupinfo);
// je réactive mes champs etablissement et room pour récupérer ls informations
function recupinfo(){
    etab.removeAttribute('disabled');
    roomm.removeAttribute('disabled');
}