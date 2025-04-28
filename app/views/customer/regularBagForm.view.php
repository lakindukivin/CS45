<!-- Corrected View regularBagForm.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Regular Bag Form</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/regularBagForm.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <script src="<?= ROOT ?>/assets/js/regularBagForm.js" defer></script>
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
        <?php if (isset($product)): ?>
            <div class="product-image">
                <img src="<?= ROOT ?>/assets/images/regular.jpg" alt="<?= htmlspecialchars($product->productName) ?>" />
            </div>

            <div class="product-details">
                <h2><?= htmlspecialchars($product->productName) ?></h2>

                <?php if (!empty($bag_sizes)): ?>
                    <?php
                    $prices = array_column($bag_sizes, 'price');
                    $min_price = min($prices);
                    $max_price = max($prices);
                    ?>
                    <h3>LKR <?= number_format($min_price, 2) ?> - <?= number_format($max_price, 2) ?></h3>
                <?php endif; ?>

                <p><?= htmlspecialchars($product->productDescription) ?></p>

                <?php if (!empty($packs)): ?>
                    <div class="dropdown">
                        <label for="pack-size">Pack Size</label>
                        <select id="pack-size" name="pack_size">
                            <?php foreach ($packs as $pack): ?>
                                <option value="<?= htmlspecialchars($pack->pack_size) ?>"><?= htmlspecialchars($pack->pack_size) ?> bags</option>

                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php endif; ?>


                <?php if (!empty($bag_sizes)): ?>
                    <div class="dropdown">
                        <label for="bag-size">Bag Size</label>
                        <select id="bag-size" name="bag_id">
                            <?php foreach ($bag_sizes as $bag): ?>
                                <option value="<?= $bag->bag_id ?>" data-price="<?= $bag->price ?>">
                                    <?= htmlspecialchars($bag->bag_size) ?> - LKR <?= number_format($bag->price, 2) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                    </div>
                <?php endif; ?>

                <div class="dropdown">
                    <label for="quantity">Quantity</label>
                    <input type="number" id="quantity" name="quantity" value="1" min="1" />
                </div>

                <div class="price-display">
                    <strong>Total Price: </strong>
                    <span id="dynamic-price">
                        <?php
                        // Assuming $bag_sizes and $pack_sizes are defined in PHP
                        if (!empty($bag_sizes) && !empty($pack_sizes)) {
                            $price = $bag_sizes[0]->price; // Price of the first bag size
                            $pack_size = $pack_sizes[0]; // First pack size, e.g., 10
                            $total_price = $price * $pack_size;
                            echo 'LKR ' . number_format($total_price, 2);
                        } else {
                            echo 'LKR 0.00';
                        }
                        ?>
                    </span>
                </div>
                <div class="button-group">
                    <button class="btn" onclick="addToCart()">Add to Cart</button>
                    <button class="btn" onclick="location.href='<?= ROOT ?>/customOrder'">Custom Order</button>
                </div>
            </div>
        <?php else: ?>
            <div class="error-message">
                <p>Product information not available.</p>
                <a href="<?= ROOT ?>/store">Return to Store</a>
            </div>
        <?php endif; ?>
    </main>

    <footer>
        <div class="footer-content">
            <p>© 2024 Waste360. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Update price dynamically
        document.addEventListener('DOMContentLoaded', function() {
            const bagSizeSelect = document.getElementById('bag-size');
            const packSizeSelect = document.getElementById('pack-size');
            const quantityInput = document.getElementById('quantity');
            const priceDisplay = document.getElementById('dynamic-price');

            // Initialize the default pack size (assume the first pack size is 10)
            const defaultPackSize = 10;

            // Function to update the total price
            function updatePrice() {
                const selectedBagOption = bagSizeSelect.options[bagSizeSelect.selectedIndex];
                const unitPrice = parseFloat(selectedBagOption.getAttribute('data-price')); // Price for selected bag size
                const packSize = parseInt(packSizeSelect.value) || defaultPackSize; // Use the selected pack size, default to 10 if not selected
                const quantity = parseInt(quantityInput.value) || 1; // Default to 1 if no quantity is selected

                // Correct the calculation: total price = unit price * pack size * quantity
                const totalPrice = unitPrice * packSize * quantity;

                // Update the displayed total price
                priceDisplay.textContent = 'LKR ' + totalPrice.toFixed(2);
            }

            // Add event listeners to update the price when selections change
            bagSizeSelect.addEventListener('change', updatePrice);
            packSizeSelect.addEventListener('change', updatePrice);
            quantityInput.addEventListener('input', updatePrice);

            // Call updatePrice on page load to set the initial total price
            updatePrice();
        });



        function addToCart() {
            const packSize = document.getElementById('pack-size').value;
            const bagId = document.getElementById('bag-size').value;
            const quantity = document.getElementById('quantity').value;
            const bagSizeText = document.getElementById('bag-size').options[document.getElementById('bag-size').selectedIndex].text.split(' - ')[0];
            const totalPrice = parseFloat(document.getElementById('dynamic-price').textContent.replace('LKR ', '').replace(',', ''));

            // Validate the fields
            if (!packSize || !bagId || !quantity) {
                alert('Please select all required options');
                return;
            }

            // Prepare form data
            const formData = new FormData();
            formData.append('product_id', <?= $product->product_id ?>);
            formData.append('pack_size', packSize);
            formData.append('bag_id', bagId);
            formData.append('bag_size', bagSizeText);
            formData.append('quantity', quantity);
            formData.append('total_price', totalPrice); // Send the calculated total price

            // Send the data to the server
            fetch('<?= ROOT ?>/cart/add', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success message
                        alert('Item added to cart successfully!');
                        // Redirect to the cart page
                        window.location.href = '<?= ROOT ?>/cart';
                    } else {
                        // Show error message
                        alert(data.message || 'Error adding to cart');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while adding to cart');
                });
        }
    </script>

</body>

</html>