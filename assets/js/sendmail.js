$(document).ready(function () {
  $("#send-mail").on("click", function (e) {
    e.preventDefault(); // Empêcher l'envoi classique du formulaire

    // Récupérer les valeurs des champs du formulaire
    var formData = {
      prenom: $("#first_name").val(),
      nom: $("#last_name").val(),
      telephone: $("#phone").val(),
      email: $("#email").val(),
      message: $("#message").val(),
    };

    // Envoyer les données via AJAX
    $.ajax({
      type: "POST",
      url: "/atelier_mrt/contact", // URL de ton script PHP
      data: formData,
      success: function (response) {
        var result = JSON.parse(response);
        alert(result.message);
      },
      error: function () {
        alert("Une erreur est survenue.");
      },
    });
  });
});
