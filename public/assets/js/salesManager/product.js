// products.js
// document.addEventListener('DOMContentLoaded', function () {
//   // Initialize any necessary variables
//   let currentProductId = null;

//   // Add event listener for the add product form
//   const productForm = document.getElementById('productForm');
//   if (productForm) {
//     productForm.addEventListener('submit', function (e) {
//       e.preventDefault();
//       addProduct();
//     });
//   }

//   // Add event listener for the edit product form
//   const editProductForm = document.getElementById('editProductForm');
//   if (editProductForm) {
//     editProductForm.addEventListener('submit', function (e) {
//       e.preventDefault();
//       updateProduct();
//     });
//   }
// });

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
  productPrice,
  description
) {
  currentProductId = productId;

  document.getElementById('editProductID').value = productId;
  document.getElementById('editProductName').value = productName;
  document.getElementById('existingImage').src = '<?= ROOT ?>' + productImage;
  document.getElementById('editProductPrice').value = productPrice;
  document.getElementById('editDescription').value = description;

  document.getElementById('editModal').style.display = 'block';
}

function closeEditModal() {
  document.getElementById('editModal').style.display = 'none';
  document.getElementById('editProductForm').reset();
  currentProductId = null;
}

function openDeleteModal(productId) {
  currentProductId = productId;
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

// CRUD Operations
// function addProduct() {
//   const form = document.getElementById('productForm');
//   const formData = new FormData(form);

//   fetch('<?= ROOT ?>/products/add', {
//     method: 'POST',
//     body: formData,
//   })
//     .then((response) => response.json())
//     .then((data) => {
//       if (data.success) {
//         showResponse('Product added successfully!');
//         closeAddModal();
//       } else {
//         showResponse(
//           'Error adding product: ' + (data.message || 'Unknown error')
//         );
//       }
//     })
//     .catch((error) => {
//       showResponse('Network error: ' + error.message);
//     });
// }

// function updateProduct() {
//   const form = document.getElementById('editProductForm');
//   const formData = new FormData(form);

//   fetch('<?= ROOT ?>/products/update', {
//     method: 'POST',
//     body: formData,
//   })
//     .then((response) => response.json())
//     .then((data) => {
//       if (data.success) {
//         showResponse('Product updated successfully!');
//         closeEditModal();
//       } else {
//         showResponse(
//           'Error updating product: ' + (data.message || 'Unknown error')
//         );
//       }
//     })
//     .catch((error) => {
//       showResponse('Network error: ' + error.message);
//     });
// }

// function confirmDelete() {
//   if (!currentProductId) return;

//   const formData = new FormData();
//   formData.append('product_id', currentProductId);

//   fetch('<?= ROOT ?>/products/delete', {
//     method: 'POST',
//     body: formData,
//   })
//     .then((response) => response.json())
//     .then((data) => {
//       if (data.success) {
//         showResponse('Product deleted successfully!');
//         closeDeleteModal();
//       } else {
//         showResponse(
//           'Error deleting product: ' + (data.message || 'Unknown error')
//         );
//       }
//     })
//     .catch((error) => {
//       showResponse('Network error: ' + error.message);
//     });
// }

// function showResponse(message) {
//   document.getElementById('responseMessage').textContent = message;
//   document.getElementById('responseModal').style.display = 'block';
// }
