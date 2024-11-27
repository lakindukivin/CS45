<?php
include "../../../../connect.php";
$reply_id = $_GET['updateid'];
$sql = "SELECT * FROM `reviewreply` WHERE reply_id = '$reply_id'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$review_id = $row['review_id'];
$customer_id = $row['customer_id'];
$customer_id = $row['order_id'];
$comment = $row['comment'];
$reply = $row['reply'];

if(isset($_POST['submit'])){
    $review_id = $_POST['review_id'];
    $customer_id = $_POST['customer_id'];
    $order_id = $_POST['customer_id'];
    $comment = $_POST['comment'];
    $reply = $_POST['reply'];

    $sql = "update `reviewreply` set reply_id=$reply_id, review_id = '$review_id', customer_id = '$customer_id', order_id = '$order_id',
            comment = '$comment', reply = '$reply' where reply_id=$reply_id";
    $result = mysqli_query($con, $sql);
    if($result){
        echo '<script>alert("Reply submitted successfully");
        window.location.href="replied_table.php"</script>';
    }else{
        echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
    }
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
    <title>Waste360|Dashboard|CSM</title>
</head>
<body>
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
                        <a href="../../html/home.html"><img src="../../../../assets/dashboard.svg" alt="dashboard" />
                            <span class="sidebar-titles">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="../give_away/give_away_request.html">
                            <img src="../../../../assets/give_away.svg" alt="give away" />
                            <span class="sidebar-titles">Give Away</span>
                        </a>
                    </li>
                    <li>
                        <a href="../../html/returns/returns.html">
                            <img src="../../../../assets/returns.svg" alt="returns" />
                            <span class="sidebar-titles">Returns</span>
                        </a>
                    </li>
                    <li>
                        <a href="../manage_orders/manage_order.html">
                            <img src="../../../../assets/manage_order.svg" alt="manage order" />
                            <span class="sidebar-titles">Manage order</span>
                        </a>
                    </li>
                    <li>
                        <a href="manage_reviews.php" class="sidebar-active">
                            <img src="../../../../assets/reviews.svg" alt="reviews" />
                            <span class="sidebar-titles">Manage Reviews</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

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
                    <div class="form-group">
                        <label for="customer_id">Order ID</label>
                        <input type="text" id="order_id" name="customer_id" value="<?php echo htmlspecialchars($customer_id); ?>" readonly>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="comment">comment</label>
                    <textarea id="comment" name="comment" readonly><?php echo htmlspecialchars($comment); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="reply">Reply</label>
                    <textarea id="reply" name="reply" 
                    placeholder="Enter your reply" required autocomplete = "off"><?php echo $reply;?></textarea>
                </div>

                <div style="text-align: center;">
                    <button type="submit" name="submit" class="submit-button">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script src="../../javaScript/manage_reviews.js"></script>
    <script src="../../javaScript/sidebar.js"></script>
</body>
</html>