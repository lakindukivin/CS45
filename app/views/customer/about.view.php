<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Services</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/services.css" />
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
        <div class="content">
            <section class="about-section">
                <div class="content">
                    <h1>About Waste360</h1>
                    <p>
                        <strong>Waste360</strong> is an integrated waste management
                        company, specializing in polythene recycling. Our facility in
                        Horana is well-equipped to recycle different types of polythene
                        material and create new products facilitating a circular economy
                        for the future.
                    </p>
                    <p>
                        We believe that it is up to all of us to responsibly manage and
                        dispose of our waste to minimize the impact on the environment.
                    </p>
                    <p>
                        We partner with individuals such as yourself, collectors,
                        companies, and organizations across Sri Lanka to recycle polythene
                        waste. Waste360 will pick up your cleaned polythene waste from
                        your doorstep, or you could simply drop it off at one of our many
                        collection points across the country.
                    </p>
                </div>
                <div class="image-container">
                    <img
                        src="<?= ROOT ?>/assets/images/waste360.png"
                        alt="Waste360 Team Illustration" />
                </div>
            </section>
        </div>
    </main>

    <footer>
        <div class="footer-content">
            <p>© 2024 Waste360. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>