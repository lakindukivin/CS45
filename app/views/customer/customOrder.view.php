<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Custom Order</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/customOrder.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"
        rel="stylesheet" />
    <script src="<?= ROOT ?>/assets/js/customOrder.js" defer></script>
</head>

<body>
    <?php
    if (isset($_SESSION['user_id'])) {
        $profileLink = ROOT . '/profile';
    } else {
        $profileLink = ROOT . '/login';
    }
    ?>

    <header>
        <a href="#" class="logo">
            <img
                src="<?= ROOT ?>/assets/images/Waste360.png"
                alt="Waste360 Logo"
                class="logo-image" />
            <span>Waste360</span>
        </a>

        <nav>
            <ul class="nav-links">
                <li><a href="<?= ROOT ?>">Home</a></li>
                <li><a href="<?= ROOT ?>/service">Services</a></li>
                <li><a href="<?= ROOT ?>/store">Store</a></li>
                <li><a href="<?= ROOT ?>/contact">Contact</a></li>
                <li><a href="<?= ROOT ?>/about">About</a></li>
                <li>
                    <a href="<?= $profileLink ?>" class="profile-icon">
                        <div class="profile-placeholder"></div>
                    </a>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="order-section">
            <h2>Order Customized Bags</h2>

            <!-- Display Success/Failure Messages -->
            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="success-message"><?= $_SESSION['success_message']; ?></div>
                <?php unset($_SESSION['success_message']); ?>
            <?php elseif (isset($_SESSION['error_message'])): ?>
                <div class="error-message"><?= $_SESSION['error_message']; ?></div>
                <?php unset($_SESSION['error_message']); ?>
            <?php endif; ?>

            <form id="custom-order-form" method="POST">
                <label for="company-name">Company/Client Name</label>
                <input type="text" id="company-name" name="company_name" placeholder="Enter company name" required />

                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" name="quantity" placeholder="min 1000*" min="1000" required />

                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required />

                <label for="phone">Phone</label>
                <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" minlength="10" maxlength="10" placeholder="Enter your phone number" required />

                <label for="bag-type">Bag Type</label>
                <select id="bag-type" name="type" required>
                    <option value="" disabled selected>Select bag type</option>
                    <option value="regular">Regular</option>
                    <option value="oxo-biodegradable">Oxo-biodegradable</option>
                </select>

                <label for="specifications">Specifications</label>
                <textarea id="specifications" name="specifications" placeholder="Enter specifications" rows="4"></textarea>

                <button type="submit">Submit</button>
            </form>
        </div>
    </main>
    <footer>
        <div class="footer-content">
            <p>© 2024 Waste360. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>