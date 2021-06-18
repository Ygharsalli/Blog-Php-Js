<?php 

namespace App\Model;

use App\Framework\AbstractModel;

class UserModel extends AbstractModel {

    public function insertUser(string $firstname, string $lastname, string $email, string $password)
    {
        $sql = 'INSERT INTO user (firstname, lastname, email, password, created_at)
                VALUES (?,?,?,?,NOW())';

        $this->database->executeQuery($sql, [$firstname, $lastname, $email, $password]);
    }

    public function getUserByEmail(string $email)
    {
        $sql = 'SELECT *
                FROM user
                WHERE email = ?';

        return $this->database->getOneResult($sql, [$email]);
    }

    public function checkCredentials(string $email, string $password)
    {
        // On va chercher dans la base l'utilisateur qui correspond à l'email
        $user = $this->getUserByEmail($email);

        // Si on ne trouve aucun utilisateur avec cet email => échec
        if (!$user) {
            return false;
        }

        // Ensuite si le mot de passe est inccorrect => échec
        if (!password_verify($password, $user['password'])) {
            return false;
        }

        // Si tout est ok, on retourne l'utilisateur
        return $user;
    }

}