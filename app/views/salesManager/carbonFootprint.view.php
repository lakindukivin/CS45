<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/salesManager/common.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/salesManager/sidebar.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/salesManager/carbonFootprint.css" />

    <title>Carbon Footprint</title>
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
                <span class="user-title">Sales and Marketing Manager</span>
            </div>

            <div>
                <ul>
                    <li>
                        <a href="<?= ROOT ?>/salesManagerHome">
                            <img src="<?= ROOT ?>/assets/images/dashboard.svg" alt="dashboard" />
                            <span class="sidebar-titles">Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="sidebar-active">
                            <img src="<?= ROOT ?>/assets/images/carbon-footprint.svg" alt="carbon footprint" />
                            <span class="sidebar-titles">Carbon Footprint</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= ROOT ?>/discounts">
                            <img src="<?= ROOT ?>/assets/images/discount.svg" alt="discounts" />
                            <span class="sidebar-titles">Discount</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= ROOT ?>/products">
                            <img src="<?= ROOT ?>/assets/images/product.svg" alt="products" />
                            <span class="sidebar-titles">Products</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= ROOT ?>/adsAndBanners">
                            <img src="<?= ROOT ?>/assets/images/ads.svg" alt="ads/banners" />
                            <span class="sidebar-titles">Ads/Banners</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= ROOT ?>/generateReports">
                            <img src="<?= ROOT ?>/assets/images/report.svg" alt="reports" />
                            <span class="sidebar-titles">Generate Reports</span>
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

            <h1 class="logo">Carbon Footprint</h1>

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

        <div id="carbon-footprint-section" class="container">

            <div class="table-header">
                <form class="search-bar" method="get" action="">
                    <img src="<?= ROOT ?>/assets/images/magnifying-glass-solid.svg" class="search-icon" width="20px" />
                    <input type="text" name="search" value="<?= isset($search) ? htmlspecialchars($search) : '' ?>"
                        placeholder="Search ..." />
                    <button type="submit">Search</button>
                </form>

            </div>
            <div id="current-data">
                <h3>Current Carbon Footprint Data</h3>
                <table id="carbonFootprintTable">
                    <thead>
                        <tr>
                            <th>Carbon Footprint ID</th>
                            <th>Customer</th>
                            <th>Carbon Footprint Type</th>
                            <th>Item</th>
                            <th>Amount of Carbon Footprint Saved</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($carbonFootprints)): ?>
                            <?php foreach ($carbonFootprints as $carbonFootprint): ?>
                                <tr>
                                    <td><?= htmlspecialchars($carbonFootprint->id) ?></td>
                                    <td><?= htmlspecialchars($carbonFootprint->email) ?></td>
                                    <td><?= htmlspecialchars($carbonFootprint->type) ?></td>
                                    <td><?= htmlspecialchars($carbonFootprint->amount) ?></td>

                                    <td>
                                        <button class="delete-btn"
                                            onclick="openDeleteModal('<?= $carbonFootprint->discount_id ?>')"><img
                                                src="<?= ROOT ?>/assets/images/delete-btn.svg"" alt=" delete"></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">No data found.</td>
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
                <!-- Delete Confirmation Modal -->
                <div id="deleteModal" class="modal">
                    <div class="modal-content">
                        <h3>Confirm Delete</h3>
                        <p>Are you sure you want to delete this record?</p>
                        <form action="<?= ROOT ?>/carbonFootprint/delete" method="POST">
                            <input type="hidden" name="footprint_id" id="delete_footprint_id">
                            <button type="submit" class="delete-btn">Delete</button>
                            <button type="button" class="cancel-btn" onclick="closeDeleteModal()">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- <footer>
        <div class="logo">
          <img src="/src/roles/salesManager/assets/Waste360.png" alt="Waste360" />
        </div>
        <p>&copy; 2024 Waste360. All rights reserved.</p>
      </footer> -->
    </main>
    <script src="<?= ROOT ?>/assets/js/sidebar.js"></script>
    <script src="<?= ROOT ?>/assets/js/modal.js"></script>
    <script src="<?= ROOT ?>/assets/js/salesManager/carbonFootprint.js"></script>
</body>

</html>