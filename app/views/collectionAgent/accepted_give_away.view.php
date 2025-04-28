<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/collectionAgent/sidebar.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/collectionAgent/give_away_request.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/collectionAgent/common.css">
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
                <span class="user-title">Collection Agent</span>
            </div>

            <div>
                <ul>
                    <li>
                        <a href="<?=ROOT?>/CollectionAgentHome" ><img src="<?= ROOT ?>/assets/images/dashboard.svg" alt="dashboard" /><span
                                class="sidebar-titles">Dashboard</span></a>
                    </li>

                    <li>
                        <a href="<?= ROOT ?>/AcceptedGiveAwayRequest" class="sidebar-active"><img src="<?= ROOT ?>/assets/images/give_away.svg" /><span
                                class="sidebar-titles">Accepted Give Aways</span></a>
                    </li>
                    <li>
                        <a href="<?= ROOT ?>/GuestCollection"><img src="<?= ROOT ?>/assets/images/returns.svg" /><span
                                class="sidebar-titles">Add Guest Collection</span></a>
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
            <input type="text" name="status" id="giveaway_status" readonly/>
          </div>

          <div class="popup-content">
            <label for="details">Details: </label>
            <input type="text" name="details" id="details" readonly/>
          </div>

          <div class="popup-content">
            <label for="polytheneAmount">Polythene Amount (kg):</label>
            <input type="number" name="amount" id="polythene_amount" step="0.01" min="10" required placeholder="Enter amount in kg"/>
          </div>

          <div>
            <button type="submit" class="accept"
              name="accept_giveaway">Collect</button>    
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
          <li><a href="<?=ROOT?>/collectionagentprofile">Profile</a></li>
          <li><a href="<?=ROOT?>/logout">Logout</a></li>
        </ul>
      </nav>
    </header>
    <div class="box">
      <div class="container">
        <div class="status-tabs">
          <button class="status-tab <?= (!isset($data['activeTab']) || $data['activeTab'] == 'accepted') ? 'active' : '' ?>" data-status="accepted" onclick="window.location.href='?tab=accepted&page=1'">Accepted</button>
          <button class="status-tab <?= (isset($data['activeTab']) && $data['activeTab'] == 'collected') ? 'active' : '' ?>" data-status="collected" onclick="window.location.href='?tab=collected&page=1'">Collected</button>
        </div>
        
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
        
        <div class="tab-content <?= (!isset($data['activeTab']) || $data['activeTab'] == 'accepted') ? 'active' : '' ?>" id="accepted-orders">
        <table>
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
            <?php if (isset($data['accepted_giveaway']) && is_array($data['accepted_giveaway']) && !empty($data['accepted_giveaway'])): ?>
              <?php foreach ($data['accepted_giveaway'] as $giveaway): ?>
                <tr data-order='<?= htmlspecialchars(json_encode($giveaway), ENT_QUOTES, 'UTF-8') ?>'>                  
                  <td><?= $giveaway->name ?></td>
                  <td><?= $giveaway->phone ?></td>
                  <td><?= $giveaway->request_date ?></td>
                  <td><?= $giveaway->address ?></td>
                  <td><span>Accepted</span></td>
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

         <!-- Accepted Pagination Controls -->
         <div class="pagination">
                <?php if (isset($data['totalAcceptedPages']) && $data['totalAcceptedPages'] > 1): ?>
                    <?php for ($i = 1; $i <= $data['totalAcceptedPages']; $i++): ?>
                        <a href="?tab=accepted&page=<?= $i ?><?= !empty($data['filters']['name']) ? '&filter_name='.urlencode($data['filters']['name']) : '' ?><?= !empty($data['filters']['date']) ? '&filter_date='.urlencode($data['filters']['date']) : '' ?>"
                            class="<?= (isset($data['currentPage']) && $data['currentPage'] == $i && (!isset($data['activeTab']) || $data['activeTab'] == 'accepted')) ? 'active' : '' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                <?php endif; ?>
        </div>
        </div>

        <div class="tab-content <?= (isset($data['activeTab']) && $data['activeTab'] == 'collected') ? 'active' : '' ?>" id="collected-orders">
        <table>
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
            <?php if (isset($data['collected_giveaway']) && is_array($data['collected_giveaway'])): ?>
              <?php foreach ($data['collected_giveaway'] as $giveaway): ?>
                <tr data-order='<?= htmlspecialchars(json_encode($giveaway), ENT_QUOTES, 'UTF-8') ?>'>                  
                  <td><?= $giveaway->name ?></td>
                  <td><?= $giveaway->phone ?></td>
                  <td><?= $giveaway->request_date ?></td>
                  <td><?= $giveaway->address ?></td>
                  <td><span>Collected</span></td>
                  <td>
                    <button class="view-btn" onclick="openCompletedGiveAwayPopup(<?= htmlspecialchars(json_encode($giveaway), ENT_QUOTES, 'UTF-8')?>)"><img src="<?= ROOT ?>/assets/images/edit-btn.svg" alt=""></button>
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
        
        <!-- Collected Pagination Controls -->
        <div class="pagination">
                <?php if (isset($data['totalCollectedPages']) && $data['totalCollectedPages'] > 1): ?>
                    <?php for ($i = 1; $i <= $data['totalCollectedPages']; $i++): ?>
                        <a href="?tab=collected&page=<?= $i ?><?= !empty($data['filters']['name']) ? '&filter_name='.urlencode($data['filters']['name']) : '' ?><?= !empty($data['filters']['date']) ? '&filter_date='.urlencode($data['filters']['date']) : '' ?>"
                            class="<?= (isset($data['currentPage']) && $data['currentPage'] == $i && isset($data['activeTab']) && $data['activeTab'] == 'collected') ? 'active' : '' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                <?php endif; ?>
        </div>
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
  <script src="<?= ROOT ?>/assets/js/collectionAgent/giveAwayRequest.js"></script>
  <script>
    // Make sure tab switching preserves the current page
    document.addEventListener('DOMContentLoaded', function() {
      const statusTabs = document.querySelectorAll('.status-tab');
      const tabContents = document.querySelectorAll('.tab-content');
      
      // Show active tab based on URL parameter or default to accepted
      const urlParams = new URLSearchParams(window.location.search);
      const activeTab = urlParams.get('tab') || 'accepted';
      
      // Update tab visibility
      tabContents.forEach(content => {
        if (content.id === activeTab + '-orders') {
          content.classList.add('active');
        } else {
          content.classList.remove('active');
        }
      });
      
      // Update tab button active state
      statusTabs.forEach(tab => {
        if (tab.getAttribute('data-status') === activeTab) {
          tab.classList.add('active');
        } else {
          tab.classList.remove('active');
        }
      });
    });
  </script>
</body>
</html>