const fetchProducts = async () => {
  try {
    const response = await fetch('viewProducts.php');
    if (!response.ok) throw new Error('Failed to fetch products');
    const products = await response.json();

    const container = document.getElementById('productTableBody');
    container.innerHTML = products
      .map((product) => {
        return `   <tr>
            <td>${product.product_id}</td>
            <td>${product.product_name}</td>
            <td>${product.product_img}</td>
            <td>${product.product_price}</td>
            <td>${product.description}</td>
            <td>${product.pack_size}</td>
            <td>${product.bag_size}</td>
            <td>${product.quantity}</td>
            <td>
            <button class="edit-btn" onclick="editProduct(${product.product_id})">Edit</button>
            <button class="delete-btn" onclick="deleteProduct(${product.product_id})">Delete</button>
            </td>
            </tr>`;
      })
      .join('');
    console.log(products);
  } catch (error) {
    console.error('Error:', error);
  }
};
fetchProducts();

const deleteProduct = async (product_id) => {
  console.log('Attempting to delete product:', product_id);
  if (!confirm('Are you sure you want to delete this product?')) return;

  const productData = new URLSearchParams({ product_id });

  try {
    const response = await fetch('deleteProduct.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: productData,
    });
    const result = await response.json();
    console.log('Server Response:', result);

    if (result.success) {
      alert('Product deleted successfully');
      fetchProducts(); // Reload the product list
    } else {
      alert('Failed to delete product');
    }
  } catch (error) {
    console.error('Error:', error);
  }
};

//update

const editProduct = (product_id) => {
  openEditModal();

  // Fetch product details and pre-fill the form
  fetch(`viewProductDetails.php?product_id=${product_id}`)
    .then((response) => response.json())
    .then((product) => {
      // Populate form fields with product details
      document.getElementById('editProductForm').product_id.value =
        product.product_id;
      document.getElementById('editProductForm').product_name.value =
        product.product_name;
      // document.getElementById('editProductForm').product_img.value =
      //   product.product_img;
      document.getElementById('editProductForm').product_price.value =
        product.product_price;
      document.getElementById('editProductForm').description.value =
        product.description;
      document.getElementById('editProductForm').pack_size.value =
        product.pack_size;
      document.getElementById('editProductForm').bag_size.value =
        product.bag_size;
      document.getElementById('editProductForm').quantity.value =
        product.quantity;
    })
    .catch((error) => console.error('Error fetching product details:', error));
};
