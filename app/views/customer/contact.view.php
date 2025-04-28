<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Us</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/contact.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"
        rel="stylesheet" />
</head>

<body>
    <?php
    if (isset($_SESSION['user_id'])) {
        $profileLink = ROOT . '/profile';
    } else {
        $profileLink = ROOT . '/login';
    }

    // Set default tab and status tab
    $activeTab = isset($_GET['tab']) ? $_GET['tab'] : 'contact';
    $activeStatusTab = isset($_GET['statusTab']) ? $_GET['statusTab'] : 'issues';
    
    // Process issue status form
    $issueStatus = null;
    if (isset($_POST['checkIssue']) && !empty($_POST['issueReference'])) {
        $issueReference = htmlspecialchars($_POST['issueReference']);
        // In a real application, you would fetch this data from a database
        $issueStatus = [
            'reference' => $issueReference,
            'status' => 'In Progress',
            'submitted' => date('Y-m-d'),
            'lastUpdated' => date('Y-m-d'),
            'description' => 'Your issue is currently being reviewed by our support team.'
        ];
        $activeTab = 'status';
        $activeStatusTab = 'issues';
    }
    
    // Process return status form
    $returnStatus = null;
    if (isset($_POST['checkReturn']) && !empty($_POST['returnReference'])) {
        $returnReference = htmlspecialchars($_POST['returnReference']);
        // In a real application, you would fetch this data from a database
        $returnStatus = [
            'reference' => $returnReference,
            'status' => 'Approved',
            'submitted' => date('Y-m-d'),
            'expectedCompletion' => date('Y-m-d', strtotime('+7 days')),
            'details' => 'Your return has been approved and is being processed.'
        ];
        $activeTab = 'status';
        $activeStatusTab = 'returns';
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
        <!-- Tab Navigation -->
        <div class="tab-container">
            <div class="tab-header">
                <a href="?tab=contact" class="tab-button <?= $activeTab == 'contact' ? 'active' : '' ?>">
                    Contact Us
                </a>
                <a href="?tab=status" class="tab-button <?= $activeTab == 'status' ? 'active' : '' ?>">
                    Check Status
                </a>
            </div>
            
            <!-- Contact Form Tab -->
            <div id="contact" class="tab-content <?= $activeTab == 'contact' ? 'active' : '' ?>">
                <section class="contact-section">
                    <h2>Contact for support</h2>
                    <form id="contactForm" method="post" action="">
                        <label for="email">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="Enter your email"
                            required />

                        <label for="reason">Reason</label>
                        <select id="reason" name="reason" required>
                            <option value="returns">Returns</option>
                            <option value="general">General</option>
                        </select>
                        <label for="details">Details</label>
                        <textarea
                            id="details"
                            name="details"
                            rows="4"
                            placeholder="Enter your message here..."
                            required></textarea>
                        <label for="phone">Phone</label>
                        <input
                            type="tel"
                            id="phone"
                            name="phone"
                            placeholder="Enter your phone number"
                            required />

                        <button type="submit" name="submitContact">Submit</button>
                    </form>
                </section>
            </div>
            
            <!-- Status Check Tab -->
            <div id="status" class="tab-content <?= $activeTab == 'status' ? 'active' : '' ?>">
                <section class="status-section">
                    <h2>Check Request Status</h2>
                    
                    <!-- Status Type Tabs -->
                    <div class="status-tab-header">
                        <a href="?tab=status&statusTab=issues" class="status-tab-button <?= $activeStatusTab == 'issues' ? 'active' : '' ?>">
                            Issues
                        </a>
                        <a href="?tab=status&statusTab=returns" class="status-tab-button <?= $activeStatusTab == 'returns' ? 'active' : '' ?>">
                            Returns
                        </a>
                    </div>
                    
                    <!-- Issues Status Tab -->
                    <div id="issues" class="status-tab-content <?= $activeStatusTab == 'issues' ? 'active' : '' ?>">
                        <form id="issuesStatusForm" method="post" action="">
                            <label for="issueReference">Reference Number</label>
                            <input
                                type="text"
                                id="issueReference"
                                name="issueReference"
                                placeholder="Enter your issue reference number"
                                required />
                            
                            <button type="submit" name="checkIssue">Check Status</button>
                        </form>
                        
                        <div class="status-result" id="issueStatusResult">
                            <?php if ($issueStatus): ?>
                            <div class="status-card">
                                <h3>Issue #<?= $issueStatus['reference'] ?></h3>
                                <div class="status-info">
                                    <p><strong>Status:</strong> <span class="status-badge in-progress"><?= $issueStatus['status'] ?></span></p>
                                    <p><strong>Submitted:</strong> <?= $issueStatus['submitted'] ?></p>
                                    <p><strong>Last Updated:</strong> <?= $issueStatus['lastUpdated'] ?></p>
                                    <p><strong>Description:</strong> <?= $issueStatus['description'] ?></p>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Returns Status Tab -->
                    <div id="returns" class="status-tab-content <?= $activeStatusTab == 'returns' ? 'active' : '' ?>">
                        <form id="returnsStatusForm" method="post" action="">
                            <label for="returnReference">Return ID</label>
                            <input
                                type="text"
                                id="returnReference"
                                name="returnReference"
                                placeholder="Enter your return ID"
                                required />
                            
                            <button type="submit" name="checkReturn">Check Status</button>
                        </form>
                        
                        <div class="status-result" id="returnStatusResult">
                            <?php if ($returnStatus): ?>
                            <div class="status-card">
                                <h3>Return #<?= $returnStatus['reference'] ?></h3>
                                <div class="status-info">
                                    <p><strong>Status:</strong> <span class="status-badge approved"><?= $returnStatus['status'] ?></span></p>
                                    <p><strong>Submitted:</strong> <?= $returnStatus['submitted'] ?></p>
                                    <p><strong>Expected Completion:</strong> <?= $returnStatus['expectedCompletion'] ?></p>
                                    <p><strong>Details:</strong> <?= $returnStatus['details'] ?></p>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer-content">
            <p>Call us - 077 7168174</p>
            <p>Get in touch - info@waste360.lk</p>
        </div>
    </footer>
</body>

</html>