<?php

namespace App\Models\Manager;

use App\Core\Database;
use App\Models\Entity\Event;
use App\Models\Entity\Image;
use App\Models\Entity\User;

class EventManager
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function insertEvent(Event $event, ?int $imageId): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO events (name, description, start_datetime, end_datetime, min_players, max_players, status, created_by, requirements, type, image_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );

        $insertValid = $stmt->execute([
            $event->getName(),
            $event->getDescription(),
            $event->getStartDateTime()->format('Y-m-d H:i:s'),
            $event->getEndDateTime()->format('Y-m-d H:i:s'),
            $event->getMinPlayers(),
            $event->getMaxPlayers(),
            $event->getStatus(),
            $event->getCreatedBy(),
            $event->getRequirements(),
            $event->getType(),
            $imageId
        ]);

        return $insertValid;
    }

    public function getAllEvents(): array
    {
        $stmt = $this->db->query("SELECT * FROM events WHERE end_datetime >= NOW()");
        $events = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $eventObjects = [];
        foreach ($events as $eventData) {
            $image = null;
            if ($eventData['image_id']) {
                $image = $this->getImageById($eventData['image_id']);
            }

            $event = new Event(
                $eventData['name'],
                $eventData['description'],
                new \DateTime($eventData['start_datetime']),
                new \DateTime($eventData['end_datetime']),
                (int) $eventData['min_players'],
                (int) $eventData['max_players'],
                $eventData['status'],
                (int) $eventData['created_by'],
                $eventData['requirements'],
                $eventData['type'],
                $image
            );

            $event->setId($eventData['id']);

            $eventObjects[] = $event;
        }

        return $eventObjects;
    }

    public function getEventById(int $id): ?Event
{
    $stmt = $this->db->prepare("SELECT * FROM events WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $eventData = $stmt->fetch(\PDO::FETCH_ASSOC);

    if ($eventData) {
        $image = null;
        if (!empty($eventData['image_id'])) {
            $image = $this->getImageById($eventData['image_id']);
        }

        $event = new Event(
            $eventData['name'],
            $eventData['description'],
            new \DateTime($eventData['start_datetime']),
            new \DateTime($eventData['end_datetime']),
            (int) $eventData['min_players'],
            (int) $eventData['max_players'],
            $eventData['status'],
            (int) $eventData['created_by'],
            $eventData['requirements'],
            $eventData['type'],
            $image
        );
        $event->setId($eventData['id']);
        return $event;
    }

    return null;
}


    public function getImageById(int $imageId): ?Image
    {
        $stmt = $this->db->prepare("SELECT * FROM images WHERE id = ?");
        $stmt->execute([$imageId]);
        $imageData = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$imageData) {
            return null;
        }

        return new Image(
            $imageData['file_name'],
            $imageData['file_path'],
            new \DateTime($imageData['uploaded_at'])
        );
    }

    public function getUserById(int $userId): ?User
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        $userData = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$userData) {
            return null;
        }

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
        
        return $user;
    }

    public function insertImage(Image $image): int
    {
        $stmt = $this->db->prepare(
            "INSERT INTO images (file_name, file_path, uploaded_at)
            VALUES (?, ?, ?)"
        );

        $insertValid = $stmt->execute([
            $image->getFileName(),
            $image->getFilePath(),
            $image->getUploadedAt()->format('Y-m-d H:i:s')
        ]);

        if ($insertValid) {
            return (int) $this->db->lastInsertId();
        } else {
            return -1;
        }
    }

    public function deleteExpiredEvents(): int
    {
        $stmt = $this->db->prepare("DELETE FROM events WHERE end_datetime < NOW()");
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function deleteEvent(int $eventId): bool
    {
        $stmt = $this->db->prepare("DELETE FROM events WHERE id = ?");
        $deletedEvent = $stmt->execute([$eventId]);
        return $deletedEvent;
    }

    public function generateEvent(Event $event, User $user): string
{
    $id = $event->getId();
    $userId = $user->getId();

    $name = htmlspecialchars($event->getName());
    $description = htmlspecialchars($event->getDescription());
    $startDateTime = $event->getStartDateTime()->format('Y-m-d H:i:s');
    $endDateTime = $event->getEndDateTime()->format('Y-m-d H:i:s');
    $minPlayers = $event->getMinPlayers();
    $maxPlayers = $event->getMaxPlayers();
    $requirements = htmlspecialchars($event->getRequirements());
    $type = htmlspecialchars($event->getType());
    $createdByUser = $this->getUserById($event->getCreatedBy());
    $createdByUsername = $createdByUser ? htmlspecialchars($createdByUser->getUsername()) : "Utilisateur inconnu";

    $imagePath = $event->getImage() ? htmlspecialchars($event->getImage()->getFilePath()) : '';
    $imageSrc = "/practicality/public/assets/img/uploads/" . basename($imagePath);

    $cardStyle = "background-image: url('$imageSrc'); background-size: cover; background-position: center; background-repeat: no-repeat; position: relative; overflow: hidden; height: 400px; border: 5px solid grey";
    $cardBodyStyle = "background-color: rgba(0, 0, 0, 0.5); color: #fff; font-weight: 600; height: 100%; overflow-y: auto; padding: 15px; backdrop-filter: blur(1px);";

    $registerUrl = URL . "registerParticipant?event_id=$id&user_id=$userId";
    $rankingUrl = URL . "ranking?event_id=$id";

    $cardHtml = "
        <div class=\"col-md-4 mb-4\">
            <div class=\"card shadow-sm\" style=\"$cardStyle\">
                <div style=\"$cardBodyStyle\">
                    <h5 class=\"card-title text-light\">$name</h5>
                    <p class=\"card-text\"><strong>Créé par :</strong> $createdByUsername</p>
                    <p class=\"card-text description-overflow\">$description</p>
                    <p class=\"card-text\"><small>$startDateTime - $endDateTime</small></p>
                    <p class=\"card-text\"><strong>Nombre de joueurs :</strong> $minPlayers - $maxPlayers</p>
                    <p class=\"card-text\"><strong>Prérequis :</strong> $requirements</p>
                    <p class=\"card-text\"><strong>Type :</strong> $type</p>
                    <div class=\"d-flex justify-content-between align-items-center mt-auto\">
                        <div class=\"btn-group\">
                            <a href=\"#\" class=\"btn btn-sm btn-outline-light\" data-bs-toggle=\"modal\" data-bs-target=\"#eventModal-$id\">Détails</a>
                            <a href=\"$registerUrl\" class=\"btn btn-sm btn-outline-light\">S'inscrire</a>
                            <a href=\"$rankingUrl\" class=\"btn btn-sm btn-outline-light\">Classement</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    ";





        $modalHtml = "
        <div class=\"modal fade\" id=\"eventModal-$id\" tabindex=\"-1\" aria-labelledby=\"eventModalLabel-$id\" aria-hidden=\"true\">
            <div class=\"modal-dialog modal-dialog-centered\">
                <div class=\"modal-content\">
                    <div class=\"modal-header\">
                        <h5 class=\"modal-title\" id=\"eventModalLabel-$id\"><strong>$name</strong></h5>
                        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
                    </div>
                    <div class=\"modal-body\" style=\"max-height: calc(100vh - 200px); overflow-y: auto;\">
                        <img src=\"$imageSrc\" class=\"img-fluid mb-3\" alt=\"$name\">
                        <p><strong>Créé par :</strong> $createdByUsername</p>
                        <p>$description</p>
                        <p><small class=\"text-muted\">$startDateTime - $endDateTime</small></p>
                        <p><strong>Nombre de joueurs :</strong> $minPlayers - $maxPlayers</p>
                        <p><strong>Prérequis :</strong> $requirements</p>
                        <p><strong>Type :</strong> $type</p>
                    </div>
                    <div class=\"modal-footer\">
                        <button type=\"button\" class=\"btn btn-secondary\" data-bs-dismiss=\"modal\">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
        ";

        $additionalCss = "
        <style>
        .description-overflow {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
            overflow: hidden;
        }
        </style>
        ";

        echo $additionalCss . $modalHtml;
        return $cardHtml;
    }

    public function formatEventData(Event $event): array
    {
        $createdByUser = $this->getUserById($event->getCreatedBy());
        return [
            'id' => $event->getId(),
            'name' => htmlspecialchars($event->getName()),
            'description' => htmlspecialchars($event->getDescription()),
            'startDateTime' => $event->getStartDateTime()->format('Y-m-d H:i:s'),
            'endDateTime' => $event->getEndDateTime()->format('Y-m-d H:i:s'),
            'minPlayers' => $event->getMinPlayers(),
            'maxPlayers' => $event->getMaxPlayers(),
            'requirements' => htmlspecialchars($event->getRequirements()),
            'type' => htmlspecialchars($event->getType()),
            'createdByUsername' => $createdByUser ? htmlspecialchars($createdByUser->getUsername()) : "Utilisateur inconnu",
            'imageSrc' => $event->getImage() ? "/projet/public/assets/img/uploads/" . basename(htmlspecialchars($event->getImage()->getFilePath())) : ''
        ];
    }
}