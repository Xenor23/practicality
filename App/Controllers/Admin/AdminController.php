<?php

namespace App\Controllers\Admin;

use App\Controllers\AbstractController;
use App\Controllers\DisplayController;
use App\Controllers\SecurityController;
use App\Models\Manager\EventManager;

class AdminController extends AbstractController
{
    private SecurityController $security;
    private EventManager $eventManager;

    public function __construct()
    {
        $this->security = new SecurityController(); // Injection de l'AbstractController dans SecurityController
        $this->eventManager = new EventManager();
    }

    public function dashboard(): void
    {
        $title = "Dashboard Admin";
        $list = ["Admin/dashboard.view"];

        $this->render($list, ["title" => $title], "admin");
    }

    public function eventform(): void
    {
        $title = "EventForm";
        $list = ["Admin/eventform.view"];

        $this->render($list, ["title" => $title], "admin");
    }

    public function manageUsers(): void
    {
        $title = "Gestion des Utilisateurs";
        $list = ["Admin/manageUsers.view"];

        $this->render($list, ["title" => $title], "admin");
    }

    public function manageEvents(): void
    {
        $events = $this->eventManager->getAllEvents();
        $formattedEvents = [];
        foreach ($events as $event) {
            $formattedEvents[] = $this->eventManager->formatEventData($event);
        }
        $title = "Gestion des Evenements";
        $list = ["Admin/manageEvents.view"];

        $this->render($list, [
            "title" => $title,
            'events' => $formattedEvents,
        ], "admin");
    }
}
