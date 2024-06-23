<?php

namespace App\Controllers\Visitor;

use App\Controllers\AbstractController;
use App\Controllers\SecurityController;

class VisitorController extends AbstractController
{
    private SecurityController $security;

    public function __construct()
    {
        $this->security = new SecurityController();
    }

    public function home(): void
    {
        $title = "Accueil";
        $list = ["Visitor/home.view"];

        $this->render($list, ["title" => $title]);
    }

    public function account(): void
    {
        $title = "Mon Compte";
        $list = ["Visitor/account.view"];

        $this->render($list, ["title" => $title]);
    }

    public function login(): void
    {
        // Vérifie si l'utilisateur est déjà connecté, si oui, rediriger
        if ($this->security->isUserLoggedIn()) {
            $this->redirectToRoute("account");
        }

        $title = "Se connecter";
        $list = ["Visitor/login.view"];

        $this->render($list, ["title" => $title]);
    }


    public function register(): void
    {
        $title = "S'inscrire";
        $token = $this->security->generateCsrfToken();
        $list = ["Visitor/register.view"];

        $this->render($list, [
            "title" => $title,
            "token" => $token,
        ]);
    }

    public function event(): void
    {
        $title = "Event";
        $list = ["Visitor/event.view"];

        $this->render($list, ["title" => $title]);
    }

    public function privacy(): void
    {
        $title = "Politique de confidentialité";
        $list = ["Visitor/privacy.view"];

        $this->render($list, ["title" => $title]);
    }

    public function terms(): void
    {
        $title = "Conditions d'utilisation";
        $list = ["Visitor/terms.view"];

        $this->render($list, ["title" => $title]);
    }

    public function ranking(): void
    {
        $title = "Classement";
        $list = ["Participant/ranking.view"];

        $this->render($list, ["title" => $title]);
    }



}

?>
