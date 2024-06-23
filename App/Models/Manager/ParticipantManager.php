<?php

namespace App\Models\Manager;

use App\Core\Database;
use App\Models\Entity\Participant;

class ParticipantManager
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function participantExists(int $eventId, int $userId): bool
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM participants WHERE event_id = :eventId AND user_id = :userId");
        $stmt->execute(['eventId' => $eventId, 'userId' => $userId]);
        return $stmt->fetchColumn() > 0;
    }

    public function registerParticipant(int $eventId, int $userId, int $position, int $points): bool
    {
        $stmt = $this->db->prepare("INSERT INTO participants (event_id, user_id, position, points) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$eventId, $userId, $position, $points]);
    }

    public function getParticipantsByEvent(int $eventId): array
    {
        $stmt = $this->db->prepare("SELECT * FROM participants WHERE event_id = :eventId ORDER BY position");
        $stmt->execute(['eventId' => $eventId]);
        $participantsData = $stmt->fetchAll();

        $participants = [];
        foreach ($participantsData as $data) {
            $participants[] = new Participant($data['event_id'], $data['user_id'], $data['position'], $data['points']);
        }
        return $participants;
    }

}
