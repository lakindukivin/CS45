// View data from the database
const fetchProducts = async () => {
  try {
    const response = await fetch(
      'http://localhost/cs45/app/controllers/ProductController.php?action=fetch'
    );

    if (!response.ok) throw new Error('Failed to fetch products');

    const products = await response.json();

    // Populate the table for desktop view
    const container = document.getElementById('productTableBody');
    container.innerHTML = products
      .map((product) => {
        return `<tr>
          <td>${product.product_id}</td>
          <td>${product.product_name}</td>
          <td><img src="${product.product_img_url}" alt="${product.product_name}" style="width: 100px; height: auto;" /></td>
          <td>${product.product_price}</td>
          <td>${product.product_description}</td>
          <td>${product.product_pack_size}</td>
          <td>${product.product_bag_size}</td>
          <td>${product.product_quantity}</td>
          <td>
            <button class="edit-btn" onclick="editProduct(${product.product_id})">Edit</button>
            <button class="delete-btn" onclick="openDeleteModal(${product.product_id})">Delete</button>
          </td>
        </tr>`;
      })
      .join('');

    // Populate the card view for mobile
    const cardContainer = document.getElementById('manageCustomerAccountsCard');
    cardContainer.innerHTML = products
      .map((product) => {
        return `<div class="product-card">
          <img src="${product.product_img_url}" alt="${product.product_name}" class="product-card-img" />
          <div class="product-card-content">
            <h3>${product.product_name}</h3>
            <p><strong>Price:</strong> Rs.${product.product_price}</p>
            <p><strong>Description:</strong> ${product.product_description}</p>
            <p><strong>Pack Size:</strong> ${product.product_pack_size}</p>
            <p><strong>Bag Size:</strong> ${product.product_bag_size}</p>
            <p><strong>Quantity:</strong> ${product.product_quantity}</p>
            <div class="product-card-actions">
              <button class="edit-btn" onclick="editProduct(${product.product_id})">Edit</button>
              <button class="delete-btn" onclick="openDeleteModal(${product.product_id})">Delete</button>
            </div>
          </div>
        </div>`;
      })
      .join('');
  } catch (error) {
    console.error('Error:', error);
  }
};

fetchProducts();

// Add Product Form Submission
document
  .getElementById('productForm')
  .addEventListener('submit', async function (event) {
    event.preventDefault(); // Prevent the form's default submission behavior
    const form = event.target;
    const formData = new FormData(form);

    try {
      const response = await fetch(
        'http://localhost/cs45/app/controllers/ProductController.php?action=add',
        {
          method: 'POST',
          body: formData,
        }
      );

      if (!response.ok) {
        throw new Error('Failed to fetch product details');
      }

      const result = await response.json();
      if (result.success) {
        alert('Product added successfully!');
        window.location.reload();
      } else {
        alert(result.message || 'Failed to add product.');
      }
    } catch (error) {
      // Handle network or server errors
      console.error('Error:', error);
      alert(error.message || 'An error occurred while adding the product.');
    }
  });

const editProduct = async (product_id) => {
  try {
    openEditModal();

    const response = await fetch(
      `http://localhost/cs45/app/controllers/ProductController.php?action=view&product_id=${product_id}`
    );

    if (!response.ok) {
      throw new Error('Failed to fetch product details');
    }

    const product = await response.json();

    // Populate the edit form with product data
    document.getElementById('editProductForm').product_id.value =
      product.product_id;
    document.getElementById('editProductForm').product_name.value =
      product.product_name;
    document.getElementById('existingImage').src = product.product_img_url;
    document.getElementById('editProductForm').existing_image.value =
      product.product_img;
    document.getElementById('editProductForm').product_price.value =
      product.product_price;
    document.getElementById('editProductForm').description.value =
      product.product_description;
    const packSizeSelect = document.getElementById('editProductForm').packSize;
    const bagSizeSelect = document.getElementById('editProductForm').bagSize;

    packSizeSelect.value = product.product_pack_size;
    bagSizeSelect.value = product.product_bag_size;
  } catch (error) {
    console.error('Error fetching product details:', error);
  }
};

// Handle Edit Product Form Submission
document
  .getElementById('editProductForm')
  .addEventListener('submit', async function (event) {
    const form = event.target;
    const formData = new FormData(form);

    try {
      const response = await fetch(
        'http://localhost/cs45/app/controllers/ProductController.php?action=edit',
        {
          method: 'POST',
          body: formData,
        }
      );

      const result = await response.json();

      if (response.ok) {
        alert('Product updated successfully!');
        fetchProducts();
      } else {
        alert(result.message || 'Failed to update product.');
      }
    } catch (error) {
      console.error('Error:', error);
      alert('An error occurred while updating the product.');
    }
  });

//Delete the product | soft delete
let productToDelete = null;

// Open Delete Modal
function openDeleteModal(productId) {
  productToDelete = productId; // Save the product ID for deletion
  const deleteModal = document.getElementById('deleteConfirmationModal');
  deleteModal.style.display = 'block';
}

// Close Delete Modal
function closeDeleteModal() {
  productToDelete = null; // Reset the product ID
  const deleteModal = document.getElementById('deleteConfirmationModal');
  deleteModal.style.display = 'none';
}

// Confirm Delete
async function confirmDelete() {
  if (!productToDelete) {
    showResponseModal('No product selected for deletion.');
    return;
  }

  closeDeleteModal(); // Close the delete confirmation modal

  try {
    const response = await fetch(
      'http://localhost/cs45/app/controllers/ProductController.php?action=delete',
      {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `product_id=${productToDelete}`, // Send product ID for deletion
      }
    );

    if (!response.ok) {
      throw new Error('Network response was not ok.');
    }

    const result = await response.json();
    if (result.success) {
      showResponseModal('Product deleted successfully.');
      fetchProducts(); // Refresh product list after deletion
    } else {
      showResponseModal(result.message || 'Failed to delete the product.');
    }
  } catch (error) {
    console.error('Error during delete operation:', error);
    showResponseModal('An error occurred while deleting the product.');
  }
}

// Open Response Modal
function showResponseModal(message) {
  const responseMessage = document.getElementById('responseMessage');
  const responseModal = document.getElementById('responseModal');

  responseMessage.textContent = message; // Set the message
  responseModal.style.display = 'block'; // Show the modal
}

// Close Response Modal
function closeResponseModal() {
  const responseModal = document.getElementById('responseModal');
  responseModal.style.display = 'none'; // Hide the modal
}

// const deleteProduct = async (product_id) => {
//   if (!confirm("Are you sure you want to delete this product?")) return;

//   try {
//     const response = await fetch(
//       "http://localhost/cs45/app/controllers/ProductController.php?action=delete",
//       {
//         method: "POST",
//         headers: { "Content-Type": "application/x-www-form-urlencoded" },
//         body: new URLSearchParams({ product_id }),
//       }
//     );

//     const result = await response.json();
//     if (result.success) {
//       alert("Product deleted successfully");
//       fetchProducts();
//     } else {
//       alert(result.message || "Failed to delete product");
//     }
//   } catch (error) {
//     console.error("Error:", error);
//   }
// };
