<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/salesManager/common.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/salesManager/sidebar.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/salesManager/discounts.css" />
    <title>Discounts</title>
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
            </div>
            <div>
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
                        <a href="<?= ROOT ?>/carbonFootprint">
                            <img src="<?= ROOT ?>/assets/images/carbon-footprint.svg" alt="carbon footprint" />
                            <span class="sidebar-titles">Carbon Footprint</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= ROOT ?>/discounts" class="sidebar-active">
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
        <header>
            <div class="logo">
                <img src="<?= ROOT ?>/assets/images/Waste360.png" alt="Waste360" />
                <h1>Waste360</h1>
            </div>
            <div class="page-title">
                <p>Discounts</p>
            </div>
            <nav class="header-nav">
                <a href="#"><img src="<?= ROOT ?>/assets/images/notifications.svg" alt="" /></a>
                <a href="#">Profile</a>
                <a href="#">Log Out</a>
            </nav>
        </header>

        <div class="form-container">
            <h2>Discount Management</h2>

            <!-- Create New Discount Section -->
            <div id="discountForm" class="input-container">
                <h3>Create New Discount</h3>
                <form id="discountFormContent">
                    <div class="form-group">
                        <label>Discount Percentage:
                            <input type="number" id="discountPercentage" placeholder="E.g., 10, 20" min="1" max="100"
                                required />
                        </label>
                    </div>
                    <div class="form-group">
                        <label>Start Date:
                            <input type="date" id="startDate" required />
                        </label>
                    </div>
                    <div class="form-group">
                        <label>End Date:
                            <input type="date" id="endDate" required />
                        </label>
                    </div>
                    <button type="submit" class="action-btn">Save Discount</button>
                </form>
            </div>

            <!-- Existing Discounts Section -->
            <div id="discountTableSection" class="table-container">
                <div class="table-title">
                    <h3>Existing Discounts</h3>
                </div>
                <table id="discountTable">
                    <thead>
                        <tr>
                            <th>Percentage</th>
                            <th>Validity Period</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Rows dynamically added -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- <footer>
            <div class="logo">
                <img src="<?= ROOT ?>/assets/images/Waste360.png" alt="Waste360" />
            </div>
            <p>&copy; 2024 Waste360. All rights reserved.</p>
        </footer> -->
    </main>
    <script src="<?= ROOT ?>/assets/js/salesManager/sidebar.js"></script>
    <script src="<?= ROOT ?>/assets/js/salesManager/discounts.js"></script>
</body>

</html>