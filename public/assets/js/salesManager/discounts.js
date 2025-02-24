
function openEditModal(
  discountId,
  productName,
  percentage,
  startDate,
  endDate
) {
  document.getElementById('edit_discount_id').value = discountId;
  document.getElementById('edit_product_name').value = productName;
  document.getElementById('edit_discount_percentage').value = percentage;
  document.getElementById('edit_start_date').value = startDate;
  document.getElementById('edit_end_date').value = endDate;
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
