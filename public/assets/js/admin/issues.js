function openAddModal() {
  document.getElementById('addModal').style.display = 'block';
}
function closeAddModal() {
  document.getElementById('addModal').style.display = 'none';
  document.getElementById('issueForm').reset();
}

function openEditModal(issue_id, description, status, action_taken) {
  currentadId = issue_id;

  document.getElementById('issueId').value = issue_id;
  document.getElementById('description').value = description;
  document.getElementById('status').value = status;
  document.getElementById('actionsTaken').value = action_taken;
  document.getElementById('editModal').style.display = 'block';
}

function closeEditModal() {
  document.getElementById('editModal').style.display = 'none';
  document.getElementById('editIssueForm').reset();
  currentadId = null;
}

function openDeleteModal(issue_id) {
  document.getElementById('deleteIssueId').value = issue_id;
  document.getElementById('deleteModal').style.display = 'block';
}

function closeDeleteModal() {
  document.getElementById('deleteModal').style.display = 'none';
  currentadId = null;
}
