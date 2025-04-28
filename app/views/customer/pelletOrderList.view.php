<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Your Pellet Orders</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/customOrderList.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <script src="<?= ROOT ?>/assets/js/profileComplete.js" defer></script>
</head>

<body>
    <?php
    // Check if the user is logged in
    if (isset($_SESSION['user_id'])) {
        $profileLink = ROOT . '/profile'; // Link to the profile page
    } else {
        $profileLink = ROOT . '/login'; // Link to the login page if the user is not logged in
    }
    ?>

    <header>
        <a href="<?= ROOT ?>" class="logo">
            <img src="<?= ROOT ?>/assets/images/Waste360.png" alt="Waste360 Logo" class="logo-image" />
            <span>Waste360</span>
        </a>

        <nav>
            <ul class="nav-links">
                <li><a href="<?= ROOT ?>">Home</a></li>
                <li><a href="<?= ROOT ?>/service">Services</a></li>
                <li><a href="<?= ROOT ?>/store">Store</a></li>
                <li><a href="<?= ROOT ?>/contact">Contact</a></li>
                <li><a href="<?= ROOT ?>/about">About</a></li>
                <li><a href="<?= ROOT ?>/logout?logout=true" class="logout-btn">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
    <h2>Pellet Orders</h2>
    <div class="orders-container">
    <table class="orders-table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Date</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td data-label="Order ID">#W360-78945</td>
                <td data-label="Date">2024-03-15</td>
                <td data-label="Quantity">15 kg</td>
                <td data-label="Price">$45.00</td>
                <td data-label="Status">
                    <span class="status-badge status-pending">Pending</span>
                </td>
                <td data-label="Actions" class="actions-cell">
                <button class="action-btn delete-btn">Cancel</button>
                </td>
            </tr>
            
        </tbody>
    </table>
</div>
    </main>

    <footer>
        <div class="footer-content">
            <p>© 2024 Waste360. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>