<?php

namespace App\Controllers\Participant;

use App\Models\Entity\Participant;
use App\Models\Manager\UserManager;
use App\Models\Manager\EventManager;
use App\Controllers\DisplayController;
use App\Controllers\AbstractController;
use App\Models\Manager\ParticipantManager;

class ParticipantController extends AbstractController
{
    private $eventManager;
    private $participantManager;

    public function __construct()
    {
        $this->eventManager = new EventManager();
        $this->participantManager = new ParticipantManager();
    }

    public function registerParticipant()
    {
        $eventId = $_GET['event_id'] ?? null;
        $userId = $_GET['user_id'] ?? null;

        if (!$eventId || !$userId) {
            DisplayController::messageAlert("Données d'inscription invalides, l'événement n'existe pas", DisplayController::ROUGE);
            $this->redirectToRoute("event");
        }

        if ($this->participantManager->participantExists($eventId, $userId)) {
            DisplayController::messageAlert("Vous êtes déjà inscrit à cet événement.", DisplayController::ROUGE);
            $this->redirectToRoute("event");
        }

        $event = $this->eventManager->getEventById($eventId);
        if (!$event) {
            DisplayController::messageAlert("Événement non trouvé.", DisplayController::ROUGE);
            $this->redirectToRoute("home");
        }

        $title = "Inscription à l'événement";
        $list = ["Participant/registerParticipant.view"];

        $this->render($list, ["title" => $title, "eventId" => $eventId, "userId" => $userId]);
    }

    public function handleRegisterParticipant()
    {
        $eventId = $_POST['event_id'] ?? null;
        $userId = $_POST['user_id'] ?? null;
        $position = $_POST['position'] ?? 0;
        $points = $_POST['points'] ?? 0;

        // Validation des données
        if ($eventId && $userId && is_numeric($position) && is_numeric($points)) {
            // Appeler le manager pour enregistrer les données
            $result = $this->participantManager->registerParticipant($eventId, $userId, $position, $points);

            if ($result) {
                // Rediriger vers une page de succès ou d'événement
                DisplayController::messageAlert("Inscription réussie à l'événement.", DisplayController::VERTE);
                $this->redirectToRoute("home");
            } else {
                // Afficher un message d'erreur
                DisplayController::messageAlert("L'inscription a échoué. Veuillez réessayer.", DisplayController::ROUGE);
                $this->redirectToRoute("home");
            }
        } else {
            // Afficher un message d'erreur pour les champs invalides
            DisplayController::messageAlert("Tous les champs sont obligatoires.", DisplayController::ROUGE);
            $this->redirectToRoute("home");
        }
    }

    public function ranking()
{
    $eventId = $_GET['event_id'] ?? null;

    $participantManager = new ParticipantManager();
    $participants = $participantManager->getParticipantsByEvent($eventId);

    $userManager = new UserManager();

    foreach ($participants as $participant) {
        $user = $userManager->getUserById($participant->getUserId());
        $participant->setUser($user);
    }

    $list = ["Participant/ranking.view"];
    $title = "Classement";
    $this->render($list, ['title' => $title,'participants' => $participants]);
}

}

?>
