$(document).ready(function () {
  $("#send-mail").on("click", function (e) {
    e.preventDefault(); // Empêcher l'envoi classique du formulaire

    // Récupérer les valeurs des champs du formulaire
    $("#send-mail").html = "Envoie en cours...";
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
        console.log(result.message);
        alert(result.message);
        $("#send-mail").HTML = "Envoyer";
      },
      error: function (error) {
        alert("Une erreur est survenue.");
        console.log(error);
      },
    });
  });
});
