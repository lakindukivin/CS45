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
