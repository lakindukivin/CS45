<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="root-url" content="<?= ROOT ?>">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/common.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/sidebar.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/home.css" />
    <title>Waste360 | Dashboard</title>
</head>

<body>
    <nav id="sidebar">
        <button id="toggle-btn" onclick="toggleSidebar()" class="toggle-btn">
            <img src="<?= ROOT ?>/assets/images/menu.svg" alt="menu" />
        </button>
        <div class="sidebar-container">
            <div class="prof-picture">
                <img src="<?= ROOT ?>/assets/images/user.svg" alt="profile" />
                <span class="user-title">Admin</span>
            </div>

            <div>
                <ul>
                    <li>
                        <a href="#" class="sidebar-active">
                            <img src="<?= ROOT ?>/assets/images/dashboard.svg" alt="dashboard" />
                            <span class="sidebar-titles">Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= ROOT ?>/manageCustomerAccounts">
                            <img src="<?= ROOT ?>/assets/images/customer-account.svg" alt="customer" />
                            <span class="sidebar-titles">Customer Management</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= ROOT ?>/manageStaffAccounts">
                            <img src="<?= ROOT ?>/assets/images/staff-account.svg" alt="staff" />
                            <span class="sidebar-titles">Staff Management</span>
                        </a>


                    </li>

                    <li>
                        <a href="<?= ROOT ?>/issues">
                            <img src="<?= ROOT ?>/assets/images/legal-issues.svg" alt="legal issues" />
                            <span class="sidebar-titles">Issues</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        <header class="header">
            <div class="logo">
                <img src="<?= ROOT ?>/assets/images/Waste360.png" alt="Waste360" />
                <h1>Waste360</h1>
            </div>

            <h1 class="logo">Dashboard</h1>

            <nav class="nav">
                <ul>
                    <li>
                        <a href="#"><img onclick="openNotificationModal()"
                                src="<?= ROOT ?>/assets/images/notifications.svg" alt="" /></a>
                    </li>
                    <li>
                        <a href="<?= ROOT ?>/AdminProfile">Profile</a>
                    </li>
                    <li>
                        <a href="<?= ROOT ?>/Logout">Log Out</a>
                    </li>
                </ul>
            </nav>
        </header>

        <div class="top">
            <div class="left">

                <div class="panel-card">
                    <h4><i class="fas fa-bell"></i> Recent Issues</h4>
                    <div class="notification-list">
                        <?php if (empty($notifications)): ?>
                            <p class="no-notifications">No recent issues reported</p>
                        <?php else: ?>
                            <?php
                            $currentDate = null;
                            foreach ($notifications as $notification):
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
                                    data-id="<?= $notification['id'] ?>" data-type="<?= $notification['type'] ?>">
                                    <div class="notification-icon">
                                        <img src="<?= ROOT ?>/assets/images/legal-issues.svg" alt="issue">
                                    </div>
                                    <div class="notification-content">
                                        <p class="notification-message"><?= $notification['message'] ?></p>
                                        <p class="notification-email"><?= $notification['email'] ?></p>
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


            <div class="status-section">
                <div class="time-display">
                    <h3>Current Time</h3>
                    <div id="clock" class="clock">Loading...</div>
                </div>
                <div class="metric-grid">
                    <a href="<?= ROOT ?>/manageStaffAccounts">
                        <div class="metric-card">
                            <h4>Total Staff</h4>
                            <div class="metric-value">
                                <span id="totalStaff"><?= isset($totalStaff) ? $totalStaff : 0 ?></span>
                            </div>
                        </div>
                    </a>
                    <a href="<?= ROOT ?>/manageCustomerAccounts">
                        <div class="metric-card">
                            <h4>Total Customers</h4>
                            <div class="metric-value">
                                <span id="totalCustomers"><?= isset($totalCustomers) ? $totalCustomers : 0 ?></span>
                            </div>
                        </div>
                    </a>
                    <!-- <div class="metric-card">
                        <h4>Site Performance</h4>
                        <div class="metric-value">
                            <img src="<?= ROOT ?>/assets/images/graph1.png" alt="graph" height="100px" width="200px" />
                        </div>
                    </div> -->

                </div>
                <div class="container">
                    <section class="performance-section">
                        <div class="user-traffic">
                            <h3>User Traffic Information</h3>
                            <p>Total Visits (24h): <span id="total-visits">Loading...</span></p>
                            <p>Unique Visitors: <span id="unique-visitors">Loading...</span></p>
                            <p>Average Time on Site: <span id="avg-time">Loading...</span></p>
                        </div>

                        <div class="user-traffic-trend">
                            <h3>User Traffic Trend (Last 7 Days)</h3>
                            <canvas id="trafficTrendChart" width="400" height="200"></canvas>
                        </div>
                    </section>
                </div>
            </div>


            <div class="modal" id="notificationModal">
                <div class="modal-content">
                    <div class="modal-header">
                        <span onclick="closeNotificationModal()" class="close">&times;</span>
                        <h2>Notifications</h2>
                    </div>
                    <div class="panel-card">
                        <h4><i class="fas fa-bell"></i> Recent Issues</h4>
                        <div class="notification-list">
                            <?php if (empty($notifications)): ?>
                                <p class="no-notifications">No recent issues reported</p>
                            <?php else: ?>
                                <?php
                                $currentDate = null;
                                foreach ($notifications as $notification):
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
                                        data-id="<?= $notification['id'] ?>" data-type="<?= $notification['type'] ?>">
                                        <div class="notification-icon">
                                            <img src="<?= ROOT ?>/assets/images/legal-issues.svg" alt="issue">
                                        </div>
                                        <div class="notification-content">
                                            <p class="notification-message"><?= $notification['message'] ?></p>
                                            <p class="notification-email"><?= $notification['email'] ?></p>
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



        </div>


    </main>


    <script src="<?= ROOT ?>/assets/js/admin/sidebar.js"></script>
    <script src="<?= ROOT ?>/assets/js/admin/home.js"></script>
    <script src="<?= ROOT ?>/assets/js/notifications.js"></script>
</body>

</html>