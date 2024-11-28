document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("custom-order-form");

  form.addEventListener("submit", async (event) => {
    event.preventDefault();

    // Collect form data
    const companyName = document.getElementById("company-name").value;
    const quantity = document.getElementById("quantity").value;
    const email = document.getElementById("email").value;
    const phone = document.getElementById("phone").value;
    const type = document.getElementById("bag-type").value;
    const specifications = document.getElementById("specifications").value;

    // Send data to the server
    try {
      const response = await fetch(window.location.href, {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams({
          company_name: companyName,
          quantity,
          email,
          phone,
          type,
          specifications,
        }),
      });

      if (response.ok) {
        alert("Your custom order has been submitted successfully!");
        form.reset();
      } else {
        alert("Failed to submit your order. Please try again.");
      }
    } catch (error) {
      console.error("Error submitting the order:", error);
      alert("An error occurred. Please try again.");
    }
  });
});
