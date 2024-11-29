<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT ?>/src/roles/productionManager/styles/sidebar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/src/roles/productionManager/styles/home.css">
    <link rel="stylesheet" href="<?= ROOT ?>/src/roles/productionManager/styles/common.css">
    <title>Waste360|Dashboard|PM</title>
</head>

<body>
    <nav id="sidebar">
        <button id="toggle-btn" onclick="toggleSidebar()" class="toggle-btn">
            <img src="<?= ROOT ?>/src/assets/menu.svg" alt="menu" />
        </button>
        <div class="sidebar-container">
            <div class="prof-picture">
                <img src="<?= ROOT ?>/src/assets/user.svg" alt="profile" />
                <span class="user-title">Production Manager</span>
            </div>

            <div>
                <ul>
                    <li>
                        <a href="#" class="sidebar-active"><img src="<?= ROOT ?>/src/assets/dashboard.svg" alt="dashboard" /><span
                                class="sidebar-titles">Dashboard</span></a>
                    </li>

                    <li>
                        <a href="<?= ROOT ?>/src/roles/productionManager/html/customer_order/pending_custom_orders.html"><img src="<?= ROOT ?>/src/assets/order.svg" /><span
                                class="sidebar-titles">Custom Orders</span></a>
                    </li>
                    <li>
                        <a href="<?= ROOT ?>/src/roles/productionManager/html/recycled_polythene/recycled_polythene.html"><img src="<?= ROOT ?>/src/assets/recycle.svg" /><span
                                class="sidebar-titles">Recycled Polythene</span></a>
                    </li>
                    <li>
                        <a href="<?= ROOT ?>/src/roles/productionManager/html/polythene_collection/schedule.html"><img
                                src="<?= ROOT ?>/src/assets/collection.svg"
                                alt="site Performance" /><span class="sidebar-titles">Polythene Collection</span></a>
                    </li>
                    <li>
                        <a href="<?= ROOT ?>/src/roles/productionManager/html/supply_requests/supply_request.html"><img src="<?= ROOT ?>/src/assets/supply.svg" alt="supply" /><span
                                class="sidebar-titles">Supply Requests</span></a>
                    </li>
                    <li>
                        <a href="<?= ROOT ?>/src/roles/productionManager/html/pellets_requests/pellets_requests.html"><img src="<?= ROOT ?>/src/assets/order.svg" alt="supply" /><span
                                class="sidebar-titles">Pellets Requests</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="content">
        <header>
            <div class="logo">
                <img src="<?= ROOT ?>/src/assets/Waste360.png" alt="logo" />
                <h1>Waste360</h1>
            </div>
            <h1 class="logo">DashBoard</h1>
            <nav class="nav">
                <ul>
                    <li><a href="#"><img src="<?= ROOT ?>/src/assets/notifications.svg"></a></li>
                    <li><a href="#">Profile</a></li>
                    <li><a href="#">Logout</a></li>
                </ul>
            </nav>
        </header>

        <div class="top">
            <div class="left">
                <div class="calendar">
                    <div class="calendar-header">
                        <button onclick="prevMonth()">‹</button>
                        <h2 id="monthYear"></h2>
                        <button onclick="nextMonth()">›</button>
                    </div>
                    <div class="days">
                        <div class="day">Sun</div>
                        <div class="day">Mon</div>
                        <div class="day">Tue</div>
                        <div class="day">Wed</div>
                        <div class="day">Thu</div>
                        <div class="day">Fri</div>
                        <div class="day">Sat</div>
                    </div>
                    <div class="days" id="dates"></div>
                </div>
            </div>

            <!--timeeeeeeeeeeeee-->
            <div class="status-section">
                <div class="time-display">
                    <h3>Current Time</h3>
                    <div id="clock" class="clock">Loading...</div>
                </div>
                <div class="metric-grid">
                    <div class="metric-card">
                        <h4>New Orders</h4>
                        <div class="metric-value">0</div>
                    </div>
                    <div class="metric-card">
                        <h4>Monthly Amount of Recycled Polythene</h4>
                        <div class="metric-value">0</div>
                    </div>
                    <div class="metric-card">
                        <h4>Today Collection centres</h4>
                        <div class="metric-value">0</div>
                    </div>
                    <div class="metric-card">
                        <h4>Amount of Supply request</h4>
                        <div class="metric-value">0</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= ROOT ?>/src/roles/productionManager/javaScript/sidebar.js"></script>
    <script src="<?= ROOT ?>/src/roles/productionManager/javaScript/home.js"></script>
    </main>
</body>

</html>