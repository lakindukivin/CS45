document.addEventListener("DOMContentLoaded", function () {
  // Price calculation functionality
  const bagSizeSelect = document.getElementById("bag-size");
  const quantityInput = document.getElementById("quantity");
  const priceDisplay = document.getElementById("dynamic-price");

  function updatePrice() {
    const selectedOption = bagSizeSelect.options[bagSizeSelect.selectedIndex];
    const unitPrice = parseFloat(selectedOption.getAttribute("data-price"));
    const quantity = parseInt(quantityInput.value);
    const totalPrice = unitPrice * quantity;

    priceDisplay.textContent = "LKR " + totalPrice.toFixed(2);
  }

  bagSizeSelect.addEventListener("change", updatePrice);
  quantityInput.addEventListener("input", updatePrice);

  // Initialize price display
  updatePrice();
});
AV;
