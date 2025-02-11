function viewRequest(id) {
  fetch(`<?= ROOT ?>/GiveAwayRequest/view/${id}`, {
      headers: {
          'Accept': 'application/json'
      }
  })
  .then(response => {
      if (!response.ok) {
          throw new Error('Network response was not ok');
      }
      return response.json();
  })
  .then(data => {
      document.getElementById('requestDetails').innerHTML = `
          <p><strong>Customer:</strong> ${data.customer_name}</p>
          <p><strong>Type:</strong> ${data.Type}</p>
          <p><strong>Address:</strong> ${data.Address}</p>
          <p><strong>Quantity:</strong> ${data.quantity}</p>
      `;
      document.getElementById('viewModal').style.display = 'block';
  })
  .catch(error => console.error('Error:', error));
}

function editRequest(id) {
  fetch(`<?= ROOT ?>/GiveAwayRequest/view/${id}`)
      .then(response => response.json())
      .then(data => {
          document.getElementById('editId').value = data.Giveaway_id;
          document.getElementById('editType').value = data.Type;
          document.getElementById('editAddress').value = data.Address;
          document.getElementById('editQuantity').value = data.quantity;
          document.getElementById('editModal').style.display = 'block';
      });
}

document.getElementById('editForm').addEventListener('submit', function(e) {
  e.preventDefault();
  const formData = new FormData(this);
  
  fetch('<?= ROOT ?>/GiveAwayRequest/update', {
      method: 'POST',
      body: formData
  })
  .then(response => response.json())
  .then(data => {
      if (data.success) {
          location.reload();
      }
  });
});

// Close modal functionality
document.querySelectorAll('.close').forEach(closeBtn => {
  closeBtn.onclick = function() {
      this.closest('.modal').style.display = 'none';
  }
});