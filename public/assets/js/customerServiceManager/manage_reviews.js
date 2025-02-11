document.addEventListener('DOMContentLoaded', function() {
  const modal = document.getElementById('replyModal');
  const replyBtns = document.querySelectorAll('.reply-btn');
  const closeBtn = document.querySelector('.close-modal');
  
  replyBtns.forEach(btn => {
      btn.addEventListener('click', function() {
          const reviewId = this.getAttribute('data-review-id');
          document.getElementById('modal-review-id').value = reviewId;
          modal.style.display = 'block';
      });
  });

  closeBtn.addEventListener('click', function() {
      modal.style.display = 'none';
  });

  window.addEventListener('click', function(event) {
      if (event.target == modal) {
          modal.style.display = 'none';
      }
  });
});