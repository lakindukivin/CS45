// Load data into the table on page load
window.addEventListener('DOMContentLoaded', () => {
  loadLegalIssues();
});

// Function to load legal issues into the table
function loadLegalIssues() {
  fetch('<?= ROOT ?>/legalIssues/getIssues') // Fetch issues from the backend
    .then((response) => response.json())
    .then((data) => {
      const tableBody = document.querySelector('#legalIssuesTable tbody');
      tableBody.innerHTML = ''; // Clear existing rows

      data.forEach((issue) => {
        const row = document.createElement('tr');
        row.innerHTML = `
          <td>${issue.issue_id}</td>
          <td>${issue.description}</td>
          <td>${issue.status}</td>
          <td>
            <button class="action-btn" onclick="editLegalIssue('${issue.issue_id}')">Edit</button>
            <button class="action-btn" onclick="deleteLegalIssue('${issue.issue_id}')">Delete</button>
          </td>
        `;
        tableBody.appendChild(row);
      });
    })
    .catch((error) => {
      console.error('Error fetching legal issues:', error);
      showMessage('Failed to load legal issues.', 'error');
    });
}

// Handle form submission
document.getElementById('legalForm').addEventListener('submit', (e) => {
  e.preventDefault();

  const issueId = document.getElementById('issueId').value;
  const description = document.getElementById('description').value;
  const status = document.getElementById('status').value;
  const actionsTaken = document.getElementById('actionsTaken').value;

  if (!description || !status) {
    alert('Please fill in all required fields.');
    return;
  }

  const formData = new FormData();
  formData.append('issue_id', issueId);
  formData.append('description', description);
  formData.append('status', status);
  formData.append('actions_taken', actionsTaken);

  const url = issueId
    ? `<?= ROOT ?>/legalIssues/updateIssue/${issueId}`
    : '<?= ROOT ?>/legalIssues/createIssue';

  fetch(url, {
    method: issueId ? 'PUT' : 'POST',
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        loadLegalIssues(); // Reload the table
        resetForm(); // Reset the form
        showMessage(data.message, 'success');
      } else {
        showMessage(data.message, 'error');
      }
    })
    .catch((error) => {
      console.error('Error saving legal issue:', error);
      showMessage('Failed to save legal issue.', 'error');
    });
});

// Function to reset the form
function resetForm() {
  document.getElementById('legalForm').reset();
  document.getElementById('issueId').value = '';
  delete document.getElementById('legalForm').dataset.editingIndex;
}

// Function to edit a legal issue
function editLegalIssue(issueId) {
  fetch(`<?= ROOT ?>/legalIssues/getIssue/${issueId}`)
    .then((response) => response.json())
    .then((issue) => {
      document.getElementById('issueId').value = issue.issue_id;
      document.getElementById('description').value = issue.description;
      document.getElementById('status').value = issue.status;
      document.getElementById('actionsTaken').value = issue.actions_taken;
      document.getElementById('legalForm').dataset.editingIndex =
        issue.issue_id;
    })
    .catch((error) => {
      console.error('Error fetching legal issue:', error);
      showMessage('Failed to fetch legal issue details.', 'error');
    });
}

// Function to delete a legal issue
function deleteLegalIssue(issueId) {
  if (confirm('Are you sure you want to delete this issue?')) {
    fetch(`<?= ROOT ?>/legalIssues/deleteIssue/${issueId}`, {
      method: 'DELETE',
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          loadLegalIssues(); // Reload the table
          showMessage(data.message, 'success');
        } else {
          showMessage(data.message, 'error');
        }
      })
      .catch((error) => {
        console.error('Error deleting legal issue:', error);
        showMessage('Failed to delete legal issue.', 'error');
      });
  }
}

// Function to display messages
function showMessage(message, type) {
  const messageBox =
    document.getElementById('message') || document.createElement('div');
  messageBox.id = 'message';
  messageBox.textContent = message;
  messageBox.style.color = type === 'success' ? 'green' : 'red';
  document.getElementById('legal-issues-overview').appendChild(messageBox);
  setTimeout(() => messageBox.remove(), 3000); // Remove after 3 seconds
}
