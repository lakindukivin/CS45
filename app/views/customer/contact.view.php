<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Us</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/contact.css" />
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
        <section class="contact-section">
            <h2>Contact for support</h2>
            <form id="contactForm" action="<?= ROOT ?>/Issues/add" method="POST">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required />

                <label for="phone">Phone</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required />

                <label for="reason">Reason</label>
                <select id="reason" name="reason" required>
                    <option value="returns">Returns</option>
                    <option value="general">Report Issue</option>
                </select>

                <label for="description">Describe</label>
                <textarea type="text" id="description" name="description" placeholder="Enter your issue" required></textarea>

                <button type="submit">Submit</button>
            </form>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <p>Call us - 077 7168174</p>
            <p>Get in touch - info@waste360.lk</p>
        </div>
    </footer>

    <script src="contact.js"></script>
</body>

</html>