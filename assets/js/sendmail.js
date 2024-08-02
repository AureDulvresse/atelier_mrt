document.addEventListener("DOMContentLoaded", function () {
  document
    .querySelector(".contact-form .btn")
    .addEventListener("click", function (e) {
      e.preventDefault(); // Empêcher l'envoi classique du formulaire

      // Récupérer les valeurs des champs du formulaire
      var prenom = document.querySelector('input[name="prenom"]').value;
      var nom = document.querySelector('input[name="nom"]').value;
      var telephone = document.querySelector('input[name="telephone"]').value;
      var email = document.querySelector('input[name="email"]').value;
      var message = document.querySelector('textarea[name="message"]').value;

      // Envoyer les données via AJAX
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "path/to/send_email.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onload = function () {
        if (xhr.status === 200) {
          var response = JSON.parse(xhr.responseText);
          alert(response.message);
        } else {
          alert("Une erreur est survenue.");
        }
      };
      xhr.send(
        "prenom=" +
          encodeURIComponent(prenom) +
          "&nom=" +
          encodeURIComponent(nom) +
          "&telephone=" +
          encodeURIComponent(telephone) +
          "&email=" +
          encodeURIComponent(email) +
          "&message=" +
          encodeURIComponent(message)
      );
    });
});
