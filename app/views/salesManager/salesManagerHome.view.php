<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= ROOT ?>/src/roles/salesManager/styles/common.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/src/roles/salesManager/styles/sidebar.css" />
    <title>Dashboard</title>
</head>

<body>
    <nav id="sidebar">
        <button id="toggle-btn" onclick="toggleSidebar()" class="toggle-btn">
            <img src="<?= ROOT ?>/src/assets/menu.svg" alt="menu" />
        </button>
        <div class="sidebar-container">
            <div class="prof-picture">
                <img src="<?= ROOT ?>/src/assets/user.svg" alt="profile" />
                <span class="user-title">Sales and Marketing Manager</span>
            </div>

            <div>
                <ul>
                    <li>
                        <a href="#" class="sidebar-active"><img
                                src="<?= ROOT ?>/src/assets/dashboard.svg"
                                alt="dashboard" /><span class="sidebar-titles">Dashboard</span></a>
                    </li>

                    <li>
                        <a
                            href="<?= ROOT ?>/src/roles/salesManager/html/carbon footprint/carbonFootprint.html"><img
                                src="<?= ROOT ?>/src/assets/carbon-footprint.svg"
                                alt="carbon-footprint" /><span class="sidebar-titles">Carbon footprint</span></a>
                    </li>
                    <li>
                        <a href="<?= ROOT ?>/src/roles/salesManager/html/discounts/discounts.html"><img
                                src="<?= ROOT ?>/src/assets/discount.svg"
                                alt="Discount" /><span class="sidebar-titles">Discount</span></a>
                    </li>
                    <li>
                        <a href="<?= ROOT ?>/src/roles/salesManager/html/products/products.html"><img
                                src="<?= ROOT ?>/src/assets/product.svg"
                                alt="product" /><span class="sidebar-titles">Products</span></a>
                    </li>
                    <li>
                        <a
                            href="<?= ROOT ?>/src/roles/salesManager/html/adsAndBanners/adsAndBanners.html"><img
                                src="<?= ROOT ?>/src/assets/ads.svg"
                                alt="ads/banners" /><span class="sidebar-titles">Ads/Banners</span></a>
                    </li>
                    <li>
                        <a
                            href="<?= ROOT ?>/src/roles/salesManager/html/genarateReports/generateReports.html"><img
                                src="<?= ROOT ?>/src/assets/report.svg"
                                alt="reports" /><span class="sidebar-titles">Generate Reports</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <header>
            <div class="logo">
                <img
                    src="<?= ROOT ?>/src/assets/Waste360.png"
                    alt="Waste360" />
                <h1>Waste360</h1>
            </div>
            <div class="page-title">
                <p>Dashboard</p>
            </div>
            <nav class="header-nav">
                <a href="#"><img src="<?= ROOT ?>/src/assets/notifications.svg" alt="" /></a>
                <a href="#">Profile</a>
                <a href="#">Log Out</a>
            </nav>
        </header>

        <!-- <footer>
        <div class="logo">
          <img src="/assets/assets/Waste360.png" alt="Waste360" />
        </div>
        <p>&copy; 2024 Waste360. All rights reserved.</p>
      </footer> -->
    </main>
    <script src="<?= ROOT ?>/src/roles/salesManager/javaScript/sidebar.js"></script>
</body>

</html>