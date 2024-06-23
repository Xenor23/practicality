<link rel="stylesheet" href="<?= CSS ?>form.css">

<div class="container mt-5">
    <h2 class="text-center my-4 form-title">Inscription à l'événement</h2>
    <div class="form-container">
        <form action="<?= URL ?>handleRegisterParticipant" method="post" class="needs-validation" novalidate>
            <input type="hidden" name="event_id" value="<?= $eventId ?>">
            <input type="hidden" name="user_id" value="<?= $userId ?>">

            <div class="mb-3">
                <label for="points" class="form-label">Points</label>
                <input type="number" class="form-control" id="points" name="points" required>
            </div>
            <button type="submit" class="btn btn-custom-primary w-100">S'inscrire</button>
        </form>
    </div>
</div>
