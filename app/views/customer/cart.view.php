<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cart</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/cart.css" />
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

    <main class="cart-container">
        <h1>Shopping Cart</h1>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert success"><?= $_SESSION['success'] ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert error"><?= $_SESSION['error'] ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (empty($cartItems)): ?>
            <br>
            <p>Your cart is empty!</p><br>
            <a href="<?= ROOT ?>/store" class="btn">Shop Now</a>
        <?php else: ?>
            <div class="cart-items">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Pack Size</th>
                            <th>Bag Size</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0; ?>

                        <?php foreach ($cartItems as $item): ?>
                            <?php
                            $itemSubtotal = $item->price * $item->quantity * $item->pack_size;
                            $total += $itemSubtotal;
                            ?>
                            <tr>
                                <td>
                                    <div class="product-info">
                                        <?= htmlspecialchars($item->productName) ?>
                                    </div>
                                </td>
                                <td><?= htmlspecialchars($item->pack_size) ?> bags</td>
                                <td><?= htmlspecialchars($item->bag_size) ?></td>
                                <td>
                                    <form action="<?= ROOT ?>/cart/update" method="POST">
                                        <input type="hidden" name="cart_id" value="<?= $item->cart_id ?>">
                                        <input type="number" name="quantity" value="<?= $item->quantity ?>" min="1">
                                        <button type="submit" class="btn">Update</button>
                                    </form>
                                </td>
                                <td>
                                    LKR <?= number_format($itemSubtotal, 2) ?>
                                </td>
                                <td>
                                    <form action="<?= ROOT ?>/cart/removeFromCart" method="POST" onsubmit="return confirm('Are you sure you want to remove this item?');">
                                        <input type="hidden" name="cart_id" value="<?= $item->cart_id ?>">
                                        <button type="submit" class="btn btn-danger">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="cart-total">
                    <h3>Total: LKR <?= number_format($total, 2) ?></h3>
                    <div class="cart-actions">
                        <a href="<?= ROOT ?>/checkout" class="btn btn-primary">Proceed to Checkout</a>
                        <a href="<?= ROOT ?>/store" class="btn">Back to Store</a>
                    </div>
                </div>

            </div>
        <?php endif; ?>

    </main>

</body>

</html>