document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('polytheneForm');
  
  // Form validation
  function validateForm() {
      let isValid = true;
      
      // Amount validation
      const amount = document.getElementById('amount');
      const amountError = document.getElementById('amountError');
      amount.parentElement.classList.remove('error');
      
      if (!amount.value) {
          showError(amount, amountError, 'Amount is required');
          isValid = false;
      } else if (parseFloat(amount.value) <= 0) {
          showError(amount, amountError, 'Amount must be greater than 0');
          isValid = false;
      }
      
      // Message validation
      const message = document.getElementById('message');
      const messageError = document.getElementById('messageError');
      message.parentElement.classList.remove('error');
      
      if (!message.value.trim()) {
          showError(message, messageError, 'Message is required');
          isValid = false;
      }
      
      // Month validation
      const month = document.getElementById('month');
      const monthError = document.getElementById('monthError');
      month.parentElement.classList.remove('error');
      
      if (!month.value) {
          showError(month, monthError, 'Please select a month');
          isValid = false;
      }
      
      return isValid;
  }
  
  function showError(input, errorElement, message) {
      input.parentElement.classList.add('error');
      errorElement.textContent = message;
  }
  
  // Handle form submission
  form.addEventListener('submit', function(e) {
      e.preventDefault();
      
      if (validateForm()) {
          const formData = {
              amount: document.getElementById('amount').value,
              message: document.getElementById('message').value,
              month: document.getElementById('month').value
          };
          
          // Here you would typically send the data to your server
          console.log('Form submitted:', formData);
          
          // Show success message
          showSuccessMessage();
          
          // Reset form
          form.reset();
      }
  });
  
  function showSuccessMessage() {
      // Create and show success message
      const successMessage = document.createElement('div');
      successMessage.className = 'success-message';
      successMessage.style.cssText = `
          position: fixed;
          top: 20px;
          right: 20px;
          background-color: #4caf50;
          color: white;
          padding: 1rem;
          border-radius: 4px;
          box-shadow: 0 2px 4px rgba(0,0,0,0.2);
          animation: slideIn 0.3s ease-out;
      `;
      successMessage.textContent = 'Form submitted successfully!';
      
      document.body.appendChild(successMessage);
      
      // Remove success message after 3 seconds
      setTimeout(() => {
          successMessage.style.animation = 'slideOut 0.3s ease-in';
          setTimeout(() => {
              document.body.removeChild(successMessage);
          }, 300);
      }, 3000);
  }
  
  // Add these CSS animations to your stylesheet
  const style = document.createElement('style');
  style.textContent = `
      @keyframes slideIn {
          from { transform: translateX(100%); opacity: 0; }
          to { transform: translateX(0); opacity: 1; }
      }
      
      @keyframes slideOut {
          from { transform: translateX(0); opacity: 1; }
          to { transform: translateX(100%); opacity: 0; }
      }
  `;
  document.head.appendChild(style);
});