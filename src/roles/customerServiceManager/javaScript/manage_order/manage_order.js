const orders = [
  { 
    id: 1, 
    name: 'Item 1',
    status: 'Processing',
    date: '2024-03-19',
    customer: 'John Doe',
    description: 'Custom plastic container with specific dimensions'
  },
  { 
    id: 1, 
    name: 'Item 1',
    status: 'Processing',
    date: '2024-03-19',
    customer: 'John Doe',
    description: 'Custom plastic container with specific dimensions'
  },
  { 
    id: 1, 
    name: 'Item 1',
    status: 'Processing',
    date: '2024-03-19',
    customer: 'John Doe',
    description: 'Custom plastic container with specific dimensions'
  },
  { 
    id: 1, 
    name: 'Item 1',
    status: 'Processing',
    date: '2024-03-19',
    customer: 'John Doe',
    description: 'Custom plastic container with specific dimensions'
  },
  { 
    id: 1, 
    name: 'Item 1',
    status: 'Processing',
    date: '2024-03-19',
    customer: 'John Doe',
    description: 'Custom plastic container with specific dimensions'
  },
  { 
    id: 1, 
    name: 'Item 1',
    status: 'Processing',
    date: '2024-03-19',
    customer: 'John Doe',
    description: 'Custom plastic container with specific dimensions'
  },
  { 
    id: 1, 
    name: 'Item 1',
    status: 'Processing',
    date: '2024-03-19',
    customer: 'John Doe',
    description: 'Custom plastic container with specific dimensions'
  },
  { 
    id: 1, 
    name: 'Item 1',
    status: 'Processing',
    date: '2024-03-19',
    customer: 'John Doe',
    description: 'Custom plastic container with specific dimensions'
  },
  { 
    id: 1, 
    name: 'Item 1',
    status: 'Processing',
    date: '2024-03-19',
    customer: 'John Doe',
    description: 'Custom plastic container with specific dimensions'
  },
  { 
    id: 1, 
    name: 'Item 1',
    status: 'Processing',
    date: '2024-03-19',
    customer: 'John Doe',
    description: 'Custom plastic container with specific dimensions'
  },
  // Add more items as needed
];

const orderList = document.getElementById('orderList');
const orderList1 = document.getElementById('orderList1');
const modal = document.getElementById('statusModal');
const closeBtn = document.getElementsByClassName('close')[0];

// Set initial modal state to hidden
modal.style.display = 'none';

// Function to add orders to the list
function addOrders() {
  orders.forEach(order => {
    const li = document.createElement('li');
    li.textContent = order.name;
    li.setAttribute('data-id', order.id);
    li.addEventListener('click', () => openOrderStatus(order));
    orderList.appendChild(li);
  });
}

function addOrders1() {
  orders.forEach(order => {
    const li = document.createElement('li');
    li.textContent = order.name;
    li.setAttribute('data-id', order.id);
    li.addEventListener('click', () => openOrderStatus(order));
    orderList1.appendChild(li);
  });
}

function openOrderStatus(order) {
  // Update modal content with order details
  document.getElementById('orderId').textContent = order.id;
  document.getElementById('orderStatus').textContent = order.status;
  document.getElementById('orderDate').textContent = order.date;
  document.getElementById('customerName').textContent = order.customer;
  document.getElementById('orderDescription').textContent = order.description;

  // Show the modal
  modal.style.display = 'block';
}

// Close modal when clicking the close button
closeBtn.onclick = function() {
  modal.style.display = 'none';
}

// Close modal when clicking outside of it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = 'none';
  }
}

// Initialize the lists
addOrders();
addOrders1();