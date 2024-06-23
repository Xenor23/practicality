
<div class="container mt-5">
    <H1 class="my-4" style="color: var(--btn-color); font-weight: 600;">Liste des événements</H1>
    <div class="row">

    <?php
   // event.view.php
   
   // Démarrer la session si elle n'est pas déjà démarrée
   if (session_status() == PHP_SESSION_NONE) {
       session_start();
   }
   
   use App\Controllers\Event\EventController;
   use App\Models\Entity\User;
   
   // Récupérer l'utilisateur actuel de la session
   $userData = $_SESSION['user'] ?? null;
   if ($userData) {
       // Créer une instance de l'utilisateur actuel
       $user = new User(
           $userData['firstname'],
           $userData['email'],
           $userData['password_hash'],
           $userData['role'],
           $userData['lastname'],
           $userData['age'],
           $userData['username'],
           $userData['country']
       );
       $user->setId($userData['id']);
   
       // Afficher les événements
       $eventController = new EventController();
       $eventController->showEvents($user);
   } else {
       echo "Veuillez vous connecter pour voir les événements.";
   }
   
    ?>
    </div>
</div>