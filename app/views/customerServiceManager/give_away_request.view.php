<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/customerServiceManager/sidebar.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/customerServiceManager/give_away_request.css">
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
              <a href="../home.html" 
                ><img src="<?=ROOT?>/assets/images/dashboard.svg" alt="dashboard" /><span
                  class="sidebar-titles"
                  >Dashboard</span
                ></a
              >
            </li>

            <li>
              <a href="#" class="sidebar-active"
                ><img src="<?=ROOT?>/assets/images/give_away.svg" /><span
                  class="sidebar-titles"
                  >Give Away</span
                ></a
              >
            </li>
            <li>
              <a href="../returns/returns.html"
                ><img src="<?=ROOT?>/assets/images/returns.svg" /><span
                  class="sidebar-titles"
                  >Returns</span
                ></a
              >
            </li>
            <li>
              <a href="../manage_orders/manage_order.html"
                ><img
                  src="<?=ROOT?>/assets/images/manage_order.svg"
                /><span class="sidebar-titles">Manage Orders</span></a
              >
            </li>
            <li>
              <a href="../manage_reviews/manage_reviews.php"
                ><img src="<?=ROOT?>/assets/images/reviews.svg" /><span
                  class="sidebar-titles"
                  >Manage Reviews</span
                ></a
              >
            </li>
          </ul>
        </div> 
      </div>
    </nav>

  <div class="content">
    <header class="header">
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
        <h2>Pending Give Away Request</h2>
        <div class="order-list">
          <ul id="orderList">
            <!-- Orders will be dynamically added here -->
          </ul>
        </div>
      </div>
  
      <!-- Add this modal HTML -->
      <div id="statusModal" class="modal">
        <div class="modal-content">
          <span class="close">&times;</span>
          <h2>Give Away Status</h2>
          <div class="status-details">
            <p><strong>Give Away ID:</strong> <span id="orderId"></span></p>
            <p><strong>Status:</strong> <span id="orderStatus"></span></p>
            <p><strong>Created Date:</strong> <span id="orderDate"></span></p>
            <p><strong>Customer:</strong> <span id="customerName"></span></p>
            <p><strong>Polythene Quantity(Roughly kgs):</strong> <span id="quantity"></span></p>
            <p><strong>Description:</strong> <span id="orderDescription"></span></p>
          </div>
            <div class="operation">
              <button class="accept">Accept</button>
              <button class="reject">Reject</button>
              </div>
        </div>
      </div>
      <div> <button type="view" class="view-btn" ><a href="../give_away/completed_give_away.html">View</a> </button></div>
    </div>
  </div>
  <script src="<?=ROOT?>/assets/js/customerServiceManager/sidebar.js"></script>
  <script src="<?=ROOT?>/assets/js/customerServiceManager/give_away_request.js"></script>
</body>
</html>