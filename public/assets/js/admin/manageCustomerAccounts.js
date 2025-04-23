function openEditModal(customer_id, name, image, phone, address, status) {
  document.getElementById('editCustomerId').value = customer_id;
  document.getElementById('editCustomerName').value = name;
  document.getElementById('editCustomerImage').value = image ? image : '';
  document.getElementById('editCustomerContactNo').value = phone;
  document.getElementById('editCustomerAddress').value = address;
  document.getElementById('editCustomerStatus').value = status;

  document.getElementById('editModal').style.display = 'block';
}

function closeEditModal() {
  document.getElementById('editModal').style.display = 'none';
  document.getElementById('editCustomerForm').reset();
}

function openDeleteModal(customer_id) {
  document.getElementById('deleteCustomerId').value = customer_id;
  document.getElementById('deleteConfirmationModal').style.display = 'block';
}

function closeDeleteModal() {
  document.getElementById('deleteConfirmationModal').style.display = 'none';
  document.getElementById('deleteCustomerForm').reset();
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
