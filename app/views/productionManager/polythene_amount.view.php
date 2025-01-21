<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/productionManager/sidebar.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/productionManager/schedule.css">
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
              <a href="<?=ROOT?>/productionManagerHome" 
                ><img src="<?=ROOT?>/assets/images/dashboard.svg" alt="dashboard" /><span
                  class="sidebar-titles"
                  >Dashboard</span
                ></a
              >
            </li>

            <li>
              <a href="<?=ROOT?>/PendingCustomOrder"
                ><img src="<?=ROOT?>/assets/images/order.svg"/><span
                  class="sidebar-titles"
                  >Custom Orders</span
                ></a
              >
            </li>
            <li>
              <a href="<?=ROOT?>/RecycledPolythene" class="sidebar-active"
                ><img src="<?=ROOT?>/assets/images/recycle.svg"  /><span
                  class="sidebar-titles"
                  >Recycled Polythene</span
                ></a
              >
            </li>
            <li>
              <a href="<?=ROOT?>/Schedule" 
                ><img
                  src="<?=ROOT?>/assets/images/collection.svg "
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
              <a href="<?=ROOT?>/PelletsRequests"
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
          <li><a href="#"><img src="<?=ROOT?>/assets/images/notifications.svg"></a></li>
          <li><a href="#">Profile</a></li>
          <li><a href="#">Logout</a></li>
        </ul>
      </nav>
    </header>
    <div class="container">
      <h1>Recyled Polythene Amount</h1>
      <div class="table-container">
          <table id="collectionTable">
              <thead>
                  <tr>
                      <th>Amount(Tons)</th>
                      <th>Message</th>
                      <th>Month</th>
                      <th>Updated Date</th>
                  </tr>
                  <tr>
                    <td>10000</td>
                    <td>Recyled Monthly</td>
                    <td>January</td>
                    <td>2023-09-30</td>
                </tr>
                <tr>
                  <td>10000</td>
                  <td>Recyled Monthly</td>
                  <td>February</td>
                  <td>2023-09-30</td>
              </tr>
              <tr>
                <td>10000</td>
                    <td>Recyled Monthly</td>
                    <td>March</td>
                    <td>2023-09-30</td>
            </tr>
          <tr>
            <td>10000</td>
            <td>Recyled Monthly</td>
            <td>April</td>
            <td>2023-09-30</td>
        </tr>
        <tr>
          <td>10000</td>
          <td>Recyled Monthly</td>
          <td>May</td>
          <td>2023-09-30</td>
      </tr>
      <tr>
        <td>10000</td>
        <td>Recyled Monthly</td>
        <td>June</td>
        <td>2023-09-30</td>
    </tr>
    <tr>
      <td>10000</td>
      <td>Recyled Monthly</td>
      <td>July</td>
      <td>2023-09-30</td>
  </tr>
              </thead>
              <tbody>
                  <!-- Table rows will be dynamically added here -->
              </tbody>
          </table>
      </div>
  </div>

  </div>
  <script src="../../javaScript/sidebar.js"></script>
</body>
</html>