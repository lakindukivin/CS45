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
                        <a href="#">Log Out</a>
                    </li>
                </ul>
            </nav>
        </header>

        <div id="carbon-footprint-section" class="container">


            <!-- <div id="update-data" class="input-container">
                <h3>Update Carbon Footprint Data</h3>
                <form id="updateForm">
                    <div class="form-group">
                        <label for="value">Value:</label>
                        <input type="number" id="value" placeholder="Enter value" min="0" step="0.01" required />
                    </div>
                    <div class="form-group">
                        <label for="unit">Unit:</label>
                        <select id="unit" required>
                            <option value="" disabled selected>Select a unit</option>
                            <option value="kgs">kgs</option>
                            <option value="Tons">Tons</option>
                        </select>
                    </div>
                    <button type="submit" class="action-btn">Save Changes</button>
                </form>
            </div> -->
            <div id="current-data">
                <h3>Current Carbon Footprint Data</h3>
                <table id="carbonFootprintTable">
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>Amount of Carbon Footprint Saved(in kg)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($carbonFootprints)): ?>
                            <?php foreach ($carbonFootprints as $carbonFootprint): ?>
                                <tr>
                                    <td><?= htmlspecialchars($carbonFootprint->month) ?></td>
                                    <td><?= htmlspecialchars($carbonFootprint->amount) ?></td>

                                    <td>
                                        <button class="delete-btn"
                                            onclick="openDeleteModal('<?= $carbonFootprint->discount_id ?>')">Delete</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">No discounts found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- <footer>
        <div class="logo">
          <img src="/src/roles/salesManager/assets/Waste360.png" alt="Waste360" />
        </div>
        <p>&copy; 2024 Waste360. All rights reserved.</p>
      </footer> -->
    </main>
    <script src="<?= ROOT ?>/assets/js/salesManager/sidebar.js"></script>
    <script src="<?= ROOT ?>/assets/js/salesManager/carbonFootprint.js"></script>
</body>

</html>