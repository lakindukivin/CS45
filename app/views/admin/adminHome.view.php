<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= ROOT ?>/src/roles/admin/styles/sidebar.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/src/roles/admin/styles/common.css" />
    <!-- <link rel="stylesheet" href="/src/roles/admin/styles/home.css" /> -->
    <title>Waste360|Dashboard</title>
</head>

<body>
    <nav id="sidebar">
        <button id="toggle-btn" onclick="toggleSidebar()" class="toggle-btn">
            <img src="<?= ROOT ?>/src/roles/admin/assets/menu.svg" alt="menu" />
        </button>
        <div class="sidebar-container">
            <div class="prof-picture">
                <img src="<?= ROOT ?>/src/roles/admin/assets/user.svg" alt="profile" />
                <span class="user-title">Admin</span>
            </div>

            <div>
                <ul>
                    <li>
                        <a href="#" class="sidebar-active"><img src="<?= ROOT ?>/src/roles/admin/assets/dashboard.svg" alt="dashboard" /><span
                                class="sidebar-titles">Dashboard</span></a>
                    </li>

                    <li>
                        <button onclick="toggleSubMenu()" class="dropdown-button">
                            <img src="<?= ROOT ?>/src/roles/admin/assets/manage-accounts.svg" alt="" />
                            <span class="sidebar-titles">Manage Accounts</span><img
                                src="<?= ROOT ?>/src/roles/admin/assets/dropdownbtn.svg"
                                alt="dropdown-button"
                                id="dropdownbtn-img" />
                        </button>

                        <ul id="sub-menu" class="sub-menu">
                            <li>
                                <a
                                    class="sidebar-titles"
                                    href="<?= ROOT ?>/src/roles/admin/html/manageAccounts/manageCustomerAccounts.html">Manage Customer Accounts</a>
                            </li>
                            <li>
                                <a
                                    class="sidebar-titles"
                                    href=".<?= ROOT ?>/src/roles/admin/html/manageAccounts/manageStaffAccounts.html">Manage Staff Accounts</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="<?= ROOT ?>/src/roles/admin/html/legalIssues/legalIssues.html"><img
                                src="<?= ROOT ?>/src/roles/admin/assets/legal-issues.svg"
                                alt="legal issues" /><span class="sidebar-titles">Issues</span></a>
                    </li>
                    <li>
                        <a href="<?= ROOT ?>/src/roles/admin/html/siteperformance/sitePerformance.html"><img
                                src="<?= ROOT ?>/src/roles/admin/assets/site-performance.svg"
                                alt="site Performance" /><span class="sidebar-titles">Site Performance</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        <header>
            <div class="logo">
                <img src="<?= ROOT ?>/src/roles/admin/assets/Waste360.png" alt="Waste360" />
                <h1>Waste360</h1>
            </div>
            <div class="page-title">
                <p>Dashboard</p>
            </div>
            <nav class="header-nav">
                <a href="#"><img src="<?= ROOT ?>/src/roles/admin/assets/notifications.svg" alt="" /></a>
                <a href="#">Profile</a>
                <a href="<?= ROOT ?>/login">Log Out</a>
            </nav>
        </header>

        <!-- <footer>
        <div class="logo">
            <img src="/src/roles/admin/assets/Waste360.png" alt="Waste360">
        </div>
        <p>&copy; 2024 Waste360. All rights reserved.</p>
    </footer> -->
        <script src="<?= ROOT ?>/src/roles/admin/javaScript/sidebar.js"></script>
    </main>
</body>

</html>