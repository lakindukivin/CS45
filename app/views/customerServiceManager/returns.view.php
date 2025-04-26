<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/customerServiceManager/sidebar.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/customerServiceManager/returns.css">
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
              <a href="#" class="sidebar-active"
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
  <div id="returnUpdatePopup">
      <div class="popup-content">
        <form action="" method="post" class="bg-white p-5 rounded-md w-full">
          <div class="popup-content">
          <span class="close" id="closePopupBtn">&times;</span>
            <h1>Return Update</h1>
          </div>
          <div class="popup-content">
          <div>
            <label for="Return-id" class="" type="hidden" ></label>
            <input type="hidden" id="return_id" name="returnId" class="input-field" readonly>
          </div>

          <div>
            <label for="Order-id" class=""></label>
            <input type="hidden" id="order_id" name="orderId" class="input-field" readonly>
          </div>
          </div>
          
          <div class="popup-content">
          <div>
            <label for="Product-id" class=""></label>
            <input type="hidden" id="product_id" name="productId" class="input-field" readonly>
          </div>

          <div >
            <label for="Customer-id" class=""></label>
            <input type="hidden" id="customer_id" name="customerId" class="input-field" readonly>
          </div>
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
            <label for="Bag-size" class="">Bag Size:</label>
            <input type="text" id="bagSize" name="bagSize" class="input-field" readonly>
          </div>

            <div class="popup-content">
            <label for="Pack-size" class="">Pack Size:</label>
            <input type="text" id="packSize" name="packSize" class="input-field" readonly>
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
            <label for="Request-date" class="">Request Date:</label>
            <input type="text" id="requestDate" name="requestDate" class="input-field" readonly>
          </div>

          <div class="popup-content">
            <label for="Phone" class="">Phone:</label>
            <input type="text" id="phone" name="phone" class="input-field" readonly>
          </div>

          <div class="popup-content">
            <label for="Return-Details" class="">Return Details:</label>
            <input type="text" id="returnDetails" name="returnDetails" class="input-field" readonly>
          </div>

          <div class="popup-content">
            <label for="Customer-Requirements" class="">Customer Requirements:</label>
            <input type="text" id="cus_requirements" name="cus_requirements" class="input-field" readonly>
          </div>

          <div class="popup-content">
            <label for="decision_reason" class="">Decision Reason:</label>
            <textarea id="decision_reason" name="decision_reason" class="input-field"></textarea>
          </div>

          <div class="popup-content">
            <label for="message_to_customer" class="">Message to Customer:</label>
            <textarea id="message_to_customer" name="message_to_customer" class="input-field"></textarea>
          </div>

          <div class="popup-content">
            <label for="returnStatus" class="">Status:</label>
            <input type="text" id="return_status" name="returnStatus">
          </div>

          <div class="button-container">
            <button type="submit" class="accept" name="accept_return">Accept</button>
            <button type="submit" class="reject" name="reject_return">Reject</button>
          </div>

  
        </form>
      </div>
    </div>
    <header class="header">
      <div class="logo">
      <img src="<?=ROOT?>/assets/images/Waste360.png" alt="logo" />
      <h1>Waste360</h1>  
      </div> 
      <h1 class="logo">Pending Return Requests</h1>
      <nav class="nav">
        <ul>
          <li><a href="<?=ROOT?>/CSmanagerProfile">Profile</a></li>
          <li><a href="<?=ROOT?>/logout">Logout</a></li>
        </ul>
      </nav>
    </header>
    <div class="box">
      <div class="container">
        <div class="header">
           <!-- Filter Form -->
        <div class="filter-container">
          <form action="" method="get" class="filter-form">
            <input type="hidden" name="tab" value="<?= $data['activeTab'] ?? 'accepted' ?>">
            
            <div class="filter-input">
              <label for="filter_name">Customer Name:</label>
              <input type="text" id="filter_name" name="filter_name" value="<?= htmlspecialchars($data['filters']['name'] ?? '') ?>" placeholder="Filter by name">
            </div>
            
            <div class="filter-input">
              <label for="filter_date">Request Date:</label>
              <input type="date" id="filter_date" name="filter_date" value="<?= htmlspecialchars($data['filters']['date'] ?? '') ?>">
            </div>
            
            <div class="filter-actions">
              <button type="submit" class="filter-btn">Apply Filters</button>
              <a href="?tab=<?= $data['activeTab'] ?? 'accepted' ?>" class="reset-filter-btn">Reset</a>
            </div>
          </form>
        </div>
        <button class="add-button">
                <a href="<?=ROOT?>/CompletedReturns">View Completed Returns</a>
            </button>
        </div>
        <table id="returnTable">
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php if(isset($data['returns']) && is_array($data['returns']) && !empty($data['returns'])): ?>
              <?php foreach ($data['returns'] as $return) : ?>
                <tr>
                  <td><?= $return->customerName ?></td>
                  <td><?= $return->productName ?></td>
                  <td><?= $return->quantity ?></td>
                  <td><?= $return->phone ?></td>
                  <td>
                  <button class="view-btn" onclick="openReturnUpdatePopup(<?= htmlspecialchars(json_encode($return), ENT_QUOTES, 'UTF-8')?>)"><img src="<?= ROOT ?>/assets/images/edit-btn.svg" alt=""></button>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No pending return requests found</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>

        <!-- Pagination Controls - Fixed to use $data array -->
        <div class="pagination">
                <?php if (isset($data['totalPages']) && $data['totalPages'] > 1): ?>
                    <?php for ($i = 1; $i <= $data['totalPages']; $i++): ?>
                        <a href="?page=<?= $i ?><?= !empty($data['filters']['name']) ? '&filter_name='.urlencode($data['filters']['name']) : '' ?><?= !empty($data['filters']['date']) ? '&filter_date='.urlencode($data['filters']['date']) : '' ?>"
                            class="<?= (isset($data['currentPage']) && $data['currentPage'] == $i) ? 'active' : '' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                <?php endif; ?>
        </div>
        
      </div>
    </div>
  </div> 

  
  <div id="successMessage" class="success-message" style="display: none;">
    <div class="icon">✅</div>
    <p class="message-text">The return was successfully accepted!</p>
</div>

<div id="errorMessage" class="error-message" style="display: none;">
    <div class="icon">❌</div>
    <p class="message-text">The return was rejected!</p>
</div>

  <script src="<?=ROOT?>/assets/js/customerServiceManager/sidebar.js"></script>  
  <script src="<?=ROOT?>/assets/js/customerServiceManager/returns.js"></script>  
</body>
</html>