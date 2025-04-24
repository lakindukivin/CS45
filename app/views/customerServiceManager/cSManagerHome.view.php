<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="root-url" content="<?= ROOT ?>">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/customerServiceManager/sidebar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/customerServiceManager/home.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/customerServiceManager/common.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/customerServiceManager/notifications.css">
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
                <span class="user-title">Customer Service Manager</span>
            </div>

            <div>
                <ul>
                    <li>
                        <a href="#" class="sidebar-active"><img src="<?= ROOT ?>/assets/images/dashboard.svg" alt="dashboard" /><span
                                class="sidebar-titles">Dashboard</span></a>
                    </li>

                    <li>
                        <a href="<?= ROOT ?>/GiveAwayRequest"><img src="<?= ROOT ?>/assets/images/give_away.svg" /><span
                                class="sidebar-titles">Give Away</span></a>
                    </li>
                    <li>
                        <a href="<?= ROOT ?>/Returns"><img src="<?= ROOT ?>/assets/images/returns.svg" /><span
                                class="sidebar-titles">Returns</span></a>
                    </li>
                    <li>
                        <a href="<?= ROOT ?>/ManageOrders"><img
                                src="<?= ROOT ?>/assets/images/manage_order.svg" /><span class="sidebar-titles">Manage Orders</span></a>
                    </li>
                    <li>
                        <a href="<?= ROOT ?>/ManageReviews"><img src="<?= ROOT ?>/assets/images/reviews.svg" /><span
                                class="sidebar-titles">Manage Reviews</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="content">
        <header class="header">
            <div class="logo">
                <img src="<?= ROOT ?>/assets/images/Waste360.png" alt="logo" />
                <h1>Waste360</h1>
            </div>
            <h1 class="logo">DashBoard</h1>
            <div class="time-display">
                    <div id="clock" class="clock">Loading...</div>
                </div>
            <nav class="nav">
                <ul>
                    <li><a href="<?= ROOT ?>/staffprofile">Profile</a></li>
                    <li><a href="<?= ROOT ?>/logout">Logout</a></li>
                </ul>
            </nav>
        </header>

        <div class="top">
            <div class="left">
                <div class="calendar">
                    <div class="calendar-header">
                        <button onclick="prevMonth()">‹</button>
                        <h2 id="monthYear"></h2>
                        <button onclick="nextMonth()">›</button>
                    </div>
                    <div class="days">
                        <div class="day">Sun</div>
                        <div class="day">Mon</div>
                        <div class="day">Tue</div>
                        <div class="day">Wed</div>
                        <div class="day">Thu</div>
                        <div class="day">Fri</div>
                        <div class="day">Sat</div>
                    </div>
                    <div class="days" id="dates">
                        <!-- Example of dynamically generated dates -->
                        <div class="date" data-date="2025-04-20">20</div>
                        <div class="date" data-date="2025-04-21">21</div>
                        <!-- Add more dates dynamically -->
                    </div>
                </div>
                <div class="notification">
                    <div class="panel-card">
                        <h4><i class="fas fa-bell"></i> Pending Notifications</h4>
                        <div class="notification-list">
                            <?php if (empty($notifications)): ?>
                                <p class="no-notifications">No recent notifications</p>
                            <?php else: ?>
                                <?php 
                                $currentDate = null;
                                foreach($notifications as $notification): 
                                    $notificationDate = date('Y-m-d', $notification['timestamp']);
                                    $today = date('Y-m-d');
                                    $yesterday = date('Y-m-d', strtotime('-1 day'));
                                    
                                    // Display date separators
                                    if ($currentDate != $notificationDate) {
                                        $currentDate = $notificationDate;
                                        $dateLabel = '';
                                        
                                        if ($currentDate == $today) {
                                            $dateLabel = 'Today';
                                        } else if ($currentDate == $yesterday) {
                                            $dateLabel = 'Yesterday';
                                        } else {
                                            $dateLabel = date('F j, Y', strtotime($currentDate));
                                        }
                                        
                                        echo '<div class="notification-time-indicator"><span>' . $dateLabel . '</span></div>';
                                    }
                                ?>
                                    <div class="notification-item notification-<?= $notification['type'] ?>" 
                                         data-id="<?= $notification['id'] ?>"
                                         data-type="<?= $notification['type'] ?>">
                                        <div class="notification-icon">
                                            <?php if($notification['type'] == 'order'): ?>
                                                <img src="<?= ROOT ?>/assets/images/manage_order.svg" alt="">
                                            <?php elseif($notification['type'] == 'giveaway'): ?>
                                                <img src="<?= ROOT ?>/assets/images/give_away.svg" alt="">
                                            <?php elseif($notification['type'] == 'review'): ?>
                                                <img src="<?= ROOT ?>/assets/images/reviews.svg" alt="">
                                            <?php elseif($notification['type'] == 'return'): ?>
                                                <img src="<?= ROOT ?>/assets/images/returns.svg" alt="">
                                            <?php endif; ?>
                                        </div>
                                        <div class="notification-content">
                                            <p class="notification-message"><?= $notification['message'] ?></p>
                                            <p class="notification-date">
                                                <span><?= date('h:i A', $notification['timestamp']) ?></span>
                                            </p>
                                        </div>
                                        <div class="notification-status <?= strtolower($notification['status']) ?>">
                                            <?= ucfirst($notification['status']) ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!--timee-->
            <div class="status-section">
                <div class="metric-grid">
                    <div class="metric-card">
                        <h4>Give Aways</h4>
                        <div class="metric-value" id="giveaways-count"><?= $giveaways ?></div>
                    </div>
                    <div class="metric-card">
                        <h4>Returns</h4>
                        <div class="metric-value" id="returns-count"><?= $returns ?></div>
                    </div>
                    <div class="metric-card">
                        <h4>Orders</h4>
                        <div class="metric-value" id="orders-count"><?= $orders ?></div>
                    </div>
                    <div class="metric-card">
                        <h4>Reviews</h4>
                        <div class="metric-value" id="reviews-count"><?= $reviews ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= ROOT ?>/assets/js/customerServiceManager/home.js"></script>
    <script src="<?= ROOT ?>/assets/js/customerServiceManager/sidebar.js"></script>
    <script src="<?= ROOT ?>/assets/js/customerServiceManager/notifications.js"></script>
</body>

</html>