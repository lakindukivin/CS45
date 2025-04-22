function openAddModal() {
  document.getElementById('addModal').style.display = 'block';
}
function closeAddModal() {
  document.getElementById('addModal').style.display = 'none';
  document.getElementById('adForm').reset();
}

function openEditModal(
  ad_id,
  title,
  image,
  description,
  start_date,
  end_date,
  status
) {
  currentadId = ad_id;

  document.getElementById('editAdId').value = ad_id;
  document.getElementById('editAdTitle').value = title;
  //   document.getElementById('existingImage').src = '<?= ROOT ?>' + image;
  document.getElementById('editAdDescription').value = description;
  document.getElementById('editAdStartDate').value = start_date;
  document.getElementById('editAdEndDate').value = end_date;
  document.getElementById('editStatus').value = status;
  document.getElementById('editModal').style.display = 'block';
}

function closeEditModal() {
  document.getElementById('editModal').style.display = 'none';
  document.getElementById('editAdForm').reset();
  currentadId = null;
}

function openDeleteModal(ad_id) {
  document.getElementById('deleteAdId').value = ad_id;
  document.getElementById('deleteModal').style.display = 'block';
}

function closeDeleteModal() {
  document.getElementById('deleteModal').style.display = 'none';
  currentadId = null;
}
//refresh searchbar
document
  .querySelector('input[name="search"]')
  .addEventListener('input', function (e) {
    if (e.target.value.trim() === '') {
      window.location.href = window.location.pathname;
    }
  });
