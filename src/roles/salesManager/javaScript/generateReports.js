// Initialize reports from localStorage
let reports = JSON.parse(localStorage.getItem('reports')) || [];

// Load existing reports into the table on page load
window.addEventListener('DOMContentLoaded', () => {
  loadReports();
});

// Function to load reports into the table
function loadReports() {
  const table = document.getElementById('reportTable').querySelector('tbody');
  table.innerHTML = ''; // Clear existing rows
  reports.forEach((report, index) => {
    const row = document.createElement('tr');
    row.innerHTML = `
      <td>${report.type}</td>
      <td>${report.dateRange}</td>
      <td>${report.metrics}</td>
      <td>
        <button class="action-btn" onclick="downloadReport(${index})">Download</button>
        <button class="action-btn secondary" onclick="deleteReport(${index})">Delete</button>
      </td>
    `;
    table.appendChild(row);
  });
}

// Handle report generation
document.getElementById('generateReport').addEventListener('click', () => {
  const type = document.getElementById('reportType').value;
  const startDate = document.getElementById('startDate').value;
  const endDate = document.getElementById('endDate').value;
  const metrics = document.getElementById('metrics').value;

  if (!type || !startDate || !endDate || !metrics) {
    alert('Please fill in all fields to generate a report.');
    return;
  }

  const newReport = {
    type,
    dateRange: `${startDate} to ${endDate}`,
    metrics,
  };

  reports.push(newReport); // Add to report list
  localStorage.setItem('reports', JSON.stringify(reports)); // Update localStorage
  loadReports(); // Reload the table
  resetForm(); // Clear form fields
});

// Reset form fields
function resetForm() {
  document.getElementById('reportType').value = '';
  document.getElementById('startDate').value = '';
  document.getElementById('endDate').value = '';
  document.getElementById('metrics').value = '';
}

// Delete report
function deleteReport(index) {
  reports.splice(index, 1); // Remove from reports
  localStorage.setItem('reports', JSON.stringify(reports)); // Update localStorage
  loadReports(); // Reload table
}

// Download report (dummy functionality)
function downloadReport(index) {
  const report = reports[index];
  alert(`Downloading report: ${report.type} (${report.dateRange})`);
}
