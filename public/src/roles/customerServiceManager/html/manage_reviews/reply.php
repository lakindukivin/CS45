<?php
include "../../../../connect.php";

// Initialize variables
$review_id = "";
$customer_id = "";
$order_id = "";
$comment = "";

// Fetch review data if review_id is provided via GET
if (isset($_GET['review_id'])) {
    $review_id = intval($_GET['review_id']); // Ensure review_id is an integer

    // Use prepared statements to fetch review details
    $sql = "SELECT * FROM `review` WHERE review_id = ?";
    $stmt = $con->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $con->error);
    }

    $stmt->bind_param("i", $review_id); // Bind review_id as an integer
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $customer_id = $row['customer_id'];
        $order_id = $row['order_id'];
        $comment = $row['comment']; // Assuming 'comment' holds the review comment
    } else {
        echo "<script>alert('No review found with the given ID.');</script>";
        echo "<script>window.location.href = '../manage_reviews/manage_reviews.php';</script>";
        exit;
    }

    $stmt->close();
} else {
    echo "<script>alert('No review ID provided.');</script>";
    echo "<script>window.location.href = '../manage_reviews/manage_reviews.php';</script>";
    exit;
}

// Handle form submission
if (isset($_POST['submit'])) {
    $reply = $_POST['reply'];

    // Use prepared statements to insert reply into the reply table
    $sql = "INSERT INTO `reviewreply` (review_id, customer_id, order_id, comment, reply) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $con->error);
    }

    $stmt->bind_param("iisss", $review_id, $customer_id, $order_id, $comment, $reply);

    if ($stmt->execute()) {
        echo "<script>alert('Reply submitted successfully');</script>";
        echo "<script>window.location.href = '../manage_reviews/manage_reviews.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/sidebar.css?version=1">
    <link rel="stylesheet" href="../../styles/manage_review/reply.css">
    <link rel="stylesheet" href="../../styles/common.css">
    <title>Waste360 | Dashboard | CSM</title>
</head>
<body>
    <!-- Sidebar -->
    <nav id="sidebar">
        <button id="toggle-btn" onclick="toggleSidebar()" class="toggle-btn">
            <img src="../../../../assets/menu.svg" alt="menu" />
        </button>
        <div class="sidebar-container">
            <div class="prof-picture">
                <img src="../../../../assets/user.svg" alt="profile" />
                <span class="user-title">Customer Service Manager</span>
            </div>
            <div>
                <ul>
                    <li>
                        <a href="../home.html">
                            <img src="../../../../assets/dashboard.svg" alt="dashboard" />
                            <span class="sidebar-titles">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="../give_away/give_away_request.html">
                            <img src="../../../../assets/give_away.svg" />
                            <span class="sidebar-titles">Give Away</span>
                        </a>
                    </li>
                    <li>
                        <a href="../returns/returns.html">
                            <img src="../../../../assets/returns.svg" />
                            <span class="sidebar-titles">Returns</span>
                        </a>
                    </li>
                    <li>
                        <a href="../manage_orders/manage_order.html">
                            <img src="../../../../assets/manage_order.svg" />
                            <span class="sidebar-titles">Manage order</span>
                        </a>
                    </li>
                    <li>
                        <a href="../manage_reviews/manage_reviews.php" class="sidebar-active">
                            <img src="../../../../assets/reviews.svg" />
                            <span class="sidebar-titles">Manage Reviews</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Reply Form -->
    <div class="reply">
        <header class="header">
            <div class="logo">
                <img src="../../../../assets/Waste360.png" alt="logo" />
                <h2>Waste360</h2>
            </div>
            <h2>Reply to Review</h2>
            <nav class="nav">
                <ul>
                    <li><a href="#"><img src="../../../../assets/notifications.svg" alt="notifications"></a></li>
                    <li><a href="#">Profile</a></li>
                    <li><a href="#">Logout</a></li>
                </ul>
            </nav>
        </header>

        <div class="formm">
            <form action="" method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label for="review_id">Review ID</label>
                        <input type="text" id="review_id" name="review_id" value="<?php echo htmlspecialchars($review_id); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="customer_id">Customer ID</label>
                        <input type="text" id="customer_id" name="customer_id" value="<?php echo htmlspecialchars($customer_id); ?>" readonly>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="comment">comment</label>
                    <textarea id="comment" name="comment" readonly><?php echo htmlspecialchars($comment); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="reply">Reply</label>
                    <textarea id="reply" name="reply" placeholder="Enter your reply" required></textarea>
                </div>

                <div style="text-align: center;">
                    <button type="submit" name="submit" class="submit-button">Submit Reply</button>
                </div>
            </form>
        </div>
    </div>

    <script src="../../javaScript/manage_reviews.js"></script>
    <script src="../../javaScript/sidebar.js"></script>
</body>
</html>
