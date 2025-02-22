<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/customerServiceManager/sidebar.css">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/customerServiceManager/common.css">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/customerServiceManager/manage_reviews.css">
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
            <a href="<?=ROOT?>/CSManagerHome"><img
                src="<?=ROOT?>/assets/images/dashboard.svg" alt="dashboard" /><span
                class="sidebar-titles">Dashboard</span></a>
          </li>

          <li>
            <a href="<?=ROOT?>/GiveAwayRequest"><img
                src="<?=ROOT?>/assets/images/give_away.svg" /><span class="sidebar-titles">Give Away</span></a>
          </li>
          <li>
            <a href="<?=ROOT?>/Returns"><img
                src="<?=ROOT?>/assets/images/returns.svg" /><span class="sidebar-titles">Returns</span></a>
          </li>
          <li>
            <a href="<?=ROOT?>/ManageOrders"><img
                src="<?=ROOT?>/assets/images/manage_order.svg" /><span class="sidebar-titles">Manage order</span></a>
          </li>
          <li>
            <a href="<?=ROOT?>/ManageReviews" class="sidebar-active"><img src="<?=ROOT?>/assets/images/reviews.svg" /><span
                class="sidebar-titles">Manage Reviews</span></a>
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


    <div class="form">
    <form method="POST" action="<?=ROOT?>/Reviews/reply">
        <input type="hidden" name="Review_id" value="<?=esc($review->Review_id)?>">
        
        <div class="form-row">
            <div class="form-group">
                <label>Review ID</label>
                <input type="text" value="<?=esc($review->Review_id)?>" readonly>
            </div>
            <div class="form-group">
                <label>Customer Name</label>
                <input type="text" value="<?=esc($review->customer_name)?>" readonly>
            </div>
            <div class="form-group">
                <label>Order ID</label>
                <input type="text" value="<?=esc($review->order_id)?>" readonly>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Rating</label>
                <input type="text" value="<?=esc($review->Rating)?>" readonly>
            </div>
            <div class="form-group">
                <label>Date</label>
                <input type="text" value="<?=esc($review->Date)?>" readonly>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Comment</label>
                <textarea readonly><?=esc($review->comment)?></textarea>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Reply</label>
                <textarea name="reply" required></textarea>
            </div>
        </div>

        <button type="submit">Submit Reply</button>
    </form>
</div>

</div> 
</body>
</html>