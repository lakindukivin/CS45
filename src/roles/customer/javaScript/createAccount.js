document.addEventListener("DOMContentLoaded", function () {
  const password = document.getElementById("password");
  const confirmPassword = document.getElementById("confirmPassword");
  const message = document.getElementById("message");
  const form = document.querySelector(".login-form");

  // Debugging: Check if elements exist
  console.log("Password field:", password);
  console.log("Confirm Password field:", confirmPassword);
  console.log("Message element:", message);
  console.log("Form element:", form);

  if (!password || !confirmPassword || !message || !form) {
    console.error("One or more required elements are missing from the DOM.");
    return; // Stop execution if elements are not found
  }

  // Function to check if passwords match
  function validatePassword() {
    if (password.value === confirmPassword.value) {
      message.textContent = "Passwords match!";
      message.className = "success";
    } else {
      message.textContent = "Passwords do not match.";
      message.className = "error";
    }
  }

  // Listen for input events on the password fields
  password.addEventListener("input", validatePassword);
  confirmPassword.addEventListener("input", validatePassword);

  // Prevent form submission if passwords do not match
  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    if (password.value !== confirmPassword.value) {
      alert("Passwords do not match. Please try again.");
      return;
    }

    const formData = new FormData(form);
    try {
      const response = await fetch("createAccount.php", {
        method: "POST",
        body: formData,
      });

      if (!response.ok) {
        throw new Error("Network response was not ok");
      }

      const result = await response.json();
      alert(result.message);

      if (result.status === "success") {
        window.location.href = "login.html";
      }
    } catch (error) {
      console.error("Error during form submission:", error);
      alert("An error occurred. Please try again later.");
    }
  });
});
