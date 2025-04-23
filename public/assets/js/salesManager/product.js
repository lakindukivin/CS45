// Modal functions
function openAddModal() {
  document.getElementById('addModal').style.display = 'block';
}

function closeAddModal() {
  document.getElementById('addModal').style.display = 'none';
  document.getElementById('productForm').reset();
}

function openEditModal(
  productId,
  productName,
  productImage,
  description,
  status
) {
  document.getElementById('editProductID').value = productId;
  document.getElementById('editProductName').value = productName;
  document.getElementById('existingImage').src = productImage
    ? 'http://localhost/cs45/public/' + productImage
    : '';
  document.getElementById('existingImagePath').value = productImage;
  document.getElementById('editDescription').value = description;
  document.getElementById('editStatus').value = status;
  document.getElementById('editModal').style.display = 'block';
}

function closeEditModal() {
  document.getElementById('editModal').style.display = 'none';
  document.getElementById('editProductForm').reset();
}

function openDeleteModal(productId) {
  document.getElementById('deleteProductID').value = productId;
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

//validation for add product form
document.addEventListener('DOMContentLoaded', function () {
  // Set up validation for the Add Product form
  if (document.getElementById('productForm')) {
    setupFormValidation('productForm', {
      // Define validation rules for each field
      productName: [
        { type: 'required' },
        { type: 'minLength', value: 3 },
        { type: 'maxLength', value: 100 }, // Limit product name length
      ],
      img: [
        { type: 'required' },
        { type: 'fileType', extensions: ['jpg', 'jpeg', 'png', 'gif'] },
      ],
      description: [
        { type: 'required' },
        { type: 'minLength', value: 10 },
        { type: 'maxLength', value: 500 }, // Limit description to reasonable size
      ],
    });
  }

  // Set up validation for the Edit Product form
  if (document.getElementById('editProductForm')) {
    setupFormValidation('editProductForm', {
      editProductName: [
        { type: 'required' },
        { type: 'minLength', value: 3 },
        { type: 'maxLength', value: 100 },
      ],
      editImage: [
        { type: 'fileType', extensions: ['jpg', 'jpeg', 'png', 'gif'] },
      ],
      editDescription: [
        { type: 'required' },
        { type: 'minLength', value: 10 },
        { type: 'maxLength', value: 500 },
      ],
    });
  }
});
