<?php 

namespace App\Controller;

use App\Framework\AbstractController;
use App\Model\CommentModel;
use App\Framework\UserSession;
use App\Framework\FlashBag;
use App\Model\ArticleModel;

class ArticleController extends AbstractController {

    public function index()
    {
        // Validation du paramètre id de la chaîne de requête. Si PB => 404
        if (!array_key_exists('id', $_GET) || !$_GET['id'] || !ctype_digit($_GET['id'])) {
            http_response_code(404); // On modifie le code de status de la réponse HTTP 
            echo '404 NOT FOUND'; // On affiche un message à l'internaute
            exit; // On arrête le script PHP, on n'a plus rien à faire ! 
        }

        // Récupérer le paramètre id de la chaîne de requête
        $articleId = (int) $_GET['id']; // ou bien $articleId = intval($_GET['id']);

        $articleModel = new ArticleModel();
        $article = $articleModel->getOneArticle($articleId);

        // Est-ce qu'il y a bien un résultat ? Sinon => 404
        if (!$article) {
            http_response_code(404); // On modifie le code de status de la réponse HTTP 
            echo '404 NOT FOUND'; // On affiche un message à l'internaute
            exit; // On arrête le script PHP, on n'a plus rien à faire ! 
        }

        // Get comments
        $commentModel = new CommentModel();
        $comments = $commentModel->getAllComments($articleId);

        // Affichage
        return $this->render('article', [
            'article' => $article,
            'comments' => $comments
        ]);
    }

    public function addComment()
    {
        // Si l'utilisateur n'est pas connecté on n'ajoute pas de commentaire
        if (UserSession::isAuthenticated()) {

            $articleId = (int) $_POST['article-id'];
            $content = trim($_POST['content']);

            // Validation du formulaire : le champ commentaire est-il correctement rempli ?
            $errors = [];

            if (strlen($content)===0) {
                $errors[] = 'Le champ Commentaire est obligatoire';
            }

            // Pour chaque erreur on ajoute un message flash d'erreur
            foreach ($errors as $error) {
                FlashBag::addFlash($error, 'error');
            }

            // S'il n'y a pas d'erreurs
            if (empty($errors)) {

                $userId = UserSession::getId();
                $commentModel = new CommentModel();
                $commentModel->insertComment($content, $articleId, $userId);

                FlashBag::addFlash('Votre commentaire a bien été ajouté.');
            }
        }

        // Redirection
        $this->redirect('article', ['id' => $articleId]);
    }
}