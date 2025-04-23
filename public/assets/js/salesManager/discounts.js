// Modal functions
function openAddModal() {
  document.getElementById('addModal').style.display = 'block';
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
  editStatus
) {
  document.getElementById('editDiscountId').value = editDiscountId;
  document.getElementById('editProductName').value = editProductName;
  document.getElementById('editDiscountPercentage').value =
    editDiscountPercentage;
  document.getElementById('editStartDate').value = editStartDate;
  document.getElementById('editEndDate').value = editEndDate;
  document.getElementById('editStatus').value = editStatus;
  document.getElementById('editModal').style.display = 'block';
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
      discountPercentage: [{ type: 'required' }],
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
      editDiscountPercentage: [{ type: 'required' }],
      editStartDate: [{ type: 'required' }, { type: 'dateFormat' }],
      editEndDate: [
        { type: 'required' },
        { type: 'dateFormat' },
        { type: 'dateOrder', related: 'editStartDate' },
      ],
      editStatus: [{ type: 'required' }],
    });
  }
});
