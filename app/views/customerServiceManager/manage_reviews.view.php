<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/customerServiceManager/sidebar.css">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/customerServiceManager/manage_reviews.css">
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
            <a href="<?=ROOT?>/CSManagerHome"><img
                src="<?=ROOT?>/assets/images/dashboard.svg" alt="dashboard" /><span
                class="sidebar-titles">Dashboard</span></a>
          </li>

          <li>
            <a href="<?=ROOT?>GiveAwayRequest"><img
                src="<?=ROOT?>/assets/images/give_away.svg" /><span class="sidebar-titles">Give Away</span></a>
          </li>
          <li>
            <a href="<?=ROOT?>/Returns"><img
                src="<?=ROOT?>/assets/images/returns.svg" /><span class="sidebar-titles">Returns</span></a>
          </li>
          <li>
            <a href="<?=ROOT?>/ManageOrders"><img
                src="<?=ROOT?>/assets/images/manage_order.svg" /><span class="sidebar-titles">Manage order</span></a>
          </li>
          <li>
            <a href="#" class="sidebar-active"><img src="<?=ROOT?>/assets/images/reviews.svg" /><span
                class="sidebar-titles">Manage Reviews</span></a>
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
        <div class="header">
        <h2>Pending Give Away Request</h2>
        <button class="add-button">
                <a href="<?=ROOT?>/CompletedOrders">View Completed Orders</a>
            </button>
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
                <!-- Table body will be populated by JavaScript -->
            </tbody>
        </table>
      </div>
    <!-- Status Modal -->
    <div id="statusModal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Review Details</h2>
        <div class="status-details">
          <p><strong>Review No:</strong> <span id="reviewId"></span></p>
          <p><strong>Status:</strong> <span id="reviewStatus"></span></p>
          <p><strong>Created Date:</strong> <span id="reviewDate"></span></p>
          <p><strong>Customer:</strong> <span id="customerName"></span></p>
          <p><strong>Description:</strong> <span id="reviewDescription"></span></p>
          <p id="replySection" style="display: none;">
            <strong>Previous Reply:</strong> <span id="reviewReply"></span>
          </p>
        </div>
        <div class="reply-box" id="replyBox" style="display: none;">
          <textarea id="replyText" placeholder="Type your reply here..."></textarea>
        </div>
        <div class="button-group" id="modalButtons">
          <!-- Buttons will be dynamically added here -->
        </div>
      </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmationModal" class="modal-overlay">
      <div class="confirmation-modal">
        <h3>Confirm Delete</h3>
        <p>Are you sure you want to delete this review?</p>
        <div class="button-group">
          <button class="btn btn-danger" id="confirmDelete">Delete</button>
          <button class="btn btn-primary" id="cancelDelete">Cancel</button>
        </div>
      </div>
    </div>
  </div>
  <script src="<?=ROOT?>/assets/js/customerServiceManager/manage_reviews.js"></script>
  <script src="<?=ROOT?>/assets/js/customerServiceManager/sidebar.js"></script>
</body>

</html>