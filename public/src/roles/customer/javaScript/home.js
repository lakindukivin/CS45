document.querySelectorAll(".cta-buttons button").forEach((button) => {
  button.addEventListener("click", () => {
    alert("Button clicked!");
  });
});

const navLinks = document.querySelectorAll(".nav-links li a");

const currentPage = window.location.pathname;

navLinks.forEach((link) => {
  if (link.getAttribute("href") === currentPage) {
    link.classList.add("current");
  }
});
