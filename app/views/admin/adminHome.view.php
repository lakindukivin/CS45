<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/common.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/sidebar.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/home.css" />
    <title>Waste360 | Dashboard</title>
</head>

<body>
    <?php
    if (isset($_SESSION['user_id'])) {
        $profileLink = ROOT . '/profile';
    } else {
        $profileLink = ROOT . '/login';
    }
    ?>
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
                        <button onclick="toggleSubMenu()" class="dropdown-button">
                            <img src="<?= ROOT ?>/assets/images/manage-accounts.svg" alt="" />
                            <span class="sidebar-titles">Manage Accounts</span>
                            <img src="<?= ROOT ?>/assets/images/dropdownbtn.svg" alt="dropdown-button"
                                id="dropdownbtn-img" />
                        </button>

                        <ul id="sub-menu" class="sub-menu">
                            <li>
                                <a class="sidebar-titles" href="<?= ROOT ?>/manageCustomerAccounts">
                                    Manage Customer Accounts
                                </a>
                            </li>
                            <li>
                                <a class="sidebar-titles" href="<?= ROOT ?>/manageStaffAccounts">
                                    Manage Staff Accounts
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="<?= ROOT ?>/issues">
                            <img src="<?= ROOT ?>/assets/images/legal-issues.svg" alt="legal issues" />
                            <span class="sidebar-titles">Issues</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= ROOT ?>/siteperformance">
                            <img src="<?= ROOT ?>/assets/images/site-performance.svg" alt="site Performance" />
                            <span class="sidebar-titles">Site Performance</span>
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
                        <a href="#"><img src="<?= ROOT ?>/assets/images/notifications.svg" alt="" /></a>
                    </li>
                    <li>
                        <a href="#">Profile</a>
                    </li>
                    <li>
                        <a href="#">Log Out</a>
                    </li>
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
                    <div class="days" id="dates"></div>
                </div>
            </div>

            <div class="status-section">
                <div class="time-display">
                    <h3>Current Time</h3>
                    <div id="clock" class="clock">Loading...</div>
                </div>
                <div class="metric-grid">
                    <div class="metric-card">
                        <h4>Total Staff</h4>
                        <div class="metric-value">10+</div>
                    </div>
                    <div class="metric-card">
                        <h4>Total Users</h4>
                        <div class="metric-value">100+</div>
                    </div>
                    <div class="metric-card">
                        <h4>Site Performance</h4>
                        <div class="metric-value">
                            <img src="<?= ROOT ?>/assets/images/graph1.png" alt="graph" height="100px" width="200px" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <script src="<?= ROOT ?>/assets/js/admin/sidebar.js"></script>
    <script src="<?= ROOT ?>/assets/js/admin/home.js"></script>
</body>

</html>