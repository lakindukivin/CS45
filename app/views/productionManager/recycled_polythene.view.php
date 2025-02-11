<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/productionManager/sidebar.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/productionManager/recycled_polythene.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/productionManager/common.css" />
  <title>Waste360|Dashboard|PM</title>
</head>
<?php if(isset($success) && !empty($success)): ?>
    <div class="alert success-message" id="successAlert">
        <?= $success ?>
    </div>
<?php endif; ?>

<body>
  <nav id="sidebar">
    <button id="toggle-btn" onclick="toggleSidebar()" class="toggle-btn">
      <img src="<?= ROOT ?>/assets/images/menu.svg" alt="menu" />
    </button>
    <div class="sidebar-container">
      <div class="prof-picture">
        <img src="<?= ROOT ?>/assets/images/user.svg" alt="profile" />
        <span class="user-title">Production Manager</span>
      </div>

      <div>
        <ul>
          <li>
            <a href="<?= ROOT ?>/productionManagerHome"><img src="<?= ROOT ?>/assets/images/dashboard.svg"
                alt="dashboard" /><span class="sidebar-titles">Dashboard</span></a>
          </li>

          <li>
            <a href="<?= ROOT ?>/PendingCustomOrder"><img
                src="<?= ROOT ?>/assets/images/order.svg" /><span class="sidebar-titles">Custom Orders</span></a>
          </li>
          <li>
            <a href="#" class="sidebar-active"><img src="<?= ROOT ?>/assets/images/recycle.svg" /><span
                class="sidebar-titles">Recycled Polythene</span></a>
          </li>
          <li>
            <a href="<?=ROOT?>/Schedule"><img
                src="<?= ROOT ?>/assets/images/collection.svg" alt="site Performance" /><span class="sidebar-titles">Polythene
                Collection</span></a>
          </li>
          <li>
            <a href="<?=ROOT?>/SupplyRequest"><img
                src="<?= ROOT ?>/assets/images/supply.svg" alt="supply" /><span class="sidebar-titles">Supply Requests</span></a>
          </li>
          <li>
            <a href="<?=ROOT?>/PelletsRequests"><img
                src="<?= ROOT ?>/assets/images/order.svg" alt="supply" /><span class="sidebar-titles">Pellets Requests</span></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <div class="content">
    <header>
      <div class="logo">
        <img src="<?= ROOT ?>/assets/images/Waste360.png" alt="logo" />
        <h1>Waste360</h1>
      </div>
      <h1 class="logo">DashBoard</h1>
      <nav class="nav">
        <ul>
          <li><a href="#"><img src="<?= ROOT ?>/assets/images/notifications.svg"></a></li>
          <li><a href="#">Profile</a></li>
          <li><a href="#">Logout</a></li>
        </ul>
      </nav>
    </header>

    <div class="container">
      <form action="<?=ROOT?>/RecycledPolythene/updateAmount" method="POST" class="form-card">
        <h2>Polythene Collection Details</h2>

        <div class="form-group">
          <label for="amount">Polythene Amount (Tons):</label>
          <input type="number" id="amount" name="amount" step="0.01" min="0" required class="form-control">
          <small class="error-message" id="amountError"></small>
        </div>

        <div class="form-group">
          <label for="message">Message:</label>
          <textarea id="message" name="message" rows="4" class="form-control" required></textarea>
          <small class="error-message" id="messageError"></small>
        </div>

        <div class="form-group">
          <label for="month">Month:</label>
          <select id="month" name="month" class="form-control" required>
            <option value="January">January</option>
            <option value="February">February</option>
            <option value="March">March</option>
            <option value="April">April</option>
            <option value="May">May</option>
            <option value="June">June</option>
            <option value="July">July</option>
            <option value="August">August</option>
            <option value="September">September</option>
            <option value="October">October</option>
            <option value="November">November</option>
            <option value="December">December</option>
          </select>
          <small class="error-message" id="monthError"></small>
        </div>

        <button type="submit" class="submit-btn">Save</button>
      </form>
      <div> <button type="view" class="add-button" ><a href="<?=ROOT?>/PolytheneAmount">View Polythene Amounts</a> </button></div>
    </div>
    <script src="<?= ROOT ?>/assets/js/productionManager/sidebar.js"></script>
    <script src="<?=ROOT?>/assets/js/productionManager/recycled_polythene.js"></script>
</body>

</html>