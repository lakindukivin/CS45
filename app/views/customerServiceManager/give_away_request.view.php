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
              <a href="#" class="sidebar-active"
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
        <h2>Pending Give Away Request</h2>
        <button class="add-button">
                <a href="<?=ROOT?>/CompletedOrders">View Completed Give Aways</a>
            </button>
        </div>
        <table id="giveAwayTable">  
            <thead>
                <tr>
                    <th>Customer ID</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Type</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="orderTableBody">
            <?php foreach($giveAwayRequests as $request): ?>
                <tr>
                    <td><?= htmlspecialchars($request->Giveaway_id) ?></td>
                    <td><?= htmlspecialchars($request->customer_name) ?></td>
                    <td><?= htmlspecialchars($request->Type) ?></td>
                    <td><?= htmlspecialchars($request->Address) ?></td>
                    <td><?= htmlspecialchars($request->quantity) ?></td>
                    <td>
                        <button onclick="viewRequest(<?= $request->Giveaway_id ?>)" class="view-btn">View</button>
                        <button onclick="editRequest(<?= $request->Giveaway_id ?>)" class="edit-btn">Edit</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
      </div>
  <!-- View Modal -->
<div id="viewModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Request Details</h2>
        <div id="requestDetails"></div>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Edit Request</h2>
        <form id="editForm">
            <input type="hidden" id="editId" name="id">
            <div class="form-group">
                <label>Type:</label>
                <input type="text" id="editType" name="type" required>
            </div>
            <div class="form-group">
                <label>Address:</label>
                <input type="text" id="editAddress" name="address" required>
            </div>
            <div class="form-group">
                <label>Quantity:</label>
                <input type="number" id="editQuantity" name="quantity" required>
            </div>
            <button type="submit" class="submit-btn">Update</button>
        </form>
    </div>
</div>
    </div>
  </div>
  <script src="<?=ROOT?>/assets/js/customerServiceManager/sidebar.js"></script>
  <script src="<?=ROOT?>/assets/js/customerServiceManager/give_away_request.js"></script>
</body>
</html>