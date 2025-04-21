function openGiveAwayReqUpdatePopup(giveaway) {
  document.getElementById('giveaway_id').value = giveaway.giveaway_id;
  document.getElementById('customer_id').value = giveaway.customer_id;
  document.getElementById('name').value = giveaway.name;
  document.getElementById('phone').value = giveaway.phone;
  document.getElementById('request_date').value = giveaway.request_date;
  document.getElementById('address').value = giveaway.address;
  document.getElementById('giveaway_status').value = giveaway.giveawayStatus;
  document.getElementById('details').value = giveaway.details;

  
  document.getElementById('giveAwayReqUpdatePopup').style.display = 'flex';
  document.getElementById('giveAwayReqUpdatePopupClose').addEventListener('click', () => {
    document.getElementById('giveAwayReqUpdatePopup').style.display = 'none';
  });
}

function openCompletedGiveAwayPopup(giveaway) {
    document.getElementById('customer_id').value = giveaway.customer_id;
    document.getElementById('name').value = giveaway.name;
    document.getElementById('phone').value = giveaway.phone;
    document.getElementById('request_date').value = giveaway.request_date;
    document.getElementById('address').value = giveaway.address;
    document.getElementById('status').value = giveaway.status;
    document.getElementById('details').value = giveaway.details;

    document.getElementById('completedGiveAwayPopup').style.display = 'block';
    document.getElementById('completedGiveAwayPopupClose').addEventListener('click', () => {
      document.getElementById('completedGiveAwayPopup').style.display = 'none';
    });
  }

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
      showMessage('success', 'The request was successfully accepted!');
    } else if (urlParams.get('error') === '1') {
      console.log("Error flag detected in URL");
      showMessage('error', 'The request was rejected.');
    }

    const acceptButton = document.querySelector('button[name="accept_giveaway"]');
    const rejectButton = document.querySelector('button[name="reject_giveaway"]');

    if (acceptButton) {
      acceptButton.addEventListener('click', function() {
        console.log("Accept button clicked");
      });
    }

    if (rejectButton) {
      rejectButton.addEventListener('click', function() {
        console.log("Reject button clicked");
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