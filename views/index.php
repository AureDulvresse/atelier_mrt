<?php
$title = "My Account";
include 'base.php'; // Inclure le fichier de base qui pourrait contenir des en-têtes et autres inclusions globales
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?></title>
    <link rel="stylesheet" href="path/to/your/css/file.css"> <!-- Inclure le fichier CSS -->
    <!-- Ajouter les autres inclusions nécessaires -->
</head>
<body>

<?php include 'components/loader.php'; ?>
<?php include 'store/layout/header.php'; ?>

<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Mon Compte</li>
        <li class="breadcrumb-item">Gère ton compte comme tu le sens !</li>
    </ol>
</nav>

<div class="mt-4 py-5">
    <div class="container">
        <div class="rounded shadow">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="d-flex align-items-center justify-content-center py-4">
                        <div class="container">
                            <form action="update_account.php" method="post" class="px-2 py-3">
                                <h3 class="text-secondary-emphasis" style="color: #f28123">
                                    Informations compte !
                                </h3>

                                <?php if (!empty($messages)): ?>
                                    <div class="alert alert-danger">
                                        <?php foreach ($messages as $message): ?>
                                            <?php echo htmlspecialchars($message); ?>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <div class="mb-3">
                                    <label for="first_name" class="form-label">Prénom</label>
                                    <input
                                        type="text"
                                        name="first_name"
                                        id="first_name"
                                        class="form-control form-control-lg"
                                        placeholder="Votre prénom"
                                        value="<?php echo htmlspecialchars($user['first_name']); ?>"
                                    />
                                </div>

                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Nom</label>
                                    <input
                                        type="text"
                                        name="last_name"
                                        id="last_name"
                                        class="form-control form-control-lg"
                                        placeholder="Votre nom"
                                        value="<?php echo htmlspecialchars($user['last_name']); ?>"
                                    />
                                </div>

                                <div class="mb-3">
                                    <label for="username" class="form-label">Nom d'utilisateur</label>
                                    <input
                                        type="text"
                                        name="username"
                                        id="username"
                                        class="form-control form-control-lg"
                                        placeholder="Nom d'utilisateur"
                                        value="<?php echo htmlspecialchars($user['username']); ?>"
                                    />
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Adresse électronique</label>
                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        class="form-control form-control-lg"
                                        placeholder="Adresse mail"
                                        value="<?php echo htmlspecialchars($user['email']); ?>"
                                    />
                                </div>

                                <div class="d-flex align-items-center justify-content-center">
                                    <button
                                        type="submit"
                                        class="btn rounded-pill mx-2"
                                        style="
                                            font-family: 'Inter', sans-serif;
                                            display: inline-block;
                                            background-color: #f28123;
                                            color: #fff;
                                            padding: 10px 20px;
                                        "
                                    >
                                        Mettre à jour
                                    </button>
                                    <a
                                        href="delete_account.php"
                                        class="btn btn-danger rounded-pill py-2"
                                    >
                                        Supprimer compte
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="d-flex align-items-center justify-content-center pt-5">
                        <div class="container">
                            <h3 class="text-secondary-emphasis" style="color: #f28123">
                                <i class="fas fa-history"></i> Historique d'activité !
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'store/layout/footer.php'; ?>

</body>
</html>
