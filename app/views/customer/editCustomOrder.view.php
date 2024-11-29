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



            <!-- customer/editCustomOrder.php -->

            <form action="<?php echo '/customOrderList/update/' . $order->order_id; ?>" method="POST">
                <label for="company_name">Company Name:</label>
                <input type="text" name="company_name" value="<?php echo $order->company_name; ?>" required />

                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" value="<?php echo $order->quantity; ?>" required />

                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo $order->email; ?>" required />

                <label for="phone">Phone:</label>
                <input type="text" name="phone" value="<?php echo $order->phone; ?>" required />

                <label for="type">Type:</label>
                <input type="text" name="type" value="<?php echo $order->type; ?>" required />

                <label for="specifications">Specifications:</label>
                <textarea name="specifications" required><?php echo $order->specifications; ?></textarea>

                <button type="submit">Update Order</button>
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