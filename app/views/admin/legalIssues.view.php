<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/common.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/sidebar.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/legalIssues.css" />
    <title>Waste360 | Issues</title>
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
                        <a href="<?= ROOT ?>/legalIssues" class="sidebar-active">
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
                <p>Issues</p>
            </div>
            <nav class="header-nav">
                <a href="#"><img src="<?= ROOT ?>/assets/images/notifications.svg" alt="" /></a>
                <a href="#">Profile</a>
                <a href="#">Log Out</a>
            </nav>
        </header>

        <div class="issues-container">
           
            <!-- Legal Issues Overview -->
            <div id="legal-issues-overview">
                <h3>Legal Issues</h3>
                <table id="legalIssuesTable">
                    <thead>
                        <tr>
                            <th>Issue ID</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($issues)): ?>
                            <?php foreach ($issues as $issue): ?>
                                <tr>
                                    <td><?= htmlspecialchars($issue->issue_id) ?></td>
                                    <td><?= htmlspecialchars($issue->description) ?></td>
                                    <td><?= htmlspecialchars($issue->status) ?></td>
                                    <td>
                                        <button class="edit-btn">Edit</button>
                                        <button class="delete-btn">Delete</button>
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
            </div>

            <div id="manage-legal-issue">
                <h3>Manage Legal Issue</h3>
                <div id="editModal" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="closeEditModal()">&times;</span>
                        <form id="legalForm">
                            <label for="issueId">Issue ID:</label>
                            <input type="text" id="issueId" placeholder="Auto-generated ID" readonly />

                            <label for="description">Description:</label>
                            <textarea id="description" rows="4" placeholder="Enter issue description"
                                required></textarea>

                            <label for="status">Status:</label>
                            <select id="status" required>
                                <option value="" disabled selected>Select Status</option>
                                <option value="Pending">Pending</option>
                                <option value="Resolved">Resolved</option>
                                <option value="Escalated">Escalated</option>
                            </select>

                            <label for="actionsTaken">Actions Taken:</label>
                            <textarea id="actionsTaken" rows="4" placeholder="Document actions taken"></textarea>

                            <button type="submit" class="action-btn">Save & Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="<?= ROOT ?>/assets/js/admin/modal.js"></script>
    <script src="<?= ROOT ?>/assets/js/admin/sidebar.js"></script>
    <script src="<?= ROOT ?>/assets/js/admin/legalIssues.js"></script>
</body>

</html>