document
  .getElementById("contactForm")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form submission

    const email = document.getElementById("email").value;
    const reason = document.getElementById("reason").value;
    const phone = document.getElementById("phone").value;

    // Validate inputs (example: ensuring all fields are filled)
    if (email && reason && phone) {
      alert(
        `Thank you for contacting us!\nEmail: ${email}\nReason: ${reason}\nPhone: ${phone}`
      );
    } else {
      alert("Please fill in all the fields.");
    }
  });
