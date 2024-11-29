<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Custom Orders | Waste360</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/customOrderList.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <script src="<?= ROOT ?>/assets/js/profileComplete.js" defer></script>
</head>

<body>
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
                <h1>Custom Orders</h1>
                <p>Here are your custom orders:</p>

                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Custom Order ID</th>
                            <th>Company Name</th>
                            <th>Quantity</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Type</th>
                            <th>Specifications</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($customOrders)): ?>
                            <?php foreach ($customOrders as $order): ?>
                                <tr>
                                    <!-- Use object notation to access properties -->
                                    <td><?= htmlspecialchars($order->order_id) ?></td>
                                    <td><?= htmlspecialchars($order->company_name) ?></td>
                                    <td><?= htmlspecialchars($order->quantity) ?></td>
                                    <td><?= htmlspecialchars($order->email) ?></td>
                                    <td><?= htmlspecialchars($order->phone) ?></td>
                                    <td><?= htmlspecialchars($order->type) ?></td>
                                    <td><?= htmlspecialchars($order->specifications) ?></td>
                                    <td>
                                        <a href="<?= ROOT ?>/editCustomOrder/<?= htmlspecialchars($order->order_id) ?>" class="edit-btn">Edit</a>
                                        <a href="<?= ROOT ?>/deleteOrder/<?= htmlspecialchars($order->order_id) ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this order?');">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8">No custom orders found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
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