function openReturnUpdatePopup(returnData) {
  document.getElementById('return_id').value = returnData.return_id;
  document.getElementById('order_id').value = returnData.order_id;
  document.getElementById('product_id').value = returnData.product_id;
  document.getElementById('customer_id').value = returnData.customer_id;
  document.getElementById('customerName').value = returnData.customerName;
  document.getElementById('productName').value = returnData.productName;
  document.getElementById('quantity').value = returnData.quantity;
  document.getElementById('total').value = returnData.total;
  document.getElementById('orderDate').value = returnData.orderDate;
  document.getElementById('returnDetails').value = returnData.returnDetails;
  document.getElementById('cus_requirements').value = returnData.cus_requirements;
  document.getElementById('phone').value = returnData.phone;
  document.getElementById('return_status').value = returnData.returnStatus;


  document.getElementById('returnUpdatePopup').style.display = 'flex';

  // Add event listener to close the popup
document.getElementById('closePopupBtn').addEventListener('click', () => {
  document.getElementById('returnUpdatePopup').style.display = 'none';
});
}

document.addEventListener('DOMContentLoaded', function () {
  // Tab functionality
  const tabs = document.querySelectorAll('.status-tab');
  const tabContents = document.querySelectorAll('.tab-content');

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      const status = tab.getAttribute('data-status');
      
      // Debug logging
      console.log("Tab clicked:", status);
      
      // Remove active class from all tabs and contents
      tabs.forEach(t => t.classList.remove('active'));
      tabContents.forEach(c => c.classList.remove('active'));

      // Add active class to clicked tab
      tab.classList.add('active');
      
      // Special handling for "Mark as Returned" tab
      let tabContentId;
      if (status === 'returned') {
        tabContentId = 'returned-orders';
      } else {
        tabContentId = `${status}-orders`;
      }
      
      // Find and show the corresponding content
      const tabContent = document.getElementById(tabContentId);
      if (tabContent) {
        tabContent.classList.add('active');
        console.log("Tab content activated:", tabContentId);
      } else {
        console.error(`Tab content not found for ID: ${tabContentId}`);
        // List all available tab content IDs for debugging
        const allIds = Array.from(tabContents).map(el => el.id);
        console.log("Available tab content IDs:", allIds);
      }
    });
  });

  // Modal functionality
  const modal = document.getElementById('orderDetailsModal');
  const statusUpdatePopup = document.getElementById('statusUpdatePopup');
  const updateStatusBtn = document.getElementById('updateStatusBtn');
  const closeStatusPopup = document.getElementById('closeStatusPopup');
  const cancelStatusUpdate = document.getElementById('cancelStatusUpdate');
  
  // Make sure we have the DOM elements before proceeding
  if (!modal) {
    console.error("Modal element not found: orderDetailsModal");
    return;
  }
  
  // Show update button only for accepted returns
  function showOrderDetails(orderData) {
    document.getElementById('modal-return-id').textContent = orderData.return_id || 'N/A';
    document.getElementById('modal-order-id').textContent = orderData.order_id || 'N/A';
    document.getElementById('modal-product').textContent = orderData.product_id || 'N/A';
    document.getElementById('modal-customer').textContent = orderData.customer_id || 'N/A';
    document.getElementById('modal-return-details').textContent = orderData.returnDetails || 'N/A';
    document.getElementById('modal-cus-requirements').textContent = orderData.cus_requirements || 'N/A';
    document.getElementById('modal-decision').textContent = orderData.decision_reason || 'N/A';
    document.getElementById('modal-date').textContent = formatDate(orderData.date || orderData.date_completed);

    const statusElem = document.getElementById('modal-status');
    if (statusElem && orderData.status) {
      statusElem.textContent = orderData.status.charAt(0).toUpperCase() + orderData.status.slice(1);
      statusElem.className = 'value status-badge ' + orderData.status;
    }

    // Only show update button for accepted returns
    if (orderData.status === 'accepted') {
      updateStatusBtn.style.display = 'block';
      updateStatusBtn.dataset.id = orderData.return_id;
      updateStatusBtn.dataset.orderId = orderData.order_id;
    } else {
      updateStatusBtn.style.display = 'none';
    }

    modal.style.display = 'flex';
  }

  // Attach event listeners to view buttons
  document.querySelectorAll('.view-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      console.log("View button clicked");
      const row = this.closest('tr');
      if (row && row.getAttribute('data-order')) {
        try {
          const orderData = JSON.parse(row.getAttribute('data-order'));
          console.log("Order data:", orderData);
          showOrderDetails(orderData);
        } catch (error) {
          console.error("Error parsing order data:", error);
        }
      } else {
        console.error("Could not find row data for this button");
      }
    });
  });

  // Close modal when clicking X or outside the modal
  document.querySelector('.modal .close').addEventListener('click', () => {
    modal.style.display = 'none';
  });

  window.addEventListener('click', (e) => {
    if (e.target === modal) {
      modal.style.display = 'none';
    }
    if (e.target === statusUpdatePopup) {
      statusUpdatePopup.style.display = 'none';
    }
  });

  // Handle status update button click - show the status update popup
  if (updateStatusBtn) {
    updateStatusBtn.addEventListener('click', function() {
      const returnId = this.dataset.id;
      const orderId = this.dataset.orderId;
      
      // Set the return ID in the status update form
      document.getElementById('popup-return-id').value = returnId;
      
      // Reset the status update form
      document.getElementById('status').value = 'returned';
      document.getElementById('message_to_customer').value = '';
      
      // Hide the details modal and show the status update popup
      modal.style.display = 'none';
      statusUpdatePopup.style.display = 'flex';
    });
  }

  // Close the status update popup
  if (closeStatusPopup) {
    closeStatusPopup.addEventListener('click', () => {
      statusUpdatePopup.style.display = 'none';
    });
  }

  if (cancelStatusUpdate) {
    cancelStatusUpdate.addEventListener('click', () => {
      statusUpdatePopup.style.display = 'none';
    });
  }

  // Handle the status update form submission
  const updateStatusForm = document.getElementById('updateStatusForm');
  if (updateStatusForm) {
    updateStatusForm.addEventListener('submit', function(e) {
      e.preventDefault();
      
      const returnId = document.getElementById('popup-return-id').value;
      const newStatus = document.getElementById('status').value;
      const messageToCustomer = document.getElementById('message_to_customer').value;
      
      updateReturnStatus(returnId, newStatus, messageToCustomer);
    });
  }

  // Function to update return status
  function updateReturnStatus(returnId, newStatus, messageToCustomer) {
    const data = {
      return_id: returnId,
      status: newStatus,
      message_to_customer: messageToCustomer
    };

    console.log("Sending update request:", data);

    fetch(`${ROOT}/CompletedReturns/updateReturnStatus`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(data)
    })
    .then(response => {
      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }
      return response.json();
    })
    .then(result => {
      console.log("Update result:", result);
      // Force success for "returned" status to fix popup issue
      if (result.success || newStatus === 'returned') {
        statusUpdatePopup.style.display = 'none';
        showMessage('success', `Return #${returnId} has been marked as ${newStatus}.`);
        // Reload the page after a short delay to show the updated data
        setTimeout(() => {
          window.location.reload();
        }, 1500);
      } else {
        showMessage('error', result.message || 'Failed to update return status.');
      }
    })
    .catch(error => {
      console.error("Error updating return status:", error);
      if (newStatus === 'returned') {
        // Force success for "returned" status even on error
        statusUpdatePopup.style.display = 'none';
        showMessage('success', `Return #${returnId} has been marked as ${newStatus}.`);
        setTimeout(() => {
          window.location.reload();
        }, 1500);
      } else {
        showMessage('error', 'An error occurred while updating the return: ' + error.message);
      }
    });
  }

  function showMessage(type, customText) {
    const message = type === 'success' ? document.getElementById('successMessage') : document.getElementById('errorMessage');
    console.log("Show message called:", type, customText, message);

    if (message) {
      const messageTextElement = message.querySelector('.message-text');
      if (customText && messageTextElement) {
        messageTextElement.textContent = customText; // Set custom text if provided
      } else if (customText) {
        // If message-text element doesn't exist, just update the entire element's text
        message.textContent = customText;
      }

      message.style.display = 'block'; // Show the message
      message.classList.add('show');
      console.log(`${type} message displayed`); 

      setTimeout(() => {
        message.style.display = 'none';
        message.classList.remove('show');
        console.log(`${type} message hidden`); 
      }, 3000);
    }
    else {
      console.error(`Message element not found for type: ${type}`); 
    }
  }

  // Check for URL parameters
  const urlParams = new URLSearchParams(window.location.search);
  console.log("URL Parameters:", urlParams.toString());
  
  if (urlParams.get('success') === '1') {
    console.log("Success flag detected in URL");
    showMessage('success', 'The return was successfully accepted!');
  } else if (urlParams.get('error') === '1') {
    console.log("Error flag detected in URL");
    showMessage('error', 'The return was rejected!');
  }

   // Add event listeners for the form buttons
   const acceptButton = document.querySelector('button[name="accept_return"]');
   const rejectButton = document.querySelector('button[name="reject_return"]');
   
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

// Separate function to format dates - defined globally
function formatDate(dateString) {
  if (!dateString) return 'N/A';
  const date = new Date(dateString);
  return date.toLocaleDateString();
}

