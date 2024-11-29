// Sample data for demonstration
let carbonData = [{ metric: 'Polythene Waste', value: 50, unit: 'kg' }];

// Load data into the table on page load
window.addEventListener('DOMContentLoaded', () => {
  loadCarbonData();
});

// Function to load carbon footprint data
function loadCarbonData() {
  const tableBody = document.querySelector('#carbonFootprintTable tbody');
  tableBody.innerHTML = ''; // Clear existing rows

  carbonData.forEach((data, index) => {
    const row = document.createElement('tr');
    row.innerHTML = `
       
      <td>${data.value}</td>
      <td>${data.unit}</td>
      <td>
        <button class="action-btn" onclick="editData(${index})">Edit</button>
        <button class="action-btn" onclick="deleteData(${index})">Delete</button>
      </td>
    `;
    tableBody.appendChild(row);
  });
}

// Function to handle form submission
document.getElementById('updateForm').addEventListener('submit', (e) => {
  e.preventDefault();

  const value = parseFloat(document.getElementById('value').value);
  const unit = document.getElementById('unit').value;

  if (isNaN(value) || value <= 0) {
    showMessage(
      'Invalid input! Please enter a valid number for value.',
      'error'
    );
    return;
  }

  const editingIndex =
    document.getElementById('updateForm').dataset.editingIndex;
  if (editingIndex !== undefined) {
    carbonData[editingIndex] = { value, unit }; // Update existing data
    delete document.getElementById('updateForm').dataset.editingIndex;
  } else {
    carbonData.push({ value, unit }); // Add new data
  }

  loadCarbonData(); // Reload the table
  showMessage('Carbon footprint data updated successfully.', 'success');
  resetForm(); // Reset the form
});

// Function to reset the form
function resetForm() {
  document.getElementById('updateForm').reset();
  delete document.getElementById('updateForm').dataset.editingIndex;
}

// Function to edit existing data
function editData(index) {
  const data = carbonData[index];

  document.getElementById('value').value = data.value;
  document.getElementById('unit').value = data.unit;
  document.getElementById('updateForm').dataset.editingIndex = index;
}

// Function to delete data
function deleteData(index) {
  carbonData.splice(index, 1); // Remove data from array
  loadCarbonData(); // Reload the table
  showMessage('Carbon footprint data deleted successfully.', 'success');
}

// Function to show messages
function showMessage(message, type) {
  const messageBox =
    document.getElementById('message') || document.createElement('div');
  messageBox.id = 'message';
  messageBox.textContent = message;
  messageBox.style.color = type === 'success' ? 'green' : 'red';
  document.getElementById('carbon-footprint-section').appendChild(messageBox);
  setTimeout(() => messageBox.remove(), 3000); // Remove after 3 seconds
}
