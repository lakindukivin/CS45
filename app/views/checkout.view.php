<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Checkout - Waste360</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/checkout.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <script src="<?= ROOT ?>/assets/js/regularBagForm.js" defer></script>
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
                <li>
                    <a href="<?= $profileLink ?>" class="profile-icon">
                        <div class="profile-placeholder"></div>
                    </a>
                </li>
            </ul>
        </nav>
    </header>

    <main class="checkout-container">
        <h1>Checkout</h1>

        <!-- Display Success or Error Message -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="success-message">
                <?= htmlspecialchars($_SESSION['success']) ?>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php elseif (isset($_SESSION['error'])): ?>
            <div class="error-message">
                <?= htmlspecialchars($_SESSION['error']) ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (!empty($cartItems)): ?>
            <?php $total = 0; ?>

            <table class="checkout-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Pack Size</th>
                        <th>Bag Size</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $item): ?>
                        <?php
                        $itemSubtotal = $item->price * $item->quantity * $item->pack_size;
                        $total += $itemSubtotal;
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($item->productName) ?></td>
                            <td><?= htmlspecialchars($item->pack_size) ?> bags</td>
                            <td><?= htmlspecialchars($item->bag_size) ?></td>
                            <td><?= $item->quantity ?></td>
                            <td>LKR <?= number_format($itemSubtotal, 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="checkout-total">
                <h3>Total: LKR <?= number_format($total, 2) ?></h3>
            </div>

            <h2>Billing & Delivery Details</h2>

            <form action="<?= ROOT ?>/checkout/processCheckout" method="POST" class="payment-form">
                <label for="billingAddress">Billing Address:</label><br>
                <textarea name="billingAddress" id="billingAddress" required></textarea><br><br>

                <label for="deliveryAddress">Delivery Address:</label><br>
                <textarea name="deliveryAddress" id="deliveryAddress" required></textarea><br><br>

                <input type="hidden" name="total_amount" value="<?= $total ?>">

                <button type="submit" class="btn btn-primary">Confirm and Pay</button>
            </form>

        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </main>

</body>

</html>