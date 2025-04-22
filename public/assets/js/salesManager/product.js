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
