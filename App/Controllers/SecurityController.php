<?php

namespace App\Controllers;

class SecurityController
{
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function isUserLoggedIn(): bool
    {
        return isset($_SESSION['user']);
    }

    public function requireUser(): void
    {
        if (!$this->isUserLoggedIn()) {
            $this->redirectToRoute("login");
        }
    }

    public function isAdminLoggedIn(): bool
    {
        return $this->isUserLoggedIn() && isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin';
    }

    public function requireAdmin(): void
    {
        if (!$this->isAdminLoggedIn()) {
            $this->redirectToRoute("login");
        }
    }

    public function redirectToRoute(string $route): void
    {
        header("Location: " . URL . $route);
        exit();
    }

    public function redirectToRouteAdmin(string $route): void
    {
        header("Location: " . URL2 . $route);
        error_log("ah");
        exit();
    }

    public function cleanInput($data): string
    {
        if (!isset($data) || empty($data)) {
            return '';
        }
        return htmlspecialchars(trim($data));
    }

    public function generateCsrfToken(): string
    {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    public function verifyCsrfToken(string $token): bool
    {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
}

?>
