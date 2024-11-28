document.addEventListener("DOMContentLoaded", function () {
  const deleteAccountLink = document.getElementById("deleteAccountLink");
  const deleteAccountForm = document.getElementById("deleteAccountForm");

  deleteAccountLink.addEventListener("click", function (event) {
    event.preventDefault(); // Prevent the default link action

    // Display the confirmation dialog
    const confirmation = confirm(
      "Are you sure you want to delete your account? This action cannot be undone."
    );

    if (confirmation) {
      // If user confirms, submit the form to delete the account
      deleteAccountForm.submit();
    }
  });
});
