
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
  //   productPrice,
  description
) {
  currentProductId = productId;

  document.getElementById('editProductID').value = productId;
  document.getElementById('editProductName').value = productName;
  document.getElementById('existingImage').src = '<?= ROOT ?>' + productImage;
  //   document.getElementById('editProductPrice').value = productPrice;
  document.getElementById('editDescription').value = description;

  document.getElementById('editModal').style.display = 'block';
}

function closeEditModal() {
  document.getElementById('editModal').style.display = 'none';
  document.getElementById('editProductForm').reset();
  currentProductId = null;
}

function openDeleteModal(productId) {
  document.getElementById('deleteProductID').value = productId;
  document.getElementById('deleteConfirmationModal').style.display = 'block';
}

function closeDeleteModal() {
  document.getElementById('deleteConfirmationModal').style.display = 'none';
  currentProductId = null;
}

function closeResponseModal() {
  document.getElementById('responseModal').style.display = 'none';
  location.reload(); // Refresh the page to see changes
}



function showResponse(message) {
  document.getElementById('responseMessage').textContent = message;
  document.getElementById('responseModal').style.display = 'block';
}
