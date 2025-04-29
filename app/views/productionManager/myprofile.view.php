<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="root-url" content="<?= ROOT ?>">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/productionManager/sidebar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/productionManager/common.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/productionManager/myprofile.css">
    <title>Profile | <?= $profile->role_name ?? 'Production Manager' ?></title>
</head>

<body>
    <nav id="sidebar">
        <button id="toggle-btn" onclick="toggleSidebar()" class="toggle-btn">
            <img src="<?= ROOT ?>/assets/images/menu.svg" alt="menu" />
        </button>
        <div class="sidebar-container">
            <!-- Profile image in sidebar -->
            <div class="prof-picture">
                <?php if (!empty($profile->image)): ?>
                    <img src="<?= ROOT ?>/<?= $profile->image ?>" alt="profile" />
                <?php else: ?>
                    <img src="<?= ROOT ?>/assets/images/user.svg" alt="profile" />
                <?php endif; ?>
                <span class="user-title"><?= $profile->role_name ?? 'Production Manager' ?></span>
            </div>
                <ul>
                    <li>
                        <a href="<?=ROOT?>/ProductionManagerHome"><img src="<?= ROOT ?>/assets/images/dashboard.svg" alt="dashboard" /><span
                                class="sidebar-titles">Dashboard</span></a>
                    </li>

                    <li>
                        <a href="<?= ROOT ?>/PendingCustomOrder"><img src="<?= ROOT ?>/assets/images/order.svg" /><span
                                class="sidebar-titles">Custom Orders</span></a>
                    </li>
                    <li>
                        <a href="<?= ROOT ?>/RecycledPolythene"><img src="<?= ROOT ?>/assets/images/recycle.svg" /><span
                                class="sidebar-titles">Recycled Polythene</span></a>
                    </li>
                    <li>
                        <a href="<?= ROOT ?>/Schedule"><img
                                src="<?= ROOT ?>/assets/images/collection.svg"
                                alt="site Performance" /><span class="sidebar-titles">Polythene Collection</span></a>
                    </li>
                    <li>
                        <a href="<?= ROOT ?>/SupplyRequest"><img src="<?= ROOT ?>/assets/images/supply.svg" alt="supply" /><span
                                class="sidebar-titles">Supply Requests</span></a>
                    </li>
                    <li>
                        <a href="<?= ROOT ?>/PelletsRequests"><img src="<?= ROOT ?>/assets/images/order.svg" alt="supply" /><span
                                class="sidebar-titles">Pellets Requests</span></a>
                    </li>
                </ul>
               </div>
        </div>
    </nav>

    <div class="content">
        <header class="header">
            <div class="logo">
                <img src="<?= ROOT ?>/assets/images/Waste360.png" alt="logo" />
                <h1>Waste360</h1>
            </div>
            <h1 class="logo">My Profile</h1>
            <nav class="nav">
                <ul>
                    <li><a href="<?= ROOT ?>/ProductionManagerProfile" class="active">Profile</a></li>
                    <li><a href="<?= ROOT ?>/logout">Logout</a></li>
                </ul>
            </nav>
        </header>
  
        <div class="profile-container">
            <!-- Display success or error messages -->
            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="alert success">
                    <?= $_SESSION['success_message'] ?>
                    <?php unset($_SESSION['success_message']); ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['error_message'])): ?>
                <div class="alert error">
                    <?= $_SESSION['error_message'] ?>
                    <?php unset($_SESSION['error_message']); ?>
                </div>
            <?php endif; ?>
            
            <div class="profile-card">
                <div class="profile-header">
                    <!-- Profile image in profile header -->
                    <div class="profile-image">
                        <?php if (!empty($profile->image)): ?>
                            <img src="<?= ROOT ?>/<?= $profile->image ?>" alt="Profile Image">
                        <?php else: ?>
                            <img src="<?= ROOT ?>/assets/images/user.svg" alt="Default Profile">
                        <?php endif; ?>
                    </div>
                    <div class="profile-title">
                        <h2><?= $profile->name ?? 'User' ?></h2>
                        <p><?= $profile->role_name ?? 'Production Manager' ?></p>
                    </div>
                </div>
                
                <div class="profile-tabs">
                    <button class="tab-btn active" data-tab="personal">Personal Info</button>
                    <button class="tab-btn" data-tab="password">Change Password</button>
                </div>
                
                <div class="tab-content" id="personal-tab">
                    <div class="profile-details">
                        <form action="<?= ROOT ?>/ProductionManagerProfile/update" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input type="text" id="name" name="name" value="<?= $profile->name ?? '' ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" value="<?= $profile->email ?? '' ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="text" id="phone" name="phone" value="<?= $profile->phone ?? '' ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea id="address" name="address" rows="3"><?= $profile->address ?? '' ?></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="profile_image">Profile Image</label>
                                <input type="file" id="profile_image" name="profile_image" accept="image/*">
                                <small>Leave empty to keep current image</small>
                            </div>
                            
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="tab-content" id="password-tab" style="display: none;">
                    <div class="profile-details">
                        <form action="<?= ROOT ?>/ProductionManagerProfile/changePassword" method="POST">
                            <div class="form-group">
                                <label for="current_password">Current Password</label>
                                <input type="password" id="current_password" name="current_password">
                            </div>
                            
                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input type="password" id="new_password" name="new_password">
                            </div>
                            
                            <div class="form-group">
                                <label for="confirm_password">Confirm New Password</label>
                                <input type="password" id="confirm_password" name="confirm_password">
                            </div>
                            
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="<?= ROOT ?>/assets/js/productionManager/sidebar.js"></script>
    <script>
        // Tab switching functionality
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.tab-btn');
            const tabContents = document.querySelectorAll('.tab-content');
            
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    // Remove active class from all tabs
                    tabs.forEach(t => t.classList.remove('active'));
                    
                    // Add active class to current tab
                    this.classList.add('active');
                    
                    // Hide all tab contents
                    tabContents.forEach(content => {
                        content.style.display = 'none';
                    });
                    
                    // Show current tab content
                    const tabId = this.getAttribute('data-tab');
                    document.getElementById(tabId + '-tab').style.display = 'block';
                });
            });
        });
    </script>
</body>
</html>