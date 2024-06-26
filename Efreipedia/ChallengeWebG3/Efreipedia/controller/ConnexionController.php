<?php
require_once './model/ConnexionModel.php';

class utilisateur{
    protected $modele;

    public function __construct() {
        $this->modele = new utilisateurConnexion();
    }

    public function getConnexionForm() {
        require_once './view/authentification.php';
    }
   
    public function getUtilisateurConnexion() {
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
            $utilisateur = $this->modele->getUtilisateurbyEmail($email);
            if ($utilisateur && password_verify($_POST['motdepasse'], $utilisateur['motdepasse'])) {
                $_SESSION['pseudo'] = $utilisateur['pseudo'];
                $_SESSION['email'] = $utilisateur['email'];
                $_SESSION['tel'] = $utilisateur['telephone'];
                echo "<meta http-equiv='refresh' content='0;url=accueil'>";
            } else {
                echo 'invalid password';
                $this->getConnexionForm();
                return;
            }
        }
        $this->getConnexionForm();
        }
}