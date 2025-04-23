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
    // Start session if not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Check if the user is logged in, redirect if not
    if (!isset($_SESSION['user_id'])) {
        header("Location: " . ROOT . "/login");
        exit();
    }

    // Fetch profile data (this should come from your controller)
    $userId = $_SESSION['user_id'];
    $customer = new Customer();
    $profile = $customer->getCustomerByUserId($userId);

    // Convert object to array if needed
    if (is_object($profile)) {
        $profile = (array)$profile;
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
                <?php if (isset($_SESSION['success_message'])): ?>
                    <div class="success-message">
                        <?= htmlspecialchars($_SESSION['success_message']) ?>
                    </div>
                    <?php unset($_SESSION['success_message']); ?>
                <?php endif; ?>

                <h1>PROFILE COMPLETION SUCCESSFUL</h1>
                <p>Your profile is now complete! Thank you for being part of the Green Revolution!</p>

                <!-- Profile Info Section -->
                <div class="profile-info">
                    <!-- Profile Picture -->
                    <div class="profile-picture-container">
                        <img src="<?= !empty($profile['image']) ? ROOT . htmlspecialchars($profile['image']) : ROOT . '/assets/images/default-avatar.png' ?>"
                            alt="Profile Picture"
                            class="profile-picture">
                    </div>

                    <!-- Profile Details -->
                    <div class="profile-details">
                        <h2>Your Profile Information</h2>
                        <p><strong>Name:</strong> <?= !empty($profile['name']) ? htmlspecialchars($profile['name']) : 'Not provided' ?></p>
                        <p><strong>Address:</strong> <?= !empty($profile['address']) ? htmlspecialchars($profile['address']) : 'Not provided' ?></p>
                        <p><strong>Phone Number:</strong> <?= !empty($profile['phone']) ? htmlspecialchars($profile['phone']) : 'Not provided' ?></p>
                    </div>
                </div>

                <!-- Form for deleting the account (hidden by default) -->
                <form id="deleteAccountForm" method="POST" action="<?= ROOT ?>/profile/delete">
                    <input type="hidden" name="delete_account" value="true">
                </form>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <a href="<?= ROOT ?>/order" class="btn orders-btn">My Orders</a>
                    <button id="deleteAccountBtn" class="btn delete-account-btn">Delete Account</button>
                    <a href="<?= ROOT ?>/profile" class="btn edit-btn">Edit Profile</a>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer-content">
            <p>© 2024 Waste360. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Delete account confirmation
        document.getElementById('deleteAccountBtn').addEventListener('click', function(e) {
            if (confirm('Are you sure you want to delete your account? This action cannot be undone.')) {
                document.getElementById('deleteAccountForm').submit();
            }
        });
    </script>
</body>

</html>