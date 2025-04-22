<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/customerServiceManager/sidebar.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/customerServiceManager/returns.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/customerServiceManager/common.css">
    <title>Waste360|Completed Returns</title>

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
<div id="successMessage" class="message-popup success-message">
  <span class="message-text">Return successfully updated!</span>
</div>
<div id="errorMessage" class="message-popup error-message">
  <span class="message-text">Failed to update return!</span>
</div>
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
              <a href="<?=ROOT?>/CSManagerHome"
                ><img src="<?=ROOT?>/assets/images/dashboard.svg" alt="dashboard" /><span
                  class="sidebar-titles"
                  >Dashboard</span
                ></a
              >
            </li>

            <li>
              <a href="<?=ROOT?>/GiveAwayRequest"
                ><img src="<?=ROOT?>/assets/images/give_away.svg" /><span
                  class="sidebar-titles"
                  >Give Away</span
                ></a
              >
            </li>
            <li>
              <a href="<?=ROOT?>/Returns" class="sidebar-active"
                ><img src="<?=ROOT?>/assets/images/returns.svg" /><span
                  class="sidebar-titles"
                  >Returns</span
                ></a
              >
            </li>
            <li>
              <a href="<?=ROOT?>/ManageOrders"
                ><img
                  src="<?=ROOT?>/assets/images/manage_order.svg"
                /><span class="sidebar-titles">Manage Orders</span></a
              >
            </li>
            <li>
              <a href="<?=ROOT?>/ManageReviews"
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
      <h1 class="logo">Completed Returns</h1>
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
          <h2>Completed Return Requests</h2>
          <button class="add-button">
            <a href="<?=ROOT?>/Returns">View Pending Returns</a>
          </button>
        </div>

         <!-- Order status tabs -->
         <div class="status-tabs">
          <button class="status-tab active" data-status="accepted">Accepted</button>
          <button class="status-tab" data-status="returned">Mark as Returned</button>
          <button class="status-tab" data-status="rejected">Rejected</button>
        </div>

        <div class="tab-content active" id="accepted-orders">
        <table>
            <thead>
                <tr>
                    <th>Return ID</th>
                    <th>Order ID</th>
                    <th>Product ID</th>
                    <th>Customer ID</th>
                    <th>Date Completed</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php if(isset($data['accepted_returns']) && is_array($data['accepted_returns']) && !empty($data['accepted_returns'])): ?>
              <?php foreach ($data['accepted_returns'] as $return) : ?>
                <tr data-order='<?= htmlspecialchars(json_encode($return), ENT_QUOTES, 'UTF-8') ?>'>                  <td><?= $return->return_id ?></td>
                  <td><?= $return->order_id ?></td>
                  <td><?= $return->product_id ?></td>
                  <td><?= $return->customer_id ?></td>
                  <td><?= $return->date_completed ?></td>
                  <td><span class="status-badge accepted">Accepted</span></td>
                  <td>
                    <button class="view-btn" data-id="<?= $return->return_id ?>">View Details</button>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9">No completed return requests found</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
      </div>

      <div class="tab-content" id="returned-orders">
      <table>
            <thead>
                <tr>
                    <th>Return ID</th>
                    <th>Order ID</th>
                    <th>Product ID</th>
                    <th>Customer ID</th>
                    <th>Date Completed</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php if(isset($data['returned_orders']) && is_array($data['returned_orders']) && !empty($data['returned_orders'])): ?>
              <?php foreach ($data['returned_orders'] as $return) : ?>
                <tr data-order='<?= htmlspecialchars(json_encode($return), ENT_QUOTES, 'UTF-8') ?>'>                  <td><?= $return->return_id ?></td>
                  <td><?= $return->order_id ?></td>
                  <td><?= $return->product_id ?></td>
                  <td><?= $return->customer_id ?></td>
                  <td><?= $return->date_completed ?></td>
                  <td><span class="status-badge returned">Returned</span></td>
                  <td>
                    <button class="view-btn" data-id="<?= $return->return_id ?>">View Details</button>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9">No completed return requests found</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
      </div>

      <div class="tab-content" id="rejected-orders">
      <table>
            <thead>
                <tr>
                    <th>Return ID</th>
                    <th>Order ID</th>
                    <th>Product ID</th>
                    <th>Customer ID</th>
                    <th>Date Completed</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php if(isset($data['rejected_returns']) && is_array($data['rejected_returns']) && !empty($data['rejected_returns'])): ?>
              <?php foreach ($data['rejected_returns'] as $return) : ?>
                <tr data-order='<?= htmlspecialchars(json_encode($return), ENT_QUOTES, 'UTF-8') ?>'>                  <td><?= $return->return_id ?></td>
                  <td><?= $return->order_id ?></td>
                  <td><?= $return->product_id ?></td>
                  <td><?= $return->customer_id ?></td>
                  <td><?= $return->date_completed ?></td>
                  <td><span class="status-badge rejected">Rejected</span></td>
                  <td>
                    <button class="view-btn" data-id="<?= $return->return_id ?>">View Details</button>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9">No completed return requests found</td>
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
            <span class="label">Return ID:</span>
            <span class="value" id="modal-return-id"></span>
          </div>
          <div class="detail-row">
            <span class="label">Order ID:</span>
            <span class="value" id="modal-order-id"></span>
          </div>
          <div class="detail-row">
            <span class="label">Product ID:</span>
            <span class="value" id="modal-product"></span>
          </div>
          <div class="detail-row">
            <span class="label">Customer ID:</span>
            <span class="value" id="modal-customer"></span>
          </div>
          <div class="detail-row">
            <span class="label">Return Details:</span>
            <span class="value" id="modal-return-details"></span>
          </div>
          <div class="detail-row">
            <span class="label">Customer Requirements:</span>
            <span class="value" id="modal-cus-requirements"></span>
          </div>
          <div class="detail-row">
            <span class="label">Decision reason:</span>
            <span class="value" id="modal-decision"></span>
          </div>
          <div class="detail-row">
            <span class="label">Date:</span>
            <span class="value" id="modal-date"></span>
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
        <h2>Update Return Status</h2>
        <form id="updateStatusForm">
          <input type="hidden" name="return_id" id="popup-return-id">

          <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" id="status" class="input-field">
              <option value="returned" selected>Returned</option>
            </select>
          </div>

          <div class="form-group">
            <label for="message_to_customer">Message to Customer:</label>
            <textarea name="message_to_customer" id="message_to_customer" class="input-field" rows="4" placeholder="Enter a message for the customer regarding their returned item..."></textarea>
          </div>

          <div class="action-buttons">
            <button type="submit" class="update-status">Update Return Status</button>
            <button type="button" class="btn-secondary-color" id="cancelStatusUpdate">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
  const ROOT = "<?=ROOT?>";
  </script>
    <script src="<?=ROOT?>/assets/js/customerServiceManager/sidebar.js"></script>  
    <script src="<?=ROOT?>/assets/js/customerServiceManager/returns.js"></script>  
</body>
</html>