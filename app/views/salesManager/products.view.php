<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Products List</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/salesManager/common.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/salesManager/sidebar.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/salesManager/products.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
</head>

<body>


    <header>
        <a href="#" class="logo">
            <img src="<?= ROOT ?>/assets/images/Waste360.png" alt="Waste360 Logo" class="logo-image" />
            <span>Waste360</span>
        </a>

        <nav>
            <ul class="nav-links">
                <li><a href="<?= ROOT ?>">Home</a></li>

                <li>
                    <a href="<?= $profileLink ?>" class="profile-icon">
                        <div class="profile-placeholder"></div>
                    </a>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <nav id="sidebar">
            <button id="toggle-btn" onclick="toggleSidebar()" class="toggle-btn">
                <img src="<?= ROOT ?>/assets/images/menu.svg" alt="menu" />
            </button>
            <div class="sidebar-container">
                <div class="prof-picture">
                    <img src="<?= ROOT ?>/assets/images/profile-circle.svg" alt="profile" />

                </div>
                <div>
                    <span class="user-title">Sales and Marketing Manager</span>
                </div>

                <div>
                    <ul>
                        <li>
                            <a href="<?= ROOT ?>/home">
                                <img src="<?= ROOT ?>/assets/images/dashboard.svg" alt="dashboard" />
                                <span class="sidebar-titles">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= ROOT ?>/carbon-footprint">
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
                            <a href="<?= ROOT ?>/ads-and-banners">
                                <img src="<?= ROOT ?>/assets/images/ads.svg" alt="ads/banners" />
                                <span class="sidebar-titles">Ads/Banners</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= ROOT ?>/generate-reports">
                                <img src="<?= ROOT ?>/assets/images/report.svg" alt="reports" />
                                <span class="sidebar-titles">Generate Reports</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="content">
            <div class="table-container">
                <div>
                    <h2>Product List</h2>
                </div>

                <div class="table-header">
                    <div class="search-bar">
                        <img src="<?= ROOT ?>/assets/images/magnifying-glass-solid.svg" class="search-icon"
                            width="50px" />
                        <input type="text" />
                        <button>Search</button>
                    </div>
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
                            <th>price</th>
                            <th>Description</th>
                            <th>Pack Size</th>
                            <th>Bag Size</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="productTableBody"></tbody>
                </table>
            </div>

            <div id="manageCustomerAccountsCard"></div>

            <div id="addModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeAddModal()">&times;</span>
                    <h3>Add Product</h3>
                    <form id="productForm" enctype="multipart/form-data" method="post">
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
                            <label for="productPrice">Product Price:</label>
                            Rs.<input name="productPrice" type="number" id="productPrice"
                                placeholder="Enter product Price" min="0" required />
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea id="description" rows="4" name="description" minlength="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="packSize">Pack Size:</label>
                            <select id="packSize" name="packSize" required>
                                <option value="none">None</option>
                                <option value="small">Small</option>
                                <option value="medium">Medium</option>
                                <option value="large">Large</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="bagSize">Bag Size:</label>
                            <select id="bagSize" name="bagSize" required>
                                <option value="none">None</option>
                                <option value="small">Small</option>
                                <option value="medium">Medium</option>
                                <option value="large">Large</option>
                            </select>
                        </div>
                        <button type="submit" class="action-btn">Add</button>
                    </form>
                </div>
            </div>

            <div id="editModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeEditModal()">&times;</span>
                    <h3>Edit Product</h3>
                    <form id="editProductForm" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="product_id" id="editProductID" />
                        <div class="form-group">
                            <label for="editProductName">Product Name:</label>
                            <input name="product_name" type="text" id="editProductName" placeholder="Enter product Name"
                                required />
                        </div>
                        <div class="form-group">
                            <label for="editProductImage">Product Image:</label>
                            <img id="existingImage" src="" alt="Product Image" style="width: 100px; height: auto" />
                            <input type="text" name="existing_image" id="existingImage" accept="image/*" />
                        </div>
                        <div class="form-group">
                            <label for="editProductPrice">Product Price:</label>
                            Rs.<input name="product_price" type="number" min="0" id="editProductPrice"
                                placeholder="Enter product Price" required />
                        </div>
                        <div class="form-group">
                            <label for="editDescription">Description:</label>
                            <textarea id="editDescription" rows="4" name="description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="editPackSize">Pack Size:</label>
                            <select id="packSize" name="packSize" required>
                                <option value="none">None</option>
                                <option value="small">Small</option>
                                <option value="medium">Medium</option>
                                <option value="large">Large</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editBagSize">Bag Size:</label>
                            <select id="bagSize" name="bagSize" required>
                                <option value="none">None</option>
                                <option value="small">Small</option>
                                <option value="medium">Medium</option>
                                <option value="large">Large</option>
                            </select>
                        </div>
                        <button type="submit" class="action-btn">Update</button>
                    </form>
                </div>
            </div>

            <div id="deleteConfirmationModal" class="modal">
                <div class="modal-content delete-modal">
                    <span class="close" onclick="closeDeleteModal()">&times;</span>
                    <h3>Confirm Delete</h3>
                    <p>Are you sure you want to delete this product?</p>
                    <div class="delete-modal-actions">
                        <button class="cancel-btn" onclick="closeDeleteModal()">Cancel</button>
                        <button class="confirm-btn" onclick="confirmDelete()">Confirm</button>
                    </div>
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

    <footer>
        <div class="footer-content">
            <p>© 2024 Waste360. All rights reserved.</p>
        </div>
    </footer>

    <script src="<?= ROOT ?>/assets/js/sidebar.js"></script>
    <script src="<?= ROOT ?>/assets/js/modal.js"></script>
    <script src="<?= ROOT ?>/assets/js/products.js"></script>
</body>

</html>