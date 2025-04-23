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
                        <a href="<?= ROOT ?>/Logout">Log Out</a>
                    </li>
                </ul>
            </nav>
        </header>

        <div class="container">
            <!--Table Header-->

            <div class="table-header">
                <form class="search-bar" method="get" action="">
                    <img src="<?= ROOT ?>/assets/images/magnifying-glass-solid.svg" class="search-icon" width="20px" />
                    <input type="text" name="search" value="<?= isset($search) ? htmlspecialchars($search) : '' ?>"
                        placeholder="Search..." />
                    <button type="submit">Search</button>
                </form>
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
                        <th>Discount Percentage</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($discounts)): ?>
                        <?php foreach ($discounts as $discount): ?>
                            <tr>
                                <td><?= htmlspecialchars($discount->discount_id) ?></td>
                                <td><?= htmlspecialchars($discount->productName) ?></td>
                                <td><?= htmlspecialchars($discount->discount_percentage) ?></td>
                                <td><?= htmlspecialchars($discount->start_date) ?></td>
                                <td><?= htmlspecialchars($discount->end_date) ?></td>
                                <td><?= $discount->status == 1 ? "<a href=discounts/setInactive?discount_id=" . $discount->discount_id . " class='active-btn'>Active</a>" : "<a  href=discounts/setActive?discount_id=" . $discount->discount_id . " class='inactive-btn'>Inactive</a>"; ?>
                                </td>
                                <td>
                                    <button class="edit-btn"
                                        onclick="openEditModal('<?= $discount->discount_id ?>', '<?= $discount->productName ?>', '<?= $discount->discount_percentage ?>', '<?= $discount->start_date ?>', '<?= $discount->end_date ?>','<?= $discount->status ?>')"><img
                                            src="<?= ROOT ?>/assets/images/edit-btn.svg"" alt=" edit"></button>
                                    <button class="delete-btn" onclick="openDeleteModal('<?= $discount->discount_id ?>')"><img
                                            src="<?= ROOT ?>/assets/images/delete-btn.svg"" alt=" delete"></button>
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

            <!-- Pagination Controls -->
            <div class="pagination">
                <?php if (isset($totalPages) && $totalPages > 1): ?>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?<?= isset($search) && $search !== '' ? 'search=' . urlencode($search) . '&' : '' ?>page=<?= $i ?>"
                            class="<?= (isset($currentPage) && $currentPage == $i) ? 'active' : '' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                <?php endif; ?>
            </div>


            <!-- Update the Add Discount Modal -->
            <div id="addModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeAddModal()">&times;</span>
                    <h3>Create New Discount</h3>
                    <form action="<?= ROOT ?>/discounts/add" method="POST" id="addDiscountForm">
                        <div class="form-group">
                            <label for="productId">Product:
                                <select name="productId" id="productId" required>
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
                            <label for="discountPercentage">Discount Percentage:
                                <input id="discountPercentage" type="number" name="discountPercentage"
                                    placeholder="E.g., 0.2,0.4" min="0" max="1" required />
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="startDate">Start Date:
                                <input id="startDate" type="date" name="startDate" required />
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="endDate">End Date:
                                <input id="endDate" type="date" name="endDate" required />
                            </label>
                        </div>
                        <button type="submit" class="action-btn">Save Discount</button>
                    </form>
                </div>
            </div>

            <!-- Edit Discount Modal -->
            <div id="editModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeEditModal()">&times;</span>
                    <h3>Edit Discount</h3>
                    <form action="<?= ROOT ?>/discounts/edit" method="POST" id="editDiscountForm">
                        <input type="hidden" name="editDiscountId" id="editDiscountId">
                        <input type="hidden" name="editProductId" id="editProductId">
                        <div class="form-group">
                            <label>Product:
                                <input type="text" id="editProductName" readonly />
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="editDiscountPercentage">Discount Percentage:
                                <input type="number" name="editDiscountPercentage" id="editDiscountPercentage" min="1"
                                    max="100" step="0.1" required />
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="editStartDate">Start Date:
                                <input type="date" name="editStartDate" id="editStartDate" required />
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="editEndDate">End Date:
                                <input type="date" name="editEndDate" id="editEndDate" required />
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="editStatus">Status</label>
                            <select name="editStatus" id="editStatus">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>

                        </div>
                        <button type="submit" class="action-btn">Update Discount</button>
                     </form>
                </div>
            </div>

            <!-- Delete Confirmation Modal -->
            <div id="deleteConfirmationModal" class="modal">
                <div class="modal-content">
                    <h3>Confirm Delete</h3>
                    <p>Are you sure you want to delete this discount?</p>
                    <form action="<?= ROOT ?>/discounts/delete" method="POST">
                        <input type="hidden" name="deleteDiscountId" id="deleteDiscountId">
                        <button type="submit" class="delete-btn">Delete</button>
                        <button type="button" class="cancel-btn" onclick="closeDeleteModal()">Cancel</button>
                    </form>
                </div>
            </div>

        </div>
    </main>
    <script src="<?= ROOT ?>/assets/js/sidebar.js"></script>
    <script src="<?= ROOT ?>/assets/js/salesManager/discounts.js"></script>
</body>

</html>