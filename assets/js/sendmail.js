const send_mail = document.querySelector("#send-mail");

send_mail.addEventListener("click", function (e) {
  e.preventDefault(); // Empêcher l'envoi classique du formulaire

  // Récupérer les valeurs des champs du formulaire
  const prenom = document.querySelector('#first_name').value;
  const nom = document.querySelector('#last_name').value;
  const telephone = document.querySelector('#phone').value;
  const email = document.querySelector('#email').value;
  const message = document.querySelector('#message').value;

  // Envoyer les données via AJAX
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "/contact", true);
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
