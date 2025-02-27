<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/salesManager/common.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/salesManager/sidebar.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/salesManager/discounts.css" />
    <title>Discounts</title>
</head>

<body>

    <?php
    if (isset($_SESSION['user_id'])) {
        $profileLink = ROOT . '/profile';
    } else {
        $profileLink = ROOT . '/login';
    }
    ?>
    <nav id="sidebar">
        <button id="toggle-btn" onclick="toggleSidebar()" class="toggle-btn">
            <img src="<?= ROOT ?>/assets/images/menu.svg" alt="menu" />
        </button>
        <div class="sidebar-container">
            <div class="prof-picture">
                <img src="<?= ROOT ?>/assets/images/user.svg" alt="profile" />
                <span class="user-title">Sales and Marketing Manager</span>
            </div>

            <div>
                <ul>
                    <li>
                        <a href="<?= ROOT ?>/salesManagerHome">
                            <img src="<?= ROOT ?>/assets/images/dashboard.svg" alt="dashboard" />
                            <span class="sidebar-titles">Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= ROOT ?>/carbonFootprint">
                            <img src="<?= ROOT ?>/assets/images/carbon-footprint.svg" alt="carbon footprint" />
                            <span class="sidebar-titles">Carbon Footprint</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= ROOT ?>/discounts" class="sidebar-active">
                            <img src="<?= ROOT ?>/assets/images/discount.svg" alt="discounts" />
                            <span class="sidebar-titles">Discount</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= ROOT ?>/products">
                            <img src="<?= ROOT ?>/assets/images/product.svg" alt="products" />
                            <span class="sidebar-titles">Products</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= ROOT ?>/adsAndBanners">
                            <img src="<?= ROOT ?>/assets/images/ads.svg" alt="ads/banners" />
                            <span class="sidebar-titles">Ads/Banners</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= ROOT ?>/generateReports">
                            <img src="<?= ROOT ?>/assets/images/report.svg" alt="reports" />
                            <span class="sidebar-titles">Generate Reports</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <header class="header">
            <div class="logo">
                <img src="<?= ROOT ?>/assets/images/Waste360.png" alt="Waste360" />
                <h1>Waste360</h1>
            </div>

            <h1 class="logo">Discounts</h1>

            <nav class="nav">
                <ul>

                    <li>
                        <a href="#"><img src="<?= ROOT ?>/assets/images/notifications.svg" alt="" /></a>
                    </li>
                    <li>
                        <a href="#">Profile</a>
                    </li>
                    <li>
                        <a href="#">Log Out</a>
                    </li>
                </ul>
            </nav>
        </header>

        <div class="container">
            <!--Table Header-->

            <div class="table-header">
                <div>

                </div>
                <div>
                    <button class="action-btn" onclick="openAddModal()">Add Discount</button>
                </div>
            </div>

            <!-- Existing Discounts Section -->
            <table id="discountTable">
                <thead>
                    <tr>
                        <th>Discount ID</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Discount Percentage</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($discounts)): ?>
                        <?php foreach ($discounts as $discount): ?>
                            <tr>
                                <td><?= htmlspecialchars($discount->discount_id) ?></td>
                                <td><?= htmlspecialchars($discount->productName) ?></td>
                                <td><?= htmlspecialchars($discount->productPrice) ?></td>
                                <td><?= htmlspecialchars($discount->discount_percentage) ?></td>
                                <td><?= htmlspecialchars($discount->start_date) ?></td>
                                <td><?= htmlspecialchars($discount->end_date) ?></td>
                                <td>
                                    <button class="edit-btn"
                                        onclick="openEditModal('<?= $discount->discount_id ?>', '<?= $discount->productName ?>', '<?= $discount->discount_percentage ?>', '<?= $discount->start_date ?>', '<?= $discount->end_date ?>')">Edit</button>
                                    <button class="delete-btn"
                                        onclick="openDeleteModal('<?= $discount->discount_id ?>')">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">No discounts found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>


            <!-- Update the Add Discount Modal -->
            <div id="addModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeAddModal()">&times;</span>
                    <h3>Create New Discount</h3>
                    <form action="<?= ROOT ?>/discounts/add" method="POST">
                        <div class="form-group">
                            <label>Product:
                                <select name="product_id" required>
                                    <option value="">Select a product</option>
                                    <?php if (isset($products) && is_array($products)): ?>
                                        <?php foreach ($products as $product): ?>
                                            <option value="<?= $product->product_id ?>"><?= $product->productName ?></option>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <option value="">No products available</option>
                                    <?php endif; ?>
                                </select>
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Discount Percentage:
                                <input type="number" name="discount_percentage" placeholder="E.g., 10, 20" min="1"
                                    max="100" required />
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Start Date:
                                <input type="date" name="start_date" required />
                            </label>
                        </div>
                        <div class="form-group">
                            <label>End Date:
                                <input type="date" name="end_date" required />
                            </label>
                        </div>
                        <button type="submit" class="action-btn">Save Discount</button>
                        <button type="button" class="cancel-btn" onclick="closeAddModal()">Cancel</button>
                    </form>
                </div>
            </div>

            <!-- Edit Discount Modal -->
            <div id="editModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeEditModal()">&times;</span>
                    <h3>Edit Discount</h3>
                    <form action="<?= ROOT ?>/discounts/edit" method="POST">
                        <input type="hidden" name="Discount_id" id="edit_discount_id">
                        <!-- Add this hidden field to maintain Product_id -->
                        <input type="hidden" name="Product_id" id="edit_product_id">
                        <div class="form-group">
                            <label>Product:
                                <input type="text" id="edit_product_name" readonly />
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Discount Percentage:
                                <input type="number" name="discount_percentage" id="edit_discount_percentage" min="1"
                                    max="100" required />
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Start Date:
                                <input type="date" name="start_date" id="edit_start_date" required />
                            </label>
                        </div>
                        <div class="form-group">
                            <label>End Date:
                                <input type="date" name="end_date" id="edit_end_date" required />
                            </label>
                        </div>
                        <button type="submit" class="action-btn">Update Discount</button>
                        <button type="button" class="cancel-btn" onclick="closeEditModal()">Cancel</button>
                    </form>
                </div>
            </div>

            <!-- Delete Confirmation Modal -->
            <div id="deleteModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeDeleteModal()">&times;</span>
                    <h3>Confirm Delete</h3>
                    <p>Are you sure you want to delete this discount?</p>
                    <form action="<?= ROOT ?>/discounts/delete" method="POST">
                        <input type="hidden" name="Discount_id" id="delete_discount_id">
                        <button type="submit" class="delete-btn">Delete</button>
                        <button type="button" class="cancel-btn" onclick="closeDeleteModal()">Cancel</button>
                    </form>
                </div>
            </div>

        </div>

        <!-- <footer>
            <div class="logo">
                <img src="<?= ROOT ?>/assets/images/Waste360.png" alt="Waste360" />
            </div>
            <p>&copy; 2024 Waste360. All rights reserved.</p>
        </footer> -->
    </main>
    <script src="<?= ROOT ?>/assets/js/salesManager/sidebar.js"></script>
    <script src="<?= ROOT ?>/assets/js/salesManager/modal.js"></script>
    <!-- <script src="<?= ROOT ?>/assets/js/salesManager/discounts.js"></script> -->
</body>

</html>