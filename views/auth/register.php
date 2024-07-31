<?php
$title = "Enregistrement";
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
<?php include 'accounts/layout/header.php'; ?>

<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Enregistrement</li>
        <li class="breadcrumb-item">Devenez un de nous client en un clic</li>
    </ol>
</nav>

<div class="mt-4 py-5">
    <div class="container">
        <div class="rounded shadow">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="single-homepage-slider homepage-bg-1 rounded h-100 py-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-10 col-lg-7 offset-lg-1 offset-xl-0">
                                    <div class="hero-text py-4 px-5">
                                        <div class="hero-text-tablecell">
                                            <p class="subtitle">Fresh & Organic</p>
                                            <h1>Delicious Seasonal Fruits</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="d-flex align-items-center justify-content-center h-100 py-4">
                        <div class="container">
                            <form action="register.php" method="post" class="py-3 px-2">
                                <h3 class="text-secondary-emphasis" style="color: #f28123">
                                    Enregistrez-vous !
                                </h3>

                                <?php if (!empty($messages)): ?>
                                    <div class="alert alert-danger">
                                        <?php foreach ($messages as $message): ?>
                                            <?php echo htmlspecialchars($message); ?>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <div class="mb-3">
                                    <input
                                        type="text"
                                        name="first_name"
                                        id="first_name"
                                        class="form-control form-control-lg"
                                        placeholder="Votre prénom"
                                    />
                                </div>

                                <div class="mb-3">
                                    <input
                                        type="text"
                                        name="last_name"
                                        id="last_name"
                                        class="form-control form-control-lg"
                                        placeholder="Votre nom"
                                    />
                                </div>

                                <div class="mb-3">
                                    <input
                                        type="text"
                                        name="username"
                                        id="username"
                                        class="form-control form-control-lg"
                                        placeholder="Nom d'utilisateur"
                                    />
                                </div>

                                <div class="mb-3">
                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        class="form-control form-control-lg"
                                        placeholder="Adresse mail"
                                    />
                                </div>

                                <div class="mb-3">
                                    <input
                                        type="password"
                                        name="password"
                                        id="password"
                                        class="form-control form-control-lg"
                                        placeholder="Mot de passe"
                                    />
                                </div>

                                <div class="mb-3 text-center">
                                    <button
                                        type="submit"
                                        class="btn rounded-pill col-12 mb-4"
                                        style="
                                            font-family: 'Inter', sans-serif;
                                            display: inline-block;
                                            background-color: #f28123;
                                            color: #fff;
                                            padding: 10px 20px;
                                        "
                                    >
                                        Inscription
                                    </button>

                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="my-2 mx-3">J'ai déjà un compte</p>
                                        <a
                                            href="login.php"
                                            class="cart-btn"
                                            style="
                                                background-color: transparent !important;
                                                border: 0.5px solid #f28123 !important;
                                                color: #f28123;
                                            "
                                        >
                                            Connexion
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
