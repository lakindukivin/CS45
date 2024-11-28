<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile Complete | Waste360</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/profileComplete.css" />
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
        <div class="content">
            <div class="cta">
                <h1>PROFILE COMPLETION SUCCESSFUL</h1>
                <p>Your profile is now complete! Thank you for being part of the Green Revolution!</p>

                <!-- Profile Info Section -->
                <div class="profile-info">
                    <h2>Your Profile Information</h2>
                    <p><strong>Address:</strong> <?= isset($profileData->address) ? $profileData->address : 'Not provided' ?></p>
                    <p><strong>Phone Number:</strong> <?= isset($profileData->phone_number) ? $profileData->phone_number : 'Not provided' ?></p>
                </div>

                <!-- Form for deleting the account (hidden by default) -->
                <form id="deleteAccountForm" method="POST" action="<?= ROOT ?>/profileComplete">
                    <input type="hidden" name="delete_account" value="true">
                </form>

                <!-- Orders and Delete Account Buttons -->
                <div class="action-buttons">
                    <a href="<?= ROOT ?>/orders">
                        <button class="orders-btn">My Orders</button>
                    </a>
                    <!-- Delete account button with confirmation -->
                    <a href="javascript:void(0);" id="deleteAccountLink">
                        <button class="delete-account-btn">Delete Account</button>
                    </a>
                    <a href="<?= ROOT ?>/profile">
                        <button>Edit Account</button>
                    </a>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer-content">
            <p>© 2024 Waste360. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>