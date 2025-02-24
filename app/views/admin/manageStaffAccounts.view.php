<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/common.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/sidebar.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/manageStaffAccounts.css" />
    <title>Waste360 | Manage Staff Accounts</title>
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
                                <a class="sidebar-titles sidebar-active" href="<?= ROOT ?>/manageStaffAccounts">
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
        <header>
            <div class="logo">
                <img src="<?= ROOT ?>/assets/images/Waste360.png" alt="Waste360" />
                <h1>Waste360</h1>
            </div>
            <div class="page-title">
                <p>Staff Management</p>
            </div>
            <nav class="header-nav">
                <a href="#"><img src="<?= ROOT ?>/assets/images/notifications.svg" alt="" /></a>
                <a href="#">Profile</a>
                <a href="#">Log Out</a>
            </nav>
        </header>

        <div class="container">
            

            <div class="table-header">
                <div class="search-bar">
                    <img src="<?= ROOT ?>/assets/images/magnifying-glass-solid.svg" class="search-icon" />
                    <input type="text" />
                    <button>Search</button>
                </div>

                <div class="total-users">
                    Total Staff: <span id="totalUsers">0</span>
                </div>
            </div>

            <table id="staffTable">
                <thead>
                    <tr>
                        <th>Staff ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact No.</th>
                        <th>Address</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Duties</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="staffTableBody"></tbody>
            </table>
        </div>

        <div id="editModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeEditModal()">&times;</span>
                <h3>Edit Staff Details</h3>
                <form id="editStaffAccounts" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="userId" id="userId" />
                    <div class="form-group">
                        <label for="editStaffName">Name:</label>
                        <input name="editStaffName" type="text" id="editStaffName" placeholder="Enter Staff Name"
                            required />
                    </div>

                    <div class="form-group">
                        <label for="editStaffEmail">Email</label>
                        <input name="editStaffEmail" type="email" id="editStaffEmail" placeholder="Enter Staff Email"
                            required />
                    </div>
                    <div class="form-group">
                        <label for="editStaffContactNo">Contact No</label>
                        <input name="editStaffContactNo" type="text" id="editStaffContactNo"
                            placeholder="Enter Staff Contact Number" required />
                    </div>
                    <div class="form-group">
                        <label for="editStaffAddress">Address</label>
                        <textarea name="editStaffAddress" id="editStaffAddress" required></textarea>
                    </div>

                    <button type="button" class="action-btn">Update</button>
                </form>
            </div>
        </div>
    </main>

    <script src="<?= ROOT ?>/assets/js/admin/sidebar.js"></script>
    <script src="<?= ROOT ?>/assets/js/admin/modal.js"></script>
    <script src="<?= ROOT ?>/assets/js/admin/manageStaffAccounts.js"></script>
</body>

</html>