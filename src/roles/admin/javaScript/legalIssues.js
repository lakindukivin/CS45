 // Sample data for demonstration
let legalIssues = [
  {
    id: 'L001',
    description: 'GDPR compliance audit required',
    status: 'Pending',
    actions: '',
  },
  {
    id: 'L002',
    description: 'User dispute over data handling',
    status: 'Resolved',
    actions: 'Consulted legal team',
  },
];

// Load data into the table on page load
window.addEventListener('DOMContentLoaded', () => {
  loadLegalIssues();
});

// Function to load legal issues into the table
function loadLegalIssues() {
  const tableBody = document.querySelector('#legalIssuesTable tbody');
  tableBody.innerHTML = ''; // Clear existing rows

  legalIssues.forEach((issue, index) => {
    const row = document.createElement('tr');
    row.innerHTML = `
      <td>${issue.id}</td>
      <td>${issue.description}</td>
      <td>${issue.status}</td>
      <td>
        <button class="action-btn" onclick="editLegalIssue(${index})">Edit</button>
        <button class="action-btn" onclick="deleteLegalIssue(${index})">Delete</button>
      </td>
    `;
    tableBody.appendChild(row);
  });
}

// Handle form submission
document.getElementById('legalForm').addEventListener('submit', (e) => {
  e.preventDefault();

  const issueId =
    document.getElementById('issueId').value ||
    `L${String(legalIssues.length + 1).padStart(3, '0')}`;
  const description = document.getElementById('description').value;
  const status = document.getElementById('status').value;
  const actionsTaken = document.getElementById('actionsTaken').value;

  if (!description || !status) {
    alert('Please fill in all required fields.');
    return;
  }

  const editingIndex =
    document.getElementById('legalForm').dataset.editingIndex;
  if (editingIndex !== undefined) {
    legalIssues[editingIndex] = {
      id: issueId,
      description,
      status,
      actions: actionsTaken,
    };
    delete document.getElementById('legalForm').dataset.editingIndex;
  } else {
    legalIssues.push({
      id: issueId,
      description,
      status,
      actions: actionsTaken,
    });
  }

  loadLegalIssues(); // Reload the table
  resetForm(); // Reset the form
  showMessage('Legal issue saved successfully.', 'success');
});

// Function to reset the form
function resetForm() {
  document.getElementById('legalForm').reset();
  delete document.getElementById('legalForm').dataset.editingIndex;
}

// Function to edit a legal issue
function editLegalIssue(index) {
  const issue = legalIssues[index];
  document.getElementById('issueId').value = issue.id;
  document.getElementById('description').value = issue.description;
  document.getElementById('status').value = issue.status;
  document.getElementById('actionsTaken').value = issue.actions;
  document.getElementById('legalForm').dataset.editingIndex = index;
}

// Function to delete a legal issue
function deleteLegalIssue(index) {
  legalIssues.splice(index, 1); // Remove issue from the array
  loadLegalIssues(); // Reload the table
  showMessage('Legal issue deleted successfully.', 'success');
}

// Function to display messages
function showMessage(message, type) {
  const messageBox =
    document.getElementById('message') || document.createElement('div');
  messageBox.id = 'message';
  messageBox.textContent = message;
  messageBox.style.color = type === 'success' ? 'green' : 'red';
  document.getElementById('legal-issues-section').appendChild(messageBox);
  setTimeout(() => messageBox.remove(), 3000); // Remove after 3 seconds
}
