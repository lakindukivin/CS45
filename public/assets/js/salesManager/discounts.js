
document.addEventListener('DOMContentLoaded', function () {
  // Get the add discount form
  const addDiscountForm = document.querySelector('#addModal form');

  if (addDiscountForm) {
    addDiscountForm.addEventListener('submit', function (event) {
      // Prevent default form submission only for validation
      event.preventDefault();

      // Get form data
      const productId = addDiscountForm.querySelector(
        'select[name="product_id"]'
      ).value;
      const discountPercentage = addDiscountForm.querySelector(
        'input[name="discount_percentage"]'
      ).value;
      const startDate = addDiscountForm.querySelector(
        'input[name="start_date"]'
      ).value;
      const endDate = addDiscountForm.querySelector(
        'input[name="end_date"]'
      ).value;

      // Validate form data
      if (!productId) {
        alert('Please select a product');
        return;
      }

      if (
        !discountPercentage ||
        discountPercentage < 1 ||
        discountPercentage > 100
      ) {
        alert('Please enter a valid discount percentage between 1 and 100');
        return;
      }

      if (!startDate) {
        alert('Please select a start date');
        return;
      }

      if (!endDate) {
        alert('Please select an end date');
        return;
      }

      // Compare dates to ensure start date is before end date
      if (new Date(startDate) > new Date(endDate)) {
        alert('Start date must be before end date');
        return;
      }

      // If all validations pass, submit the form
      this.submit();
    });
  }
});
function openEditModal(
  discountId,
  productName,
  discount_percentage,
  start_date,
  end_date
) {
  document.getElementById('edit_discount_id').value = discountId;
  document.getElementById('edit_product_name').value = productName;
  document.getElementById('edit_discount_percentage').value = discount_percentage;
  document.getElementById('edit_start_date').value = start_date;
  document.getElementById('edit_end_date').value = end_date;
  document.getElementById('editModal').style.display = 'block';
}

function closeEditModal() {
  document.getElementById('editModal').style.display = 'none';
}

function openDeleteModal(discountId) {
  document.getElementById('delete_discount_id').value = discountId;
  document.getElementById('deleteModal').style.display = 'block';
}

function closeDeleteModal() {
  document.getElementById('deleteModal').style.display = 'none';
}
