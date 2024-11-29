// View data from the database
const fetchProducts = async () => {
  try {
    const response = await fetch(
      'http://localhost/cs45/app/controllers/ProductController.php?action=fetch'
    );

    if (!response.ok) throw new Error('Failed to fetch products');

    const products = await response.json();
    console.log(products);
    const container = document.getElementById('productTableBody');
    container.innerHTML = products
      .map((product) => {
        return `<tr>
          <td>${product.product_id}</td>
          <td>${product.product_name}</td>
          <td><img src="${product.product_img_url}" alt="${product.product_name}" style="width: 100px; height: 100px;" /></td>
          <td>${product.product_price}</td>
          <td>${product.product_description}</td>
          <td>${product.product_pack_size}</td>
          <td>${product.product_bag_size}</td>
           
          <td>
            <button class="edit-btn" onclick="editProduct(${product.product_id})">Edit</button>
            <button class="delete-btn" onclick="deleteProduct(${product.product_id})">Delete</button>
          </td>
        </tr>`;
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
const deleteProduct = async (product_id) => {
  if (!confirm('Are you sure you want to delete this product?')) return;

  try {
    const response = await fetch(
      'http://localhost/cs45/app/controllers/ProductController.php?action=delete',
      {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ product_id }),
      }
    );

    const result = await response.json();
    if (result.success) {
      alert('Product deleted successfully');
      fetchProducts();
    } else {
      alert(result.message || 'Failed to delete product');
    }
  } catch (error) {
    console.error('Error:', error);
  }
};
