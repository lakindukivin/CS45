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
              <a href="<?=ROOT?>/CSManagerHome" 
                ><img src="<?=ROOT?>/assets/images/dashboard.svg" alt="dashboard" /><span
                  class="sidebar-titles"
                  >Dashboard</span
                ></a
              >
            </li>

            <li>
              <a href="<?=ROOT?>/GiveAwayRequest" class="sidebar-active"
                ><img src="<?=ROOT?>/assets/images/give_away.svg" /><span
                  class="sidebar-titles"
                  >Give Away</span
                ></a
              >
            </li>
            <li>
              <a href="<?=ROOT?>/Returns"
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
  <div id="completedGiveAwayPopup">
      <div class="popup-content">
        <form action="" method="post" class="bg-white p-5 rounded-md w-full">

          <div class="popup-content">
          <span  class="close"
          id="completedGiveAwayPopupClose">&times;</span>
            <h1>Give Away Request Update</h1>
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
            <label for="request_date">request_date: </label>
            <input type="text" name="request_date" id="request_date" readonly/>
          </div>
          <div class="popup-content">
            <label for="Address">Address: </label>
            <input type="text" name="Address" id="address" readonly/>
          </div>

          <div class="popup-content">
            <label for="status">Status: </label>
            <input type="text" name="status" id="status" readonly/>
          </div>

          <div class="popup-content">
            <label for="status">Details: </label>
            <input type="text" name="details" id="details" readonly/>
          </div>
        </form>
      </div>
    </div>

    <header class="header">
      <div class="logo">
      <img src="<?=ROOT?>/assets/images/Waste360.png" alt="logo" />
      <h1>Waste360</h1>  
      </div> 
      <h1 class="logo">Completed Give Away Request</h1>
      <nav class="nav">
        <ul>
          <li><a href="<?=ROOT?>/CSManagerProfile">Profile</a></li>
          <li><a href="#">Logout</a></li>
        </ul>
      </nav>
    </header>
    <div class="box">
      <div class="container">
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

        <div class="status-tabs">
          <button class="status-tab <?= ($data['activeTab'] == 'accepted') ? 'active' : '' ?>" data-status="accepted" >Accepted</button>
          <button class="status-tab <?= ($data['activeTab'] == 'collected') ? 'active' : '' ?>" data-status="collected">Collected</button>
          <button class="status-tab <?= ($data['activeTab'] == 'rejected') ? 'active' : '' ?>" data-status="rejected">Rejected</button>
        </div>

        <div class="tab-content <?= ($data['activeTab'] == 'accepted') ? 'active' : '' ?>" id="accepted-orders">
        <table>  
            <thead>
                <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Request Date</th>
                <th>Address</th>
                <th>Status</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php if (isset($data['accepted_giveaway']) && is_array($data['accepted_giveaway']) && !empty($data['accepted_giveaway'])): ?>
              <?php foreach ($data['accepted_giveaway'] as $giveaway): ?>
                <tr data-order='<?= htmlspecialchars(json_encode($giveaway), ENT_QUOTES, 'UTF-8') ?>'>                  
                  <td><?= $giveaway->name ?></td>
                  <td><?= $giveaway->phone ?></td>
                  <td><?= date('Y-m-d', strtotime($giveaway->request_date)) ?></td>
                  <td><?= $giveaway->address ?></td>
                  <td><span>Accepted</span></td>
                  <td>
                    <button class="view-btn" onclick="openCompletedGiveAwayPopup(<?= htmlspecialchars(json_encode($giveaway), ENT_QUOTES, 'UTF-8')?>)"><img src="<?= ROOT ?>/assets/images/edit-btn.svg" alt=""></button>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="9">No give away requests found</td>
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
                <th>Request Date</th>
                <th>Address</th>
                <th>Status</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php if (isset($data['collected_giveaway']) && is_array($data['collected_giveaway']) && !empty($data['collected_giveaway'])): ?>
              <?php foreach ($data['collected_giveaway'] as $giveaway): ?>
                <tr data-order='<?= htmlspecialchars(json_encode($giveaway), ENT_QUOTES, 'UTF-8') ?>'>                  
                  <td><?= $giveaway->name ?></td>
                  <td><?= $giveaway->phone ?></td>
                  <td><?= date('Y-m-d', strtotime($giveaway->request_date)) ?></td>
                  <td><?= $giveaway->address ?></td>
                  <td><span>Collected</span></td>
                  <td>
                    <button class="view-btn" onclick="openCompletedGiveAwayPopup(<?= htmlspecialchars(json_encode($giveaway), ENT_QUOTES, 'UTF-8')?>)"><img src="<?= ROOT ?>/assets/images/edit-btn.svg" alt=""></button>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="9">No give away requests found</td>
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

      <div class="tab-content <?= ($data['activeTab'] == 'rejected') ? 'active' : '' ?>" id="rejected-orders">
        <table>  
            <thead>
                <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Request Date</th>
                <th>Address</th>
                <th>Status</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php if (isset($data['rejected_giveaway']) && is_array($data['rejected_giveaway']) && !empty($data['rejected_giveaway'])): ?>
              <?php foreach ($data['rejected_giveaway'] as $giveaway): ?>
                <tr data-order='<?= htmlspecialchars(json_encode($giveaway), ENT_QUOTES, 'UTF-8') ?>'>                  
                  <td><?= $giveaway->name ?></td>
                  <td><?= $giveaway->phone ?></td>
                  <td><?= date('Y-m-d', strtotime($giveaway->request_date)) ?></td>
                  <td><?= $giveaway->address ?></td>
                  <td><span class="status-badge accepted">Rejected</span></td>
                  <td>
                    <button class="view-btn" onclick="openCompletedGiveAwayPopup(<?= htmlspecialchars(json_encode($giveaway), ENT_QUOTES, 'UTF-8')?>)"><img src="<?= ROOT ?>/assets/images/edit-btn.svg" alt=""></button>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="9">No give away requests found</td>
              </tr>
            <?php endif; ?>
            </tbody>
        </table>

        <!-- Rejected Pagination Controls -->
        <div class="pagination">
                <?php if (isset($data['totalRejectedPages']) && $data['totalRejectedPages'] > 1): ?>
                    <?php for ($i = 1; $i <= $data['totalRejectedPages']; $i++): ?>
                        <a href="?tab=rejected&page=<?= $i ?><?= !empty($data['filters']['name']) ? '&filter_name='.urlencode($data['filters']['name']) : '' ?><?= !empty($data['filters']['date']) ? '&filter_date='.urlencode($data['filters']['date']) : '' ?>"
                            class="<?= (isset($data['currentPage']) && $data['currentPage'] == $i && isset($data['activeTab']) && $data['activeTab'] == 'rejected') ? 'active' : '' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                <?php endif; ?>
        </div>       
      </div> 
    </div>
  </div>

  <script src="<?=ROOT?>/assets/js/customerServiceManager/sidebar.js"></script>
  <script src="<?=ROOT?>/assets/js/customerServiceManager/give_away_request.js"></script>
</body>
</html>