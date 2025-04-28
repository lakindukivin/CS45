document
  .getElementById("contactForm")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form submission

    // Get form values
    const email = document.getElementById("email").value.trim();
    const reason = document.getElementById("reason").value;
    const phone = document.getElementById("phone").value.trim();

    // Validation functions
    function isValidEmail(email) {
      const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return re.test(email);
    }

    function isValidPhone(phone) {
      // Basic phone validation - adjust for your needs
      const re = /^[0-9]{10}$/; // Example: 10 digits
      return re.test(phone);
    }

    // Validate email
    if (!email) {
      alert("Please enter your email");
      return;
    }
    if (!isValidEmail(email)) {
      alert("Please enter a valid email address");
      return;
    }

    // Validate reason
    if (!reason) {
      alert("Please select a reason for contacting us");
      return;
    }

    // Validate phone
    if (!phone) {
      alert("Please enter your phone number");
      return;
    }
    if (!isValidPhone(phone)) {
      alert("Please enter a valid 10-digit phone number");
      return;
    }

    // If all validations pass
    alert(
      `Thank you for contacting us!\nEmail: ${email}\nReason: ${reason}\nPhone: ${phone}`
    );
  });
