
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

    ocument.addEventListener('DOMContentLoaded', function () {
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

      document.getElementById('modal-return-id').textContent = orderData.return_id;
      document.getElementById('modal-order-id').textContent = orderData.order_id;
      document.getElementById('modal-product').textContent = orderData.product_id;
      document.getElementById('modal-customer').textContent = orderData.customer_id;
      document.getElementById('modal-return-details').textContent = orderData.returnDetails;
      document.getElementById('modal-cus-requirements').textContent = orderData.cus_requirements; 
      document.getElementById('modal-decision').textContent = orderData.decision_reason;
      document.getElementById('modal-date').textContent = formatDate(orderData.date);

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


    function showMessage(type, customText) {
        const message = type === 'success' ? document.getElementById('successMessage') : document.getElementById('errorMessage');
        console.log("Show message called:",type,customText, message);

        if (message) {
          const messageTextElement = message.querySelector('.message-text');
          if (customText && messageTextElement) {
            messageTextElement.textContent = customText; // Set custom text if provided
            console.log("Custom message text set:", customText); // Debug: Log custom message text
          }

          message.style.display = 'block'; // Show the message
          message.classList.add('show');
          console.log(`${type} message displayed`); // Debug: Log message display

          setTimeout(() => {
              message.style.display = 'none';
              message.classList.remove('show');
              console.log(`${type} message hidden`); // Debug: Log message hide
          }, 3000);
        }
        else {
            console.error(`Message element not found for tyoe: ${type}`); // Debug: Log error if element is missing
        }
      }

      document.addEventListener('DOMContentLoaded', () => {
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

    });

