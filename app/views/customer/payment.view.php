<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Waste360</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/payment.css">
</head>

<body>

    <header>
        <a href="<?= ROOT ?>" class="logo">
            <img src="<?= ROOT ?>/assets/images/Waste360.png" alt="Waste360 Logo" class="logo-image" />
            <span>Waste360</span>
        </a>
    </header>

    <main class="payment-container">
        <h1>Complete Your Payment</h1>

        <?php if (isset($order)): ?>
            <div class="payment-summary">
                <p><strong>Order ID:</strong> <?= htmlspecialchars($order->order_id) ?></p>
                <p><strong>Total Amount:</strong> LKR <?= number_format($order->total_amount, 2) ?></p>
            </div>

            <form action="<?= ROOT ?>/payment/processPayment" method="POST" class="payment-form">
                <input type="hidden" name="order_id" value="<?= htmlspecialchars($order->order_id) ?>">
                <button type="submit" class="btn btn-primary">Pay Now</button>
            </form>
        <?php else: ?>
            <p>Invalid Order.</p>
        <?php endif; ?>

    </main>

</body>

</html>