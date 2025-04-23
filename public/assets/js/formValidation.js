// Function to display error message
function showError(input, message) {
  // Find the parent container (form-group)
  const formGroup = input.parentElement;
  // Add error class to input
  input.classList.add('error-input');
  // Create error message element
  const errorMessage = document.createElement('div');
  errorMessage.className = 'error-message';
  errorMessage.innerText = message;
  // Remove any existing error messages
  const existingError = formGroup.querySelector('.error-message');
  if (existingError) {
    formGroup.removeChild(existingError);
  }
  // Add the error message to the form group
  formGroup.appendChild(errorMessage);
}
 
// Function to remove error message
function removeError(input) {
  // Find the parent container
  const formGroup = input.parentElement;
  // Remove error class from input
  input.classList.remove('error-input');
  // Remove any existing error messages
  const errorMessage = formGroup.querySelector('.error-message');
  if (errorMessage) {
    formGroup.removeChild(errorMessage);
  }
}
 
// Function to validate required fields
function validateRequired(input) {
  if (input.value.trim() === '') {
    showError(input, 'This field is required');
    return false;
  }
  removeError(input);
  return true;
}
 
// Function to validate email format
function validateEmail(input) {
  // Check if the field is empty
  if (input.value.trim() === '') {
    return true; // Skip validation if empty (handled by required check)
  }
  // Simple email validation regex
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(input.value.trim())) {
    showError(input, 'Please enter a valid email address');
    return false;
  }
  removeError(input);
  return true;
}
 
// Function to validate phone number
function validatePhone(input) {
  // Check if the field is empty
  if (input.value.trim() === '') {
    return true; // Skip validation if empty (handled by required check)
  }
  // Simple phone validation - 10 digits
  const phoneRegex = /^\d{10}$/;
  if (!phoneRegex.test(input.value.trim())) {
    showError(input, 'Please enter a valid 10-digit phone number');
    return false;
  }
  removeError(input);
  return true;
}
 
// Function to validate minimum length
function validateMinLength(input, minLength) {
  if (input.value.trim().length < minLength) {
    showError(input, `Must be at least ${minLength} characters`);
    return false;
  }
  removeError(input);
  return true;
}
 
// Function to validate maximum length
function validateMaxLength(input, maxLength) {
  if (input.value.trim().length > maxLength) {
    showError(input, `Cannot exceed ${maxLength} characters`);
    return false;
  }
  removeError(input);
  return true;
}
 
// Function to sanitize input (prevent SQL injection characters)
function sanitizeInput(input) {
  // Basic sanitization - remove potentially harmful characters
  const sanitized = input.value
    .replace(/[<>'"]/g, '') // Remove angle brackets, quotes
    .replace(/;/g, '');     // Remove semicolons
  if (sanitized !== input.value) {
    input.value = sanitized;
    showError(input, 'Special characters removed for security');
    return false;
  }
  return true;
}
 
// Function to enforce special characters policy
function validateSpecialChars(input, allowSpecial) {
  if (!allowSpecial) {
    // Regular expression to find special characters
    const specialCharsRegex = /[^\w\s]/;
    if (specialCharsRegex.test(input.value)) {
      showError(input, 'Special characters are not allowed');
      return false;
    }
  }
  removeError(input);
  return true;
}
 
// Function to validate file type
function validateFileType(input, allowedTypes) {
  // Check if a file is selected
  if (input.files.length === 0) {
    return true; // Skip validation if no file (handled by required check)
  }
  const fileName = input.files[0].name;
  const fileExt = fileName.split('.').pop().toLowerCase();
  if (!allowedTypes.includes(fileExt)) {
    showError(input, `Only ${allowedTypes.join(', ')} files are allowed`);
    return false;
  }
  removeError(input);
  return true;
}
 
// Function to limit input length in real-time
function setupCharLimit(input, maxLength) {
  // Set maxlength attribute
  input.setAttribute('maxlength', maxLength);
  // Create and add counter element
  const counter = document.createElement('div');
  counter.className = 'char-counter';
  counter.innerText = `0/${maxLength}`;
  input.parentElement.appendChild(counter);
  // Update counter on input
  input.addEventListener('input', function() {
    const currentLength = this.value.length;
    counter.innerText = `${currentLength}/${maxLength}`;
    // Change counter color when approaching limit
    if (currentLength >= maxLength * 0.8) {
      counter.style.color = '#ff9900';
    } else {
      counter.style.color = '#666';
    }
    // Truncate if exceeds (shouldn't happen due to maxlength attribute, but just in case)
    if (currentLength > maxLength) {
      this.value = this.value.substring(0, maxLength);
    }
  });
}
 
// Function to set up form validation
function setupFormValidation(formId, validations) {
  const form = document.getElementById(formId);
  if (!form) return;
  // Add CSS for error styling and character counters
  const style = document.createElement('style');
  style.textContent = `
    .error-input {
      border: 1px solid #ff3860 !important;
    }
    .error-message {
      color: #ff3860;
      font-size: 0.8em;
      margin-top: 2px;
      margin-bottom: 10px;
    }
    .char-counter {
      text-align: right;
      font-size: 0.8em;
      color: #666;
      margin-top: 2px;
    }
  `;
  document.head.appendChild(style);
  // Set up character limits for fields that need them
  for (const fieldName in validations) {
    const input = form.querySelector(`[name="${fieldName}"]`);
    if (!input) continue;
    // Find maxLength rule if it exists
    const maxLengthRule = validations[fieldName].find(rule => rule.type === 'maxLength');
    if (maxLengthRule) {
      setupCharLimit(input, maxLengthRule.value);
    }
  }
  // Handle form submission
  form.addEventListener('submit', function(event) {
    let isValid = true;
    // Validate each field according to its rules
    for (const fieldName in validations) {
      const input = form.querySelector(`[name="${fieldName}"]`);
      if (!input) continue;
      const rules = validations[fieldName];
      // Always sanitize inputs first
      if (input.type !== 'file') {
        if (!sanitizeInput(input)) {
          isValid = false;
        }
      }
      // Apply each validation rule
      for (const rule of rules) {
        let ruleIsValid = true;
        switch (rule.type) {
          case 'required':
            ruleIsValid = validateRequired(input);
            break;
          case 'email':
            ruleIsValid = validateEmail(input);
            break;
          case 'phone':
            ruleIsValid = validatePhone(input);
            break;
          case 'minLength':
            ruleIsValid = validateMinLength(input, rule.value);
            break;
          case 'maxLength':
            ruleIsValid = validateMaxLength(input, rule.value);
            break;
          case 'noSpecialChars':
            ruleIsValid = validateSpecialChars(input, false);
            break;
          case 'fileType':
            ruleIsValid = validateFileType(input, rule.extensions);
            break;
        }
        // If any rule fails, mark the form as invalid
        if (!ruleIsValid) {
          isValid = false;
          break; // Skip remaining rules for this field
        }
      }
    }
    // Prevent form submission if validation fails
    if (!isValid) {
      event.preventDefault();
    }
  });
  // Set up live validation on input blur
  for (const fieldName in validations) {
    const input = form.querySelector(`[name="${fieldName}"]`);
    if (!input) continue;
    input.addEventListener('blur', function() {
      // Sanitize input first
      if (input.type !== 'file') {
        sanitizeInput(input);
      }
      // Apply each validation rule
      for (const rule of validations[fieldName]) {
        let ruleIsValid = true;
        switch (rule.type) {
          case 'required':
            ruleIsValid = validateRequired(input);
            break;
          case 'email':
            ruleIsValid = validateEmail(input);
            break;
          case 'phone':
            ruleIsValid = validatePhone(input);
            break;
          case 'minLength':
            ruleIsValid = validateMinLength(input, rule.value);
            break;
          case 'maxLength':
            ruleIsValid = validateMaxLength(input, rule.value);
            break;
          case 'noSpecialChars':
            ruleIsValid = validateSpecialChars(input, false);
            break;
          case 'fileType':
            ruleIsValid = validateFileType(input, rule.extensions);
            break;
        }
        // Break on first failed rule
        if (!ruleIsValid) break;
      }
    });
    // Clear errors when user starts typing again
    input.addEventListener('input', function() {
      if (input.classList.contains('error-input')) {
        removeError(input);
      }
    });
  }
}