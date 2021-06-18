<?php 

namespace App\Model;

use App\Framework\AbstractModel;

class ArticleModel extends AbstractModel {
    
    /**
     * Sélectionne un article à partir de son identifiant
     */
    function getOneArticle(int $id): array
    {
        $sql = 'SELECT *, A.id AS article_id
                FROM article  A
                INNER JOIN category AS C ON A.category_id = C.id
                WHERE A.id = ?';
    
        $article = $this->database->getOneResult($sql, [$id]);
    
        return $article;
    }

    /**
     * Sélectionne plusieurs articles
     * Le paramètre $categoryId est facultatif. S'il n'est pas présent ou si sa valeur est null, tous les articles sont sélectionnés
     * Si le paramètre $categoryId est présent et non null, on sélectionne uniquement les articles de la catégorie correspondante
     * 
     * Rem. : la jointure va chercher les données dans 2 tables qui ont le champ id en commun. Il est alors nécessaire 
     *        de spécifier dans la clause SELECT les champs individuellement en précisant éventuellement pour les champs ambigus la table et un alias
     */
    function getAllArticles(int $categoryId = null): array
    {
        $sql = 'SELECT A.id AS article_id, title, content, A.created_at, C.label AS category_label, A.category_id, U.firstname, U.lastname
                FROM article AS A  
                INNER JOIN category AS C ON A.category_id = C.id
                INNER JOIN user AS U ON U.id = A.user_id';

        $params = [];
        /**
         * Si on cherche les articles d'une catégorie spécifique, on ajoute une clause WHERE à la requête SQL pour filtrer les articles sur cette catégorie
         * On complète également le tableau de paramètres
         */
        if ($categoryId) {
            $sql .= ' WHERE A.category_id = ?';
            $params[] = $categoryId;
        }
                
        $sql .= ' ORDER BY A.created_at DESC';

        $articles = $this->database->getAllResults($sql, $params);

        return $articles;
    }

    /**
     * Insert un article dans la base de données
     */
    public function insert(string $title, string $content, int $categoryId,$userId)
    {
        $sql = 'INSERT INTO article 
                (title, content, category_id, user_id, created_at)
                VALUES (?,?,?,?,NOW())';

        $this->database->executeQuery($sql, [$title, $content, $categoryId,$userId]);
    }

    public function update( string $title, string $content, int $categoryId, $articleId){
        $sql = 'UPDATE article
        set title = ?,
        content = ?,
        category_id = ?
          
            
        where id = ?';
              

        $this->database->executeQuery($sql, [$title, $content, $categoryId,$articleId]);

    }

    public function delete(  $articleId){
        $sql = 'DELETE FROM article
        where id = ?';

        $this->database->executeQuery($sql, [$articleId]);
    }
}