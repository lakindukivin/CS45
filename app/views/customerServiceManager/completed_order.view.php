<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/customerServiceManager/sidebar.css">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/customerServiceManager/manage_orders.css">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/customerServiceManager/common.css">
  <title>Waste360|Dashboard|CSM</title>
  <style>
    /* Status tabs */
    .status-tabs {
      display: flex;
      border-bottom: 1px solid var(--gray-300);
      margin-bottom: 20px;
    }

    .status-tab {
      padding: 10px 20px;
      border: none;
      background: none;
      font-weight: 500;
      color: var(--gray-800);
      cursor: pointer;
      position: relative;
      transition: var(--transition);
    }

    .status-tab:hover {
      color: var(--secondary-green);
    }

    .status-tab.active {
      color: var(--primary-green);
      font-weight: 600;
    }

    .status-tab.active::after {
      content: '';
      position: absolute;
      bottom: -1px;
      left: 0;
      width: 100%;
      height: 3px;
      background-color: var(--secondary-green);
    }

    /* Tab content */
    .tab-content {
      display: none;
    }

    .tab-content.active {
      display: block;
    }

    /* Status badges */
    .status-badge {
      padding: 4px 8px;
      border-radius: 12px;
      font-size: 0.85rem;
      font-weight: 500;
      text-align: center;
      display: inline-block;
    }

    .status-badge.accepted {
      background-color: #cff4fc;
      color: #055160;
    }

    .status-badge.shipped {
      background-color: #fff3cd;
      color: #664d03;
    }

    .status-badge.delivered {
      background-color: #d1e7dd;
      color: #0f5132;
    }

    .status-badge.rejected {
      background-color: #f8d7da;
      color: #842029;
    }

    /* No data message */
    .no-data {
      text-align: center;
      padding: 20px;
      color: var(--gray-800);
      font-style: italic;
    }

    /* Order details modal */
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }

    .modal-content {
      background-color: var(--white);
      padding: 25px;
      border-radius: 8px;
      width: 90%;
      max-width: 600px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
      position: relative;
    }

    .modal .close {
      position: absolute;
      top: 15px;
      right: 20px;
      font-size: 24px;
      font-weight: bold;
      cursor: pointer;
    }

    .order-details {
      margin: 20px 0;
    }

    .detail-row {
      display: flex;
      padding: 10px 0;
      border-bottom: 1px solid var(--gray-200);
    }

    .detail-row .label {
      font-weight: 600;
      width: 40%;
      color: var(--gray-800);
    }

    .detail-row .value {
      width: 60%;
    }

    .modal .action-buttons {
      margin-top: 25px;
      display: flex;
      justify-content: flex-end;
    }

    .modal .update-status {
      background-color: var(--secondary-green);
      color: white;
      border: none;
      padding: 8px 16px;
      border-radius: 4px;
      cursor: pointer;
      font-weight: 500;
      transition: var(--transition);
    }

    .modal .update-status:hover {
      background-color: var(--accent-green);
      transform: translateY(-2px);
    }

    /* Order Status Update Popup */
    #statusUpdatePopup .form-group {
      margin-bottom: 15px;
    }

    #statusUpdatePopup label {
      display: block;
      margin-bottom: 5px;
      font-weight: 500;
      color: var(--gray-800);
    }

    #statusUpdatePopup .input-field {
      width: 100%;
      padding: 8px;
      border: 1px solid var(--gray-300);
      border-radius: 4px;
      font-size: 14px;
    }

    #statusUpdatePopup .btn-secondary-color {
      background-color: var(--gray-300);
      color: var(--gray-800);
      border: none;
      padding: 8px 16px;
      border-radius: 4px;
      cursor: pointer;
      font-weight: 500;
    }

    #statusUpdatePopup .btn-secondary-color:hover {
      background-color: var(--gray-200);
    }

    .action-buttons {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      margin-top: 20px;
    }

    .update-status {
      background-color: var(--secondary-green);
      color: white;
      border: none;
      padding: 8px 16px;
      border-radius: 4px;
      cursor: pointer;
      font-weight: 500;
      transition: var(--transition);
    }

    .update-status:hover {
      background-color: var(--accent-green);
      transform: translateY(-2px);
    }

    .btn-secondary-color {
      background-color: var(--gray-300);
      color: var(--gray-800);
      border: none;
      padding: 8px 16px;
      border-radius: 4px;
      cursor: pointer;
      font-weight: 500;
    }

    .btn-secondary-color:hover {
      background-color: var(--gray-200);
    }
  </style>
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
            <a href="<?=ROOT?>/ManageOrders" class="sidebar-active"><img src="<?=ROOT?>/assets/images/manage_order.svg" /><span
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
    <header class="header">
      <div class="logo">
        <img src="<?=ROOT?>/assets/images/Waste360.png" alt="logo" />
        <h1>Waste360</h1>
      </div>
      <h1 class="logo"></h1>
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
          <h2>Completed Orders</h2>
          <button class="add-button">
            <a href="<?=ROOT?>/ManageOrders">View Pending Orders</a>
          </button>
        </div>
        
        <!-- Order status tabs -->
        <div class="status-tabs">
          <button class="status-tab active" data-status="accepted">Accepted</button>
          <button class="status-tab" data-status="shipped">Shipped</button>
          <button class="status-tab" data-status="delivered">Delivered</button>
          <button class="status-tab" data-status="rejected">Rejected</button>
        </div>
        
        <!-- Orders table with dynamic content -->
        <div class="tab-content active" id="accepted-orders">
          <table>
            <thead>
              <tr>
                <th>Order ID</th>
                <th>Product Name</th>
                <th>Customer Name</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if(isset($data['accepted_orders']) && is_array($data['accepted_orders']) && !empty($data['accepted_orders'])): ?>
                <?php foreach($data['accepted_orders'] as $order): ?>
                <tr data-order='<?= htmlspecialchars(json_encode($order), ENT_QUOTES, 'UTF-8') ?>'>
                  <td><?= $order->order_id ?></td>
                  <td><?= $order->productName ?></td>
                  <td><?= $order->customerName ?></td>
                  <td><?= $order->quantity ?></td>
                  <td>Rs. <?= number_format($order->total, 2) ?></td>
                  <td><?= date('Y-m-d', strtotime($order->orderDate)) ?></td>
                  <td><span class="status-badge accepted">Accepted</span></td>
                  <td>
                    <button class="view-btn" data-id="<?= $order->order_id ?>">View Details</button>
                  </td>
                </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="8" class="no-data">No accepted orders found</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
        
        <div class="tab-content" id="shipped-orders">
          <!-- Similar structure for shipped orders -->
          <table>
            <thead>
              <tr>
                <th>Order ID</th>
                <th>Product Name</th>
                <th>Customer Name</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if(isset($data['shipped_orders']) && is_array($data['shipped_orders']) && !empty($data['shipped_orders'])): ?>
                <?php foreach($data['shipped_orders'] as $order): ?>
                <tr data-order='<?= htmlspecialchars(json_encode($order), ENT_QUOTES, 'UTF-8') ?>'>
                  <td><?= $order->order_id ?></td>
                  <td><?= $order->productName ?></td>
                  <td><?= $order->customerName ?></td>
                  <td><?= $order->quantity ?></td>
                  <td>Rs. <?= number_format($order->total, 2) ?></td>
                  <td><?= date('Y-m-d', strtotime($order->orderDate)) ?></td>
                  <td><span class="status-badge shipped">Shipped</span></td>
                  <td>
                    <button class="view-btn" data-id="<?= $order->order_id ?>">View Details</button>
                  </td>
                </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="8" class="no-data">No shipped orders found</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
        
        <div class="tab-content" id="delivered-orders">
          <!-- Similar structure for delivered orders -->
          <table>
            <thead>
              <tr>
                <th>Order ID</th>
                <th>Product Name</th>
                <th>Customer Name</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if(isset($data['delivered_orders']) && is_array($data['delivered_orders']) && !empty($data['delivered_orders'])): ?>
                <?php foreach($data['delivered_orders'] as $order): ?>
                <tr data-order='<?= htmlspecialchars(json_encode($order), ENT_QUOTES, 'UTF-8') ?>'>
                  <td><?= $order->order_id ?></td>
                  <td><?= $order->productName ?></td>
                  <td><?= $order->customerName ?></td>
                  <td><?= $order->quantity ?></td>
                  <td>Rs. <?= number_format($order->total, 2) ?></td>
                  <td><?= date('Y-m-d', strtotime($order->orderDate)) ?></td>
                  <td><span class="status-badge delivered">Delivered</span></td>
                  <td>
                    <button class="view-btn" data-id="<?= $order->order_id ?>">View Details</button>
                  </td>
                </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="8" class="no-data">No delivered orders found</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
        
        <div class="tab-content" id="rejected-orders">
          <!-- Similar structure for rejected orders -->
          <table>
            <thead>
              <tr>
                <th>Order ID</th>
                <th>Product Name</th>
                <th>Customer Name</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if(isset($data['rejected_orders']) && is_array($data['rejected_orders']) && !empty($data['rejected_orders'])): ?>
                <?php foreach($data['rejected_orders'] as $order): ?>
                <tr data-order='<?= htmlspecialchars(json_encode($order), ENT_QUOTES, 'UTF-8') ?>'>
                  <td><?= $order->order_id ?></td>
                  <td><?= $order->productName ?></td>
                  <td><?= $order->customerName ?></td>
                  <td><?= $order->quantity ?></td>
                  <td>Rs. <?= number_format($order->total, 2) ?></td>
                  <td><?= date('Y-m-d', strtotime($order->orderDate)) ?></td>
                  <td><span class="status-badge rejected">Rejected</span></td>
                  <td>
                    <button class="view-btn" data-id="<?= $order->order_id ?>">View Details</button>
                  </td>
                </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="8" class="no-data">No rejected orders found</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Order Details Modal -->
    <div id="orderDetailsModal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Order Details</h2>
        <div class="popup-details">
          <div class="detail-row">
            <span class="label">Order ID:</span>
            <span class="value" id="modal-order-id"></span>
          </div>
          <div class="detail-row">
            <span class="label">Customer:</span>
            <span class="value" id="modal-customer"></span>
          </div>
          <div class="detail-row">
            <span class="label">Product:</span>
            <span class="value" id="modal-product"></span>
          </div>
          <div class="detail-row">
            <span class="label">Quantity:</span>
            <span class="value" id="modal-quantity"></span>
          </div>
          <div class="detail-row">
            <span class="label">Total:</span>
            <span class="value" id="modal-total"></span>
          </div>
          <div class="detail-row">
            <span class="label">Order Date:</span>
            <span class="value" id="modal-date"></span>
          </div>
          <div class="detail-row">
            <span class="label">Delivery Address:</span>
            <span class="value" id="modal-delivery"></span>
          </div>
          <div class="detail-row">
            <span class="label">Status:</span>
            <span class="value status-badge" id="modal-status"></span>
          </div>
        </div>
        
        <div class="action-buttons">
          <button class="update-status" data-id="" id="updateStatusBtn">Update Status</button>
        </div>
      </div>
    </div>
  </div>
  <script src="<?=ROOT?>/assets/js/customerServiceManager/sidebar.js"></script>
  <script src="<?=ROOT?>/assets/js/customerServiceManager/manage_orders.js"></script>
 

  <!-- Order Status Update Popup -->
<div id="statusUpdatePopup" class="modal">
  <div class="modal-content">
    <span class="close" id="closeStatusPopup">&times;</span>
    <h2>Update Order Status</h2>
    <form id="updateStatusForm">
      <input type="hidden" name="order_id" id="popup-order-id">

      <div class="form-group">
        <label for="status">Status:</label>
        <select name="status" id="status" class="input-field">
          <option value="processing">Processing</option>
          <option value="shipped">Shipped</option>
          <option value="delivered">Delivered</option>
          <option value="rejected">Rejected</option>
        </select>
      </div>

      <div class="form-group">
        <label for="message_to_customer">Message to Customer:</label>
        <textarea name="message_to_customer" id="message_to_customer" class="input-field" rows="4"></textarea>
      </div>

      <div class="action-buttons">
        <button type="submit" class="update-status">Update Order</button>
        <button type="button" class="btn-secondary-color" id="cancelStatusUpdate">Cancel</button>
      </div>
    </form>
  </div>
</div>
</body>

</html>