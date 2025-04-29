<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Waste360</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/home.css" />
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
            <img
                src="<?= ROOT ?>/assets/images/recycling.jpg"
                alt="Recycling image"
                class="recycling-image" />
            <div class="cta">
                <h1>BE A PART OF THE <br />GREEN REVOLUTION</h1>
                <div class="cta-buttons">
                    <a href="<?= ROOT ?>/store">
                        <button>BUY NOW</button>
                    </a>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="<?= ROOT ?>/recycleForm">
                            <button>RECYCLE</button>
                        </a>
                    <?php else: ?>
                        <a href="<?= ROOT ?>/login">
                            <button>RECYCLE</button>
                        </a>
                    <?php endif; ?>

                </div>
            </div>
        </div>

        <div class="stats-box">
            <div class="stats">
                <div class="stat-item">
                    <h2>50+ Tons</h2>
                    <p>polythene recycled last month</p>
                </div>
                <div class="stat-item">
                    <h2>20,000+</h2>
                    <p>carbon footprints saved</p>
                </div>
            </div>
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