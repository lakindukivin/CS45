const password = document.getElementById('password');
const confirmPassword = document.getElementById('confirmPassword');
const message = document.getElementById('message');

// Function to check if passwords match
function validatePassword() {
  if (password.value === confirmPassword.value) {
    message.textContent = 'Passwords match!';
    message.className = 'success';
  } else {
    message.textContent = 'Passwords do not match.';
    message.className = 'error';
  }
}

// Listen for input events on the password fields
password.addEventListener('input', validatePassword);
confirmPassword.addEventListener('input', validatePassword);

// Prevent form submission if passwords do not match
document.getElementById('passwordForm').addEventListener('submit', function (event) {
  if (password.value !== confirmPassword.value) {
    event.preventDefault();
    alert('Passwords do not match. Please try again.');
  }
});
