<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/salesManager/common.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/salesManager/sidebar.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/salesManager/adsAndBanners.css" />
    <title>Ads/Banners</title>
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
                        <a href="<?= ROOT ?>/discounts">
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
                        <a href="<?= ROOT ?>/adsAndBanners" class="sidebar-active">
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

            <h1 class="logo">Ads / Banners</h1>

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

        <div id="ad-management" class="container">
            <!--Table Header-->

            <div class="table-header">
                <form class="search-bar" method="get" action="">
                    <img src="<?= ROOT ?>/assets/images/magnifying-glass-solid.svg" class="search-icon" width="20px" />
                    <input type="text" name="search" value="<?= isset($search) ? htmlspecialchars($search) : '' ?>"
                        placeholder="Search ads by title,description or dates..." />
                    <button type="submit">Search</button>
                </form>
                <div>
                    <button class="action-btn" onclick="openAddModal()">Add Ads/Banners</button>
                </div>
            </div>

            <!-- Existing Ads Section -->


            <table id="adTable">
                <thead>
                    <tr>
                        <th>Ads/Banner ID</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($adsAndBanners)): ?>
                        <?php foreach ($adsAndBanners as $adsAndBanner): ?>
                            <tr>
                                <td><?= htmlspecialchars($adsAndBanner->ad_id) ?></td>
                                <td><?= htmlspecialchars($adsAndBanner->title) ?></td>
                                <td><?= htmlspecialchars($adsAndBanner->image) ?></td>
                                <td><?= htmlspecialchars($adsAndBanner->description) ?></td>
                                <td><?= htmlspecialchars($adsAndBanner->status) ?></td>
                                <td><?= htmlspecialchars($adsAndBanner->start_date) ?></td>
                                <td><?= htmlspecialchars($adsAndBanner->end_date) ?></td>
                                <td>
                                    <button class="edit-btn"
                                        onclick="openEditModal('<?= $adsAndBanner->ad_id ?>', '<?= $adsAndBanner->title ?>', '<?= $adsAndBanner->image ?>','<?= $adsAndBanner->description ?>','<?= $adsAndBanner->start_date ?>', '<?= $adsAndBanner->end_date ?>')">Edit</button>
                                    <button class="delete-btn"
                                        onclick="openDeleteModal('<?= $adsAndBanner->ad_id ?>')">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">No data found.</td>
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

            <div id="addModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeAddModal()">&times;</span>
                    <h3>Add Ads/Banners</h3>

                    <form action="<?= ROOT ?>/AdsAndBanners/add" id="adForm" enctype="multipart/form-data"
                        method="post">
                        <input type="hidden" id="adId" name="adId" value="" />
                        <div class="form-group">
                            <label>Title:
                                <input type="text" id="adTitle" name="title" placeholder="Ad Title" required />
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Upload Banner File:
                                <input type="file" id="adImage" name="adImage" accept="image/*" required />
                            </label>
                            <div id="imagePreview" class="image-preview"></div>
                        </div>
                        <div class="form-group">
                            <label>Description:
                                <textarea id="adDescription" name="description" placeholder="Ad Description"
                                    required></textarea>
                            </label>
                        </div>

                        <div class="form-group date-inputs" id="scheduledDateContainer">
                            <label>Start Date:
                                <input type="date" id="adStartDate" name="startDate" />
                            </label>
                            <label>End Date:
                                <input type="date" id="adEndDate" name="endDate" />
                            </label>
                        </div>
                        <!-- <div class="form-group">
                            <label>Status:
                                <select id="adStatus" name="status" required>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="scheduled">Scheduled</option>
                                </select>
                            </label>
                        </div> -->

                        <div class="form-actions">
                            <button type="submit" class="action-btn" id="saveAdBtn">Save</button>
                            <button type="button" class="cancel-btn" onclick="closeAddModal()">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

            <div id="editModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeEditModal()">&times;</span>
                    <h3>Edit Ads/Banner</h3>

                    <form id="editAdForm" enctype="multipart/form-data" action="<?= ROOT ?>/AdsAndBanners/update"
                        method="post">
                        <input type="hidden" id="editAdId" name="adId" />
                        <div class="form-group">
                            <label>Title:
                                <input type="text" id="editAdTitle" name="title" placeholder="Ad Title" required />
                            </label>
                        </div>
                        <!-- <div class="form-group">
                            <label>Current Image:</label>
                            <div id="currentImagePreview" class="image-preview"></div>
                        </div>
                        <div class="form-group">
                            <label>Replace Image (Optional):
                                <input type="file" id="editAdImage" name="adImage" accept="image/*" />
                            </label>
                            <div id="editImagePreview" class="image-preview"></div>
                        </div> -->
                        <div class="form-group">
                            <label for="editAdImage">Ad Image:</label>
                            <img id="editAdImage" src="" alt="AD Image" style="width: 100px; height: auto" />
                            <input type="file" name="adImage" id="editAdImage" accept="image/*" />
                        </div>
                        <div class="form-group">
                            <label>Description:
                                <textarea id="editAdDescription" name="description" placeholder="Ad Description"
                                    required></textarea>
                            </label>
                        </div>
                        <!-- <div class="form-group">
                            <label>Status:
                                <select id="editAdStatus" name="status" required>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="scheduled">Scheduled</option>
                                </select>
                            </label>
                        </div> -->
                        <div class="form-group date-inputs" id="editScheduledDateContainer">
                            <label>Start Date:
                                <input type="date" id="editAdStartDate" name="startDate" />
                            </label>
                            <label>End Date:
                                <input type="date" id="editAdEndDate" name="endDate" />
                            </label>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="action-btn">Update</button>
                            <button type="button" class="cancel-btn" onclick="closeEditModal()">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Delete Confirmation Modal -->
            <div id="deleteModal" class="modal">
                <div class="modal-content delete-modal">
                    <span class="close" onclick="closeDeleteModal()">&times;</span>
                    <h3>Confirm Deletion</h3>
                    <p>Are you sure you want to delete this ad/banner? This action cannot be undone.</p>
                    <form action="<?= ROOT ?>/AdsAndBanners/delete" id="deleteAdForm" method="post">

                        <input type="hidden" id="deleteAdId" name="adId" />
                        <div class="form-actions">
                            <button type="submit" class="confirm-btn">Delete</button>
                            <button type="button" class="cancel-btn" onclick="closeDeleteModal()">Cancel</button>
                        </div>
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
    <script src="<?= ROOT ?>/assets/js/sidebar.js"></script>
    <script src="<?= ROOT ?>/assets/js/salesManager/adsAndBanners.js"></script>
</body>

</html>