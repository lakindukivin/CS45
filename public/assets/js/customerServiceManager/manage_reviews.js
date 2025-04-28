// Function to open the review update popup
function openReviewUpdatePopup(review) {
  document.getElementById('review_id').value = review.review_id;
  document.getElementById('customer_id').value = review.customer_id;
  document.getElementById('order_id').value = review.order_id;
  document.getElementById('customer_name').value = review.customerName;
  document.getElementById('product_name').value = review.productName;
  document.getElementById('rating').value = review.rating;
  document.getElementById('date').value = review.date;
  document.getElementById('comment').value = review.comment;

  document.getElementById('reviewUpdatePopup').style.display = 'block';

  document.getElementById('closePopup').addEventListener('click', () => {
    document.getElementById('reviewUpdatePopup').style.display = 'none';
  });
}

// Function to show the success or error message
function showMessage(type) {
    const message = type === 'success' ? document.getElementById('successMessage') : document.getElementById('errorMessage');
    console.log("Message element:", message); // Debug: Log the message element

    if (message) {
        message.style.display = 'block'; // Show the message
        message.classList.add('show');
        console.log(`${type} message displayed`); // Debug: Log message display

        // Remove the message after 3 seconds
        setTimeout(() => {
            message.style.display = 'none';
            message.classList.remove('show');
            console.log(`${type} message hidden`); // Debug: Log message hide
        }, 3000);
    } else {
        console.error("Message element not found"); // Debug: Log error if element is missing
    }
}

// Check for success or error flags in the URL
document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    console.log("URL Parameters:", urlParams.toString()); // Debug: Log the URL parameters

    // Check for success parameter first
    if (urlParams.has('success')) {
        console.log("Success flag detected"); // Debug: Log success detection
        showMessage('success'); // Show success message
    } 
    // Only show error if there's no success parameter
    else if (urlParams.has('error')) {
        console.log("Error flag detected"); // Debug: Log error detection
        showMessage('error'); // Show error message
    }
});

function openCompletedReviewsPopup(review) {
    document.getElementById('review_id').value = review.review_id;
    document.getElementById('reply_id').value = review.reply_id; // Pass reply_id
    document.getElementById('reply').value = review.reply; // Pre-fill reply text
    document.getElementById('customer_id').value = review.customer_id;
    document.getElementById('customer_name').value = review.customerName;
    document.getElementById('product_name').value = review.productName;
    document.getElementById('order_id').value = review.order_id;
    document.getElementById('rating').value = review.rating;
    document.getElementById('date').value = review.date;
    document.getElementById('comment').value = review.comment;

    document.getElementById('reviewUpdatePopup').style.display = 'block';

    document.getElementById('closePopup').addEventListener('click', () => {
        document.getElementById('reviewUpdatePopup').style.display = 'none';
    });
}