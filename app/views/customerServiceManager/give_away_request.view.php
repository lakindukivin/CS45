<!DOCrequest_date html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/customerServiceManager/sidebar.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/customerServiceManager/give_away_request.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/customerServiceManager/common.css">
  <title>Waste360|Dashboard|CSM</title>
</head>

<body>
  <nav id="sidebar">
    <button id="toggle-btn" onclick="toggleSidebar()" class="toggle-btn">
      <img src="<?= ROOT ?>/assets/images/menu.svg" alt="menu" />
    </button>
    <div class="sidebar-container">
      <div class="prof-picture">
        <img src="<?= ROOT ?>/assets/images/user.svg" alt="profile" />
        <span class="user-title">Customer Service Manager</span>
      </div>

      <div>
        <ul>
          <li>
            <a href="<?= ROOT ?>/CSManagerHome"><img src="<?= ROOT ?>/assets/images/dashboard.svg" alt="dashboard" /><span
                class="sidebar-titles">Dashboard</span></a>
          </li>

          <li>
            <a href="#" class="sidebar-active"><img src="<?= ROOT ?>/assets/images/give_away.svg" /><span
                class="sidebar-titles">Give Away</span></a>
          </li>
          <li>
            <a href="<?= ROOT ?>/Returns"><img src="<?= ROOT ?>/assets/images/returns.svg" /><span
                class="sidebar-titles">Returns</span></a>
          </li>
          <li>
            <a href="<?= ROOT ?>/ManageOrders"><img
                src="<?= ROOT ?>/assets/images/manage_order.svg" /><span class="sidebar-titles">Manage Orders</span></a>
          </li>
          <li>
            <a href="<?= ROOT ?>/ManageReviews"><img src="<?= ROOT ?>/assets/images/reviews.svg" /><span
                class="sidebar-titles">Manage Reviews</span></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="content">
    <div id="giveAwayReqUpdatePopup">
      <div class="popup-content">
        <form action="" method="post" class="bg-white p-5 rounded-md w-full">

          <div class="popup-content">
            <h1>Give Away Request Update</h1>

            <span class="close"
            id="giveAwayReqUpdatePopupClose">&times;</span>
          </div>

          <div class="popup-content">
            <label for="Order-id" class=""></label>
            <input type="hidden" name="giveaway_id" id="giveaway_id" readonly/>
          </div>


          <div class="popup-content">
            <label for="Customer_id" class=""></label>
            <input type="hidden" name="customer_id" id="customer_id" readonly/>
          </div>


          <div class="popup-content">
            <label for="Name" class="">Name: </label>
            <input type="text" name="name" id="name" readonly/>
          </div>

          <div class="popup-content">
            <label for="Phone">Phone: </label>
            <input type="text" name="Phone" id="phone" readonly/>
          </div>
          <div class="popup-content">
            <label for="request_date">Request date: </label>
            <input type="text" name="request_date" id="request_date" readonly/>
          </div>
          <div class="popup-content">
            <label for="Address">Address: </label>
            <input type="text" name="address" id="address" readonly/>
          </div>

          <div class="popup-content">
            <label for="giveawayStatus">Status: </label>
            <input type="text" name="giveawayStatus" id="giveaway_status" readonly/>
          </div>

          <div class="popup-content">
            <label for="details">Details: </label>
            <input type="text" name="details" id="details" readonly/>
          </div>


          <div class="popup-content">
            <label for="decision-date">Decision date:</label>
            <input type="date" name="decision_date" id="decision_date" required/>
          </div>

          <div class="popup-content">
            <label for="decision-reason">Decision reason:</label>
            <input type="text" name="decision_reason" id="decision_reason" required/>
          </div>
 
          <div class="popup-content">
            <label for="message_to_customer">Message to Customer:</label>
            <textarea id="message_to_customer" name="message_to_customer" class="input-field"></textarea>
          </div>

          <div>
            <button type="submit" class="accept"
              name="accept_giveaway">Accept</button>

              <button type="submit" class="reject"
              name="reject_giveaway">Reject</button>
          </div>

        </form>
      </div>
    </div>

    <header class="header">
      <div class="logo">
        <img src="<?= ROOT ?>/assets/images/Waste360.png" alt="logo" />
        <h1>Waste360</h1>
      </div>
      <h1 class="logo">Pending Give Away Request</h1>
      <nav class="nav">
        <ul>
          <li><a href="#"><img src="<?= ROOT ?>/assets/images/notifications.svg"></a></li>
          <li><a href="<?=ROOT?>/profile">Profile</a></li>
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
            <a href="<?= ROOT ?>/CompletedGiveAway">View Completed Give Aways</a>
          </button>          
        </div>
        <table id="giveAwayTable">
          <thead>
            <tr>
              <th>Name</th>
              <th>Phone</th>
              <th>request_date</th>
              <th>Address</th>
              <th>status</th>
              <th>Action </th>
            </tr>
          </thead>
          <tbody>
            <?php if (isset($data['giveaways']) && is_array($data['giveaways'])): ?>
              <?php foreach ($data['giveaways'] as $giveaway): ?>
                <tr>
                  <td><?= $giveaway->name ?></td>
                  <td><?= $giveaway->phone ?></td>
                  <td><?= $giveaway->request_date ?></td>
                  <td><?= $giveaway->address ?></td>
                  <td><?= $giveaway->giveawayStatus ?></td>
                  <td>
                    <button class="view-btn" onclick="openGiveAwayReqUpdatePopup(<?= htmlspecialchars(json_encode($giveaway), ENT_QUOTES, 'UTF-8')?>)"><img src="<?= ROOT ?>/assets/images/edit-btn.svg" alt=""></button>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="7">No give away requests found</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>

        <!-- Pagination Controls -->
        <div class="pagination">
          <?php if (isset($data['currentPage']) && isset($data['totalPages'])): ?>
            <?php for ($i = 1; $i <= $data['totalPages']; $i++): ?>
              <a href="?page=<?= $i ?>&tab=<?= $data['activeTab'] ?>&filter_name=<?= htmlspecialchars($data['filters']['name'] ?? '') ?>&filter_date=<?= htmlspecialchars($data['filters']['date'] ?? '') ?>" class="<?= ($i == $data['currentPage']) ? 'active' : '' ?>"><?= $i ?></a>
            <?php endfor; ?>
          <?php endif; ?>
        </div>  

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

  <script src="<?= ROOT ?>/assets/js/customerServiceManager/sidebar.js"></script>
  <script src="<?= ROOT ?>/assets/js/customerServiceManager/give_away_request.js"></script>
</body>

</html>