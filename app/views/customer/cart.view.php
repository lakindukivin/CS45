<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Shopping Cart</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/cart.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>
    <?php include 'includes/header.php'; ?>

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

    $customer = new Customer();
    $user_id = $_SESSION['user_id'];

    // Fetch customer details based on user_id
    $profile = $customer->getCustomerByUserId($user_id);
    ?>


    <main class="cart-container">
        <h1>Your Shopping Cart</h1>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert success"><?= $_SESSION['success'] ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert error"><?= $_SESSION['error'] ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (empty($cartItems)): ?>
            <div class="empty-cart">
                <p>Your cart is empty</p>
                <a href="<?= ROOT ?>/store" class="btn">Continue Shopping</a>
            </div>
        <?php else: ?>
            <div class="cart-items">
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Pack Size</th>
                            <th>Bag Size</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cartItems as $item): ?>
                            <tr>
                                <td>
                                    <div class="product-info">
                                        <img src="<?= ROOT ?>/assets/images/<?= $item->image_path ?>" alt="<?= $item->name ?>">
                                        <span><?= $item->name ?></span>
                                    </div>
                                </td>
                                <td><?= ucfirst($item->pack_size) ?></td>
                                <td><?= ucfirst($item->bag_size) ?></td>
                                <td>LKR <?= number_format($item->price, 2) ?></td>
                                <td>
                                    <form method="POST" action="<?= ROOT ?>/cart/update/<?= $item->cart_id ?>">
                                        <input type="number" name="quantity" value="<?= $item->quantity ?>" min="1">
                                        <button type="submit" class="btn-update">Update</button>
                                    </form>
                                </td>
                                <td>LKR <?= number_format($item->subtotal, 2) ?></td>
                                <td>
                                    <a href="<?= ROOT ?>/cart/remove/<?= $item->cart_id ?>" class="btn-remove">Remove</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="cart-summary">
                    <h3>Cart Total: LKR <?= number_format($total, 2) ?></h3>
                    <div class="cart-actions">
                        <a href="<?= ROOT ?>/store" class="btn">Continue Shopping</a>
                        <a href="<?= ROOT ?>/checkout" class="btn btn-primary">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>

</html>