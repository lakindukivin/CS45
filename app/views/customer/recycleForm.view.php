<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Giveaway Request</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/recycleForm.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <script src="<?= ROOT ?>/assets/js/giveawayForm.js" defer></script>
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

    <main>
        <div>
            <img src="<?= ROOT ?>/assets/images/giveaway.png" alt="Giveaway" style="max-width:100%; margin-bottom: 30px;">
        </div>

        <h1>Giveaway Request</h1>

        <form method="POST" action="<?= ROOT ?>/recycleForm">
            <?php if (isset($success) && $success === true): ?>
                <div class="success-message"><?= $success_message ?></div>
            <?php endif; ?>

            <div class="form-group">
                <label for="request_date">Requested Date</label>
                <input type="date" id="request_date" name="request_date" value="<?= isset($request_date) ? $request_date : '' ?>" required>
                <?php if (isset($errors['request_date'])): ?>
                    <div class="error-message"><?= $errors['request_date'] ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="details">Details</label>
                <textarea id="details" name="details" rows="5" required><?= isset($details) ? $details : '' ?></textarea>
                <?php if (isset($errors['details'])): ?>
                    <div class="error-message"><?= $errors['details'] ?></div>
                <?php endif; ?>
            </div>

            <?php if (isset($errors['submit'])): ?>
                <div class="error-message"><?= $errors['submit'] ?></div>
            <?php endif; ?>

            <button type="submit">Submit Request</button>
        </form>
    </main>

    <footer>
        <div class="footer-content">
            <p>© 2024 Waste360. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>