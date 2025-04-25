<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/salesManager/common.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/salesManager/sidebar.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/salesManager/products.css" />
    <title>Products List</title>
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
                            <span class="sidebar-titles">Carbon Footprint</span>
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
                        <button class="action-btn" onclick="openBagSizeModal()">Manage Bag Sizes</button>
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
                            <th style="width:100px">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="productTableBody">
                        <?php if (!empty($products)): ?>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td><?= htmlspecialchars($product->product_id) ?></td>
                                    <td><?= htmlspecialchars($product->productName) ?></td>
                                    <td>
                                        <?php if (!empty($product->productImage)): ?>
                                            <img src="<?= ROOT . $product->productImage ?>" alt="Product Image"
                                                style="width: 90px; height: 90px;" />
                                        <?php else: ?>
                                            No image
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($product->productDescription) ?></td>
                                    <td><?= $product->productStatus == 1 ? "<a href=Products/setInactive?product_id=" . $product->product_id . " class='active-btn'>Active</a>" : "<a  href=Products/setActive?product_id=" . $product->product_id . " class='inactive-btn'>Inactive</a>"; ?>
                                    </td>

                                    <td>
                                        <button class="edit-btn"
                                            onclick="openEditModal('<?= $product->product_id ?>', '<?= $product->productName ?>', '<?= $product->productImage ?>', '<?= $product->productDescription ?>','<?= $product->productStatus ?>')">
                                            <img src="<?= ROOT ?>/assets/images/edit-btn.svg"" alt=" edit">
                                        </button>
                                        <?php if ($product->productStatus == 1): ?>
                                            <button class="delete-btn" onclick="openDeleteModal('<?= $product->product_id ?>')">
                                                <img src="<?= ROOT ?>/assets/images/delete-btn.svg"" alt=" delete">
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan=" 6">No products found.
                                </td>
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
                            <label for="productType">Product Type:</label>
                            <select name="productType" id="productType">
                                <option value="Bags">Bags</option>
                                <option value="Pellets">Pellets</option>
                            </select>
                        </div>
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
                        <input type="hidden" name="existingImagePath" id="existingImagePath" />
                        <div class="form-group">
                            <label for="editProductName">Product Name:</label>
                            <input name="editProductName" type="text" id="editProductName"
                                placeholder="Enter product Name" required />
                        </div>
                        <div class="form-group">
                            <label for="editProductImage">Product Image:</label>
                            <img id="existingImage" src="" alt="Product Image" style="width: 100px; height: auto" />
                            <input type="file" name="editImage" id="editImage" accept="image/*" />
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
                        <button type="submit" class="action-btn">Update</button>
                    </form>
                </div>
            </div>

            <div id="deleteConfirmationModal" class="modal">
                <div class="modal-content delete-modal">
                    <h3>Confirm Delete</h3>
                    <p>Are you sure you want to delete this product?</p>
                    <form action="<?= ROOT ?>/Products/delete" id="deleteProductForm" method="post">
                        <input type="hidden" name="deleteProductID" id="deleteProductID" />
                        <div class="delete-modal-actions">
                            <button type="submit" class="confirm-btn">Confirm</button>
                            <button type="button" class="cancel-btn" onclick="closeDeleteModal()">Cancel</button>
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

            <div id="bagSizeModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeBagSizeModal()">&times;</span>
                    <h3>Manage Bag Sizes</h3>

                    <!-- Display Existing Bag Sizes -->
                    <div class="form-container">
                        <div class="bag-sizes-header">
                            <h4>Current Bag Sizes</h4>
                            <button type="button" class="action-btn" onclick="openAddBagSizeModal()">Add New</button>
                        </div>
                        <table id="bagSizesTable">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Bag Size</th>
                                    <th>Weight (kg)</th>
                                    <th>Price (Rs)</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($productHasBagSizes)):
                                    foreach ($productHasBagSizes as $bagSize):
                                        ?>
                                        <tr>
                                            <td><?= htmlspecialchars($bagSize->productName) ?></td>
                                            <td><?= htmlspecialchars($bagSize->bag_size) ?></td>
                                            <td><?= htmlspecialchars($bagSize->weight) ?></td>
                                            <td><?= htmlspecialchars($bagSize->price) ?></td>
                                            <td>
                                                <button class="edit-btn"
                                                    onclick="openEditBagSizeModal(<?= $bagSize->product_id ?>, <?= $bagSize->bag_id ?>, '<?= $bagSize->weight ?>', '<?= $bagSize->price ?>')">
                                                    <img src="<?= ROOT ?>/assets/images/edit-btn.svg" alt="edit">
                                                </button>
                                                <button class="delete-btn"
                                                    onclick="openDeleteBagSizeModal(<?= $bagSize->product_id ?>, <?= $bagSize->bag_id ?>)">
                                                    <img src="<?= ROOT ?>/assets/images/delete-btn.svg" alt="delete">
                                                </button>
                                            </td>
                                        </tr>
                                        <?php
                                    endforeach;
                                else:
                                    ?>
                                    <tr>
                                        <td colspan="5">No bag sizes found</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            <!-- Add Bag Size Modal -->
            <div id="addBagSizeModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeAddBagSizeModal()">&times;</span>
                    <h3>Add New Bag Size</h3>
                    <form action="<?= ROOT ?>/ProductHasBagSizes/add" method="post" id="addBagSizeForm">
                        <div class="form-group">
                            <label for="product_id">Product:</label>
                            <select name="product_id" id="product_id" required>
                                <option value="">Select a product</option>
                                <?php if (!empty($allProducts)): ?>
                                    <?php foreach ($allProducts as $product): ?>
                                        <option value="<?= $product->product_id ?>">
                                            <?= htmlspecialchars($product->productName) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="bag_id">Bag Size:</label>
                            <select name="bag_id" id="bag_id" required>
                                <option value="1">Small</option>
                                <option value="2">Large</option>
                                <option value="3">Extra Large</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="weight">Weight (kg):</label>
                            <input type="number" step="0.001" name="weight" id="weight" min="0"
                                placeholder="Enter bag weight" required />
                        </div>
                        <div class="form-group">
                            <label for="price">Price (Rs):</label>
                            <input type="number" step="0.01" name="price" id="price" placeholder="Enter bag price"
                                min="0" required />
                        </div>
                        <button type="submit" class="action-btn">Add Bag Size</button>
                    </form>
                </div>
            </div>

            <!-- Edit Bag Size Modal -->
            <div id="editBagSizeModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeEditBagSizeModal()">&times;</span>
                    <h3>Edit Bag Size</h3>
                    <form action="<?= ROOT ?>/ProductHasBagSizes/update" method="post" id="editBagSizeForm">
                        <input type="hidden" name="editProductID" id="editProductID">
                        <input type="hidden" name="editBagID" id="editBagID">

                        <div class="form-group">
                            <label for="editWeight">Weight (kg):</label>
                            <input type="number" step="0.001" name="editWeight" id="editWeight" required>
                        </div>
                        <div class="form-group">
                            <label for="editPrice">Price (Rs):</label>
                            <input type="number" step="0.01" name="editPrice" id="editPrice" required>
                        </div>
                        <button type="submit" class="action-btn">Update</button>
                    </form>
                </div>
            </div>

            <!-- Delete Bag Size Modal -->
            <div id="deleteBagSizeModal" class="modal">
                <div class="modal-content delete-modal">
                    <h3>Confirm Delete</h3>
                    <p>Are you sure you want to delete this bag size?</p>
                    <form action="<?= ROOT ?>/ProductHasBagSizes/delete" method="post" id="deleteBagSizeForm">
                        <input type="hidden" name="product_id" id="deleteBagSizeProductID">
                        <input type="hidden" name="bag_id" id="deleteBagSizeGagID">
                        <div class="delete-modal-actions">
                            <button type="submit" class="confirm-btn">Confirm</button>
                            <button type="button" class="cancel-btn" onclick="closeDeleteBagSizeModal()">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </main>

    <script src="<?= ROOT ?>/assets/js/sidebar.js"></script>
    <script src="<?= ROOT ?>/assets/js/formValidation.js"></script>
    <script src="<?= ROOT ?>/assets/js/salesManager/product.js"></script>
</body>

</html>