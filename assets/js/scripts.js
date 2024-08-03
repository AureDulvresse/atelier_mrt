document.addEventListener("DOMContentLoaded", function () {
  const itemsPerPage = 6;
  let currentPage = 1;
  const items = document.querySelectorAll(".grid-item");
  const totalItems = items.length;
  const totalPages = Math.ceil(totalItems / itemsPerPage);
  const grid = document.querySelector(".grid");
  const pagination = document.querySelector(".pagination");

  function showPage(page) {
    const start = (page - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    const prev = document.querySelector('.pagination-btn[data-page="prev"]');
    const next = document.querySelector('.pagination-btn[data-page="next"]');

    items.forEach((item, index) => {
      item.style.display = index >= start && index < end ? "block" : "none";
    });

    // Filtre les éléments affichés avec Isotope
    if (prev && next) {
      $(".grid").isotope("layout");
      prev.disabled = page === 1;
      next.disabled = page === totalPages;
    }
  }

  if (pagination) {
    pagination.addEventListener("click", function (event) {
      if (event.target.classList.contains("pagination-btn")) {
        const page = event.target.getAttribute("data-page");
        if (page === "prev" && currentPage > 1) {
          currentPage--;
        } else if (page === "next" && currentPage < totalPages) {
          currentPage++;
        }
        showPage(currentPage);
      }
    });
  }

  showPage(currentPage);

  // Filter buttons
  const filterBtns = document.querySelectorAll(".filter-btn");
  filterBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
      filterBtns.forEach((button) => button.classList.remove("active"));
      btn.classList.add("active");
      const filterValue = btn.dataset.filter;
      $(".grid").isotope({ filter: filterValue });
      showPage(currentPage); // Re-show the current page after filtering
    });
  });

  // Isotope initialization
  $(".grid").isotope({
    itemSelector: ".grid-item",
    layoutMode: "fitRows",
    transitionDuration: "0.6s",
  });

  // Hamburger menu
  const hamburgerMenu = document.querySelector(".hamburger-menu");
  const navbar = document.querySelector("header nav");
  const links = document.querySelectorAll(".links a");

  function closeMenu() {
    navbar.classList.remove("open");
    document.body.classList.remove("stop-scrolling");
  }

  hamburgerMenu.addEventListener("click", () => {
    navbar.classList.toggle("open");
    document.body.classList.toggle("stop-scrolling");
  });

  links.forEach((link) => link.addEventListener("click", closeMenu));

  // records effect
  const recordsWrap = document.querySelector(".records");
  const recordsNumbers = document.querySelectorAll(".number");

  function checkScroll(el) {
    let rect = el.getBoundingClientRect();
    if (window.innerHeight >= rect.top + el.offsetHeight) return true;
    return false;
  }

  function countUp() {
    if (!checkScroll(recordsWrap)) return;
    recordsNumbers.forEach((numb) => {
      const updateCount = () => {
        const currentNum = +numb.innerText;
        const maxNum = +numb.dataset.num;
        const increment = Math.ceil(maxNum / 100);

        if (currentNum < maxNum) {
          numb.innerText = currentNum + increment;
          setTimeout(updateCount, 1);
        } else {
          numb.innerText = maxNum;
        }
      };

      setTimeout(updateCount, 400);
    });
  }

  $(".grid").isotope({
    itemSelector: ".grid-item",
    layoutMode: "fitRows",
    transitionDuration: "0.6s",
  });

  window.addEventListener("scroll", () => {
    countUp();
  });

  $("#send-mail").on("click", function (e) {
    e.preventDefault(); // Empêcher l'envoi classique du formulaire

    // Désactiver le bouton d'envoi pour éviter les envois multiples
    var $button = $(this);
    $button.prop("disabled", true).text("Envoi en cours...");

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
        console.log(result.message);
      },
      error: function (error) {
        alert("Une erreur est survenue.");
        console.log(error);
      },
      complete: function () {
        // Réactiver le bouton et réinitialiser le texte
        $button.prop("disabled", false).text("Envoyer");
      },
    });
  });

  const atc_btn = document.querySelector("#addToCartBtn");
  atc_btn.addEventListener("click", () => {
    const artword_id = document.querySelector("#artword_id").value();
    const cart_id = document.querySelector("#cart_id").value();
    atc_btn.textContent = "En cours...";
    addToCart(cart_id, artword_id);
  });

  const addToCart = async (cartId, artworkId, quantity = 1) => {
    $.ajax({
      url: "controllers/CartController.php",
      type: "POST",
      data: {
        action: "addToCart",
        cart_id: cartId,
        artwork_id: artworkId,
        quantity: quantity,
      },
      success: function (response) {
        let data = JSON.parse(response);
        alert(data.message);
      },
      error: function (error) {
        alert("Une erreur est survenue.");
        console.log(error);
      },
    });
  };

  const updateProfileForm = document.getElementById("update-profile-form");
  updateProfileForm.addEventListener("submit", function (event) {
    event.preventDefault();

    // Récupérer les valeurs des champs
    const formData = new FormData(updateProfileForm);

    // Envoyer les données via AJAX
    fetch("/atelier_mrt/update_profile.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        alert(data.message);
      })
      .catch((error) => {
        console.error("Erreur:", error);
        alert("Une erreur est survenue.");
      });
  });

  // Suppression du compte
  const deleteAccountButton = document.getElementById("delete-account");
  deleteAccountButton.addEventListener("click", function () {
    if (
      confirm(
        "Voulez-vous vraiment supprimer votre compte ? Cette action est irréversible."
      )
    ) {
      // Envoyer la requête de suppression via AJAX
      fetch("/atelier_mrt/delete_account.php", {
        method: "POST",
      })
        .then((response) => response.json())
        .then((data) => {
          alert(data.message);
          if (data.status === "success") {
            // Rediriger l'utilisateur après la suppression
            window.location.href = "/atelier_mrt/";
          }
        })
        .catch((error) => {
          console.error("Erreur:", error);
          alert("Une erreur est survenue.");
        });
    }
  });

  // Swiper initialization
  var mySwiper = new Swiper(".swiper-container", {
    speed: 1100,
    slidesPerView: 1,
    loop: true,
    autoplay: {
      delay: 5000,
    },
    navigation: {
      prevEl: ".swiper-button-prev",
      nextEl: ".swiper-button-next",
    },
  });
});
