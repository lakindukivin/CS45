// Initialize ads from localStorage
let ads = JSON.parse(localStorage.getItem('ads')) || [];

// Load existing ads into the table on page load
window.addEventListener('DOMContentLoaded', () => {
  loadAds();
});

// Load ads into the table
function loadAds() {
  const table = document.getElementById('adTable').querySelector('tbody');
  table.innerHTML = ''; // Clear existing rows
  ads.forEach((ad, index) => {
    const row = document.createElement('tr');
    row.innerHTML = `
      <td>${ad.title}</td>
      <td>${ad.description}</td>
      <td>${ad.audience}</td>
      <td>${ad.settings}</td>
      <td>
        <button class="action-btn" onclick="previewAd(${index})">Preview</button>
        <button class="action-btn" onclick="editAd(${index})">Edit</button>
        <button class="action-btn" onclick="deleteAd(${index})">Delete</button>
      </td>
    `;
    table.appendChild(row);
  });
}

// Handle adding or editing an ad
document.getElementById('adFormContent').addEventListener('submit', (e) => {
  e.preventDefault();

  const title = document.getElementById('adTitle').value;
  const description = document.getElementById('adDescription').value;
  const audience = document.getElementById('adAudience').value;
  const settings = document.getElementById('adSettings').value;
  const fileInput = document.getElementById('adFile');

  if (!fileInput.files.length) {
    alert('Please upload a banner file.');
    return;
  }

  const reader = new FileReader();
  reader.onload = (e) => {
    const fileUrl = e.target.result;

    const ad = { title, description, audience, settings, fileUrl };

    const editingIndex = document.getElementById('adForm').dataset.editingIndex;

    if (editingIndex !== undefined) {
      ads[editingIndex] = ad; // Update existing ad
      delete document.getElementById('adForm').dataset.editingIndex; // Clear editing index
    } else {
      ads.push(ad); // Add new ad
    }

    localStorage.setItem('ads', JSON.stringify(ads)); // Save to localStorage
    loadAds(); // Reload ads in the table
    previewAd(ads.length - 1); // Preview the newly added/edited ad
    resetForm(); // Reset the form
  };

  reader.readAsDataURL(fileInput.files[0]); // Read the uploaded file
});

// Reset form fields
function resetForm() {
  document.getElementById('adFormContent').reset();
  delete document.getElementById('adForm').dataset.editingIndex;
}

// Edit an ad
function editAd(index) {
  const ad = ads[index];
  document.getElementById('adTitle').value = ad.title;
  document.getElementById('adDescription').value = ad.description;
  document.getElementById('adAudience').value = ad.audience;
  document.getElementById('adSettings').value = ad.settings;
  document.getElementById('adForm').dataset.editingIndex = index;
}

// Delete an ad
function deleteAd(index) {
  ads.splice(index, 1); // Remove the ad from the list
  localStorage.setItem('ads', JSON.stringify(ads)); // Update localStorage
  loadAds(); // Reload the table
}

// Preview an ad
function previewAd(index) {
  const ad = ads[index];
  const previewWindow = window.open('', '_blank');
  previewWindow.document.write(`
    <html>
      <head>
        <title>${ad.title}</title>
        <style>
          body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
          }
          img {
            max-width: 100%;
            height: auto;
          }
        </style>
      </head>
      <body>
        <h1>${ad.title}</h1>
        <p>${ad.description}</p>
        <p><strong>Target Audience:</strong> ${ad.audience}</p>
        <p><strong>Display Settings:</strong> ${ad.settings}</p>
        <img src="${ad.fileUrl}" alt="${ad.title}" />
      </body>
    </html>
  `);
}
