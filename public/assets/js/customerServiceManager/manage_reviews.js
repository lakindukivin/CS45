// Function to open the review update popup
function openReviewUpdatePopup(review) {
  document.getElementById('review_id').value = review.review_id;
  document.getElementById('customer_id').value = review.customer_id;
  document.getElementById('order_id').value = review.order_id;
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
    message.style.display = 'block'; // Show the message
    message.classList.add('show');

    // Remove the message after 3 seconds
    setTimeout(() => {
        message.style.display = 'none';
        message.classList.remove('show');
    }, 3000);
}

// Check for success or error flags in the URL
document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('success')) {
        showMessage('success'); // Show success message
    } else if (urlParams.has('error')) {
        showMessage('error'); // Show error message
    }
});