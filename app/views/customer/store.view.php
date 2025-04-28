<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Store</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/store.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"
        rel="stylesheet" />
    <script src="<?= ROOT ?>/assets/js/store.js" defer></script>
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
        <h2>Products made from Recycled Material</h2>
        <div class="product-container">
            <div class="product-card">
                <img src="<?= ROOT ?>/assets/images/pellets.png" alt="Recycled Pellets" />
                <h3>Recycled Pellets</h3>
                <a href="<?= ROOT ?>/pelletForm"><button class="primary">Send Request</button></a>
            </div>

            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <div class="product-card">
                        <?php if (!empty($product->productImage)): ?>
                            <img src="<?= ROOT ?>/assets/images/<?= htmlspecialchars($product->productImage) ?>" alt="<?= htmlspecialchars($product->productName) ?>" />
                        <?php else: ?>
                            <?php if ($product->product_id == 1): ?>
                                <img src="<?= ROOT ?>/assets/images/regular.jpg" alt="Regular Garbage Bags" />
                            <?php else: ?>
                                <img src="<?= ROOT ?>/assets/images/oxo-biodegradable.jpg" alt="Oxo-biodegradable Garbage Bags" />
                            <?php endif; ?>
                        <?php endif; ?>

                        <h3><?= htmlspecialchars($product->productName) ?></h3>

                        <?php if (trim($product->product_id) == 1): ?>
                            <a href="<?= ROOT ?>/regularBagForm"><button class="primary">See Options</button></a>
                        <?php else: ?>
                            <a href="<?= ROOT ?>/oxoBagForm"><button class="primary">See Options</button></a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </main>

    <footer>
        <div class="footer-content">
            <p>© 2024 Waste360. All rights reserved.</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>

</html>