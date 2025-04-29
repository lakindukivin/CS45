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

// Bag Size Modal Functions
function openBagSizeModal() {
  document.getElementById('bagSizeModal').style.display = 'block';
}

function closeBagSizeModal() {
  document.getElementById('bagSizeModal').style.display = 'none';
}

function openAddBagSizeModal() {
  const productSelect = document.getElementById('product_id');

  // Check if there are any bag products available
  if (productSelect && productSelect.options.length <= 1) {
    // Only the default "Select a bag product" option exists
    showResponse('No bag products available. Please add a bag product first.');
    return;
  }

  document.getElementById('addBagSizeModal').style.display = 'block';
}

function closeAddBagSizeModal() {
  document.getElementById('addBagSizeModal').style.display = 'none';
  document.getElementById('addBagSizeForm').reset();
}

function openEditBagSizeModal(productId, bagId, weight, price) {
  document.getElementById('editProductID').value = productId;
  document.getElementById('editBagID').value = bagId;
  document.getElementById('editWeight').value = weight;
  document.getElementById('editPrice').value = price;
  document.getElementById('editBagSizeModal').style.display = 'block';
}

function closeEditBagSizeModal() {
  document.getElementById('editBagSizeModal').style.display = 'none';
}

function openDeleteBagSizeModal(productId, bagId) {
  document.getElementById('deleteBagSizeProductID').value = productId;
  document.getElementById('deleteBagSizeGagID').value = bagId;
  document.getElementById('deleteBagSizeModal').style.display = 'block';
}

function closeDeleteBagSizeModal() {
  document.getElementById('deleteBagSizeModal').style.display = 'none';
}

// Store existing product-bag size relationships
const productBagSizes = {};

// Function to initialize product-bag size relationships from PHP data
function initProductBagSizes(bagSizesData) {
  bagSizesData.forEach((item) => {
    if (!productBagSizes[item.product_id]) {
      productBagSizes[item.product_id] = [];
    }
    productBagSizes[item.product_id].push(parseInt(item.bag_id));
  });
}

// Update available bag sizes based on selected product
function updateAvailableBagSizes() {
  const productId = document.getElementById('product_id').value;
  const bagSizeSelect = document.getElementById('bag_id');

  // Reset options
  bagSizeSelect.innerHTML = '';

  // Define all possible bag sizes
  const allBagSizes = [
    { id: 1, name: 'Small' },
    { id: 2, name: 'Medium' },
    { id: 3, name: 'Large' },
    { id: 4, name: 'XL' },
    { id: 5, name: 'XXL' },
    { id: 6, name: 'XXXL' },
  ];

  // Filter out already used bag sizes for this product
  const usedBagSizes = productBagSizes[productId] || [];
  const availableBagSizes = allBagSizes.filter(
    (size) => !usedBagSizes.includes(size.id)
  );

  // Add available options to the select
  if (availableBagSizes.length === 0) {
    const option = document.createElement('option');
    option.value = '';
    option.textContent = 'All bag sizes already assigned to this product';
    option.disabled = true;
    option.selected = true;
    bagSizeSelect.appendChild(option);
  } else {
    availableBagSizes.forEach((size) => {
      const option = document.createElement('option');
      option.value = size.id;
      option.textContent = size.name;
      bagSizeSelect.appendChild(option);
    });
  }
}

// Add event listener to product select
document.addEventListener('DOMContentLoaded', function () {
  const productSelect = document.getElementById('product_id');
  if (productSelect) {
    productSelect.addEventListener('change', updateAvailableBagSizes);
  }
});

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

  // Add Bag Size form validation
  if (document.getElementById('addBagSizeForm')) {
    setupFormValidation('addBagSizeForm', {
      product_id: [{ type: 'required' }],
      bag_id: [{ type: 'required' }],
      weight: [
        { type: 'required' },
        {
          type: 'custom',
          validate: function (input) {
            const val = parseFloat(input.value);
            if (isNaN(val) || val <= 0) {
              showError(input, 'Weight must be greater than 0');
              return false;
            }
            removeError(input);
            return true;
          },
        },
      ],
      price: [
        { type: 'required' },
        {
          type: 'custom',
          validate: function (input) {
            const val = parseFloat(input.value);
            if (isNaN(val) || val <= 0) {
              showError(input, 'Price must be greater than 0');
              return false;
            }
            removeError(input);
            return true;
          },
        },
      ],
    });
  }

  // Edit Bag Size form validation
  if (document.getElementById('editBagSizeForm')) {
    setupFormValidation('editBagSizeForm', {
      editWeight: [
        { type: 'required' },
        {
          type: 'custom',
          validate: function (input) {
            const val = parseFloat(input.value);
            if (isNaN(val) || val <= 0) {
              showError(input, 'Weight must be greater than 0');
              return false;
            }
            removeError(input);
            return true;
          },
        },
      ],
      editPrice: [
        { type: 'required' },
        {
          type: 'custom',
          validate: function (input) {
            const val = parseFloat(input.value);
            if (isNaN(val) || val <= 0) {
              showError(input, 'Price must be greater than 0');
              return false;
            }
            removeError(input);
            return true;
          },
        },
      ],
    });
  }
});
