<?php
namespace App\Router;

use App\Controllers\SecurityController;
use Exception;

class Router
{
    private $routes = [];         // Tableau des routes user/visitor
    private $adminRoutes = [];    // Tableau des routes admin

    // Méthode pour ajouter une route
    public function addRoute($method, $path, $controller, $action, $isAdmin = false)
    {
        // tableau représentant la route
        $route = compact('method', 'path', 'controller', 'action');

        // Array approprié en fonction d'admin ou non
        if ($isAdmin) {
            $this->adminRoutes[] = $route;  // Ajout dans les routes admin
        } else {
            $this->routes[] = $route;       // Ajout dans les routes publiques
        }
    }

    // Méthode pour dispatcher (routage) une URL
    public function dispatch($url)
    {
        // Séparation de l'URL 
        $parsedUrl = explode("/", filter_var($url, FILTER_SANITIZE_URL));

        // Récupération de la méthode
        $method = $_SERVER['REQUEST_METHOD'];

        // Vérification admin
        $securityController = new SecurityController();
        $isAdmin = $securityController->isAdminLoggedIn();

        // Sélection des routes admin ou non
        $routes = $isAdmin ? array_merge($this->routes, $this->adminRoutes) : $this->routes;

        // Tri des routes par longueur décroissante
        usort($routes, function($a, $b) {
            return strlen($b['path']) - strlen($a['path']);
        });

        // Parcours des routes le match de l'URL
        foreach ($routes as $route) {
            $routePathSegments = explode('/', $route['path']);
            $isMatch = true;

            // Vérification des morceaux (segments)
            foreach ($routePathSegments as $index => $segment) {
                if (!isset($parsedUrl[$index]) || $parsedUrl[$index] !== $segment) {
                    $isMatch = false;
                    break;
                }
            }

            // Vérification entre méthode et chemin
            if ($method === $route['method'] && $isMatch) {
                $controller = new $route['controller'];

                // Supression des chemins dans $parsedUrl pour laisser que ce qui n'est pas utilisé
                for ($i = 0; $i < count($routePathSegments); $i++) {
                    array_shift($parsedUrl);
                }

                // Appel de la méthode avec les paramètres
                call_user_func_array([$controller, $route['action']], $parsedUrl);
                return;
            }
        }

        throw new Exception("La page n'existe pas");
    }
}
