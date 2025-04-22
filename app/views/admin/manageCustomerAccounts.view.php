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
                        <a href="#" class="sidebar-active">
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
                            <img src="<?= ROOT ?>/assets/images/legal-issues.svg" alt="issues" />
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
                        <a href="<?= ROOT ?>/Logout">Log Out</a>
                    </li>
                </ul>
            </nav>
        </header>

        <div class="container">
            <div class="table-header">
                <form class="search-bar" method="get" action="">
                        <img src="<?= ROOT ?>/assets/images/magnifying-glass-solid.svg" class="search-icon" width="20px" />
                    <input type="text" name="search" value="<?= isset($search) ? htmlspecialchars($search) : '' ?>"
                        placeholder="Search customer by name,email.." />
                    <button type="submit">Search</button>
                </form>
                <div class="total-users">
                    Total Customers: <span
                        id="totalUsers"><?= isset($customerAccounts) ? count($customerAccounts) : 0 ?></span>
                </div>
                
            </div>

            <table id="customerTable">
                <thead>
                    <tr>
                        <th>Customer ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact No.</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($customerAccounts)): ?>
                        <?php foreach ($customerAccounts as $customer): ?>
                            <tr>
                                <td><?= htmlspecialchars($customer->customer_id) ?></td>
                                <td><?= htmlspecialchars($customer->name) ?></td>
                                <td><?= htmlspecialchars($customer->email) ?></td>
                                <td><?= htmlspecialchars($customer->phone) ?></td>
                                <td><?= htmlspecialchars($customer->address) ?></td>
                                <td><?= $customer->status == 1 ? 'Active' : 'Inactive' ?></td>
                                <td class="action-buttons">
                                    <button class="edit-btn"
                                        onclick="openEditModal('<?= $customer->customer_id ?>','<?= $customer->name  ?>','<?= $customer->image ?>','<?= $customer->phone ?>','<?= $customer->address ?>','<?= $customer->status ?>')"><img src="<?= ROOT ?>/assets/images/edit-btn.svg"" alt=" edit"></button>
                                    <button class="delete-btn"
                                        onclick="openDeleteModal('<?= $customer->customer_id ?>')"><img src="<?= ROOT ?>/assets/images/delete-btn.svg"" alt=" delete"></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">No customer accounts found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

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

        <!-- Edit Customer Modal -->
        <div id="editModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeEditModal()">&times;</span>
                <h3>Edit Customer Details</h3>
                <form id="editCustomerForm" action="<?= ROOT ?>/ManageCustomerAccounts/update" method="post">
                    <input type="hidden" name="editCustomerId" id="editCustomerId" />
                    <div class="form-group">
                        <label for="editCustomerName">Name:</label>
                        <input name="editCustomerName" type="text" id="editCustomerName" required />
                    </div>
                    <div class="form-group">
                        <label for="editCustomerImage">Image:</label>
                        <input name="editCustomerImage" type="file" id="editCustomerImage" required />
                    </div>
                    <div class="form-group">
                        <label for="editCustomerContactNo">Contact No:</label>
                        <input name="editCustomerContactNo" type="text" id="editCustomerContactNo" required />
                    </div>
                    <div class="form-group">
                        <label for="editCustomerAddress">Address:</label>
                        <textarea name="editCustomerAddress" id="editCustomerAddress" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="editCustomerStatus">Status:</label>
                        <select name="editCustomerStatus" id="editCustomerStatus" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="action-btn">Update</button>
                    <button type="button" class="action-btn" onclick="closeEditModal()">Cancel</button>
                </form>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div id="deleteConfirmationModal" class="modal">
            <div class="modal-content delete-modal">
                <span class="close" onclick="closeDeleteModal()">&times;</span>
                <h3>Confirm Delete Customer</h3>
                <p>Are you sure you want to delete this customer? This action cannot be undone.</p>
                <div class="action-buttons">
                    <form id="deleteCustomerForm" action="<?= ROOT ?>/ManageCustomerAccounts/delete" method="post">
                        <input type="hidden" name="deleteCustomerId" id="deleteCustomerId" />
                        <button type="button" class="action-btn cancel-btn" onclick="closeDeleteModal()">Cancel</button>
                        <button type="submit" class="action-btn delete-btn">Delete Customer</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script src="<?= ROOT ?>/assets/js/admin/sidebar.js"></script>
    <script src="<?= ROOT ?>/assets/js/admin/manageCustomerAccounts.js"></script>
</body>

</html>