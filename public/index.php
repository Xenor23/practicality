<?php
    session_start();
    


use App\Router\Router;
use App\Models\Manager\EventManager;
use App\Controllers\User\UserController;
use App\Controllers\Admin\AdminController;
use App\Controllers\Event\EventController;
use App\Controllers\Visitor\VisitorController;
use App\Controllers\Participant\ParticipantController;

require_once __DIR__ . "/../vendor/autoload.php";

// Définition de la constante URL pour l'URL de base de l'application
define("URL", str_replace(
    "public/",
    "",
    str_replace(
        "index.php",
        "",
        (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . dirname($_SERVER['PHP_SELF'])
    ) . '/'
));

define("URL2", URL . 'admin/dashboard/');

define('UPLOAD_PATH', __DIR__ . '/assets/img/uploads/');
define('VIEWS_PATH', __DIR__ . '/../App/Views/');
define('CSS', URL . 'assets/css/');
define('JS', URL . 'assets/js/');
define('IMG', URL . 'assets/img/');


$visitor = new VisitorController();
$user = new UserController();
$admin = new AdminController();
$event = new EventController();
$eventManager = new EventManager();

$router = new Router();

$router->addRoute('GET', 'home', VisitorController::class, 'home');
$router->addRoute('GET', 'login', VisitorController::class, 'login');
$router->addRoute('GET', 'account', VisitorController::class, 'account');
$router->addRoute('GET', 'register', VisitorController::class, 'register');
$router->addRoute('GET', 'logout', UserController::class, 'logout');
$router->addRoute('GET', 'event', VisitorController::class, 'event');
$router->addRoute('GET', 'ranking', ParticipantController::class, 'ranking');
$router->addRoute('GET', 'registerParticipant', ParticipantController::class, 'registerParticipant');
$router->addRoute('GET', 'privacy', VisitorController::class, 'privacy');
$router->addRoute('GET', 'terms', VisitorController::class, 'terms');


$router->addRoute('POST', 'loginValidation', UserController::class, 'loginValidation');
$router->addRoute('POST', 'registerValidation', UserController::class, 'registerValidation');
$router->addRoute('POST', 'deleteUser', UserController::class, 'deleteUser');
$router->addRoute('POST', 'changeUserRole', UserController::class, 'changeUserRole');
$router->addRoute('POST', 'updateProfile', UserController::class, 'updateProfile');
$router->addRoute('POST', 'updatePassword', UserController::class, 'updatePassword');
$router->addRoute('POST', 'createEvent', EventController::class, 'createEvent');
$router->addRoute('POST', 'deleteEvent', EventController::class, 'handleDeleteEvent');
$router->addRoute('POST', 'handleRegisterParticipant', ParticipantController::class, 'handleRegisterParticipant');


$router->addRoute('GET', 'admin', AdminController::class, 'dashboard', true);
$router->addRoute('GET', 'admin/dashboard', AdminController::class, 'dashboard', true);
$router->addRoute('GET', 'admin/dashboard/manageEvents', AdminController::class, 'manageEvents', true);
$router->addRoute('GET', 'admin/dashboard/manageUsers', UserController::class, 'listUsers', true);
$router->addRoute('GET', 'admin/dashboard/manageEvents/eventform', AdminController::class, 'eventform', true);

try {
    // Dispatching des routes
    $router->dispatch($_GET['page'] ?? 'home');
} catch (Exception $exception) {
    $error = $exception->getMessage();
    include VIEWS_PATH . 'error.view.php';
}

// Supprime $_SESSION['admin'] après la gestion d'une exception ou après la déconnexion (dépend de ma config)
unset($_SESSION['admin']);