<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/common.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/sidebar.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/issues.css" />
    <title>Waste360 | Issues</title>
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
                        <a href="<?= ROOT ?>/manageStaffAccounts">
                            <img src="<?= ROOT ?>/assets/images/staff-account.svg" alt="staff" />
                            <span class="sidebar-titles">Staff Management</span>
                        </a>


                    </li>

                    <li>
                        <a href="#" class="sidebar-active">
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

            <h1 class="logo">Issues</h1>

            <nav class="nav">
                <ul>
                    <li>
                        <a href="#"><img src="<?= ROOT ?>/assets/images/notifications.svg" alt="" /></a>
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
        <div class="content">
            <div class="container">
                <div class="table-header">
                    <form class="search-bar" method="get" action="">
                        <img src="<?= ROOT ?>/assets/images/magnifying-glass-solid.svg" class="search-icon"
                            width="20px" />
                        <input type="text" name="search" value="<?= isset($search) ? htmlspecialchars($search) : '' ?>"
                            placeholder="Search products..." />
                        <button type="submit">Search</button>
                    </form>

                </div>

                <table id="issuesTable">
                    <thead>
                        <tr>
                            <th>Issue ID</th>
                            <th>Description</th>
                            <th>Email</th>
                            <th>Contact No.</th>
                            <th>Status</th>
                            <th>Action Taken</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($issues)): ?>
                            <?php foreach ($issues as $issue): ?>
                                <tr>
                                    <td><?= htmlspecialchars($issue->issue_id) ?></td>
                                    <td><?= htmlspecialchars($issue->description) ?></td>
                                    <td><?= htmlspecialchars($issue->email) ?></td>
                                    <td><?= htmlspecialchars($issue->phone) ?></td>
                                    <td><?= htmlspecialchars($issue->status == 1 ? 'Resolved' : 'Pending') ?></td>
                                    <td><?= htmlspecialchars($issue->action_taken) ?></td>
                                    <td>
                                        <button class="edit-btn"
                                            onclick="openEditModal('<?= $issue->issue_id ?>','<?= $issue->description ?>','<?= $issue->email ?>','<?= $issue->phone ?>','<?= $issue->status ?>','<?= $issue->action_taken ?>')"><img
                                                src="<?= ROOT ?>/assets/images/edit-btn.svg"" alt=" edit"></button>
                                        <button class="delete-btn" onclick="openDeleteModal('<?= $issue->issue_id ?>')"><img
                                                src="<?= ROOT ?>/assets/images/delete-btn.svg"" alt=" delete"></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4">No issues found.</td>
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

                <!-- <div id="addModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeAddModal()">&times;</span>
                    <h3>Report your Problem here</h3>

                    <form action="<?= ROOT ?>/Issues/add" id="issueForm" enctype="multipart/form-data" method="post">

                        <div class="form-group">
                            <label>Description:
                                <textarea id="issueDescription" name="description" placeholder="Write your issue here"
                                    required></textarea>
                            </label>
                        </div>
                        <input type="hidden" id="status" name="status" value="" />
                        <input type="hidden" id="actionTaken" name="actionTaken" value="" />

                        <div class="form-actions">
                            <button type="submit" class="action-btn" id="saveAdBtn">Save</button>
                            <button type="button" class="cancel-btn" onclick="closeAddModal()">Cancel</button>
                        </div>
                    </form>
                </div>
            </div> -->

                <div id="editModal" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="closeEditModal()">&times;</span>
                        <h3>Manage Issues</h3>
                        <form id="editIssueForm" action="<?= ROOT ?>/Issues/update" method="post">
                            <input type="hidden" id="issueId" name="editIssueId" />
                            <input type="hidden" id="description" name="description" />
                            <input type="hidden" id="email" name="email" />
                            <input type="hidden" id="phone" name="phone" />
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select id="status" name="status" required>
                                    <option disabled>Select Status</option>
                                    <option value='0'>Pending</option>
                                    <option value='1'>Resolved</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="actionsTaken">Actions Taken:</label>
                                <textarea name="actionsTaken" id="actionsTaken" rows="4"
                                    placeholder="Document actions taken"></textarea>
                            </div>
                            <button type="submit" class="action-btn">Save & Update</button>
                        </form>
                    </div>
                </div>


                <!-- Delete Confirmation Modal -->
                <div id="deleteModal" class="modal">
                    <div class="modal-content delete-modal">
                        <span class="close" onclick="closeDeleteModal()">&times;</span>
                        <h3>Confirm Deletion</h3>
                        <p>Are you sure you want to delete this issue record? This action cannot be undone.</p>
                        <form action="<?= ROOT ?>/Issues/delete" id="deleteIssueForm" method="post">

                            <input type="hidden" id="deleteIssueId" name="deleteIssueId" />
                            <div class="form-actions">
                                <button type="submit" class="confirm-btn">Delete</button>
                                <button type="button" class="cancel-btn" onclick="closeDeleteModal()">Cancel</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="<?= ROOT ?>/assets/js/sidebar.js"></script>
    <script src="<?= ROOT ?>/assets/js/formValidation.js"></script>
    <script src="<?= ROOT ?>/assets/js/admin/issues.js"></script>
</body>

</html>