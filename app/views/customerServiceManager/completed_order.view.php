<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/customerServiceManager/sidebar.css">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/customerServiceManager/manage_orders.css">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/customerServiceManager/completed_order.css">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/customerServiceManager/common.css">
  <title>Waste360|Dashboard|CSM</title>
  <!-- Updated CSS for message popups with higher z-index to always show on top -->
  <style>
    .message-popup {
      position: fixed;
      top: 20px;
      right: 20px;
      padding: 15px 25px;
      border-radius: 5px;
      color: white;
      font-weight: bold;
      z-index: 2000; /* Higher than other modals (typically 1000) */
      display: none;
      opacity: 0;
      transition: opacity 0.3s ease-in-out;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    
    .message-popup.show {
      opacity: 1;
    }
    
    .success-message {
      background-color:rgb(72, 173, 75);
    }
    
    .error-message {
      background-color:rgb(221, 42, 29);
    }

    /* Dim background overlay for popups */
    .modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 1500;
      display: none;
    }
  </style>
</head>

<body>
  <!-- Success and Error message popups - moved outside of any other container -->
  <div id="successMessage" class="message-popup success-message">Order successfully updated!</div>
  <div id="errorMessage" class="message-popup error-message">Failed to update order!</div>
  <div id="modalOverlay" class="modal-overlay"></div>

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
          <li><a href="<?=ROOT?>/profile">Profile</a></li>
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
          <button class="status-tab" data-status="processing">Processing</button>
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

        <div class="tab-content" id="processing-orders">
          <!-- Similar structure for processing orders -->
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
              <?php if(isset($data['processing_orders']) && is_array($data['processing_orders']) && !empty($data['processing_orders'])): ?>
                <?php foreach($data['processing_orders'] as $order): ?>
                <tr data-order='<?= htmlspecialchars(json_encode($order), ENT_QUOTES, 'UTF-8') ?>'>
                  <td><?= $order->order_id ?></td>
                  <td><?= $order->productName ?></td>
                  <td><?= $order->customerName ?></td>
                  <td><?= $order->quantity ?></td>
                  <td>Rs. <?= number_format($order->total, 2) ?></td>
                  <td><?= date('Y-m-d', strtotime($order->orderDate)) ?></td>
                  <td><span class="status-badge processing">Processing</span></td>
                  <td>
                    <button class="view-btn" data-id="<?= $order->order_id ?>">View Details</button>
                  </td>
                </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="8" class="no-data">No processing orders found</td>
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
          <!-- Only show update button for statuses that can be updated -->
          <button class="update-status" data-id="" id="updateStatusBtn" style="display:none;">Update Status</button>
        </div>
      </div>
    </div>

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
  </div>
  data-order
  <!-- Pass the ROOT constant to JavaScript -->
  <script>
    const ROOT = "<?=ROOT?>";
  </script>
  <script src="<?=ROOT?>/assets/js/customerServiceManager/sidebar.js"></script>
  <script src="<?=ROOT?>/assets/js/customerServiceManager/manage_orders.js"></script>

  
</body>

</html>