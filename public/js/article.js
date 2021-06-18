/////////////////////////////
// FONCTIONS //////////////// 
/////////////////////////////

async function onSubmitAddCommentForm(event)
{
    // On stoppe le comportement par défaut du navigateur (soumission du formulaire)
    event.preventDefault();

    // On va chercher les données du formulaire en créant un objet FormData
    const formData = new FormData(form);

    // On récupère l'action du formulaire : ce sera l'URL vers laquelle on enverra la requête AJAX
    const url = form.action;

    // Construction des options de la requête AJAX avec la méthode POST et le body contenant le formData
    const options = {
        method: 'post',
        body: formData
    };

    // On envoie une requête AJAX vers l'URL de l'action du formulaire en POST en transmettant les données du formulaire dans le body
    const response = await fetch(url, options);
    const htmlComment = await response.text();

    console.log(htmlComment);

    // Lors de la réception de la réponse, on insère simplement le code HTML reçu en haut de la liste des commentaires
}

////////////////////////////////////
// CODE PRINCIPAL //////////////////
////////////////////////////////////

// On sélectionne le formulaire d'ajout de commentaire auquel on a mis l'id 'add-comment-form'
const form = document.getElementById('add-comment-form');

// On écoute sur le formulaire l'événement 'submit' qui est lancé par le navigateur lors du click sur le bouton de soumission du formulaire
form.addEventListener('submit', onSubmitAddCommentForm);/////////////////////////////
// FONCTIONS //////////////// 
/////////////////////////////

async function onSubmitAddCommentForm(event)
{
    // On stoppe le comportement par défaut du navigateur (soumission du formulaire)
    event.preventDefault();

    // On va chercher les données du formulaire en créant un objet FormData
    const formData = new FormData(form);

    // On récupère l'action du formulaire : ce sera l'URL vers laquelle on enverra la requête AJAX
    const url = form.action;

    // Construction des options de la requête AJAX avec la méthode POST et le body contenant le formData
    const options = {
        method: 'post',
        body: formData
    };

    // On envoie une requête AJAX vers l'URL de l'action du formulaire en POST en transmettant les données du formulaire dans le body
    const response = await fetch(url, options);
    const htmlComment = await response.text();

    console.log(htmlComment);

    // Lors de la réception de la réponse, on insère simplement le code HTML reçu en haut de la liste des commentaires
}

////////////////////////////////////
// CODE PRINCIPAL //////////////////
////////////////////////////////////

// On sélectionne le formulaire d'ajout de commentaire auquel on a mis l'id 'add-comment-form'
const form = document.getElementById('add-comment-form');

// On écoute sur le formulaire l'événement 'submit' qui est lancé par le navigateur lors du click sur le bouton de soumission du formulaire
form.addEventListener('submit', onSubmitAddCommentForm);