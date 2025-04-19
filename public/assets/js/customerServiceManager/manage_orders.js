document.addEventListener('DOMContentLoaded', function() {
  // Tab functionality
  const tabs = document.querySelectorAll('.status-tab');
  const tabContents = document.querySelectorAll('.tab-content');
  
  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      const status = tab.getAttribute('data-status');
      
      // Remove active class from all tabs and contents
      tabs.forEach(t => t.classList.remove('active'));
      tabContents.forEach(c => c.classList.remove('active'));
      
      // Add active class to clicked tab and corresponding content
      tab.classList.add('active');
      document.getElementById(`${status}-orders`).classList.add('active');
    });
  });
  
  // Modal functionality
  const modal = document.getElementById('orderDetailsModal');
  const viewButtons = document.querySelectorAll('.view-btn');
  const closeBtn = document.querySelector('.modal .close');
  const updateStatusBtn = document.querySelector('.update-status');
  
  viewButtons.forEach(btn => {
    btn.addEventListener('click', function() {
      // Get order data from the row
      const row = this.closest('tr');
      const orderData = JSON.parse(row.getAttribute('data-order'));
      
      // Populate modal
      document.getElementById('modal-order-id').textContent = orderData.order_id;
      document.getElementById('modal-customer').textContent = orderData.customerName;
      document.getElementById('modal-product').textContent = orderData.productName;
      document.getElementById('modal-quantity').textContent = orderData.quantity;
      document.getElementById('modal-total').textContent = 'Rs. ' + parseFloat(orderData.total).toFixed(2);
      document.getElementById('modal-date').textContent = formatDate(orderData.orderDate);
      document.getElementById('modal-delivery').textContent = orderData.delivery_address || 'Not available';
      
      // Add appropriate class to status badge
      const statusElem = document.getElementById('modal-status');
      statusElem.textContent = orderData.status.charAt(0).toUpperCase() + orderData.status.slice(1);
      statusElem.className = 'value status-badge ' + orderData.status;
      
      // Save order ID for update
      updateStatusBtn.setAttribute('data-id', orderData.order_id);
      
      // Show modal
      modal.style.display = 'flex';
    });
  });
  
  // Status update functionality
  updateStatusBtn.addEventListener('click', function() {
    const orderId = this.getAttribute('data-id');
    
    // Create and populate the status update form
    const updateForm = document.createElement('form');
    updateForm.method = 'POST';
    updateForm.action = '<?=ROOT?>/CompletedOrders/updateOrderStatus';
    
    // Hidden order ID field
    const orderIdField = document.createElement('input');
    orderIdField.type = 'hidden';
    orderIdField.name = 'order_id';
    orderIdField.value = orderId;
    
    // Status select dropdown
    const statusField = document.createElement('div');
    statusField.style.marginBottom = '15px';
    statusField.innerHTML = `
      <label for="status">Update Status:</label>
      <select name="status" id="status" style="width: 100%; padding: 8px; margin-top: 5px; border-radius: 4px; border: 1px solid #dee2e6;">
        <option value="processing">Processing</option>
        <option value="shipped">Shipped</option>
        <option value="delivered">Delivered</option>
      </select>
    `;
    
    // Message field
    const messageField = document.createElement('div');
    messageField.style.marginBottom = '15px';
    messageField.innerHTML = `
      <label for="message_to_customer">Message to Customer:</label>
      <textarea name="message_to_customer" id="message_to_customer" rows="3" 
              style="width: 100%; padding: 8px; margin-top: 5px; border-radius: 4px; border: 1px solid #dee2e6;"></textarea>
    `;
    
    // Submit button
    const submitBtn = document.createElement('button');
    submitBtn.type = 'submit';
    submitBtn.textContent = 'Update Status';
    submitBtn.style.cssText = `
      background-color: var(--secondary-green);
      color: white;
      padding: 10px 16px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      float: right;
    `;
    
    // Add elements to form
    updateForm.appendChild(orderIdField);
    updateForm.appendChild(statusField);
    updateForm.appendChild(messageField);
    updateForm.appendChild(submitBtn);
    
    // Clear the modal content and add the form
    const modalContent = document.querySelector('.order-details');
    modalContent.innerHTML = '';
    modalContent.appendChild(updateForm);
  });
  
  // Close modal when clicking X or outside
  closeBtn.addEventListener('click', () => {
    modal.style.display = 'none';
  });
  
  window.addEventListener('click', (e) => {
    if (e.target === modal) {
      modal.style.display = 'none';
    }
  });
  
  // Helper function to format date
  function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toISOString().split('T')[0];
  }
});

document.addEventListener('DOMContentLoaded', function () {
  const updateStatusPopup = document.getElementById('statusUpdatePopup');
  const closePopupBtn = document.getElementById('closeStatusPopup');
  const cancelUpdateBtn = document.getElementById('cancelStatusUpdate');
  const updateButtons = document.querySelectorAll('.view-btn'); // Buttons to open the popup
  const popupOrderIdField = document.getElementById('popup-order-id');
  const popupStatusField = document.getElementById('status');
  const popupMessageField = document.getElementById('message_to_customer');

  // Open the popup and populate fields
  updateButtons.forEach((button) => {
    button.addEventListener('click', function () {
      const orderData = JSON.parse(this.closest('tr').getAttribute('data-order'));

      // Populate the popup fields
      popupOrderIdField.value = orderData.order_id;
      popupStatusField.value = orderData.status || 'processing'; // Default to 'processing' if no status
      popupMessageField.value = '';

      // Show the popup
      updateStatusPopup.style.display = 'flex';
    });
  });

  // Close the popup when clicking the close button or cancel button
  closePopupBtn.addEventListener('click', () => {
    updateStatusPopup.style.display = 'none';
  });

  if (cancelUpdateBtn) {
    cancelUpdateBtn.addEventListener('click', () => {
      updateStatusPopup.style.display = 'none';
    });
  }

  // Close the popup when clicking outside the modal content
  window.addEventListener('click', (e) => {
    if (e.target === updateStatusPopup) {
      updateStatusPopup.style.display = 'none';
    }
  });
});

document.addEventListener('DOMContentLoaded', function () {
  const updateStatusPopup = document.getElementById('statusUpdatePopup');
  const closePopupBtn = document.getElementById('closeStatusPopup');
  const cancelUpdateBtn = document.getElementById('cancelStatusUpdate');
  const updateButtons = document.querySelectorAll('.view-btn'); // Buttons to open the popup
  const popupOrderIdField = document.getElementById('popup-order-id');
  const popupStatusField = document.getElementById('status');
  const popupMessageField = document.getElementById('message_to_customer');
  const updateStatusForm = document.getElementById('updateStatusForm');

  // Open the popup and populate fields
  updateButtons.forEach((button) => {
    button.addEventListener('click', function () {
      const orderData = JSON.parse(this.closest('tr').getAttribute('data-order'));

      // Populate the popup fields
      popupOrderIdField.value = orderData.order_id;
      popupStatusField.value = orderData.status || 'processing'; // Default to 'processing' if no status
      popupMessageField.value = '';

      // Show the popup
      updateStatusPopup.style.display = 'flex';
    });
  });

  // Close the popup when clicking the close button or cancel button
  closePopupBtn.addEventListener('click', () => {
    updateStatusPopup.style.display = 'none';
  });

  if (cancelUpdateBtn) {
    cancelUpdateBtn.addEventListener('click', () => {
      updateStatusPopup.style.display = 'none';
    });
  }

  // Close the popup when clicking outside the modal content
  window.addEventListener('click', (e) => {
    if (e.target === updateStatusPopup) {
      updateStatusPopup.style.display = 'none';
    }
  });

  // Handle form submission
  updateStatusForm.addEventListener('submit', function (e) {
    e.preventDefault();

    const orderId = popupOrderIdField.value;
    const status = popupStatusField.value;
    const messageToCustomer = popupMessageField.value;

    // Send the update request via AJAX
    fetch('<?=ROOT?>/CompletedOrders/updateOrderStatus', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        order_id: orderId,
        status: status,
        message_to_customer: messageToCustomer,
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          // Move the order to the relevant section
          const orderRow = document.querySelector(`tr[data-order*='"order_id":${orderId}']`);
          if (orderRow) {
            const newSection = document.getElementById(`${status}-orders`).querySelector('tbody');
            newSection.appendChild(orderRow);
          }

          // Close the popup
          updateStatusPopup.style.display = 'none';
        } else {
          alert('Failed to update the order status.');
        }
      })
      .catch((error) => {
        console.error('Error:', error);
        alert('An error occurred while updating the order status.');
      });
  });
});

document.addEventListener('DOMContentLoaded', function () {
// Order Details Modal
const orderDetailsModal = document.getElementById('orderDetailsModal');
const closeOrderDetailsBtn = document.querySelector('.modal .close');
const viewButtons = document.querySelectorAll('.view-btn'); // Buttons to open the Order Details Modal

// Order Status Update Popup
const updateStatusPopup = document.getElementById('statusUpdatePopup');
const closeStatusPopupBtn = document.getElementById('closeStatusPopup');
const cancelUpdateBtn = document.getElementById('cancelStatusUpdate');
const updateStatusButtons = document.querySelectorAll('.update-status'); // Buttons to open the Order Status Update Popup
const popupOrderIdField = document.getElementById('popup-order-id');
const popupStatusField = document.getElementById('status');
const popupMessageField = document.getElementById('message_to_customer');
const updateStatusForm = document.getElementById('updateStatusForm');

// Open the Order Details Modal
viewButtons.forEach((btn) => {
btn.addEventListener('click', function () {
  // Get order data from the row
  const row = this.closest('tr');
  const orderData = JSON.parse(row.getAttribute('data-order'));

  // Populate the modal fields
  document.getElementById('modal-order-id').textContent = orderData.order_id;
  document.getElementById('modal-customer').textContent = orderData.customerName;
  document.getElementById('modal-product').textContent = orderData.productName;
  document.getElementById('modal-quantity').textContent = orderData.quantity;
  document.getElementById('modal-total').textContent = 'Rs. ' + parseFloat(orderData.total).toFixed(2);
  document.getElementById('modal-date').textContent = formatDate(orderData.orderDate);
  document.getElementById('modal-delivery').textContent = orderData.deliveryAddress || 'Not available';

  // Add appropriate class to status badge
  const statusElem = document.getElementById('modal-status');
  statusElem.textContent = orderData.status.charAt(0).toUpperCase() + orderData.status.slice(1);
  statusElem.className = 'value status-badge ' + orderData.status;

  // Show the modal
  orderDetailsModal.style.display = 'flex';
});
});

// Close the Order Details Modal
closeOrderDetailsBtn.addEventListener('click', () => {
orderDetailsModal.style.display = 'none';
});

// Close the modal when clicking outside the content
window.addEventListener('click', (e) => {
if (e.target === orderDetailsModal) {
  orderDetailsModal.style.display = 'none';
}
});

// Open the Order Status Update Popup
updateStatusButtons.forEach((btn) => {
btn.addEventListener('click', function () {
  const orderId = this.getAttribute('data-id');

  // Populate the popup fields
  popupOrderIdField.value = orderId;
  popupStatusField.value = 'processing'; // Default status
  popupMessageField.value = '';

  // Show the popup
  updateStatusPopup.style.display = 'flex';
});
});

// Close the Order Status Update Popup
closeStatusPopupBtn.addEventListener('click', () => {
updateStatusPopup.style.display = 'none';
});

if (cancelUpdateBtn) {
cancelUpdateBtn.addEventListener('click', () => {
  updateStatusPopup.style.display = 'none';
});
}

// Close the popup when clicking outside the content
window.addEventListener('click', (e) => {
if (e.target === updateStatusPopup) {
  updateStatusPopup.style.display = 'none';
}
});

// Handle form submission for updating status
updateStatusForm.addEventListener('submit', function (e) {
e.preventDefault();

const orderId = popupOrderIdField.value;
const status = popupStatusField.value;
const messageToCustomer = popupMessageField.value;

// Send the update request via AJAX
fetch('<?=ROOT?>/CompletedOrders/updateOrderStatus', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
  },
  body: JSON.stringify({
    order_id: orderId,
    status: status,
    message_to_customer: messageToCustomer,
  }),
})
  .then((response) => response.json())
  .then((data) => {
    if (data.success) {
      // Move the order to the relevant section
      const orderRow = document.querySelector(`tr[data-order*='"order_id":${orderId}']`);
      if (orderRow) {
        const newSection = document.getElementById(`${status}-orders`).querySelector('tbody');
        newSection.appendChild(orderRow);
      }

      // Close the popup
      updateStatusPopup.style.display = 'none';
    } else {
      alert('Failed to update the order status.');
    }
  })
  .catch((error) => {
    console.error('Error:', error);
    alert('An error occurred while updating the order status.');
  });
});

// Helper function to format date
function formatDate(dateString) {
const date = new Date(dateString);
return date.toISOString().split('T')[0];
}
});
