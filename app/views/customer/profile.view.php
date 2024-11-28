<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/profile.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
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
                <li>
                    <a href="<?= ROOT ?>/logout?logout=true" class="logout-btn">Logout</a>
                </li>
            </ul>
        </nav>
    </header>

    <div class="profile-container">
        <form method="POST">
            <!-- Profile Picture -->
            <input type="file" id="profilePictureInput" accept="image/*" style="display:none;">
            <img src="<?= $profile['profile_picture'] ?? ROOT . '/assets/images/default-avatar.png' ?>"
                alt="Profile Picture"
                class="profile-picture"
                id="profilePicture"
                onclick="document.getElementById('profilePictureInput').click()">

            <!-- Phone Number Input -->
            <div class="input-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone_number"
                    placeholder="Enter your phone number"
                    value="<?= $profile['phone_number'] ?? '' ?>">
            </div>

            <!-- Address Input -->
            <div class="input-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address"
                    placeholder="Enter your full address"
                    value="<?= $profile['address'] ?? '' ?>">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="update-btn">Update Profile</button>
            <button class="update-btn">Profile</button>
        </form>

        <!-- Display success or error messages -->
        <?php if (!empty($success_message)): ?>
            <p class="success-message"><?= $success_message ?></p>
        <?php endif; ?>

        <?php if (!empty($error_message)): ?>
            <p class="error-message"><?= $error_message ?></p>
        <?php endif; ?>
    </div>

    <script>
        // Preview selected profile picture
        const profilePictureInput = document.getElementById('profilePictureInput');
        const profilePicture = document.getElementById('profilePicture');

        profilePictureInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    profilePicture.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>