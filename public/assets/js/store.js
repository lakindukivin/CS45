document.addEventListener("DOMContentLoaded", () => {
  const cards = document.querySelectorAll(".product-card");

  const animateCards = () => {
    cards.forEach((card, index) => {
      setTimeout(() => {
        card.classList.add("visible");
      }, index * 300); // Delay each card's animation for a cascading effect
    });
  };

  // Call animateCards immediately when the page loads
  animateCards();
});
