function viewDetails(orderId) {
  const modal = document.getElementById('detailsModal');
  const detailsDiv = document.getElementById('orderDetails');
  
  fetch(`${ROOT}/PendingCustomOrder/getOrderDetails`, {
      method: 'POST',
      headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: `orderId=${orderId}`
  })
  .then(response => response.json())
  .then(data => {
      detailsDiv.innerHTML = `
          <div class="order-details">
              <p><strong>Order ID:</strong> ${data.customOrder_id}</p>
              <p><strong>Customer:</strong> ${data.customer_name}</p>
              <p><strong>Company:</strong> ${data.Company_name}</p>
              <p><strong>Quantity:</strong> ${data.Quantity}</p>
              <p><strong>Type:</strong> ${data.Type}</p>
              <p><strong>Status:</strong> ${data.customOrder_status}</p>
          </div>
      `;
      modal.style.display = "block";
  })
  .catch(error => console.error('Error:', error));
}


function updateStatus(orderId) {
  const modal = document.getElementById('statusModal');
  modal.style.display = "block";
  
  const form = document.getElementById('statusForm');
  form.onsubmit = function(e) {
      e.preventDefault();
      const status = form.querySelector('select[name="status"]').value;
      
      fetch('/PendingCustomOrder/updateStatus', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: `orderId=${orderId}&status=${status}`
      })
      .then(response => response.json())
      .then(data => {
          if(data.success) {
              closeModal();
              window.location.reload();
          }
      });
  };
}

function closeModal() {
  document.getElementById('statusModal').style.display = "none";
}

function closeDetailsModal() {
  document.getElementById('detailsModal').style.display = "none";
}
