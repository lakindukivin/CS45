<!-- filepath: c:\xampp\htdocs\CS45\app\views\customerServiceManager\manage_reviews.view.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/customerServiceManager/sidebar.css">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/customerServiceManager/manage_reviews.css">
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
            <a href="<?=ROOT?>/CSManagerHome"><img src="<?=ROOT?>/assets/images/dashboard.svg" alt="dashboard" /><span
                class="sidebar-titles">Dashboard</span></a>
          </li>

          <li>
            <a href="<?=ROOT?>/GiveAwayRequest"><img src="<?=ROOT?>/assets/images/give_away.svg" /><span
                class="sidebar-titles">Give Away</span></a>
          </li>
          <li>
            <a href="<?=ROOT?>/Returns"><img src="<?=ROOT?>/assets/images/returns.svg" /><span
                class="sidebar-titles">Returns</span></a>
          </li>
          <li>
            <a href="<?=ROOT?>/ManageOrders"><img src="<?=ROOT?>/assets/images/manage_order.svg" /><span
                class="sidebar-titles">Manage order</span></a>
          </li>
          <li>
            <a href="#" class="sidebar-active"><img src="<?=ROOT?>/assets/images/reviews.svg" /><span
                class="sidebar-titles">Manage Reviews</span></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="content">
  <div id="reviewUpdatePopup" style="display: none;">
    <div class="popup-content">
        <form action="<?=ROOT?>/ManageReviews/addReply" method="POST" class="bg-white p-5 rounded-md w-full">
            <div class="popup-content">
            <span class="close" id="closePopup">&times;</span>

                <h1>Update Review</h1>
            </div>
            <div class="popup-content">
            <div>
                <label for="review_id">Review ID:</label>
                <input type="text" id="review_id" name="review_id" readonly>
            </div>

            <div>
                <label for="customer_id">Customer ID:</label>
                <input type="text" id="customer_id" name="customer_id" readonly>
            </div>

            <div>
                <label for="order_id">Order ID:</label>
                <input type="text" id="order_id" name="order_id" readonly>
            </div>
            </div>
            

            <div class="popup-content">
                <label for="rating">Rating:</label>
                <input type="text" id="rating" name="rating" readonly>
            </div>

            <div class="popup-content">
                <label for="date">Date:</label>
                <input type="text" id="date" name="date" readonly>
            </div>

            <div class="popup-content">
                <label for="review">Review:</label>
                <textarea id="comment" name="comment" rows="4" cols="50" readonly></textarea>
            </div>

            <div class="popup-content">
                <label for="reply">Reply:</label>
                <textarea id="reply" name="reply" rows="4" cols="50" required></textarea>
            </div>

            <div class="button-container">
                <button type="submit" class="accept">Submit</button>
            </div>
        </form>
    </div>
</div>
    <header class="header">
      <div class="logo">
        <img src="<?=ROOT?>/assets/images/Waste360.png" alt="logo" />
        <h1>Waste360</h1>
      </div>
      <h1 class="logo">Pending Reviews</h1>
      <nav class="nav">
        <ul>
          <li><a href="#"><img src="<?=ROOT?>/assets/images/notifications.svg"></a></li>
          <li><a href="<?=ROOT?>/profile">Profile</a></li>
          <li><a href="<?=ROOT?>/logout">Logout</a></li>
        </ul>
      </nav>
    </header>

    <div class="box">
      <div class="container">
        <div class="header">
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
          <button class="add-button">
            <a href="<?=ROOT?>/CompletedReviews">View Replied Reviews</a>
          </button>
        </div>
        <table>
          <thead>
            <tr>
              <th>Customer ID</th>
              <th>Order ID</th>
              <th>Rating</th>
              <th>Date</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php if(isset($data['reviews']) && is_array($data['reviews'])): ?>
            <?php foreach($data['reviews'] as $review): ?>
            <tr>
              <td><?=$review->customer_id?></td>
              <td><?=$review->order_id?></td>
              <td><?=$review->rating?></td>
              <td><?=$review->date?></td>
              <td>
              <button class="view-btn" onclick="openReviewUpdatePopup(<?= htmlspecialchars(json_encode($review),ENT_QUOTES,'UTF-8')?>)"><img src="<?= ROOT ?>/assets/images/edit-btn.svg" alt=""></button>
              </td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="7">No reviews found</td>
              </tr>
            <?php endif; ?>  
          </tbody>
        </table>

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
    <p class="message-text">The reply was successfully added!</p>
</div>

<div id="errorMessage" class="error-message" style="display: none;">
    <div class="icon">❌</div>
    <p class="message-text">The reply cannot be empty!</p>
</div>

  <script src="<?=ROOT?>/assets/js/customerServiceManager/manage_reviews.js"></script>
  <script src="<?=ROOT?>/assets/js/customerServiceManager/sidebar.js"></script>
</body>
</html>