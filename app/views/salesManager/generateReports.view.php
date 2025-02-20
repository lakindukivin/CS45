<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/salesManager/common.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/salesManager/sidebar.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/salesManager/generateReports.css" />
    <title>Generate Reports</title>
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
                        <a href="<?= ROOT ?>/discounts">
                            <img src="<?= ROOT ?>/assets/images/discount.svg" alt="discounts" />
                            <span class="sidebar-titles">Discounts</span>
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
                        <a href="<?= ROOT ?>/generateReports" class="sidebar-active">
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
                <p>Reports</p>
            </div>
            <nav class="header-nav">
                <a href="#"><img src="<?= ROOT ?>/assets/images/notifications.svg" alt="" /></a>
                <a href="#">Profile</a>
                <a href="#">Log Out</a>
            </nav>
        </header>

        <div id="generate-reports" class="form-container">
            <h2>Generate Reports</h2>

            <div id="reportForm" class="input-container">
                <div class="form-group">
                    <label for="reportType">Select Report Type:</label>
                    <select id="reportType" required>
                        <option value="" disabled selected>Select Report Type</option>
                        <option value="sales">Sales Report</option>
                        <option value="performance">Performance Report</option>
                        <option value="conversion">Conversion Report</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Date Range:</label>
                    <input type="date" id="startDate" required /> to
                    <input type="date" id="endDate" required />
                </div>
                <div class="form-group">
                    <label>Specific Metrics:
                        <input type="text" id="metrics" placeholder="E.g., Revenue, Clicks" />
                    </label>
                </div>

                <button id="generateReport" class="action-btn">Generate Report</button>
            </div>

            <div id="reportTableSection">
                <h3>Generated Reports</h3>
                <table id="reportTable">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Date Range</th>
                            <th>Metrics</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </main>

    <script src="<?= ROOT ?>/assets/js/salesManager/sidebar.js"></script>
    <script src="<?= ROOT ?>/assets/js/salesManager/generateReports.js"></script>
</body>

</html>