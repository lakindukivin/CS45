<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/sidebar.css">
    <link rel="stylesheet" href="../../styles/customer_order/pending_custom_orders.css">
    <link rel="stylesheet" href="../../styles/common.css">
    <title>Waste360|Dashboard|PM</title>
</head>
<body>
    <nav id="sidebar">
      <button id="toggle-btn" onclick="toggleSidebar()" class="toggle-btn">
        <img src="../../../../assets/menu.svg" alt="menu" />
      </button>
      <div class="sidebar-container">
        <div class="prof-picture">
          <img src="../../../../assets/user.svg" alt="profile" />
          <span class="user-title">Production Manager</span>
        </div>

        <div>
          <ul>
            <li>
              <a href="../home.html"
                ><img src="../../../../assets/dashboard.svg" alt="dashboard" /><span
                  class="sidebar-titles"
                  >Dashboard</span
                ></a
              >
            </li>

            <li>
              <a href="../customer_order/pending_custom_orders.html" class="sidebar-active"
                ><img src="../../../../assets/order.svg" /><span
                  class="sidebar-titles"
                  >Custom Orders</span
                ></a
              >
            </li>
            <li>
              <a href="../recycled_polythene/recycled_polythene.html"
                ><img src="../../../../assets/recycle.svg" /><span
                  class="sidebar-titles"
                  >Recycled Polythene</span
                ></a
              >
            </li>
            <li>
              <a href="../polythene_collection/schedule.html"
                ><img
                  src="../../../../assets/collection.svg"
                  alt="site Performance"
                /><span class="sidebar-titles">Polythene Collection</span></a
              >
            </li>
            <li>
              <a href="../supply_requests/supply_request.html"
                ><img src="../../../../assets/supply.svg" alt="supply" /><span
                  class="sidebar-titles"
                  >Supply Requests</span
                ></a
              >
            </li>
            <li>
              <a href="../pellets_requests/pellets_requests.html"
                ><img src="../../../../assets/order.svg" alt="supply" /><span
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
      <img src="../../../../assets/Waste360.png" alt="logo" />
      <h1>Waste360</h1>  
      </div> 
      <h1 class="logo">DashBoard</h1>
      <nav class="nav">
        <ul>
          <li><a href="#"><img src="../../../../assets/notifications.svg"></a></li>
          <li><a href="#">Profile</a></li>
          <li><a href="#">Logout</a></li>
        </ul>
      </nav>
    </header>

    <div class="box">
      <div class="container">
        <h2>Completed Custom Orders</h2>
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
        </div>
      </div>
    </div> 
  </div>
  <script src="../../javaScript/sidebar.js"></script>
  <script src="../../javaScript/customer_order/pending_custom_order.js"></script>
</body>
</html>