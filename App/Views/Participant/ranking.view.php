
<style>
        :root {
            --main-color: #7a57d1; /* Couleur principale violette */
        }

        .btn-primary {
            background-color: var(--main-color);
            border-color: var(--main-color);
        }

        .btn-primary:hover {
            background-color: #6b4ebf; /* Légère variation pour le hover */
            border-color: #6b4ebf;
        }

        .table th, .table td {
            vertical-align: middle; /* Pour centrer le contenu vertical dans les cellules */
        }

        .table th {
            background-color: var(--main-color);
            color: white;
        }

        .table-bordered th, .table-bordered td {
            border: 1px solid var(--main-color); /* Couleur de bordure de base */
        }

        .table-bordered {
            border: 2px solid var(--main-color); /* Bordure plus épaisse pour le tableau */
        }
        .table-bordered td{
            background-color: var(--td-bg);
            color: var(--td-text);
        }
        
    </style>
    <div class="container mt-5">
        <h2 class="text-center my-4" style="color: var(--btn-color); font-weight: 600;">Classement de l'événement</h2>
        <button id="randomizeButton" class="btn btn-primary mb-3">Randomiser le classement</button>
        <table class="table table-bordered" id="rankingTable">
            <thead>
                <tr>
                    <th>Position</th>
                    <th>Nom du joueur</th>
                    <th>Points</th>
                </tr>
            </thead>
            <tbody>
                <!-- Le contenu du tableau sera généré dynamiquement par JavaScript -->
            </tbody>
        </table>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Fonction pour générer un nombre aléatoire entre min et max
        function getRandomInt(min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }

        // Fonction pour randomiser le classement
        function randomizeRanking() {
            // Récupérer les participants depuis PHP
            const participants = [
                <?php foreach ($participants as $index => $participant): ?>
                    { username: '<?= addslashes($participant->getUser()->getUsername()) ?>', points: <?= $participant->getPoints() ?> },
                <?php endforeach; ?>
            ];

            // Générer des joueurs aléatoires supplémentaires jusqu'à 100 joueurs
            const maxPlayers = 100;
            const currentPlayers = participants.length;

            if (currentPlayers < maxPlayers) {
                const additionalPlayers = maxPlayers - currentPlayers;
                for (let i = 0; i < additionalPlayers; i++) {
                    const randomPoints = getRandomInt(0, 100); // points aléatoires entre 0 et 200
                    const randomName = `JoueurAléatoire${currentPlayers + i + 1}`;
                    participants.push({ username: randomName, points: randomPoints });
                }
            }

            // Calculer la position en fonction des points
            participants.sort((a, b) => b.points - a.points);

            // Réafficher le tableau mis à jour avec les joueurs (existants + aléatoires)
            const tableBody = document.querySelector('#rankingTable tbody');
            tableBody.innerHTML = '';

            participants.forEach((participant, index) => {
                const row = `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${participant.username}</td>
                        <td>${participant.points}</td>
                    </tr>
                `;
                tableBody.innerHTML += row;
            });
        }

        // Appel initial pour afficher le classement
        randomizeRanking();

        // Gestionnaire d'événement pour le bouton de randomisation
        const randomizeButton = document.querySelector('#randomizeButton');
        randomizeButton.addEventListener('click', function () {
            randomizeRanking();
        });
    });
    </script>
</body>
</html>


