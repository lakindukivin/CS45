<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/productionManager/sidebar.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/productionManager/pellets_requests.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/productionManager/common.css">
    <title>Waste360|Dashboard|PM</title>
</head>
<body>
    <nav id="sidebar">
      <button id="toggle-btn" onclick="toggleSidebar()" class="toggle-btn">
        <img src="<?=ROOT?>/assets/images/menu.svg" alt="menu" />
      </button>
      <div class="sidebar-container">
        <div class="prof-picture">
          <img src="<?=ROOT?>/assets/images/user.svg" alt="profile" />
          <span class="user-title">Production Manager</span>
        </div>

        <div>
          <ul>
            <li>
              <a href="<?=ROOT?>/ProductionManagerHome"
                ><img src="<?=ROOT?>/assets/images/dashboard.svg" alt="dashboard" /><span
                  class="sidebar-titles"
                  >Dashboard</span
                ></a
              >
            </li>

            <li>
              <a href="<?=ROOT?>/PendingCustomOrder"
                ><img src="<?=ROOT?>/assets/images/order.svg" /><span
                  class="sidebar-titles"
                  >Custom Orders</span
                ></a
              >
            </li>
            <li>
              <a href="<?=ROOT?>/RecycledPolythene"
                ><img src="<?=ROOT?>/assets/images/recycle.svg" /><span
                  class="sidebar-titles"
                  >Recycled Polythene</span
                ></a
              >
            </li>
            <li>
              <a href="<?=ROOT?>/Schedule"
                ><img
                  src="<?=ROOT?>/assets/images/collection.svg"
                  alt="site Performance"
                /><span class="sidebar-titles">Polythene Collection</span></a
              >
            </li>
            <li>
              <a href="<?=ROOT?>/SupplyRequest"
                ><img src="<?=ROOT?>/assets/images/supply.svg" alt="supply" /><span
                  class="sidebar-titles"
                  >Supply Requests</span
                ></a
              >
            </li>
            <li>
              <a href="#" class="sidebar-active"
                ><img src="<?=ROOT?>/assets/images/order.svg" alt="supply" /><span
                  class="sidebar-titles"
                  >Pellets Requests</span
                ></a
              >
            </li>
          </ul>
        </div> 
      </div>
    </nav>

    
  <div class="content">
    <header>
      <div class="logo">
      <img src="<?=ROOT?>/assets/images/Waste360.png" alt="logo" />
      <h1>Waste360</h1>  
      </div> 
      <h1 class="logo">DashBoard</h1>
      <nav class="nav">
        <ul>
          <li><a href="<?= ROOT ?>/ProductionManagerProfile">Profile</a></li>
          <li><a href="<?= ROOT ?>/Logout">Logout</a></li>
        </ul>
      </nav>
    </header>

    <div class="box">
      <div class="container">
        <div class="header">
        <h1>Pending Pellets Orders</h1>
        <button class="add-button">
                <a href="<?=ROOT?>/CompletedPellets">View Completed Pellets Requests</a>
            </button>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Comapany Name</th>
                    <th>Amount</th>
                    <th>Date Required</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php if(isset($data['orders']) && is_array($data['orders'])): ?>
                <?php foreach($data['orders'] as $order): ?>
                    <tr>
                        <td><?=htmlspecialchars($order->pelletOrder_id)?></td>
                        <td><?=htmlspecialchars($order->customer_name)?></td>
                        <td><?=htmlspecialchars($order->company_name)?></td>
                        <td><?=htmlspecialchars($order->amount)?></td>
                        <td><?=htmlspecialchars($order->dateRequired)?></td>
                        <td><?=htmlspecialchars($order->pelletOrderStatus)?></td>
                        <td>
                        <div class="buttons">
                            <button class="view-btn" onclick="window.location.href='<?= ROOT ?>/PelletsRequestsViewForm/index/<?= $order->pelletOrder_id ?>'">View</button>
                            </div>
                          </td>
                    </tr>
                <?php endforeach; ?><?php else: ?>
        <tr>
            <td colspan="7" class="no-items">
                <img src="<?= ROOT ?>/assets/images/dolly.svg" alt="All good">
                No pellets reqeusts available
            </td>
        </tr>
        <?php endif; ?></tbody>
        </table>
      </div>
  
   <!-- View Details Modal -->
   <div id="detailsModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeDetailsModal()">&times;</span>
            <h2>Order Details</h2>
            <div id="orderDetails"></div>
        </div>
    </div>

    <!-- Status Update Modal -->
    <div id="statusModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Update Order Status</h2>
            <form id="statusForm" method="POST">
                <div class="form-group">
                    <label>Select Status:</label>
                    <select name="status" required>
                        <option value="accepted">Accept</option>
                        <option value="rejected">Reject</option>
                    </select>
                </div>
                <div class="button-group">
                    <button type="submit" class="submit-btn">Update</button>
                    <button type="button" class="cancel-btn" onclick="closeModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>
     

    </div>
  </div>
  <script src="<?=ROOT?>/assets/js/productionManager/sidebar.js"></script>
  <script src="<?=ROOT?>/assets/js/productionManager/pellets_requests.js"></script>
</body>
</html>