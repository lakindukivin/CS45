<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/common.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/sidebar.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/sitePerformance.css" />
    <title>Waste360 | Site Performance</title>
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
                <img src="<?= ROOT ?>/assets/images/profile-circle.svg" alt="profile" />
                <span class="user-title">Admin</span>
            </div>

            <div>
                <ul>
                    <li>
                        <a href="<?= ROOT ?>/adminHome">
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
                        <a href="<?= ROOT ?>/legalIssues">
                            <img src="<?= ROOT ?>/assets/images/legal-issues.svg" alt="legal issues" />
                            <span class="sidebar-titles">Issues</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= ROOT ?>/siteperformance" class="sidebar-active">
                            <img src="<?= ROOT ?>/assets/images/site-performance.svg" alt="site Performance" />
                            <span class="sidebar-titles">Site Performance</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <header>
            <div class="logo">
                <img src="<?= ROOT ?>/assets/images/Waste360.png" alt="Waste360" />
                <h1>Waste360</h1>
            </div>
            <div class="page-title">
                <p>Site Performance</p>
            </div>
            <nav class="header-nav">
                <a href="#"><img src="<?= ROOT ?>/assets/images/notifications.svg" alt="" /></a>
                <a href="#">Profile</a>
                <a href="#">Log Out</a>
            </nav>
        </header>

        <div class="performance-container">
            <section class="performance-section">
                <div class="user-traffic">
                    <h3>User Traffic Information</h3>
                    <p>Total Visits (24h): <span id="total-visits">Loading...</span></p>
                </div>

                <div class="user-traffic-trend">
                    <h3>User Traffic Trend (Last 24h)</h3>
                    <canvas id="trafficChart"></canvas>
                </div>

                <div class="server-status">
                    <h3>Server Status</h3>
                    <table>
                        <tr>
                            <th>Uptime</th>
                            <td>12h</td>
                        </tr>
                        <tr>
                            <th>CPU Usage</th>
                            <td>55%</td>
                        </tr>
                        <tr>
                            <th>Memory Usage</th>
                            <td>65</td>
                        </tr>
                        <tr>
                            <th>Disk I/O</th>
                            <td>120Mbps</td>
                        </tr>
                    </table>
                </div>

                <div class="server-table">
                    <button onclick="openErrorLogs()">Open Error Logs</button>
                </div>
            </section>
        </div>

        <!-- Error Logs Modal -->
        <div id="errorLogsModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeErrorLogs()">&times;</span>
                <h2>Error Logs</h2>
                <label for="filter">Filter by Severity:</label>
                <select id="filter">
                    <option>All</option>
                    <option>Critical</option>
                    <option>Warning</option>
                    <option>Info</option>
                </select>
                <table>
                    <tr>
                        <th>Time</th>
                        <th>Severity</th>
                        <th>Description</th>
                    </tr>
                    <tr>
                        <td>2024-11-10 14:32</td>
                        <td>Critical</td>
                        <td>Database connection failure</td>
                    </tr>
                    <tr>
                        <td>2024-11-10 12:10</td>
                        <td>Warning</td>
                        <td>High memory usage</td>
                    </tr>
                </table>
            </div>
        </div>
    </main>

    <script src="<?= ROOT ?>/assets/js/admin/sidebar.js"></script>
    <script src="<?= ROOT ?>/assets/js/admin/sitePerformance.js"></script>
</body>

</html>