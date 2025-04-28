<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/productionManager/sidebar.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/productionManager/pending_custom_orders.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/productionManager/common.css" />
    <title>Waste360|Dashboard|PM</title>
</head>
<body>
<nav id="sidebar">
        <button id="toggle-btn" onclick="toggleSidebar()" class="toggle-btn">
            <img src="<?= ROOT ?>/assets/images/menu.svg" alt="menu" />
        </button>
        <div class="sidebar-container">
            <div class="prof-picture">
                <img src="<?= ROOT ?>/assets/images/user.svg" alt="profile" />
                <span class="user-title">Production Manager</span>
            </div>

            <div>
                <ul>
                    <li>
                        <a href="<?=ROOT?>/ProductionManagerHome"><img src="<?= ROOT ?>/assets/images/dashboard.svg" alt="dashboard" /><span
                                class="sidebar-titles">Dashboard</span></a>
                    </li>

                    <li>
                        <a href="<?= ROOT ?>/PendingCustomOrder" class="sidebar-active"><img src="<?= ROOT ?>/assets/images/order.svg" /><span
                                class="sidebar-titles">Custom Orders</span></a>
                    </li>
                    <li>
                        <a href="<?= ROOT ?>/RecycledPolythene"><img src="<?= ROOT ?>/assets/images/recycle.svg" /><span
                                class="sidebar-titles">Recycled Polythene</span></a>
                    </li>
                    <li>
                        <a href="<?= ROOT ?>/Schedule"><img
                                src="<?= ROOT ?>/assets/images/collection.svg"
                                alt="site Performance" /><span class="sidebar-titles">Polythene Collection</span></a>
                    </li>
                    <li>
                        <a href="<?= ROOT ?>/SupplyRequest"><img src="<?= ROOT ?>/assets/images/supply.svg" alt="supply" /><span
                                class="sidebar-titles">Supply Requests</span></a>
                    </li>
                    <li>
                        <a href="<?= ROOT ?>/PelletsRequests"><img src="<?= ROOT ?>/assets/images/order.svg" alt="supply" /><span
                                class="sidebar-titles">Pellets Requests</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    
  <div class="content">
    <header>
      <div class="logo">
      <img src="<?= ROOT ?>/assets/images/Waste360.png" alt="logo" />
      <h1>Waste360</h1>  
      </div> 
      <h1 class="logo">DashBoard</h1>
      <nav class="nav">
        <ul>
          <li><a href="#"><img src="<?= ROOT ?>/assets/images/notifications.svg"></a></li>
          <li><a href="#">Profile</a></li>
          <li><a href="#">Logout</a></li>
        </ul>
      </nav>
    </header>

    <div class="box">
    <div class="container">
        <div class="header">
            <h1>Order Details</h1>
        </div>

        <div class="form">
        <form method="POST" action="<?= ROOT ?>/CustomOrderViewForm/post/<?= $order->customOrder_id ?>">
        <input type="hidden" name="order_id" value="<?= $order->customOrder_id ?>">
        <div class="form-row">
            <div class="form-group">
                <label>Customer Name</label>
                <input type="text" value="<?= htmlspecialchars($data['order']->customer_name) ?>" readonly>
            </div>
            <div class="form-group">
                <label>Company Name</label>
                <input type="text" value="<?= htmlspecialchars($data['order']->company_name) ?>" readonly>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Type</label>
                <input type="text" value="<?= htmlspecialchars($data['order']->type) ?>" readonly>
            </div>
            <div class="form-group">
                <label>Quantity</label>
                <input type="number" value="<?= htmlspecialchars($data['order']->quantity) ?>" readonly>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Email</label>
                <input type="email" value="<?= htmlspecialchars($data['order']->email) ?>" readonly>
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="tel" value="<?= htmlspecialchars($data['order']->phone) ?>" readonly>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Specifications</label>
                <textarea readonly><?= htmlspecialchars($data['order']->Specifications) ?></textarea>   
            </div>
        </div>

        <div class="button-group">
            <button type="submit" name="action" value="accept" class="submit-button" id="acceptBtn">Accept</button>
            <button type="button" name="action" value="decline" class="decline-button" id="declineBtn">Decline</button>
        </div>
        </form>
</div>
<!-- declined reason -->
<div id="modal" class="modal">
      <div class="modal-content">
          <span class="close-btn" onclick="closeModal()">&times;</span>
          <h2>Decline Order</h2></br>
          <form id="declineForm">
          <div class="form-group">
          <label>Reason for Declining</label>
          <textarea name="reason" required placeholder="Please provide a reason..."></textarea>
</div>
<button type="submit" class="decline-button">Decline</button>
          </form>
      </div>
  </div>

    <!-- Status Update Modal -->
    <!--<div id="statusModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Update Order Status</h2>
            <form id="statusForm" method="POST">
                <div class="form-group">
                    <label>Select Status:</label>
                    <select name="status" required>
                        <option value="accepted">Accept</option>
                        <option value="rejected">Reject</option>
                    </select>
                </div>
                <div class="button-group">
                    <button type="submit" class="submit-btn">Update</button>
                    <button type="button" class="cancel-btn" onclick="closeModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>-->
  </div> 
  </div>
  <script src="<?= ROOT ?>/assets/js/productionManager/sidebar.js"></script>
  <script src="<?= ROOT ?>/assets/js/productionManager/pending_custom_order.js"></script>
  <script src="<?= ROOT ?>/assets/js/productionManager/custom_order_view_form.js"></script>
</body>
</html>