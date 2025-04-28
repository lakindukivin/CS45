document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.form-card');
    if(form) {
      // Clear error messages when user starts typing
      document.getElementById('amount').addEventListener('input', function() {
        document.getElementById('amountError').textContent = '';
        this.classList.remove('error');
      });
      
      document.getElementById('message').addEventListener('input', function() {
        document.getElementById('messageError').textContent = '';
        this.classList.remove('error');
      });
      
      document.getElementById('month').addEventListener('change', function() {
        document.getElementById('monthError').textContent = '';
        this.classList.remove('error');
      });
  
      form.addEventListener('submit', function(e) {
        let isValid = true;
        
        // Clear previous errors
        document.querySelectorAll('.error-message').forEach(el => {
          el.textContent = '';
        });
  
        // Validate amount
        const amountInput = document.getElementById('amount');
        if(!amountInput.value || parseFloat(amountInput.value) <= 0) {
          document.getElementById('amountError').textContent = 'Please enter a valid amount';
          amountInput.classList.add('error');
          isValid = false;
        }
  
        // Validate month
        const monthSelect = document.getElementById('month');
        if(!monthSelect.value) {
          document.getElementById('monthError').textContent = 'Please select a month';
          monthSelect.classList.add('error');
          isValid = false;
        } else if(monthSelect.options[monthSelect.selectedIndex].disabled) {
          document.getElementById('monthError').textContent = 'This month already has data';
          monthSelect.classList.add('error');
          isValid = false;
        }
  
        if(!isValid) {
          e.preventDefault();
          
          // Scroll to first error
          const firstError = document.querySelector('.error-message:not(:empty)');
          if(firstError) {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
          }
        }
      });
    }
  });