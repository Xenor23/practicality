<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS ?>template.css">
    <script src="<?= JS ?>template.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous" defer></script>
    <script src="https://kit.fontawesome.com/4989d61e46.js" crossorigin="anonymous"></script>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= URL ?>home">Practicality</a>
            <div class="d-flex align-items-center ms-auto">
                <?php if (isset($_SESSION["user"])): ?>
                    <?php if ($_SESSION["user"]['role']=='user'): ?>
                    <a href="<?= URL ?>account" class="navbar-brand d-flex align-items-center">
                    <?php else: ?>
                        <a href="<?= URL ?>admin" class="navbar-brand d-flex align-items-center">
                        <?php endif; ?>
                    <i class="fa-solid fa-user"></i>
                    &nbsp; <?= $_SESSION["user"]["username"] ?>
                    </a>
                    <a class="btn btn-custom-secondary btn-sm ms-2" href="<?= URL ?>logout">Se Déconnecter</a>
                <?php else: ?>
                    <a class="btn btn-custom-primary btn-sm me-2" href="<?= URL ?>login">Se connecter</a>
                    <a class="btn btn-custom-secondary btn-sm me-2" href="<?= URL ?>register">S'inscrire</a>
                <?php endif; ?>
                <button class="btn btn-custom-secondary btn-sm ms-2" id="darkModeButton">Dark Mode</button>
            </div>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #d1c4e9;">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL ?>event">Événements</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php if (isset($_SESSION["alert"])): ?>
        <div class="alert alert-<?= $_SESSION["alert"]["type"] ?> alert-dismissible fade show" role="alert">
            <?= $_SESSION["alert"]["message"] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION["alert"]); ?>
    <?php endif; ?>
</header>

<main>
    <?= $content ?>
</main>

<footer class="footer mt-5">
    <div class="container text-center">
        <p>&copy; 2024 Re:Zero. Tous droits réservés.</p>
        <p><a href="<?= URL ?>privacy">Politique de confidentialité</a> | <a href="<?= URL ?>terms">Conditions d'utilisation</a></p>
    </div>
    <div class="container text-center">
        <a href="https://discord.gg/mrCTqxt8aA" target="_blank" rel="noopener noreferrer">
        <i class="fa-brands fa-discord"></i>        
    </a>
    </div>
</footer>

</body>
</html>
