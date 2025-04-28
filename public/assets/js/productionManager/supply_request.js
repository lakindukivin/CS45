// const orders = [
//   { 
//     id: 1, 
//     name: 'Item 1',
//     status: 'Pending',
//     date: '2024-03-19',
//     customer: 'John Doe',
//     bag_size: 'small',
//     category: 'blue',
//     pack_size: '100',
//     Quantity: '50',
//     description: 'Custom plastic container with specific dimensions'
//   },
//   { 
//     id: 1, 
//     name: 'Item 1',
//     status: 'Pending',
//     date: '2024-03-19',
//     customer: 'John Doe',
//     bag_size: 'small',
//     category: 'blue',
//     pack_size: '100',
//     Quantity: '50',
//     description: 'Custom plastic container with specific dimensions'
//   },
//   { 
//     id: 1, 
//     name: 'Item 1',
//     status: 'Pending',
//     date: '2024-03-19',
//     customer: 'John Doe',
//     bag_size: 'small',
//     category: 'blue',
//     pack_size: '100',
//     Quantity: '50',
//     description: 'Custom plastic container with specific dimensions'
//   },
//   { 
//     id: 1, 
//     name: 'Item 1',
//     status: 'Pending',
//     date: '2024-03-19',
//     customer: 'John Doe',
//     bag_size: 'small',
//     category: 'blue',
//     pack_size: '100',
//     Quantity: '50',
//     description: 'Custom plastic container with specific dimensions'
//   },
//   { 
//     id: 1, 
//     name: 'Item 1',
//     status: 'Pending',
//     date: '2024-03-19',
//     customer: 'John Doe',
//     bag_size: 'small',
//     category: 'blue',
//     pack_size: '100',
//     Quantity: '50',
//     description: 'Custom plastic container with specific dimensions'
//   },
//   { 
//     id: 1, 
//     name: 'Item 1',
//     status: 'Pending',
//     date: '2024-03-19',
//     customer: 'John Doe',
//     bag_size: 'small',
//     category: 'blue',
//     pack_size: '100',
//     Quantity: '50',
//     description: 'Custom plastic container with specific dimensions'
//   },
//   { 
//     id: 1, 
//     name: 'Item 1',
//     status: 'Pending',
//     date: '2024-03-19',
//     customer: 'John Doe',
//     bag_size: 'small',
//     category: 'blue',
//     pack_size: '100',
//     Quantity: '50',
//     description: 'Custom plastic container with specific dimensions'
//   },
//   { 
//     id: 1, 
//     name: 'Item 1',
//     status: 'Pending',
//     date: '2024-03-19',
//     customer: 'John Doe',
//     bag_size: 'small',
//     category: 'blue',
//     pack_size: '100',
//     Quantity: '50',
//     description: 'Custom plastic container with specific dimensions'
//   },
//   { 
//     id: 1, 
//     name: 'Item 1',
//     status: 'Pending',
//     date: '2024-03-19',
//     customer: 'John Doe',
//     bag_size: 'small',
//     category: 'blue',
//     pack_size: '100',
//     Quantity: '50',
//     description: 'Custom plastic container with specific dimensions'
//   },
//   { 
//     id: 1, 
//     name: 'Item 1',
//     status: 'Pending',
//     date: '2024-03-19',
//     customer: 'John Doe',
//     bag_size: 'small',
//     category: 'blue',
//     pack_size: '100',
//     Quantity: '50',
//     description: 'Custom plastic container with specific dimensions'
//   },
//   // Add more items as needed
// ];

// const orderList = document.getElementById('orderList');
// const orderList1 = document.getElementById('orderList1');
// const modal = document.getElementById('statusModal');
// const closeBtn = document.getElementsByClassName('close')[0];

// // Set initial modal state to hidden
// modal.style.display = 'none';

// // Function to add orders to the list
// function addOrders() {
//   orders.forEach(order => {
//     const li = document.createElement('li');
//     li.textContent = order.name;
//     li.setAttribute('data-id', order.id);
//     li.addEventListener('click', () => openOrderStatus(order));
//     orderList.appendChild(li);
//   });
// }

// function addOrders1() {
//   orders.forEach(order => {
//     const li = document.createElement('li');
//     li.textContent = order.name;
//     li.setAttribute('data-id', order.id);
//     li.addEventListener('click', () => openOrderStatus(order));
//     orderList1.appendChild(li);
//   });
// }

// function openOrderStatus(order) {
//   // Update modal content with order details
//   document.getElementById('orderId').textContent = order.id;
//   document.getElementById('orderStatus').textContent = order.status;
//   document.getElementById('orderDate').textContent = order.date;
//   document.getElementById('bagSize').textContent = order.bag_size;
//   document.getElementById('category').textContent = order.category;
//   document.getElementById('packSize').textContent = order.pack_size;
//   document.getElementById('quantity').textContent = order.Quantity;
//   document.getElementById('orderDescription').textContent = order.description;
//   // Show the modal
//   modal.style.display = 'block';
// }

// // Close modal when clicking the close button
// closeBtn.onclick = function() {
//   modal.style.display = 'none';
// }

// // Close modal when clicking outside of it
// window.onclick = function(event) {
//   if (event.target == modal) {
//     modal.style.display = 'none';
//   }
// }

// // Initialize the lists
// addOrders();
// addOrders1();

document.addEventListener('DOMContentLoaded', function() {
  const modal = document.getElementById('modal');
  const addButtons = document.querySelectorAll('.view-btn');
  const closeModalBtn = document.querySelector('.close-btn');
  const quantityForm = document.getElementById('quantityForm');
  const quantityInput = document.getElementById('quantity');
  const productIdInput = document.getElementById('productId');
    const packIdInput = document.getElementById('packId');
    const bagIdInput = document.getElementById('bagId');

  // Remove onclick from HTML buttons and use event listeners
  addButtons.forEach(button => {
      button.addEventListener('click', function(e) {
          e.preventDefault();
          // Get the product details from data attributes
          const productId = this.getAttribute('data-product-id');
          const packId = this.getAttribute('data-pack-id');
          const bagId = this.getAttribute('data-bag-id');
          
          // Set the values in the hidden inputs
          productIdInput.value = productId;
          packIdInput.value = packId;
          bagIdInput.value = bagId;
          modal.style.display = 'block';
      });
  });

  // Close modal when X is clicked
  closeModalBtn.addEventListener('click', function() {
      modal.style.display = 'none';
  });

  // Close modal when clicking outside
  window.addEventListener('click', function(e) {
      if (e.target === modal) {
          modal.style.display = 'none';
      }
  });

  // Form submission handling
  if (quantityForm) {
      quantityForm.addEventListener('submit', function(e) {
          e.preventDefault();
          this.submit();
      });
  }
});