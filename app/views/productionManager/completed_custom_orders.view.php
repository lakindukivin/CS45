<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/productionManager/sidebar.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/productionManager/pending_custom_orders.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/productionManager/common.css">
    <title>Waste360|Dashboard|PM</title>
</head>
<body>
    <nav id="sidebar">
      <button id="toggle-btn" onclick="toggleSidebar()" class="toggle-btn">
        <img src="<?=ROOT?>/assets/images/menu.svg" alt="menu" />
      </button>
      <div class="sidebar-container">
        <div class="prof-picture">
          <img src="<?=ROOT?>/assets/images/user.svg" alt="profile" />
          <span class="user-title">Production Manager</span>
        </div>

        <div>
          <ul>
            <li>
              <a href="<?=ROOT?>/ProductionManagerHome"
                ><img src="<?=ROOT?>/assets/images/dashboard.svg" alt="dashboard" /><span
                  class="sidebar-titles"
                  >Dashboard</span
                ></a
              >
            </li>

            <li>
              <a href="<?=ROOT?>/PendingCustomOrder" class="sidebar-active"
                ><img src="<?=ROOT?>/assets/images/order.svg" /><span
                  class="sidebar-titles"
                  >Custom Orders</span
                ></a
              >
            </li>
            <li>
            <a href="<?=ROOT?>/RecycledPolythene"
                ><img src="<?=ROOT?>/assets/images/recycle.svg" /><span
                  class="sidebar-titles"
                  >Recycled Polythene</span
                ></a
              >
            </li>
            <li>
              <a href="<?=ROOT?>/Schedule"
                ><img
                  src="<?=ROOT?>/assets/images/collection.svg"
                  alt="site Performance"
                /><span class="sidebar-titles">Polythene Collection</span></a
              >
            </li>
            <li>
              <a href="<?=ROOT?>/SupplyRequest"
                ><img src="<?=ROOT?>/assets/images/supply.svg" alt="supply" /><span
                  class="sidebar-titles"
                  >Supply Requests</span
                ></a
              >
            </li>
            <li>
              <a href="<?=ROOT?>/PelletsRequests"
                ><img src="<?=ROOT?>/assets/images/order.svg" alt="supply" /><span
                  class="sidebar-titles"
                  >Pellets Requests</span
                ></a
              >
            </li>
          </ul>
        </div> 
      </div>
    </nav>

    
  <div class="content">
    <header>
      <div class="logo">
      <img src="<?=ROOT?>/assets/images/Waste360.png" alt="logo" />
      <h1>Waste360</h1>  
      </div> 
      <h1 class="logo">DashBoard</h1>
      <nav class="nav">
        <ul>
          <li><a href="#"><img src="<?=ROOT?>/assets/images/notifications.svg"></a></li>
          <li><a href="#">Profile</a></li>
          <li><a href="#">Logout</a></li>
        </ul>
      </nav>
    </header>
    <div class="box">
    <div class="container">
        <div class="header">
            <h1>Completed Custom Orders</h1>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Customer ID</th>
                    <th>Comapany Name</th>
                    <th>Quantity</th>
                    <th>Phone</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="orderTableBody">
              <?php if (!empty($completedOrders)): ?>
                <?php foreach ($completedOrders as $order): ?>
                  <tr>
                  <td><?= htmlspecialchars($order->customer_id) ?></td>
                  <td><?= htmlspecialchars($order->company_name) ?></td>
                  <td><?= htmlspecialchars($order->quantity) ?></td>
                  <td><?= htmlspecialchars($order->phone) ?></td>
                  <td><?= htmlspecialchars($order->type) ?></td>
                  <td><?= htmlspecialchars($order->customOrder_status) ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr><td colspan="6">No completed orders found.</td></tr>
              <?php endif; ?>
            </tbody>
        </table>
    </div>
  
      <!-- Add this modal HTML -->
    <!--  <div id="statusModal" class="modal">
        <div class="modal-content">
          <span class="close">&times;</span>
          <h2>Order Status</h2>
          <div class="status-details">
            <p><strong>Order ID:</strong> <span id="orderId"></span></p>
            <p><strong>Status:</strong> <span id="orderStatus"></span></p>
            <p><strong>Created Date:</strong> <span id="orderDate"></span></p>
            <p><strong>Company/Client Name:</strong> <span id="clientName"></span></p>
            <p><strong>Email:</strong> <span id="email"></span></p>
            <p><strong>Phone:</strong> <span id="phone"></span></p>
            <p><strong>Quantity:</strong> <span id="quantity"></span></p>
            <p><strong>Specifications:</strong> <span id="orderDescription"></span></p>
          </div>
        </div>-->
      </div>
    </div> 
  </div>
  <script src="<?=ROOT?>/assets/js/productionManager/sidebar.js"></script>
  <script src="<?=ROOT?>/assets/js/productionManager/pending_custom_order.js"></script>
</body>
</html>