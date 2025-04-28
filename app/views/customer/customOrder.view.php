<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Custom Order</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/customOrder.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <style>
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            font-size: 14px;
        }

        .alert.success {
            background-color: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
        }

        .alert.error {
            background-color: #f2dede;
            color: #a94442;
            border: 1px solid #ebccd1;
        }

        .field-error {
            color: #a94442;
            font-size: 0.85em;
            margin-top: 3px;
            display: block;
        }

        .form-group {
            margin-bottom: 15px;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #4CAF50;
            outline: none;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        .form-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <?php
    $profileLink = isset($_SESSION['user_id']) ? ROOT . '/profile' : ROOT . '/login';
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
        <div class="form-container">
            <h2>Order Customized Bags</h2>

            <!-- Message Display Area -->
            <?php if (isset($success)): ?>
                <div class="alert success"><?= $success ?></div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error_message'])): ?>
                <div class="alert error"><?= $_SESSION['error_message'] ?></div>
            <?php endif; ?>

            <?php if (!empty($errors)): ?>
                <div class="alert error">
                    <p>Please fix the following errors:</p>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <?php if (is_array($error)): ?>
                                <?php foreach ($error as $e): ?>
                                    <li><?= $e ?></li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li><?= $error ?></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Only the changed parts shown -->

            <form method="POST" action="<?= ROOT ?>/customOrder">
                <div class="form-group">
                    <label for="company-name">Company/Client Name</label>
                    <input type="text" id="company-name" name="company_name"
                        value="<?= htmlspecialchars($formData['company_name'] ?? '') ?>"
                        placeholder="Enter company name" required />
                    <?php if (isset($errors['company_name'])): ?>
                        <span class="field-error"><?= $errors['company_name'] ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" id="quantity" name="quantity"
                        value="<?= htmlspecialchars($formData['quantity'] ?? '') ?>"
                        placeholder="min 1000*" min="1000" required />
                    <?php if (isset($errors['quantity'])): ?>
                        <span class="field-error"><?= $errors['quantity'] ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email"
                        value="<?= htmlspecialchars($formData['email'] ?? '') ?>"
                        placeholder="Enter your email" required />
                    <?php if (isset($errors['email'])): ?>
                        <span class="field-error"><?= $errors['email'] ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" name="phone"
                        value="<?= htmlspecialchars($formData['phone'] ?? '') ?>"
                        pattern="[0-9]{10}" minlength="10" maxlength="10"
                        placeholder="Enter your phone number" required />
                    <?php if (isset($errors['phone'])): ?>
                        <span class="field-error"><?= $errors['phone'] ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="bag-type">Bag Type</label>
                    <select id="bag-type" name="type" required>
                        <option value="" disabled <?= !isset($formData['type']) ? 'selected' : '' ?>>Select bag type</option>
                        <option value="regular" <?= (isset($formData['type']) && $formData['type'] == 'regular') ? 'selected' : '' ?>>Regular</option>
                        <option value="oxo-biodegradable" <?= (isset($formData['type']) && $formData['type'] == 'oxo-biodegradable') ? 'selected' : '' ?>>Oxo-biodegradable</option>
                    </select>
                    <?php if (isset($errors['type'])): ?>
                        <span class="field-error"><?= $errors['type'] ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="specifications">Specifications</label>
                    <textarea id="specifications" name="specifications"
                        placeholder="Enter specifications" rows="4"><?= htmlspecialchars($formData['specifications'] ?? '') ?></textarea>
                </div>

                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">

                <div class="form-group">
                    <button type="submit">Submit Order</button>
                </div>
            </form>

        </div>
    </main>

    <footer>
        <div class="footer-content">
            <p>© 2024 Waste360. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>