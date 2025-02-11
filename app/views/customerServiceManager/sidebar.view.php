<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/customerServiceManager/sidebar.css">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/customerServiceManager/common.css">
  <title>Document</title>
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
              <a href="<?=ROOT?>/manage_reviews/manage_reviews.php"
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
</body>
</html>