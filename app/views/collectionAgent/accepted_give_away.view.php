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
            <label for="Order-id" class="">Give Away ID:</label>
            <input type="text" name="giveaway_id" id="giveaway_id" readonly/>
          </div>


          <div class="popup-content">
            <label for="Customer_id" class="">Customer ID: </label>
            <input type="text" name="customer_id" id="customer_id" readonly/>
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
            <input type="number" name="amount" id="polythene_amount" step="0.01" min="0" required placeholder="Enter amount in kg"/>
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
          <li><a href="#"><img src="<?= ROOT ?>/assets/images/notifications.svg"></a></li>
          <li><a href="<?=ROOT?>/profile">Profile</a></li>
          <li><a href="<?=ROOT?>/logout">Logout</a></li>
        </ul>
      </nav>
    </header>
    <div class="box">
      <div class="container">
      <div class="status-tabs">
          <button class="status-tab active" data-status="accepted">Accepted</button>
          <button class="status-tab" data-status="collected">Collected</button>
        </div>
        <div class="tab-content active" id="accepted-orders">
        <table>
          <thead>
            <tr>
              <th>Customer ID</th>
              <th>Name</th>
              <th>Phone</th>
              <th>request_date</th>
              <th>Address</th>
              <th>status</th>
              <th>Action </th>
            </tr>
          </thead>
          <tbody>
            <?php if (isset($data['accepted_giveaway']) && is_array($data['accepted_giveaway'])): ?>
              <?php foreach ($data['accepted_giveaway'] as $giveaway): ?>
                <tr data-order='<?= htmlspecialchars(json_encode($giveaway), ENT_QUOTES, 'UTF-8') ?>'>                  
                  <td><?= $giveaway->customer_id ?></td>
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
        </div>

        <div class="tab-content" id="collected-orders">
        <table>
          <thead>
            <tr>
              <th>Customer ID</th>
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
                  <td><?= $giveaway->customer_id ?></td>
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
        </div>

        <!-- Pagination Controls -->
        <div class="pagination">
                <?php if (isset($totalPages) && $totalPages > 1): ?>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?<?= isset($search) && $search !== '' ? 'search=' . urlencode($search) . '&' : '' ?>page=<?= $i ?>"
                            class="<?= (isset($currentPage) && $currentPage == $i) ? 'active' : '' ?>">
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
    <p class="message-text">The order was successfully accepted!</p>
</div>

<div id="errorMessage" class="error-message" style="display: none;">
    <div class="icon">❌</div>
    <p class="message-text">The order was rejected!</p>
</div>

  <script src="<?= ROOT ?>/assets/js/customerServiceManager/sidebar.js"></script>
  <script src="<?= ROOT ?>/assets/js/collectionAgent/giveAwayRequest.js"></script>
</body>

</html>