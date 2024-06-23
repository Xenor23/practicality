<link rel="stylesheet" href="<?= CSS ?>home.css">

<div class="container my-5">
    <!-- Première ligne : Un bloc de 3 colonnes -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="large-block p-4">
                <h2>Bienvenue sur notre site d'événements PvP Minecraft</h2>
                <p>Inscrivez-vous à nos événements passionnants et mesurez-vous aux autres joueurs !</p>
            </div>
        </div>
    </div>
    
    <!-- Deuxième et Troisième ligne -->
    <div class="row">
        <div class="col-md-4 d-flex flex-column">
            <div class="vertical-block flex-fill" style="background-image: url('<?=IMG?>minecraft_duel.jpg');">
                <div class="overlay p-5">
                    <a href="<?=URL?>event"><h3>Événement en vedette</h3></a>
                    <p>Découvrez notre événement phare du mois !</p>
                </div>
            </div>
        </div>
        <div class="col-md-8 d-flex flex-column">
            <div class="horizontal-block mb-4 flex-fill" style="background-image: url('<?=IMG?>minecraft_uhc.jpg');">
                <div class="overlay p-5">
                    <a href="<?=URL?>event"><h3>Prochain Tournoi</h3></a>
                    <p>Inscrivez-vous dès maintenant pour le prochain tournoi officiel.</p>
                </div>
            </div>
            <div class="horizontal-block flex-fill" style="background-image: url('<?=IMG?>minecraft_bed.png');">
                <div class="overlay p-5">
                    <a href="<?=URL?>event"><h3>Prochain Tournoi</h3></a>
                    <p>Inscrivez-vous dès maintenant pour le prochain mini-tournoi organisé par la communauté.</p>
                </div>
            </div>
        </div>
    </div>
</div>
