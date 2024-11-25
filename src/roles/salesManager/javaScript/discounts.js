// Initialize discounts from localStorage
let discounts = JSON.parse(localStorage.getItem('discounts')) || [];

// Load existing discounts into the table on page load
window.addEventListener('DOMContentLoaded', () => {
  loadDiscounts();
});

// Function to load discounts into the table
function loadDiscounts() {
  const table = document.getElementById('discountTable').querySelector('tbody');
  table.innerHTML = ''; // Clear existing rows
  discounts.forEach((discount, index) => {
    const row = document.createElement('tr');
    row.innerHTML = `
      <td>${discount.percentage}%</td>
      <td>${discount.startDate} to ${discount.endDate}</td>
      <td>
        <button class="action-btn" onclick="editDiscount(${index})">Edit</button>
        <button class="action-btn secondary" onclick="deleteDiscount(${index})">Delete</button>
      </td>
    `;
    table.appendChild(row);
  });
}

// Add new discount or update an existing discount
document
  .getElementById('discountFormContent')
  .addEventListener('submit', (e) => {
    e.preventDefault();

    const percentage = document.getElementById('discountPercentage').value;
    const startDate = document.getElementById('startDate').value;
    const endDate = document.getElementById('endDate').value;

    if (!percentage || !startDate || !endDate) {
      alert('Please fill in all fields.');
      return;
    }

    const newDiscount = { percentage, startDate, endDate };
    const editingIndex =
      document.getElementById('discountForm').dataset.editingIndex;

    if (editingIndex !== undefined) {
      discounts[editingIndex] = newDiscount; // Update existing discount
      delete document.getElementById('discountForm').dataset.editingIndex; // Reset editing state
    } else {
      discounts.push(newDiscount); // Add new discount
    }

    localStorage.setItem('discounts', JSON.stringify(discounts)); // Update localStorage
    loadDiscounts(); // Reload the table
    resetForm(); // Reset form fields
  });

// Reset form fields
function resetForm() {
  document.getElementById('discountFormContent').reset();
  delete document.getElementById('discountForm').dataset.editingIndex;
}

// Edit discount
function editDiscount(index) {
  const discount = discounts[index];
  document.getElementById('discountPercentage').value = discount.percentage;
  document.getElementById('startDate').value = discount.startDate;
  document.getElementById('endDate').value = discount.endDate;
  document.getElementById('discountForm').dataset.editingIndex = index; // Set editing state
}

// Delete discount
function deleteDiscount(index) {
  discounts.splice(index, 1); // Remove discount from the list
  localStorage.setItem('discounts', JSON.stringify(discounts)); // Update localStorage
  loadDiscounts(); // Reload table
}
