<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Completed Orders</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/normalOrder.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
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

    <main class="completed-orders-container">
        <h1>Your Completed Orders</h1>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert success"><?= $_SESSION['success'] ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert error"><?= $_SESSION['error'] ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (empty($completedOrders)): ?>
            <br>
            <p>You have no completed orders!</p><br>
            <a href="<?= ROOT ?>/store" class="btn">Shop Now</a>
        <?php else: ?>
            <div class="completed-orders">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Status</th>
                            <th>Date Completed</th>
                            <th>Message to Customer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($completedOrders as $order): ?>
                            <tr>
                                <td><?= htmlspecialchars($order->order_id) ?></td>
                                <td><?= htmlspecialchars($order->status) ?></td>
                                <td><?= htmlspecialchars($order->date_completed) ?></td>
                                <td><?= htmlspecialchars($order->message_to_customer) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </main>

</body>

</html>