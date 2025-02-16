<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/login.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"
        rel="stylesheet" />
</head>

<body>
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
                    <a href="<?= ROOT ?>/login" class="profile-icon">
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
                <form class="login-form" method="post">
                    <div class="input-group">
                        <label for="Email">Email</label>
                        <input
                            type="email"
                            id="Email"
                            name="Email"
                            placeholder="Enter your email"
                            required />
                    </div>
                    <div class="input-group">
                        <label for="Password">Password</label>
                        <input
                            type="password"
                            id="Password"
                            name="Password"
                            placeholder="Enter your password"
                            required />
                    </div>
                    <div class="cta-buttons">
                        <button type="submit" class="login-button">Login</button>
                    </div>
                    <p class="signup-text">
                        Don't have an account?
                        <a href="<?= ROOT ?>/createAccount">Sign up now</a>
                    </p>
                </form>
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