<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/common.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/sidebar.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/manageCustomerAccounts.css" />
    <title>Waste360 | Manage Customer Accounts</title>
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
                                <a class="sidebar-titles sidebar-active" href="<?= ROOT ?>/manageCustomerAccounts">
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

            <h1 class="logo">Customer Accounts</h1>

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

        <div class="container">

            <div class="table-header">
                <div class="search-bar">
                    <img src="<?= ROOT ?>/assets/images/magnifying-glass-solid.svg" class="search-icon" />
                    <input type="text" />
                    <button>Search</button>
                </div>

                <div class="total-users">
                    Total Customers: <span id="totalUsers">0</span>
                </div>
            </div>

            <table id="customerTable">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact No.</th>
                        <th>Address</th>
                        <th>Give Away Amount</th>
                        <th>Purchased Amount</th>
                        <th>Saved Carbon Footprint</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="customerTableBody"></tbody>
            </table>
        </div>

        <div id="editModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeEditModal()">&times;</span>
                <h3>Edit Customer Details</h3>
                <form id="editCustomerAccounts" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="userId" id="userId" />
                    <div class="form-group">
                        <label for="editCustomerName">Customer Name:</label>
                        <input name="editCustomerName" type="text" id="editCustomerName"
                            placeholder="Enter customer Name" required />
                    </div>

                    <div class="form-group">
                        <label for="editCustomerEmail">Customer Email</label>
                        <input name="editCustomerEmail" type="email" id="editCustomerEmail"
                            placeholder="Enter customer Email" required />
                    </div>
                    <div class="form-group">
                        <label for="editCustomerContactNo">Contact No</label>
                        <input name="editCustomerContactNo" type="text" id="editCustomerContactNo"
                            placeholder="Enter customer Contact Number" required />
                    </div>
                    <div class="form-group">
                        <label for="editCustomerAddress">Address</label>
                        <textarea name="editCustomerAddress" id="editCustomerAddress" required></textarea>
                    </div>

                    <button type="button" class="action-btn">Update</button>
                    <button type="button" class="cancel-btn">Cancel</button>
                </form>
            </div>

            <!-- Delete Confirmation Modal -->
            <div id="deleteModal" class="modal">
                <div class="modal-content">
                    <p>Are you sure you want to delete this customer?</p>
                    <button id="confirmDelete" class="confirm-btn">Yes, Delete</button>
                    <button id="cancelDelete" class="cancel-btn">Cancel</button>
                </div>
            </div>

            <!-- Success Message Modal -->
            <div id="successMessage" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeSuccessMessage()">&times;</span>
                    <p>Customer deleted successfully!</p>
                    <button id="closeSuccess" class="close">Close</button>
                </div>
            </div>
        </div>
    </main>

    <script src="<?= ROOT ?>/assets/js/admin/modal.js"></script>
    <script src="<?= ROOT ?>/assets/js/admin/sidebar.js"></script>
    <script src="<?= ROOT ?>/assets/js/admin/manageCustomerAccounts.js"></script>
</body>

</html>