// Modal functions
function openAddModal() {
  document.getElementById('addModal').style.display = 'block';
}

function closeAddModal() {
  document.getElementById('addModal').style.display = 'none';
  document.getElementById('addStaffForm').reset();
}

function openEditModal(staff_id, name, image, phone, address, role, status) {
  document.getElementById('staff_id').value = staff_id;
  document.getElementById('editStaffName').value = name;
  document.getElementById('editImage').src = image
    ? 'http://localhost/cs45/public/' + image
    : '';
  document.getElementById('existingImagePath').value = image;
  document.getElementById('editStaffContactNo').value = phone;
  document.getElementById('editStaffAddress').value = address;
  document.getElementById('editStaffrole').value = role;
  document.getElementById('editStaffStatus').value = status;

  document.getElementById('editModal').style.display = 'block';
}

function closeEditModal() {
  document.getElementById('editModal').style.display = 'none';
  document.getElementById('editStaffAccounts').reset();
}

function openDeleteModal(staff_id) {
  document.getElementById('deleteStaffId').value = staff_id;
  document.getElementById('deleteConfirmationModal').style.display = 'block';
}

function closeDeleteModal() {
  document.getElementById('deleteConfirmationModal').style.display = 'none';
}

function closeResponseModal() {
  document.getElementById('responseModal').style.display = 'none';
  location.reload(); // Refresh the page to see changes
}

function showResponse(message) {
  document.getElementById('responseMessage').textContent = message;
  document.getElementById('responseModal').style.display = 'block';
}

// Add this to manageStaffAccounts.js
document
  .getElementById('addStaffForm')
  .addEventListener('submit', function (e) {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    if (password !== confirmPassword) {
      e.preventDefault();
      alert('Passwords do not match!');
      return false;
    }
    // Additional validation can be added here
    return true;
  });
//refresh searchbar
document
  .querySelector('input[name="search"]')
  .addEventListener('input', function (e) {
    if (e.target.value.trim() === '') {
      window.location.href = window.location.pathname;
    }
  });
