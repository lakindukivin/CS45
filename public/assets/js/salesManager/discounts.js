// Modal functions
function openAddModal() {
  document.getElementById('addModal').style.display = 'block';
  setMinDateToToday();
}

function closeAddModal() {
  document.getElementById('addModal').style.display = 'none';
  document.getElementById('addDiscountForm').reset();
}

function openEditModal(
  editDiscountId,
  editProductName,
  editDiscountPercentage,
  editStartDate,
  editEndDate,
  editStatus,
  editProductId // Add this parameter
) {
  document.getElementById('editDiscountId').value = editDiscountId;
  document.getElementById('editProductName').value = editProductName;
  document.getElementById('editDiscountPercentage').value =
    editDiscountPercentage;
  document.getElementById('editStartDate').value = editStartDate;
  document.getElementById('editEndDate').value = editEndDate;
  document.getElementById('editStatus').value = editStatus;
  document.getElementById('editProductId').value = editProductId; // Set the product_id
  document.getElementById('editModal').style.display = 'block';

  // Special handling for edit modal - ensure min dates are today
  // but don't restrict if the existing date is in the past
  setMinDateToToday();

  // Allow the current selected dates even if they're in the past
  const today = new Date();
  const startDate = new Date(editStartDate);

  if (startDate < today) {
    // For existing discounts with past start dates, allow the current value
    document.getElementById('editStartDate').removeAttribute('min');
  }
}

function closeEditModal() {
  document.getElementById('editModal').style.display = 'none';
  document.getElementById('editDiscountForm').reset();
}

function openDeleteModal(id) {
  document.getElementById('deleteDiscountId').value = id;
  document.getElementById('deleteConfirmationModal').style.display = 'block';
}

function closeDeleteModal() {
  document.getElementById('deleteConfirmationModal').style.display = 'none';
  document.getElementById('deleteProductForm').reset();
}

function closeResponseModal() {
  document.getElementById('responseModal').style.display = 'none';
  location.reload(); // Refresh the page to see changes
}

function showResponse(message) {
  document.getElementById('responseMessage').textContent = message;
  document.getElementById('responseModal').style.display = 'block';
}

// Add this function to validate discount percentage
function validateDiscountPercentage(input) {
  const value = parseFloat(input.value);
  if (isNaN(value) || value <= 0 || value >= 1) {
    showError(
      input,
      'Discount must be greater than 0 and less than 1 (e.g., 0.2 for 20%)'
    );
    return false;
  }
  removeError(input);
  return true;
}

// Function to set minimum date to today for date inputs
function setMinDateToToday() {
  const today = new Date();
  const yyyy = today.getFullYear();
  const mm = String(today.getMonth() + 1).padStart(2, '0');
  const dd = String(today.getDate()).padStart(2, '0');
  const todayFormatted = `${yyyy}-${mm}-${dd}`;

  // Set min attribute for all date inputs
  document.querySelectorAll('input[type="date"]').forEach((input) => {
    input.setAttribute('min', todayFormatted);
  });
}

//refresh searchbar
document
  .querySelector('input[name="search"]')
  .addEventListener('input', function (e) {
    if (e.target.value.trim() === '') {
      window.location.href = window.location.pathname;
    }
  });

// Discount form validation
document.addEventListener('DOMContentLoaded', function () {
  // Add Discount form
  if (document.getElementById('addDiscountForm')) {
    setupFormValidation('addDiscountForm', {
      productId: [{ type: 'required' }],
      discountPercentage: [
        { type: 'required' },
        { type: 'custom', validate: validateDiscountPercentage },
      ],
      startDate: [{ type: 'required' }, { type: 'dateFormat' }],
      endDate: [
        { type: 'required' },
        { type: 'dateFormat' },
        { type: 'dateOrder', related: 'startDate' },
      ],
    });
  }

  // Edit Discount form
  if (document.getElementById('editDiscountForm')) {
    setupFormValidation('editDiscountForm', {
      editDiscountPercentage: [
        { type: 'required' },
        {
          type: 'custom',
          validate: function (input) {
            return validateDiscountPercentage(input);
          },
        },
      ],
      editStartDate: [{ type: 'required' }, { type: 'dateFormat' }],
      editEndDate: [
        { type: 'required' },
        { type: 'dateFormat' },
        { type: 'dateOrder', related: 'editStartDate' },
      ],
      editStatus: [{ type: 'required' }],
    });
  }

  // Set min dates on page load in case forms are visible
  setMinDateToToday();
});
