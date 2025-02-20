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
    <form method="POST" action="<?=ROOT?>/Reviews">
        <div class="form-row">
            <div class="form-group">
                <label for="review-id">Review ID</label>
                <input type="text" id="review-id" name="review-id" value="<?=esc($review['review_id'])?>" readonly>
            </div>
            <div class="form-group">
                <label for="customer-id">Customer ID</label>
                <input type="text" id="customer-id" name="customer-id" value="<?=esc($review['customer_id'])?>" readonly>
            </div>
            <div class="form-group">
                <label for="order-id">Order ID</label>
                <input type="text" id="order-id" name="order-id" value="<?=esc($review['order_id'])?>" readonly>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label for="Rating">Rating</label>
                <input type="text" id="rating" name="rating" value="<?=esc($review['rating'])?>" readonly>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" value="<?=esc($review['date'])?>" readonly>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label for="comment">Comment</label>
                <textarea id="comment" name="comment" readonly><?=esc($review['comment'])?></textarea>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label for="reply">Reply</label>
                <textarea id="reply" name="reply" placeholder="Enter your reply" required></textarea>
            </div>
        </div>
        <button type="submit" class="submit-button">Submit Reply</button>  
    </form>
</div>

</body>
</html>