<?php 

namespace App\Controller\Admin;

use App\Framework\AbstractController;
use App\Model\ArticleModel;

class AdminController extends AbstractController {

    /**
     * Action responsable de l'affichage du dashboard
     */
    public function index()
    {
        return $this->render('admin/admin', [
            'articles' => (new ArticleModel())->getAllArticles()
        ]);
    }
}