<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="root-url" content="<?= ROOT ?>">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/collectionAgent/sidebar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/collectionAgent/home.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/collectionAgent/common.css">
    <title>Waste360|Dashboard|CA</title>
</head>

<body>
    <nav id="sidebar">
        <button id="toggle-btn" onclick="toggleSidebar()" class="toggle-btn">
            <img src="<?= ROOT ?>/assets/images/menu.svg" alt="menu" />
        </button>
        <div class="sidebar-container">
            <div class="prof-picture">
                <img src="<?= ROOT ?>/assets/images/user.svg" alt="profile" />
                <span class="user-title">Collection Agent</span>
            </div>

            <div>
                <ul>
                    <li>
                        <a href="#" class="sidebar-active"><img src="<?= ROOT ?>/assets/images/dashboard.svg" alt="dashboard" /><span
                                class="sidebar-titles">Dashboard</span></a>
                    </li>

                    <li>
                        <a href="<?= ROOT ?>/AcceptedGiveAwayRequest"><img src="<?= ROOT ?>/assets/images/give_away.svg" /><span
                                class="sidebar-titles">Accepted Give Aways</span></a>
                    </li>
                    <li>
                        <a href="<?= ROOT ?>/GuestCollection"><img src="<?= ROOT ?>/assets/images/returns.svg" /><span
                                class="sidebar-titles">Add Guest Collection</span></a>
                    </li>                  
                </ul>
            </div>
        </div>
    </nav>

    <div class="content">
        <header class="header">
            <div class="logo">
                <img src="<?= ROOT ?>/assets/images/Waste360.png" alt="logo" />
                <h1>Waste360</h1>
            </div>
            <h1 class="logo">DashBoard</h1>
            <div class="time-display">
                    <div id="clock" class="clock">Loading...</div>
                </div>
            <nav class="nav">
                <ul>
                    <li><a href="<?= ROOT ?>/staffprofile">Profile</a></li>
                    <li><a href="<?= ROOT ?>/logout">Logout</a></li>
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
                    <div class="days" id="dates">
                        <!-- Example of dynamically generated dates -->
                        <div class="date" data-date="2025-04-20">20</div>
                        <div class="date" data-date="2025-04-21">21</div>
                        <!-- Add more dates dynamically -->
                    </div>
                </div>
            </div>

            <!--timee-->
            <div class="status-section">
                <div class="metric-grid">
                    <div class="metric-card">
                        <h4>Give Aways</h4>
                        <div class="metric-value" id="giveaways-count"><?= $giveaways ?></div>
                    </div>
                    <div class="metric-card">
                        <h4>Guests</h4>
                        <div class="metric-value" id="guest-count"><?= $guests ?></div>
                    </div>
                    <div class="metric-card">
                        <h4>Polythen Amount(Kgs)</h4>
                        <div class="metric-value" id="total"><?= $total ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= ROOT ?>/assets/js/collectionAgent/home.js"></script>
    <script src="<?= ROOT ?>/assets/js/collectionAgent/sidebar.js"></script>
</body>

</html>
