// Sample review data
const reviews = [
  { 
      id: 1,
      name: 'Review #001',
      status: 'Pending',
      date: '2024-03-19',
      customer: 'John Doe',
      description: 'Custom plastic container with specific dimensions',
      reply: ''
  },
  { 
      id: 2,
      name: 'Review #002',
      status: 'Replied',
      date: '2024-03-18',
      customer: 'Jane Smith',
      description: 'Feedback about recycling service',
      reply: 'Thank you for your feedback. We have improved our service.'
  },
  { 
    id: 1,
    name: 'Review #001',
    status: 'Pending',
    date: '2024-03-19',
    customer: 'John Doe',
    description: 'Custom plastic container with specific dimensions',
    reply: ''
},
{ 
    id: 2,
    name: 'Review #002',
    status: 'Replied',
    date: '2024-03-18',
    customer: 'Jane Smith',
    description: 'Feedback about recycling service',
    reply: 'Thank you for your feedback. We have improved our service.'
},
{ 
  id: 1,
  name: 'Review #001',
  status: 'Pending',
  date: '2024-03-19',
  customer: 'John Doe',
  description: 'Custom plastic container with specific dimensions',
  reply: ''
},
{ 
  id: 2,
  name: 'Review #002',
  status: 'Replied',
  date: '2024-03-18',
  customer: 'Jane Smith',
  description: 'Feedback about recycling service',
  reply: 'Thank you for your feedback. We have improved our service.'
},
{ 
  id: 1,
  name: 'Review #001',
  status: 'Pending',
  date: '2024-03-19',
  customer: 'John Doe',
  description: 'Custom plastic container with specific dimensions',
  reply: ''
},
{ 
  id: 2,
  name: 'Review #002',
  status: 'Replied',
  date: '2024-03-18',
  customer: 'Jane Smith',
  description: 'Feedback about recycling service',
  reply: 'Thank you for your feedback. We have improved our service.'
},
{ 
  id: 1,
  name: 'Review #001',
  status: 'Pending',
  date: '2024-03-19',
  customer: 'John Doe',
  description: 'Custom plastic container with specific dimensions',
  reply: ''
},
{ 
  id: 2,
  name: 'Review #002',
  status: 'Replied',
  date: '2024-03-18',
  customer: 'Jane Smith',
  description: 'Feedback about recycling service',
  reply: 'Thank you for your feedback. We have improved our service.'
},
{ 
  id: 1,
  name: 'Review #001',
  status: 'Pending',
  date: '2024-03-19',
  customer: 'John Doe',
  description: 'Custom plastic container with specific dimensions',
  reply: ''
},
{ 
  id: 2,
  name: 'Review #002',
  status: 'Replied',
  date: '2024-03-18',
  customer: 'Jane Smith',
  description: 'Feedback about recycling service',
  reply: 'Thank you for your feedback. We have improved our service.'
},
{ 
  id: 1,
  name: 'Review #001',
  status: 'Pending',
  date: '2024-03-19',
  customer: 'John Doe',
  description: 'Custom plastic container with specific dimensions',
  reply: ''
},
{ 
  id: 2,
  name: 'Review #002',
  status: 'Replied',
  date: '2024-03-18',
  customer: 'Jane Smith',
  description: 'Feedback about recycling service',
  reply: 'Thank you for your feedback. We have improved our service.'
},
{ 
  id: 1,
  name: 'Review #001',
  status: 'Pending',
  date: '2024-03-19',
  customer: 'John Doe',
  description: 'Custom plastic container with specific dimensions',
  reply: ''
},
{ 
  id: 2,
  name: 'Review #002',
  status: 'Replied',
  date: '2024-03-18',
  customer: 'Jane Smith',
  description: 'Feedback about recycling service',
  reply: 'Thank you for your feedback. We have improved our service.'
}
  // Add more review data as needed
];

// DOM Elements
const reviewList = document.getElementById('reviewList');
const reviewList1 = document.getElementById('reviewList1');
const modal = document.getElementById('statusModal');
const closeBtn = document.getElementsByClassName('close')[0];
const confirmationModal = document.getElementById('confirmationModal');
let currentReview = null;

// Helper Functions
function createButton(text, className) {
  const button = document.createElement('button');
  button.className = `btn ${className}`;
  button.textContent = text;
  return button;
}

function createReviewElement(review) {
  const li = document.createElement('li');
  li.className = 'review-item';
  
  const reviewContent = document.createElement('div');
  reviewContent.textContent = review.name;
  
  const statusBadge = document.createElement('span');
  statusBadge.className = 'review-status';
  statusBadge.textContent = review.status;
  reviewContent.appendChild(statusBadge);
  
  li.appendChild(reviewContent);
  return li;
}

// Main Functions
function addReviews() {
  reviewList.innerHTML = '';
  reviewList1.innerHTML = '';
  
  reviews.forEach(review => {
      const li = createReviewElement(review);
      
      if (review.status === 'Pending') {
          reviewList.appendChild(li);
      } else {
          const actions = document.createElement('div');
          actions.className = 'review-actions';
          
          const editBtn = createButton('Edit', 'btn-primary');
          const deleteBtn = createButton('Delete', 'btn-danger');
          
          editBtn.onclick = (e) => {
              e.stopPropagation();
              openReviewStatus(review, true);
          };
          
          deleteBtn.onclick = (e) => {
              e.stopPropagation();
              showDeleteConfirmation(review);
          };
          
          actions.appendChild(editBtn);
          actions.appendChild(deleteBtn);
          li.appendChild(actions);
          reviewList1.appendChild(li);
      }
      
      li.addEventListener('click', () => openReviewStatus(review));
  });
}

function openReviewStatus(review, isEdit = false) {
  currentReview = review;
  
  // Update modal content
  document.getElementById('reviewId').textContent = review.id;
  document.getElementById('reviewStatus').textContent = review.status;
  document.getElementById('reviewDate').textContent = review.date;
  document.getElementById('customerName').textContent = review.customer;
  document.getElementById('reviewDescription').textContent = review.description;
  
  const replySection = document.getElementById('replySection');
  const replyBox = document.getElementById('replyBox');
  const modalButtons = document.getElementById('modalButtons');
  
  modalButtons.innerHTML = '';
  
  if (review.status === 'Pending') {
      replySection.style.display = 'none';
      replyBox.style.display = 'block';
      document.getElementById('replyText').value = '';
      
      const replyBtn = createButton('Submit Reply', 'btn-success');
      replyBtn.onclick = submitReply;
      modalButtons.appendChild(replyBtn);
  } else if (isEdit) {
      replySection.style.display = 'none';
      replyBox.style.display = 'block';
      document.getElementById('replyText').value = review.reply;
      
      const updateBtn = createButton('Update Reply', 'btn-success');
      updateBtn.onclick = updateReply;
      modalButtons.appendChild(updateBtn);
  } else {
      replySection.style.display = 'block';
      replyBox.style.display = 'none';
      document.getElementById('reviewReply').textContent = review.reply;
  }

  modal.style.display = 'block';
}

function submitReply() {
  const replyText = document.getElementById('replyText').value.trim();
  if (replyText) {
      currentReview.reply = replyText;
      currentReview.status = 'Replied';
      modal.style.display = 'none';
      addReviews();
  }
}

function updateReply() {
  const replyText = document.getElementById('replyText').value.trim();
  if (replyText) {
      currentReview.reply = replyText;
      modal.style.display = 'none';
      addReviews();
  }
}

function showDeleteConfirmation(review) {
  currentReview = review;
  confirmationModal.style.display = 'block';
}

// Event Listeners
document.getElementById('confirmDelete').onclick = function() {
  const index = reviews.findIndex(r => r.id === currentReview.id);
  if (index > -1) {
      reviews.splice(index, 1);
      addReviews();
  }
  confirmationModal.style.display = 'none';
  modal.style.display = 'none';
};

document.getElementById('cancelDelete').onclick = function() {
  confirmationModal.style.display = 'none';
};

closeBtn.onclick = function() {
  modal.style.display = 'none';
};

window.onclick = function(event) {
  if (event.target == modal) {
      modal.style.display = 'none';
  }
  if (event.target == confirmationModal) {
      confirmationModal.style.display = 'none';
  }
};

// Initialize
addReviews();