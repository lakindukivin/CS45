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
        <h2>Completed Give Away Request</h2>
        </div>

        <div class="status-tabs">
          <button class="status-tab active" data-status="accepted">Accepted</button>
          <button class="status-tab" data-status="rejected">Rejected</button>
        </div>

        <div class="tab-content active" id="accepted-orders">
        <table>  
            <thead>
                <tr>
                <th>Customer ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Request Date</th>
                <th>Address</th>
                <th>Status</th>
                <th>Action</th>
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
                  <td><span class="status-badge accepted">Accepted</span></td>
                  <td>
                    <button class="view-btn" onclick="openCompletedGiveAwayPopup(<?= htmlspecialchars(json_encode($giveaway), ENT_QUOTES, 'UTF-8')?>)">View/Update</button>
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

      <div class="tab-content" id="rejected-orders">
        <table>  
            <thead>
                <tr>
                <th>Customer ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Request Date</th>
                <th>Address</th>
                <th>Status</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php if (isset($data['rejected_giveaway']) && is_array($data['rejected_giveaway'])): ?>
              <?php foreach ($data['rejected_giveaway'] as $giveaway): ?>
                <tr data-order='<?= htmlspecialchars(json_encode($giveaway), ENT_QUOTES, 'UTF-8') ?>'>                  
                  <td><?= $giveaway->customer_id ?></td>
                  <td><?= $giveaway->name ?></td>
                  <td><?= $giveaway->phone ?></td>
                  <td><?= $giveaway->request_date ?></td>
                  <td><?= $giveaway->address ?></td>
                  <td><span class="status-badge accepted">Rejected</span></td>
                  <td>
                    <button class="view-btn" onclick="openCompletedGiveAwayPopup(<?= htmlspecialchars(json_encode($giveaway), ENT_QUOTES, 'UTF-8')?>)">View/Update</button>
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
    </div>
  </div>

  <script src="<?=ROOT?>/assets/js/customerServiceManager/sidebar.js"></script>
  <script src="<?=ROOT?>/assets/js/customerServiceManager/give_away_request.js"></script>
</body>
</html>