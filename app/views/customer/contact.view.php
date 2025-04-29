<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Us</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/contact.css" />
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
        <section class="contact-section">
            <h2>Contact for support</h2>
            <form id="contactForm">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Enter your email"
                    required />

                <label for="reason">Reason</label>
                <select id="reason" name="reason" required>
                    <option value="returns">Returns</option>
                    <option value="general">General</option>
                </select>

                <label for="phone">Phone</label>
                <input
                    type="tel"
                    id="phone"
                    name="phone"
                    placeholder="Enter your phone number"
                    required />

                <button type="submit">Submit</button>
            </form>
        </section>

        <!-- 🌍 New Section for Google Map -->
        <section class="map-section">
            <h2>Find Us Here</h2>
            <div class="map-container">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.396550978857!2d80.01350687678675!3d6.721370893274595!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae24928b29a289d%3A0x5cbd6c3b54d1ede3!2sWaste%20360!5e0!3m2!1sen!2slk!4v1745895827890!5m2!1sen!2slk"
                    width="100%"
                    height="400"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
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