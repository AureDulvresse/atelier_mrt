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
    $(".grid").isotope("layout");

    if (prev && next) {
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
    const rect = el.getBoundingClientRect();
    return window.innerHeight >= rect.top + el.offsetHeight;
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

  window.addEventListener("scroll", () => {
    skillsEffect();
    countUp();
  });

  // Swiper initialization
  const mySwiper = new Swiper(".swiper-container", {
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
