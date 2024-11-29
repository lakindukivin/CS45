document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("custom-order-form");

  form.addEventListener("submit", (event) => {
    event.preventDefault();

    // Collecting form data
    const companyName = document.getElementById("company-name").value;
    const quantity = document.getElementById("quantity").value;
    const email = document.getElementById("email").value;
    const phone = document.getElementById("phone").value;
    const specifications = document.getElementById("specifications").value;

    // Log or process the data as needed
    console.log({
      companyName,
      quantity,
      email,
      phone,
      specifications,
    });

    // Display confirmation or redirect
    alert("Your custom order has been submitted successfully!");
    form.reset();
  });
});
