<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Products List</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/salesManager/common.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/salesManager/sidebar.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/salesManager/products.css" />
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
                            <img src="<?= ROOT ?>/assets/images/carbon-footprint.svg" alt="carbon-footprint" />
                            <span class="sidebar-titles">Carbon footprint</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= ROOT ?>/discounts">
                            <img src="<?= ROOT ?>/assets/images/discount.svg" alt="Discount" />
                            <span class="sidebar-titles">Discount</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="sidebar-active">
                            <img src="<?= ROOT ?>/assets/images/product.svg" alt="product" />
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

            <h1 class="logo">Product Details</h1>

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

        <div class="content">
            <div class="container">

                <div class="table-header">
                    <form class="search-bar" method="get" action="">
                        <img src="<?= ROOT ?>/assets/images/magnifying-glass-solid.svg" class="search-icon"
                            width="20px" />
                        <input type="text" name="search" value="<?= isset($search) ? htmlspecialchars($search) : '' ?>"
                            placeholder="Search products..." />
                        <button type="submit">Search</button>
                    </form>
                    <div>
                        <button class="action-btn" onclick="openAddModal()">Add Product</button>
                    </div>
                </div>

                <table id="productTable">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Product image</th>
                            <th>Description</th>
                            <th>Product Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="productTableBody">
                        <?php if (!empty($products)): ?>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td><?= htmlspecialchars($product->product_id) ?></td>
                                    <td><?= htmlspecialchars($product->productName) ?></td>
                                    <td><?= htmlspecialchars($product->productImage) ?></td>
                                    <td><?= htmlspecialchars($product->productDescription) ?></td>
                                    <td><?= htmlspecialchars($product->productStatus == 1 ? 'Active' : 'Inactive') ?></td>

                                    <td>
                                        <button class="edit-btn"
                                            onclick="openEditModal('<?= $product->product_id ?>', '<?= $product->productName ?>', '<?= $product->productImage ?>', '<?= $product->productDescription ?>','<?= $product->productStatus ?>')">Edit</button>
                                        <button class="delete-btn"
                                            onclick="openDeleteModal('<?= $product->product_id ?>')">Delete</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">No products found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

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


            <div id="addModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeAddModal()">&times;</span>
                    <h3>Add Product</h3>
                    <form action="<?= ROOT ?>/Products/add" id="productForm" enctype="multipart/form-data"
                        method="post">
                        <div class="form-group">
                            <label for="productName">Product Name:</label>
                            <input name="productName" type="text" id="productName" placeholder="Enter product Name"
                                required />
                        </div>
                        <div class="form-group">
                            <label for="img">Product Image:</label>
                            <input name="img" type="file" id="img" accept="image/*" required />
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea id="description" rows="4" name="description" minlength="3" required></textarea>
                        </div>

                        <button type="submit" class="action-btn">Add</button>
                    </form>
                </div>
            </div>

            <div id="editModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeEditModal()">&times;</span>
                    <h3>Edit Product</h3>
                    <form action="<?= ROOT ?>/Products/update" id="editProductForm" method="post"
                        enctype="multipart/form-data">
                        <input type="hidden" name="editProductID" id="editProductID" />
                        <div class="form-group">
                            <label for="editProductName">Product Name:</label>
                            <input name="editProductName" type="text" id="editProductName"
                                placeholder="Enter product Name" required />
                        </div>
                        <div class="form-group">
                            <label for="editProductImage">Product Image:</label>
                            <img id="existingImage" src="" alt="Product Image" style="width: 100px; height: auto" />
                            <input type="file" name="editImage" id="existingImage" accept="image/*" />
                        </div>
                        <div class="form-group">
                            <label for="editDescription">Description:</label>
                            <textarea id="editDescription" rows="4" name="editDescription" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="editStatus">Status</label>
                            <select name="editStatus" id="editStatus">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>

                        </div>
                        <button class="cancel-btn" onclick="closeDeleteModal()">Cancel</button>

                        <button type="submit" class="action-btn">Update</button>
                    </form>
                </div>
            </div>

            <div id="deleteConfirmationModal" class="modal">
                <div class="modal-content delete-modal">
                    <span class="close" onclick="closeDeleteModal()">&times;</span>
                    <h3>Confirm Delete</h3>
                    <p>Are you sure you want to delete this product?</p>
                    <form action="<?= ROOT ?>/Products/delete" id="deleteProductForm" method="post">
                        <input type="hidden" name="deleteProductID" id="deleteProductID" />
                        <div class="delete-modal-actions">
                            <button type="submit" class="confirm-btn">Confirm</button>
                            <button class="cancel-btn" onclick="closeDeleteModal()">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

            <div id="responseModal" class="modal">
                <div class="modal-content response-modal">
                    <span class="close" onclick="closeResponseModal()">&times;</span>
                    <h3>Action Status</h3>
                    <p id="responseMessage"></p>
                    <button class="action-btn" onclick="closeResponseModal()">Close</button>
                </div>
            </div>
        </div>
    </main>



    <script src="<?= ROOT ?>/assets/js/sidebar.js"></script>
    <script src="<?= ROOT ?>/assets/js/salesManager/product.js"></script>
</body>

</html>