<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/customerServiceManager/sidebar.css">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/customerServiceManager/manage_orders.css">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/customerServiceManager/common.css">
  <title>Waste360|Dashboard|CSM</title>
</head>

<body>
  <nav id="sidebar">
    <button id="toggle-btn" onclick="toggleSidebar()" class="toggle-btn">
      <img src="<?=ROOT?>/assets/images/menu.svg" alt="menu" />
    </button>
    <div class="sidebar-container">
      <div class="prof-picture">
        <img src="<?=ROOT?>/assets/images/user.svg" alt="profile" />
        <span class="user-title">Customer Service Manager</span>
      </div>

      <div>
        <ul>
          <li>
            <a href="<?=ROOT?>/CSManagerHome"><img src="<?=ROOT?>/assets/images/dashboard.svg" alt="dashboard" /><span
                class="sidebar-titles">Dashboard</span></a>
          </li>

          <li>
            <a href="<?=ROOT?>/GiveAwayRequest"><img src="<?=ROOT?>/assets/images/give_away.svg" /><span
                class="sidebar-titles">Give Away</span></a>
          </li>
          <li>
            <a href="<?=ROOT?>/Returns"><img src="<?=ROOT?>/assets/images/returns.svg" /><span
                class="sidebar-titles">Returns</span></a>
          </li>
          <li>
            <a href="#" class="sidebar-active"><img src="<?=ROOT?>/assets/images/manage_order.svg" /><span
                class="sidebar-titles">Manage Orders</span></a>
          </li>
          <li>
            <a href="<?=ROOT?>/ManageReviews"><img src="<?=ROOT?>/assets/images/reviews.svg" /><span
                class="sidebar-titles">Manage Reviews</span></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="content">
    <div id="manageOrderUpdatePopup">
      <div class="popup-content">
        <form action="" method="post" class="bg-white p-5 rounded-md w-full">
          <div class="popup-content">
            <h1>Order Update</h1>
            <span  class="close" id="closePopupBtn">&times;</span>
          </div>

          <div class="popup-content">
            <label for="Order-id" class="">Order ID:</label>
            <input type="text" id="order_id" name="orderId" class="input-field" readonly>
          </div>

          <div class="popup-content">
            <label for="Name" class="">Name:</label>
            <input type="text" id="customerName" name="customerName" class="input-field" readonly>
          </div>

          <div class="popup-content">
            <label for="Product-name" class="">Product Name:</label>
            <input type="text" id="productName" name="productName" class="input-field" readonly>
          </div>

          <div class="popup-content">
            <label for="Quantity" class="">Quantity:</label>
            <input type="text" id="quantity" name="quantity" class="input-field" readonly>
          </div>
          
          <div class="popup-content">
            <label for="Total" class="">Total:</label>
            <input type="text" id="total" name="total" class="input-field" readonly>
          </div>

          <div class="popup-content">
            <label for="Order-date" class="">Order Date:</label>
            <input type="text" id="orderDate" name="orderDate" class="input-field" readonly>
          </div>

          <div class="popup-content">
            <label for="Delivery-address" class="">Delivery Address:</label>
            <input type="text" id="deliveryAddress" name="deliveryAddress" class="input-field" readonly>
          </div>

          <div class="popup-content">
            <label for="Billing-address" class="">Billing Address:</label>
            <input type="text" id="billingAddress" name="billingAddress" class="input-field" readonly>  
          </div>

          <div class="popup-content">
            <label for="order status">Status:</label>
            <input type="text" id="orderStatus" name="orderStatus" class="input-field" readonly>
          </div>

          <div class="popup-content">
            <label for="message_to_customer">Message to Customer:</label>
            <textarea id="message_to_customer" name="message_to_customer" class="input-field"></textarea>
          </div>

          <div>
            <button type="submit" class="accept"
              name="accept_order">Accept</button>

              <button type="submit" class="reject"
              name="reject_order">Reject</button>
          </div>
  
        </form>
      </div>
    </div>
    <header class="header">
      <div class="logo">
        <img src="<?=ROOT?>/assets/images/Waste360.png" alt="logo" />
        <h1>Waste360</h1>
      </div>
      <h1 class="logo"></h1>
      <nav class="nav">
        <ul>
          <li><a href="#"><img src="<?=ROOT?>/assets/images/notifications.svg"></a></li>
          <li><a href="<?=ROOT?>/profile">Profile</a></li>
          <li><a href="#">Logout</a></li>
        </ul>
      </nav>
    </header>
    <div class="box">
      <div class="container">
        <div class="header">
          <h2>Pending Orders</h2>
          <button class="add-button">
            <a href="<?=ROOT?>/CompletedOrders">View Completed Orders</a>
          </button>
        </div>
        <table id="ordersTable">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Product Name</th>
              <th>Customer Name</th>
              <th>Quantity</th>
              <th>Total</th>
              <th>Order Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if(isset($data['orders']) && is_array($data['orders'])): ?>
            <?php foreach($data['orders'] as $order): ?>
            <tr>
              <td><?= $order->order_id ?></td>
              <td><?= $order->productName ?></td>
              <td><?= $order->customerName ?></td>
              <td><?= $order->quantity ?></td>
              <td>Rs. <?= number_format($order->total, 2) ?></td>
              <td><?= date('Y-m-d', strtotime($order->orderDate)) ?></td>
              <td>
              <button onclick="openManageOrderUpdatePopup(<?= htmlspecialchars(json_encode($order), ENT_QUOTES, 'UTF-8') ?>)" class="view-btn">View/Update</button>              
              </td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <tr>
              <td colspan="8">No orders found</td>
            </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div id="successMessage" class="success-message" style="display: none;">
    <div class="icon">✅</div>
    <p class="message-text">The order was successfully accepted!</p>
</div>

<div id="errorMessage" class="error-message" style="display: none;">
    <div class="icon">❌</div>
    <p class="message-text">The order was rejected!</p>
</div>

  <script>
   
  </script>
  <script src="<?=ROOT?>/assets/js/customerServiceManager/sidebar.js"></script>
  <script src="<?=ROOT?>/assets/js/customerServiceManager/manage_orders.js"></script>
</body>

</html>