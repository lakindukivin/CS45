<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pellet Purchase</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pelletForm.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"
        rel="stylesheet" />
    <script src="<?= ROOT ?>/assets/js/pelletForm.js" defer></script>
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
        <div class="product-image">
            <img src="<?= ROOT ?>//assets/images/pellets.png" alt="regular bag">
        </div>
        <div class="product-details">
            <h2>Pellet Purchase</h2></br>
            <form class="login-form" method="POST" action="<?= ROOT ?>/pelletform/submit">
                <?php if (isset($success) && $success === true): ?>
                    <div class="success-message"><?= $success_message ?></div>
                <?php endif; ?>

                <div class="input-group">
                    <label for="name">Company/Client name</label>
                    <input type="text" id="name" name="name" value="<?= isset($company_name) ? $company_name : '' ?>" required>
                    <?php if (isset($errors['name'])): ?>
                        <span class="error"><?= $errors['name'] ?></span>
                    <?php endif; ?>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?= isset($email) ? $email : '' ?>" required>
                    <?php if (isset($errors['email'])): ?>
                        <span class="error"><?= $errors['email'] ?></span>
                    <?php endif; ?>
                </div>
                <div class="input-group">
                    <label for="amount">Amount of pellets</label>
                    <input type="number" id="amount" name="amount" value="<?= isset($amount) ? $amount : '1' ?>" min="1" required>
                    <?php if (isset($errors['amount'])): ?>
                        <span class="error"><?= $errors['amount'] ?></span>
                    <?php endif; ?>
                </div>
                <div class="input-group">
                    <label for="phone">Contact</label>
                    <input type="tel" id="phone" name="phone" value="<?= isset($contact) ? $contact : '' ?>" minlength="10" pattern="[0-9]{10}" required>
                    <?php if (isset($errors['phone'])): ?>
                        <span class="error"><?= $errors['phone'] ?></span>
                    <?php endif; ?>
                </div>
                <div class="input-group">
                    <label for="date">Required Date</label>
                    <input type="date" id="date" name="date" value="<?= isset($dateRequired) ? $dateRequired : '' ?>" required>
                    <?php if (isset($errors['date'])): ?>
                        <span class="error"><?= $errors['date'] ?></span>
                    <?php endif; ?>
                </div>
                <?php if (isset($errors['submit'])): ?>
                    <div class="error"><?= $errors['submit'] ?></div>
                <?php endif; ?>
                <div class="cta-buttons">
                    <button type="submit">Submit</button>
                </div>
            </form>

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