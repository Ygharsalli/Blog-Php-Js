// function deleteButton(e){
   
//     e.preventDefault();

//     if ( confirm( " voulez vous vraiment suppimer cette article ?" ) ) {
//         window.location.href = this.getAttribute(href);
//     } else {
//         'supression annuler'
//     }
// }

// const button =    document.querySelectorAll('.delete-button');

// for (let i =0; i<button.length;i ++){
//         i.addEventListener('click', deleteButton);
//     }







// FONCTIONS //////////////// 
function onClickDelete(event)
{
    // On annule le comportement par défaut du navigateur
    event.preventDefault();
    
    // On affiche une boîte de dialogue de confirmation et on récupère la réponse de l'internaute
    const confirmed = window.confirm('Êtes-vous certain de vouloir supprimer cet article ?');

    // Si l'internaute confirme effectivement la suppression
    if (confirmed) {

        // VERSION 1 : redirection, on change de page
        // On redirige l'internaute vers la suppression en allant chercher le href du lien cliqué
        // window.location.replace(this.href);

        // VERSION 2 : on envoie une requête AJAX avec la fonction fetch


        // Lors de la récéption de la réponse, on récupère l'id de l'article supprimé pour supprimer le <tr> correspondant

    }
}


// CODE PRINCIPAL //////////////////
const deleteLinks = document.querySelectorAll('.delete-button');

for (let link of deleteLinks) {

    link.addEventListener('click', onClickDelete);
}