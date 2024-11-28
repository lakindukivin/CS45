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
            <div class="text-content">
                <h1>Waste360 Recycling Programme</h1>
                <p>
                    Waste360 is there for you to support your business in your next step in
                    protecting our environment, by redefining how we see waste. Join Us!
                </p></br>
                <button>Learn More</button>
            </div>
            <div class="image-content">
                <img src="<?= ROOT ?>/assets/images/services.png" alt="Waste360 Bags">
            </div>
            <div class="steps-section">
                <h1>How it works</h1>
                <div class="steps-container">
                    <div class="step step-left">
                        <img src="<?= ROOT ?>/assets/images/formIcon.png" alt="Form Icon">
                        <p>You/your facility send the required details by filling the relevant form.</p>
                    </div>
                    <div class="arrow">
                        <img src="<?= ROOT ?>/assets/images/arrowRight.png" alt="Arrow Icon">
                    </div>
                    <div class="step step-right">
                        <img src="<?= ROOT ?>/assets/images/truckIcon.png" alt="Truck Icon">
                        <p>We send our collection truck to collect polythene from your doorstep.</p>
                    </div>
                    <div class="arrow">
                        <img src="<?= ROOT ?>/assets/images/arrowLeft.png" alt="Arrow Icon">
                    </div>
                    <div class="step step-left">
                        <img src="<?= ROOT ?>/assets/images/garbageIcon.png" alt="Garbage Bags Icon">
                        <p>We offer garbage bags, made using the recycled material from your facility, at a discounted price.</p>
                    </div>
                </div>

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