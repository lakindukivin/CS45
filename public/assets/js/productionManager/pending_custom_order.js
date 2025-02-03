const orders = [
 /** { 
     id: 1, 
    name: 'Item 1',
    status: 'Pending',
    date: '2024-03-19',
    client: 'John Doe',
    email: 'nnimasha43@gmail.com',
    phone: '0768512877',
    pack_size: '100',
    Quantity: '50',
    description: 'Custom plastic container with specific dimensions'
  },*/
  
  { 
    customer_id: 1, 
    Company_name: 'Item 1',
    Quantity: 'Pending',
    Phone: 'John Doe',
    Type: 'nnimasha43@gmail.com',
  },
  { 
    customer_id: 1, 
    Company_name: 'Item 1',
    Quantity: 'Pending',
    Phone: 'John Doe',
    Type: 'nnimasha43@gmail.com',
  },
  { 
    customer_id: 1, 
    Company_name: 'Item 1',
    Quantity: 'Pending',
    Phone: 'John Doe',
    Type: 'nnimasha43@gmail.com',
  },
  { 
    customer_id: 1, 
    Company_name: 'Item 1',
    Quantity: 'Pending',
    Phone: 'John Doe',
    Type: 'nnimasha43@gmail.com',
  }
  // Add more items as needed
];

/*const orderList = document.getElementById('orderList');
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
  document.getElementById('clientName').textContent = order.client;
  document.getElementById('email').textContent = order.email;
  document.getElementById('phone').textContent = order.phone;
  document.getElementById('quantity').textContent = order.Quantity;
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
*/
function renderorders() {
  const tableBody = document.getElementById('orderTableBody');
  tableBody.innerHTML = '';

  orders.forEach(orders => {
      const row = document.createElement('tr');
      row.innerHTML = `
          <td>${orders.customer_id}</td>
          <td>${orders.Company_name}</td>
          <td>${orders.Quantity}</td>
          <td>${orders.Phone}</td>
          <td>${orders.Type}</td>
          <td>
              <div class="actions">
                  <button class="action-button view-button" title="View">👁️</button>
                  <button class="action-button edit-button" title="Accept">✏️</button>
                  <button class="action-button delete-button" title="Reject">🗑️</button>
              </div>
          </td>
      `;
      tableBody.appendChild(row);
  });
}

// Add event listener for Add New order button
document.querySelector('.add-button').addEventListener('click', () => {
  alert('Add New order functionality would go here');
});

// Initial render
renderorders();

// Add event listeners for action buttons
document.addEventListener('click', (e) => {
  if (e.target.closest('.view-button')) {
      alert('View order details');
  } else if (e.target.closest('.edit-button')) {
      alert('Edit order details');
  } else if (e.target.closest('.delete-button')) {
      alert('Delete order');
  }
});