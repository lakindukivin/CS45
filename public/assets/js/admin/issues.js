function openAddModal() {
  document.getElementById('addModal').style.display = 'block';
}

function closeAddModal() {
  document.getElementById('addModal').style.display = 'none';
  document.getElementById('issueForm').reset();
}

function openEditModal(
  issue_id,
  description,
  email,
  phone,
  status,
  action_taken
) {
  currentadId = issue_id;

  document.getElementById('issueId').value = issue_id;
  document.getElementById('description').value = description;
  document.getElementById('email').value = email;
  document.getElementById('phone').value = phone;
  document.getElementById('status').value = status;
  document.getElementById('actionsTaken').value = action_taken;
  document.getElementById('editModal').style.display = 'block';

  // After setting values, apply validation requirements
  handleStatusChange();
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

// Validate actions taken text
function validateActionsTaken(input) {
  const minLength = 5;
  const maxLength = 500;
  const value = input.value.trim();

  // Only validate if the status is "Resolved" (value=1)
  const statusSelect = document.getElementById('status');
  if (statusSelect.value === '1') {
    if (value.length < minLength) {
      showError(
        input,
        `Actions taken must be at least ${minLength} characters when marking an issue as resolved`
      );
      return false;
    }
  }

  if (value.length > maxLength) {
    showError(input, `Actions taken cannot exceed ${maxLength} characters`);
    return false;
  }

  removeError(input);
  return true;
}

// Status change handler - require actions taken when status is "Resolved"
function handleStatusChange() {
  const statusSelect = document.getElementById('status');
  const actionsTaken = document.getElementById('actionsTaken');

  if (statusSelect && actionsTaken) {
    if (statusSelect.value === '1') {
      // If "Resolved"
      actionsTaken.setAttribute('required', 'required');
      const actionLabel = actionsTaken.previousElementSibling;
      if (actionLabel) {
        actionLabel.innerHTML =
          'Actions Taken: <span class="required">*</span>';
      }
    } else {
      actionsTaken.removeAttribute('required');
      const actionLabel = actionsTaken.previousElementSibling;
      if (actionLabel) {
        actionLabel.innerHTML = 'Actions Taken:';
      }
    }
  }
}

// Refresh search bar
document
  .querySelector('input[name="search"]')
  .addEventListener('input', function (e) {
    if (e.target.value.trim() === '') {
      window.location.href = window.location.pathname;
    }
  });

// Add form validation when the DOM is loaded
document.addEventListener('DOMContentLoaded', function () {
  // Set up validation for the edit issue form
  if (document.getElementById('editIssueForm')) {
    setupFormValidation('editIssueForm', {
      status: [{ type: 'required' }],
      actionsTaken: [
        {
          type: 'custom',
          validate: validateActionsTaken,
        },
      ],
    });
  }

  // Add event listener for status change to update requirements
  const statusSelect = document.getElementById('status');
  if (statusSelect) {
    statusSelect.addEventListener('change', handleStatusChange);
  }
});
