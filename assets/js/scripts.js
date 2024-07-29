document.addEventListener("DOMContentLoaded", () => {
  const navToggle = document.querySelector(".nav-toggle");
  const navMenu = document.querySelector(".nav-menu");

  const isLoggedIn = false; // Remplacez ceci par la logique de votre application
  const loginBtn = document.querySelector(".login-btn");
  const cartIcon = document.querySelector(".cart-icon");
  const profileIcon = document.querySelector(".profile-icon");

  const navLinks = document.querySelectorAll('nav a[href^="#"]');

  // Gérer le changement de couleur de l'en-tête au défilement
  window.addEventListener("scroll", () => {
    const header = document.querySelector("header");
    if (header) {
      if (window.scrollY > 50) {
        header.classList.add("scrolled");
      } else {
        header.classList.remove("scrolled");
      }
    }
  });

  // Gérer la visibilité des boutons de connexion et icônes
  if (loginBtn && cartIcon && profileIcon) {
    if (isLoggedIn) {
      loginBtn.style.display = "none";
      cartIcon.style.display = "block";
      profileIcon.style.display = "block";
    } else {
      loginBtn.style.display = "block";
      cartIcon.style.display = "none";
      profileIcon.style.display = "none";
    }
  }

  navToggle.addEventListener("click", function () {
    const header = document.querySelector("header");
    navMenu.classList.toggle("active");
      header.classList.toggle("scrolled");
  });

  navLinks.forEach((link) => {
    link.addEventListener("click", (e) => {
      e.preventDefault(); // Empêche le comportement par défaut du lien

      const targetId = link.getAttribute("href").substring(1); // Récupère l'id de la cible
      const targetElement = document.getElementById(targetId);

      if (targetElement) {
        window.scrollTo({
          top: targetElement.offsetTop,
          behavior: "smooth", // Effectue un défilement fluide
        });
      }
    });
  });
});
