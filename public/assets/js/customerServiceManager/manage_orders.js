function openManageOrderUpdatePopup(order) {
  // Populate the popup fields with the order details
  document.getElementById('order_id').value = order.order_id || '';
  document.getElementById('productName').value = order.productName || '';
  document.getElementById('customerName').value = order.customerName || '';
  document.getElementById('quantity').value = order.quantity || '';
  document.getElementById('total').value = order.total || '';
  document.getElementById('deliveryAddress').value = order.deliveryAddress || '';
  document.getElementById('billingAddress').value = order.billingAddress || '';
  document.getElementById('orderDate').value = order.orderDate || '';
  document.getElementById('orderStatus').value = order.orderStatus || '';

  // Display the popup
  document.getElementById('manageOrderUpdatePopup').style.display = 'flex';

  // Add event listener to close the popup
  document.getElementById('closePopupBtn').addEventListener('click', () => {
    document.getElementById('manageOrderUpdatePopup').style.display = 'none';
  });
}

document.addEventListener('DOMContentLoaded', function () {
  // Tab functionality
  const tabs = document.querySelectorAll('.status-tab');
  const tabContents = document.querySelectorAll('.tab-content');

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      const status = tab.getAttribute('data-status');

      tabs.forEach(t => t.classList.remove('active'));
      tabContents.forEach(c => c.classList.remove('active'));

      tab.classList.add('active');
      document.getElementById(`${status}-orders`).classList.add('active');
    });
  });

  // Modal functionality
  const modal = document.getElementById('orderDetailsModal');
  const viewButtons = document.querySelectorAll('.view-btn');
  const closeBtn = document.querySelector('.modal .close');

  viewButtons.forEach(btn => {
    btn.addEventListener('click', function () {
      const row = this.closest('tr');
      const orderData = JSON.parse(row.getAttribute('data-order'));

      document.getElementById('modal-order-id').textContent = orderData.order_id;
      document.getElementById('modal-customer').textContent = orderData.customerName;
      document.getElementById('modal-product').textContent = orderData.productName;
      document.getElementById('modal-quantity').textContent = orderData.quantity;
      document.getElementById('modal-total').textContent = 'Rs. ' + parseFloat(orderData.total).toFixed(2);
      document.getElementById('modal-date').textContent = formatDate(orderData.orderDate);
      document.getElementById('modal-delivery').textContent = orderData.deliveryAddress || 'Not available';

      const statusElem = document.getElementById('modal-status');
      statusElem.textContent = orderData.status.charAt(0).toUpperCase() + orderData.status.slice(1);
      statusElem.className = 'value status-badge ' + orderData.status;

      modal.style.display = 'flex';
    });
  });

  closeBtn.addEventListener('click', () => {
    modal.style.display = 'none';
  });

  window.addEventListener('click', (e) => {
    if (e.target === modal) {
      modal.style.display = 'none';
    }
  });

  // Status Update Popup
  const updateStatusPopup = document.getElementById('statusUpdatePopup');
  const closeStatusPopupBtn = document.getElementById('closeStatusPopup');
  const cancelUpdateBtn = document.getElementById('cancelStatusUpdate');
  const updateStatusButtons = document.querySelectorAll('.update-status');
  const popupOrderIdField = document.getElementById('popup-order-id');
  const popupStatusField = document.getElementById('status');
  const popupMessageField = document.getElementById('message_to_customer');
  const updateStatusForm = document.getElementById('updateStatusForm');

  // Fix the update status button click event
  document.addEventListener('click', function(event) {
    if (event.target && event.target.classList.contains('update-status')) {
      const orderId = event.target.getAttribute('data-id');
      if (!orderId) return; // Skip if no order ID
      
      console.log('Update button clicked for order:', orderId);
      
      const row = document.querySelector(`tr[data-order*='"order_id":${orderId}']`);
      
      if (row) {
        try {
          const orderData = JSON.parse(row.getAttribute('data-order'));
          const currentStatus = orderData.status;
          
          console.log('Current status:', currentStatus);
          
          // Determine the next valid status based on current status
          const nextStatusMap = {
            'accepted': 'processing',
            'processing': 'shipped',
            'shipped': 'delivered'
          };
          
          const nextStatus = nextStatusMap[currentStatus];
          console.log('Next status would be:', nextStatus);
          
          // Only show the popup if there's a valid next status
          if (nextStatus) {
            if (popupOrderIdField) {
              popupOrderIdField.value = orderId;
              console.log('Set order ID field to:', orderId);
            }
            
            // Set the correct next status in dropdown
            if (popupStatusField) {
              // Remove all options first
              while (popupStatusField.firstChild) {
                popupStatusField.removeChild(popupStatusField.firstChild);
              }
              
              // Add only the next valid status option
              const option = document.createElement('option');
              option.value = nextStatus;
              option.textContent = nextStatus.charAt(0).toUpperCase() + nextStatus.slice(1);
              popupStatusField.appendChild(option);
              console.log('Set status dropdown to:', nextStatus);
            }
            
            if (updateStatusPopup) {
              updateStatusPopup.style.display = 'block';
              console.log('Showing popup');
            }
          } else {
            alert('This order has reached its final status and cannot be updated further.');
          }
        } catch (e) {
          console.error('Error parsing order data:', e);
        }
      } else {
        console.log('Row not found for order ID:', orderId);
        if (popupOrderIdField) popupOrderIdField.value = orderId;
        if (updateStatusPopup) updateStatusPopup.style.display = 'block';
      }
    }
  });

  if (closeStatusPopupBtn) {
    closeStatusPopupBtn.addEventListener('click', () => {
      updateStatusPopup.style.display = 'none';
    });
  }

  if (cancelUpdateBtn) {
    cancelUpdateBtn.addEventListener('click', () => {
      updateStatusPopup.style.display = 'none';
    });
  }

  window.addEventListener('click', (e) => {
    if (e.target === updateStatusPopup) {
      updateStatusPopup.style.display = 'none';
    }
  });

  if (updateStatusForm) {
    updateStatusForm.addEventListener('submit', function (e) {
      e.preventDefault();

      const orderId = popupOrderIdField.value;
      const status = popupStatusField.value;
      const messageToCustomer = popupMessageField.value;

      console.log('Submitting form with data:', {
        order_id: orderId,
        status: status,
        message_to_customer: messageToCustomer
      });

      // First hide any existing modals to prevent overlap
      if (updateStatusPopup) {
        updateStatusPopup.style.display = 'none';
      }
      if (document.getElementById('orderDetailsModal')) {
        document.getElementById('orderDetailsModal').style.display = 'none';
      }
      
      // Show loading indicator or overlay if needed
      if (document.getElementById('modalOverlay')) {
        document.getElementById('modalOverlay').style.display = 'block';
      }

      fetch(`${ROOT}/CompletedOrders/updateOrderStatus`, {
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
        .then((response) => {
          console.log('Response status:', response.status);
          if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
          return response.json();
        })
        .then((data) => {
          console.log('Response data from server:', data);
          
          if (data && data.success === true) {  // Explicitly check for true
            // Show success message and redirect after delay
            console.log('Success detected, showing success message');
            if (window.showMessage) {
              window.showMessage('success', `Order successfully updated to ${status}!`, true);
            } else {
              // Fallback if window.showMessage is not available
              alert(`Order successfully updated to ${status}!`);
              window.location.reload();
            }
          } else {
            // Show error message
            console.log('Error detected, showing error message:', data.message);
            if (window.showMessage) {
              window.showMessage('error', data.message || 'Failed to update the order status.');
            } else {
              alert(data.message || 'Failed to update the order status.');
            }
            
            // Hide overlay if error
            if (document.getElementById('modalOverlay')) {
              document.getElementById('modalOverlay').style.display = 'none';
            }
          }
        })
        .catch((error) => {
          console.error('Error:', error);
          
          // Show error message
          if (window.showMessage) {
            window.showMessage('error', 'An error occurred while updating the order status.');
          } else {
            alert('An error occurred while updating the order status.');
          }
          
          // Hide overlay if error
          if (document.getElementById('modalOverlay')) {
            document.getElementById('modalOverlay').style.display = 'none';
          }
        });
    });
  }

  // New functions to handle order update UI changes and message display
  function updateOrderDisplay(orderId, newStatus) {
    const orderRow = document.querySelector(`tr[data-order*='"order_id":${orderId}']`);
    if (orderRow) {
      // Update the order data attribute
      const orderData = JSON.parse(orderRow.getAttribute('data-order'));
      orderData.status = newStatus;
      orderRow.setAttribute('data-order', JSON.stringify(orderData));
      
      // Update status badge text and class
      const statusBadge = orderRow.querySelector('.status-badge');
      statusBadge.textContent = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);
      statusBadge.className = `status-badge ${newStatus}`;
      
      // Move the row to the appropriate tab
      const newSection = document.getElementById(`${newStatus}-orders`).querySelector('tbody');
      if (newSection) {
        newSection.appendChild(orderRow);
      }
    }
  }

  function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toISOString().split('T')[0];
  }
  
  // Add the message display function to window scope for global access
  window.showMessage = function(type, text, redirect = false) {
    const message = type === 'success' ? 
                    document.getElementById('successMessage') : 
                    document.getElementById('errorMessage');
    
    const overlay = document.getElementById('modalOverlay');
    
    if (message) {
      if (text) {
        message.textContent = text;
      }
      
      // Show overlay for better visibility
      if (overlay) overlay.style.display = 'block';
      
      message.style.display = 'block';
      message.classList.add('show');
      
      // Remove the message after delay
      setTimeout(() => {
        message.style.display = 'none';
        message.classList.remove('show');
        
        // Hide overlay
        if (overlay) overlay.style.display = 'none';
        
        // Redirect if specified (to refresh the page)
        if (redirect) {
          window.location.href = window.location.pathname;
        }
      }, 2000); // Slightly shorter delay before redirect
    }
  };
  
  // Handle view button click for order details modal
  const updateStatusBtn = document.getElementById('updateStatusBtn');
  
  viewButtons.forEach(btn => {
    btn.addEventListener('click', function() {
      const orderId = this.getAttribute('data-id');
      const row = this.closest('tr');
      const orderData = JSON.parse(row.getAttribute('data-order'));
      
      console.log('Order data from view button:', orderData);
      console.log('Order ID:', orderId);
      
      // Show update button only for orders that can be updated
      if (['accepted', 'processing', 'shipped'].includes(orderData.status)) {
        updateStatusBtn.style.display = 'block';
        updateStatusBtn.setAttribute('data-id', orderData.order_id);
        console.log('Update button visible and set with ID:', orderData.order_id);
      } else {
        updateStatusBtn.style.display = 'none';
        console.log('Update button hidden for status:', orderData.status);
      }
    });
  });
  
  // Check for URL parameters on page load
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.get('success') === '1') {
    window.showMessage('success');
  } else if (urlParams.get('error') === '1') {
    window.showMessage('error');
  }
});

// Add this function at the beginning or replace the existing one
function showMessage(type, customText) {
  const message = type === 'success' ? document.getElementById('successMessage') : document.getElementById('errorMessage');
  console.log("Show message called:", type, customText, message);

  if (message) {
    // Set custom message text if provided
    const messageTextElement = message.querySelector('.message-text');
    if (customText && messageTextElement) {
      messageTextElement.textContent = customText;
      console.log("Set message text to:", customText);
    }
    
    message.style.display = 'block'; // Show the message
    message.classList.add('show');
    console.log(`${type} message displayed`);

    // Remove the message after animation duration (3.5 seconds)
    setTimeout(() => {
      message.style.display = 'none';
      message.classList.remove('show');
      console.log(`${type} message hidden`);
    }, 3000);
  } else {
    console.error(`Message element not found for type: ${type}`);
  }
}


// Check for success or error flags in the URL as soon as the page loads
document.addEventListener('DOMContentLoaded', () => {
  const urlParams = new URLSearchParams(window.location.search);
  console.log("URL Parameters:", urlParams.toString());
  
  if (urlParams.get('success') === '1') {
    console.log("Success flag detected in URL");
    showMessage('success', 'The order was successfully accepted!');
  } else if (urlParams.get('error') === '1') {
    console.log("Error flag detected in URL");
    showMessage('error', 'The order was rejected!');
  }
  
  // Add event listeners for the form buttons
  const acceptButton = document.querySelector('button[name="accept_order"]');
  const rejectButton = document.querySelector('button[name="reject_order"]');
  
  if (acceptButton) {
    acceptButton.addEventListener('click', function() {
      // The form will redirect to success=1 via the controller
      console.log("Accept button clicked");
    });
  }
  
  if (rejectButton) {
    rejectButton.addEventListener('click', function(e) {
      // Set a flag to redirect to error=1
      console.log("Reject button clicked");
      const form = this.closest('form');
      if (form) {
        // Modify the form to redirect to error=1
        form.addEventListener('submit', function() {
          setTimeout(function() {
            window.location.href = `${window.location.pathname}?error=1`;
          }, 100);
        });
      }
    });
  }
});


// Close popups when clicking outside
window.addEventListener('click', (e) => {
  const successMessage = document.getElementById('successMessage');
  const errorMessage = document.getElementById('errorMessage');
  const manageOrderUpdatePopup = document.getElementById('manageOrderUpdatePopup');
  
  if (e.target === manageOrderUpdatePopup) {
    manageOrderUpdatePopup.style.display = 'none';
  }
  
  if (e.target === successMessage) {
    successMessage.style.display = 'none';
  }
  
  if (e.target === errorMessage) {
    errorMessage.style.display = 'none';
  }
});

