let currentOrderId = null;

function viewOrderDetails(orderId) {
    currentOrderId = orderId;
    
    // Find the order data from the table
    const row = document.querySelector(`tr[data-order-id="${orderId}"]`);
    
    // Populate modal with order details
    document.getElementById('orderId').textContent = orderId;
    document.getElementById('productName').textContent = row.dataset.productName;
    document.getElementById('customerName').textContent = row.dataset.customerName;
    document.getElementById('quantity').textContent = row.dataset.quantity;
    document.getElementById('total').textContent = row.dataset.total;
    document.getElementById('deliveryAddress').textContent = row.dataset.address;
    document.getElementById('orderDate').textContent = row.dataset.date;
    document.getElementById('orderStatus').textContent = row.dataset.status;

    // Show modal
    document.getElementById('statusModal').style.display = 'block';
}

function updateOrderStatus(orderId, status) {
    fetch(`${ROOT}/ManageOrders/updateStatus`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `order_id=${orderId}&status=${status}`
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            location.reload();
        }
    });
}

// Close modal
document.querySelector('.close').onclick = function() {
    document.getElementById('statusModal').style.display = 'none';
    currentOrderId = null;
}
