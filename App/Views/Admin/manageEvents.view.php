<link rel="stylesheet" href="<?=CSS?>manageEvents.css">
<script src="<?=JS?>manageEvents.js" defer></script>

<div class="container" id="container">
    <div class="form-container sign-up">
        <form action="<?= URL ?>createEvent" method="POST" enctype="multipart/form-data" class="needs-validation forms" novalidate>
            <h1>Créer Evenement</h1>
            <input type="text" id="name" name="name" placeholder="Nom de l'événement" required>
            <textarea id="description" name="description" placeholder="Description de l'événement" style="height: 100px;" required></textarea>
            <input type="datetime-local" id="start_datetime" name="start_datetime" required>
            <input type="datetime-local" id="end_datetime" name="end_datetime" required>
            <input type="number" id="min_players" name="min_players" placeholder="Nombre minimum de joueurs" min="1" required>
            <input type="number" id="max_players" name="max_players" placeholder="Nombre maximum de joueurs" min="1" required>
            <label>Prérequis</label>
            <div style="display: flex; flex-direction: column;">
                <label class="checkbox-label" for="2v2">
                    <input type="checkbox" id="2v2" name="requirements[]" value="2v2">
                    2v2
                </label>
                <label class="checkbox-label" for="uhc">
                    <input type="checkbox" id="uhc" name="requirements[]" value="uhc">
                    UHC
                </label>
                <label class="checkbox-label" for="bedwars">
                    <input type="checkbox" id="bedwars" name="requirements[]" value="bedwars">
                    BEDWARS
                </label>
                <label class="checkbox-label" for="no_rod">
                    <input type="checkbox" id="no_rod" name="requirements[]" value="no_rod">
                    NO ROD
                </label>
            </div>
            <select id="type" name="type" required>
                <option value="" disabled selected>-- Choisir un type --</option>
                <option value="tournois">Tournois</option>
                <option value="mini-tournois">Mini-tournois</option>
            </select>
            <label for="image">Image de l'événement</label>
            <input type="file" id="image" name="image">
            <input type="hidden" name="created_by" value="<?= $_SESSION['user']['id'] ?? 0 ?>">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
            <button type="submit">Créer l'événement</button>
        </form>
    </div>

    <div class="form-container sign-in">
    
        <form action="" class="forms">
            <?php if (isset($_SESSION["alert"])): ?>
                <div class="alert alert-<?= $_SESSION["alert"]["type"] ?> alert-dismissible fade show" role="alert">
                    <?= $_SESSION["alert"]["message"] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION["alert"]); ?>
            <?php endif; ?>
            <h1>Modifier Evenement</h1>
            <table id="events-table" class="table table-striped" class="forms">
                <thead>
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Description</th>
                        <th scope="col">Date de début</th>
                        <th scope="col">Date de fin</th>
                        <th scope="col">Créé par</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($events) && is_array($events)): ?>
                        <?php foreach ($events as $event): ?>
                            <tr>
                                <td><?= $event['name'] ?></td>
                                <td style="overflow-y: hidden; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; word-wrap: break-word;"><?= $event['description'] ?></td>
                                <td><?= $event['startDateTime'] ?></td>
                                <td><?= $event['endDateTime'] ?></td>
                                <td><?= $event['createdByUsername'] ?></td>
                                <td>
                                    <form action="<?= URL ?>deleteEvent" method="POST" class="form-button">
                                        <input type="hidden" name="event_id" value="<?= $event['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-light">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">Aucun événement disponible.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </form>
    </div>

    <div class="toggle-container">
        <div class="toggle">
            <div class="toggle-panel toggle-left">
                <h1>Création d'événement</h1>
                <p>Ici se trouve le formulaire permettant la création d'un événement</p>
                <button class="hidden" id="editEvent">Modifier</button>
            </div>
            <div class="toggle-panel toggle-right">
                <h1>Gestion d'événements</h1>
                <p>Ici se trouve la liste des événements</p>
                <button class="hidden" id="createEvent">Créer</button>
            </div>
        </div>
    </div>
</div>
