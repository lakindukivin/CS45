document.addEventListener("DOMContentLoaded", () => {
  const cards = document.querySelectorAll(".product-card");
  console.log(`Found ${cards.length} product cards`); // Debug line

  const animateCards = () => {
    cards.forEach((card, index) => {
      console.log(`Animating card ${index}:`, card); // Debug line
      setTimeout(() => {
        card.classList.add("visible");
      }, index * 300);
    });
  };

  animateCards();
});
