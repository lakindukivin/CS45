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
                        <a href="<?= ROOT ?>/manageCustomerAccounts">
                            <img src="<?= ROOT ?>/assets/images/customer-account.svg" alt="customer" />
                            <span class="sidebar-titles">Customer Management</span>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="sidebar-active">
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

            <h1 class="logo">Staff Accounts</h1>

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
                        placeholder="Search staff by name,email,role.." />
                    <button type="submit">Search</button>
                </form>
                <div class="total-users">
                    Total Staff: <span id="totalUsers"><?= isset($staffAccounts) ? count($staffAccounts) : 0 ?></span>
                </div>
                <div>
                    <button class="action-btn" onclick="openAddModal()">Add Staff</button>
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
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="staffTableBody">

                    <?php if (!empty($staffAccounts)): ?>
                        <?php foreach ($staffAccounts as $staff): ?>
                            <tr>
                                <td><?= $staff->staff_id ?></td>
                                <td><?= $staff->name ?></td>
                                <td><?= $staff->email ?></td>
                                <td><?= $staff->phone ?></td>
                                <td><?= $staff->address ?></td>
                                <td><?= $staff->role_id ?></td>
                                <td><?= $staff->status == 1 ? "<a href=ManageStaffAccounts/setInactive?staff_id=" . $staff->staff_id . " class='active-btn'>Active</a>" : "<a  href=ManageStaffAccounts/setActive?staff_id=" . $staff->staff_id . " class='inactive-btn'>Inactive</a>";?></td>
                                <td class="action-buttons">
                                    <button class="edit-btn"
                                        onclick="openEditModal('<?= $staff->staff_id ?>','<?= $staff->name ?>','<?= $staff->image ?>','<?= $staff->phone ?>','<?= $staff->address ?>','<?= $staff->role_id ?>','<?= $staff->status ?>')"><img
                                            src="<?= ROOT ?>/assets/images/edit-btn.svg"" alt=" edit"></button>
                                    <button class="delete-btn" onclick="openDeleteModal(<?= $staff->staff_id ?>)"><img
                                            src="<?= ROOT ?>/assets/images/delete-btn.svg"" alt=" delete"></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8">No staff accounts found.</td>
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


        <!-- Add Staff Modal -->
        <div id="addModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeAddModal()">&times;</span>
                <h3>Add New Staff</h3>
                <form id="addStaffForm" action="<?= ROOT ?>/ManageStaffAccounts/addStaffWithUser" method="post"
                    enctype="multipart/form-data" onsubmit="(e)=>console.log(e)">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input name="name" type="text" id="name" placeholder="Enter Staff Name" required />
                    </div>

                    <div class="form-group">
                        <label for="image">Profile Image:</label>
                        <input name="image" type="file" id="image" accept="image/*" required />
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input name="email" type="email" id="email" placeholder="Enter Staff Email" required />
                    </div>

                    <div class="form-group">
                        <label for="phone">Contact No:</label>
                        <input name="phone" type="text" id="phone" placeholder="Enter Staff Contact Number" required />
                    </div>

                    <div class="form-group">
                        <label for="address">Address:</label>
                        <textarea name="address" id="address" required placeholder="Enter Staff Address"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="role">Role:</label>
                        <select name="role" id="role" required>
                            <option value="">Select Role</option>
                            <option value="3">Production Manager</option>
                            <option value="1">Admin</option>
                            <option value="2">Sales and Marketing Manager</option>
                            <option value="4">Customer Service Manager</option>
                        </select>
                    </div>

                    <button type="submit" class="action-btn">Add Staff</button>

                </form>
            </div>
        </div>



        <div id="editModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeEditModal()">&times;</span>
                <h3>Edit Staff Details</h3>
                <form id="editStaffAccounts" method="post" enctype="multipart/form-data"
                    action="<?= ROOT ?>/ManageStaffAccounts/update">
                    <input type="hidden" name="staff_id" id="staff_id" />
                    <input type="hidden" name="existingImagePath" id="existingImagePath" />

                    <div class="form-group">
                        <label for="editStaffName">Name:</label>
                        <input name="editStaffName" type="text" id="editStaffName" placeholder="Enter Staff Name"
                            required />
                    </div>

                    <div class="form-group">
                        <label for="editStaffImage">Profile Image:</label>
                        <img id="editImage" src="" alt="Staff Profile picture" style="width: 100px; height: auto" />
                        <input name="editStaffImage" type="file" id="editStaffImage" accept="image/*" />
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

                    <div class="form-group">
                        <label for="editStaffrole">Role:</label>
                        <select name="editStaffrole" id="editStaffrole" required>
                            <option value="">Select Role</option>
                            <option value="1">Admin</option>
                            <option value="2">Sales and Marketing Manager</option>
                            <option value="3">Production Manager</option>
                            <option value="4">Customer Service Manager</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="editStaffStatus">Status:</label>
                        <select name="editStaffStatus" id="editStaffStatus" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="action-btn">Update</button>
                </form>
            </div>
        </div>

        <div id="deleteConfirmationModal" class="modal">
            <div class="modal-content delete-modal">
                <span class="close" onclick="closeDeleteModal()">&times;</span>
                <h3>Confirm Delete Staff</h3>
                <p>Are you sure you want to delete this staff member? This action cannot be undone.</p>
                <div class="staff-info">
                    <p><strong>Name:</strong> <span id="deleteStaffName"></span></p>
                    <p><strong>Email:</strong> <span id="deleteStaffEmail"></span></p>
                    <p><strong>Role:</strong> <span id="deleteStaffRole"></span></p>
                </div>
                <div class="action-buttons">
                    <form id="deleteStaffForm" action="<?= ROOT ?>/ManageStaffAccounts/delete" method="post">
                        <input type="hidden" name="staff_id" id="deleteStaffId" />
                        <button type="button" class="action-btn cancel-btn" onclick="closeDeleteModal()">Cancel</button>
                        <button type="submit" class="action-btn delete-btn">Delete Staff</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script src="<?= ROOT ?>/assets/js/admin/sidebar.js"></script>
    <script src="<?= ROOT ?>/assets/js/admin/manageStaffAccounts.js"></script>
</body>

</html>