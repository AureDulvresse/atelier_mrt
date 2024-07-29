document.addEventListener("DOMContentLoaded", () => {
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
  const isLoggedIn = false; // Remplacez ceci par la logique de votre application
  const loginBtn = document.querySelector(".login-btn");
  const cartIcon = document.querySelector(".cart-icon");
  const profileIcon = document.querySelector(".profile-icon");

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

  // Toggle menu mobile
  const menuToggle = document.querySelector(".menu-toggle");
  const navList = document.querySelector("nav ul");

  if (menuToggle && navList) {
    menuToggle.addEventListener("click", () => {
      navList.classList.toggle("active");
    });
  }
});
