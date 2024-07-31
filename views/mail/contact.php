<?php
$title = "Contact";
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

<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Nous contacter</li>
        <li class="breadcrumb-item">Disponible H24</li>
    </ol>
</nav>

<!-- contact form -->
<section
  class="mt-8 pt-4 pb-5 contact wow animate__animated animate__fadeIn"
  data-wow-delay="0.3s"
>
  <div class="container mx-auto">
    <div class="flex justify-center items-start gap-4">
      <div class="contact-text wow animate__animated animate__slideInLeft">
        <div class="subtitle mb-8">
          <h2 class="text-center mb-4">Me <span>Contacter</span></h2>
        </div>
        <p class="text-black mb-4">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi
          corrupti repudiandae nostrum. Nostrum quo dolorum aspernatur, officiis
          dolor sit. Tempore, reiciendis. Nulla doloribus possimus sint cum
          facilis magni quae repellendus!
        </p>
      </div>

      <div class="contact-form wow animate__animated animate__slideInRight">
        <form method="POST" action="path/to/your/contact/handler.php">
          <?php
          if (!empty($messages)) {
              foreach ($messages as $message) {
                  $alertClass = isset($message['tags']) ? "alert-{$message['tags']}" : '';
                  echo "<div class='alert $alertClass'>" . htmlspecialchars($message['text']) . "</div>";
              }
          }
          ?>
          <div class="mb-3 flex flex-col">
            <label for="name" class="p-2 text-black"> Votre nom </label>
            <input
              type="text"
              name="name"
              id="name"
              class="form-control"
              placeholder="Entrer votre nom"
            />
          </div>
          <div class="mb-3 flex flex-col">
            <label for="email" class="p-2 text-black"> Votre email </label>
            <input
              type="email"
              name="email"
              id="email"
              class="form-control"
              placeholder="Entrer votre adresse mail"
            />
          </div>
          <div class="mb-3 flex flex-col">
            <label for="subject" class="p-2 text-black"> Sujet </label>
            <input
              type="text"
              name="subject"
              id="subject"
              class="form-control"
              placeholder="Entrer un objet"
            />
          </div>
          <div class="mb-3 flex flex-col">
            <label for="message" class="p-2 text-black"> Votre message </label>
            <textarea
              name="message"
              id="message"
              class="form-control"
              placeholder="Taper votre message"
            ></textarea>
          </div>
          <button type="submit" class="btn btn-black">Envoyer</button>
        </form>
      </div>
    </div>
  </div>
</section>
<!-- end contact form -->

<!-- find our location -->
<div class="flex items-center flex-col subtitle mt-4 mb-8">
  <h2 class="text-center mb-4">Retrouvez <span>Moi</span></h2>
  <div class="subtitle-line"></div>
</div>
<!-- end find our location -->

<!-- google map section -->
<div class="embed-responsive embed-responsive-21by9 w-full">
  <iframe
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d26432.42324808999!2d-118.34398767954286!3d34.09378509738966!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2bf07045279bf%3A0xf67a9a6797bdfae4!2sHollywood%2C%20Los%20Angeles%2C%20CA%2C%20USA!5e0!3m2!1sen!2sbd!4v1576846473265!5m2!1sen!2sbd"
    width="800"
    height="450"
    frameborder="0"
    title="Address"
    style="border: 0"
    allowfullscreen=""
    class="embed-responsive-item"
  ></iframe>
</div>
<!-- end google map section -->

</body>
</html>
