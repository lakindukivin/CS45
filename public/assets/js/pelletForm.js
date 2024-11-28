// Get today's date in YYYY-MM-DD format
const dateInput = document.getElementById('date');
const today = new Date().toISOString().split('T')[0];

// Set the minimum selectable date to today
dateInput.setAttribute('min', today);

// Add event listener to check for past dates
dateInput.addEventListener('input', () => {
  if (dateInput.value < today) {
    alert('You cannot select a past date!');
    dateInput.value = '';
  }
});

let isFormDirty = false;

// Track input changes to mark the form as "dirty"
const inputs = document.querySelectorAll('input, select');
inputs.forEach((input) => {
  input.addEventListener('input', () => {
    isFormDirty = true;
  });
});

// Show a confirmation dialog when the user tries to leave the page
window.addEventListener('beforeunload', (event) => {
  if (isFormDirty) {
    // This will show the browser's default confirmation dialog
    event.preventDefault();
    event.returnValue = ''; // Required for some browsers
  }
});
