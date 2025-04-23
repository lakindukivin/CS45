document.addEventListener('DOMContentLoaded', function () {
  // Fetch and display carbon footprint data
  fetchCarbonFootprintData();
});

function fetchCarbonFootprintData() {
  fetch('<?= ROOT ?>/carbonFootprint/getData')
    .then((response) => response.json())
    .then((data) => {
      if (data) {
        updateTable(data);
      } else {
        console.log('No data available');
      }
    })
    .catch((error) => console.error('Error fetching data:', error));
}

function updateTable(data) {
  const tableBody = document.querySelector('#carbonFootprintTable tbody');
  tableBody.innerHTML = ''; // Clear existing rows

  const row = document.createElement('tr');
  const valueCell = document.createElement('td');
  const unitCell = document.createElement('td');
  const dateCell = document.createElement('td');

  valueCell.textContent = data.value;
  unitCell.textContent = data.unit;
  dateCell.textContent = new Date(data.date).toLocaleDateString();

  row.appendChild(valueCell);
  row.appendChild(unitCell);
  row.appendChild(dateCell);

  tableBody.appendChild(row);
}
//refresh searchbar
document
  .querySelector('input[name="search"]')
  .addEventListener('input', function (e) {
    if (e.target.value.trim() === '') {
      window.location.href = window.location.pathname;
    }
  });
