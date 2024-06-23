<?php

namespace App\Controllers\User;

use App\Controllers\AbstractController;
use App\Controllers\DisplayController;
use App\Controllers\SecurityController;
use App\Models\Entity\User;
use App\Models\Manager\UserManager;

class UserController extends AbstractController
{
    private SecurityController $security;
    private UserManager $userManager;

    public function __construct()
    {
        $this->security = new SecurityController();
        $this->userManager = new UserManager();
    }

    public function registerValidation(): void
    {
        $firstname = $this->security->cleanInput($_POST['firstname'] ?? '');
        $email = $this->security->cleanInput($_POST['email'] ?? '');
        $password = $this->security->cleanInput($_POST['password_hash'] ?? '');
        $confirmPassword = $this->security->cleanInput($_POST['confirm_password'] ?? '');
        $lastname = $this->security->cleanInput($_POST['lastname'] ?? '');
        $age = (int) ($this->security->cleanInput($_POST['age'] ?? '') ?? 0);
        $country = $this->security->cleanInput($_POST['country'] ?? '');
        $username = $this->security->cleanInput($_POST['username'] ?? '');
        $csrfToken = $this->security->cleanInput($_POST['csrf_token'] ?? '');

        if (!$this->security->verifyCsrfToken($csrfToken)) {
            DisplayController::messageAlert("Veuillez réessayer plus tard", DisplayController::ROUGE);
            $this->redirectToRoute("register");
        }

        if (empty($firstname) || empty($email) || empty($password) || empty($confirmPassword)) {
            DisplayController::messageAlert("Tous les champs sont requis", DisplayController::ROUGE);
            $this->redirectToRoute("register");
        }

        if ($this->userManager->getUserByEmail($email)) {
            DisplayController::messageAlert("Un compte avec cet email existe déjà", DisplayController::ROUGE);
            $this->redirectToRoute("register");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            DisplayController::messageAlert("Email non valide", DisplayController::ROUGE);
            $this->redirectToRoute("register");
        }

        if ($password !== $confirmPassword) {
            DisplayController::messageAlert("Les mots de passe ne correspondent pas", DisplayController::ROUGE);
            $this->redirectToRoute("register");
        }

        $user = new User($firstname, $email, $password, 'user', $lastname, $age, $username, $country);
        $valid = $this->userManager->insertUser($user);
        if ($valid) {
            DisplayController::messageAlert("Inscription réussie", DisplayController::VERTE);
            $this->redirectToRoute("home");
        } else {
            DisplayController::messageAlert("Erreur lors de l'inscription", DisplayController::ROUGE);
            $this->redirectToRoute("register");
        }
    }

    public function loginValidation(): void
    {
        $email = $this->security->cleanInput($_POST['email'] ?? '');
        $password = $this->security->cleanInput($_POST['password_hash'] ?? '');
        

        if (empty($email) || empty($password)) {
            DisplayController::messageAlert("Tous les champs sont requis", DisplayController::ROUGE);
            $this->redirectToRoute("login");
        }

        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            DisplayController::messageAlert("Email non valide", DisplayController::ROUGE);
            $this->redirectToRoute("login");
        }

        $user = $this->userManager->getUserByEmail($email);

        if ($user && password_verify($password, $user['password_hash'])) {
            session_regenerate_id();
            $_SESSION['user'] = $user;
            if ($user['role'] === 'admin') {
                $this->redirectToRoute('admin');
            }
            $this->redirectToRoute("home");
        } else {
            DisplayController::messageAlert("Identifiants incorrects", DisplayController::ROUGE);
            $this->redirectToRoute("login");
        }
    }

    public function logout(): void
    {
        $_SESSION = [];
        session_destroy();
        $this->redirectToRoute("home");
    }


    public function listUsers(): void
    {
        $users = $this->userManager->getAllUsers();
        $title= "Gestion des utilisateurs";
        $list = ["Admin/manageUsers.view"];
        $this->render($list, ['users' => $users, 'title' => $title], "admin");
    }
    
    public function deleteUser(): void
    {
        $userId = $this->security->cleanInput($_POST['user_id'] ?? '');
        if ($this->userManager->deleteUser($userId)) {
            DisplayController::messageAlert("Utilisateur supprimé avec succès", DisplayController::VERTE);
        } else {
            DisplayController::messageAlert("Erreur lors de la suppression de l'utilisateur", DisplayController::ROUGE);
        }
        $this->redirectToRouteAdmin("manageUsers");
    }
    
    public function changeUserRole(): void
    {
        $userId = $this->security->cleanInput($_POST['user_id'] ?? '');
        $role = $this->security->cleanInput($_POST['role'] ?? '');
        if (in_array($role, ['user', 'admin']) && $this->userManager->updateUserRole($userId, $role)) {
            DisplayController::messageAlert("Rôle mis à jour avec succès", DisplayController::VERTE);
        } else {
            DisplayController::messageAlert("Erreur lors de la mise à jour du rôle", DisplayController::ROUGE);
        }
        $this->redirectToRouteAdmin("manageUsers");
    }
    
    

    public function updatePassword(): void
    {
        $currentPassword = $this->security->cleanInput($_POST['currentPassword'] ?? '');
        $newPassword = $this->security->cleanInput($_POST['newPassword'] ?? '');
        $confirmPassword = $this->security->cleanInput($_POST['confirmPassword'] ?? '');


        if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
            DisplayController::messageAlert("Tous les champs sont requis", DisplayController::ROUGE);
            $this->redirectToRoute("account");
        }

        if ($newPassword !== $confirmPassword) {
            DisplayController::messageAlert("Les mots de passe ne correspondent pas", DisplayController::ROUGE);
            $this->redirectToRoute("account");
        }

        $email = $_SESSION['user']['email'];
        $user = $this->userManager->getUserByEmail($email);

        if ($user && $this->userManager->verifyPassword($email, $currentPassword)) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $success = $this->userManager->updatePassword($email, $hashedPassword);

            if ($success) {
                DisplayController::messageAlert("Mot de passe mis à jour avec succès", DisplayController::VERTE);
                $this->redirectToRoute("account");
            } else {
                DisplayController::messageAlert("Erreur lors de la mise à jour du mot de passe", DisplayController::ROUGE);
                $this->redirectToRoute("account");
            }
        } else {
            DisplayController::messageAlert("Mot de passe actuel incorrect", DisplayController::ROUGE);
            $this->redirectToRoute("account");
        }
    }


    public function updateProfile(): void
{
    $firstname = $this->security->cleanInput($_POST['firstname'] ?? '');
    $lastname = $this->security->cleanInput($_POST['lastname'] ?? '');
    $email = $this->security->cleanInput($_POST['email'] ?? '');

    // Vérification des champs vides
    if (empty($firstname) || empty($lastname) || empty($email)) {
        DisplayController::messageAlert("Tous les champs sont requis", DisplayController::ROUGE);
        $this->redirectToRoute("account");
    }

    // Vérification de la validité de l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        DisplayController::messageAlert("Email non valide", DisplayController::ROUGE);
        $this->redirectToRoute("account");
    }

    // Récupération de l'utilisateur actuel depuis la session
    $currentEmail = $_SESSION['user']['email'];
    $user = $this->userManager->getUserByEmail($currentEmail);

    if ($user) {
        // Mise à jour des informations de l'utilisateur
        $success = $this->userManager->updateUserProfile($currentEmail, $firstname, $lastname, $email);

        if ($success) {
            // Mise à jour des informations de l'utilisateur dans la session
            $_SESSION['user']['firstname'] = $firstname;
            $_SESSION['user']['lastname'] = $lastname;
            $_SESSION['user']['email'] = $email;

            DisplayController::messageAlert("Profil mis à jour avec succès", DisplayController::VERTE);
            $this->redirectToRoute("account");
        } else {
            DisplayController::messageAlert("Erreur lors de la mise à jour du profil", DisplayController::ROUGE);
            $this->redirectToRoute("account");
        }
    } else {
        DisplayController::messageAlert("Utilisateur non trouvé", DisplayController::ROUGE);
        $this->redirectToRoute("account");
    }
}
}

