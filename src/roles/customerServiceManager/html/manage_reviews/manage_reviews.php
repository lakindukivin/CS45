<?php
include "../../../../connect.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" reply="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../styles/common.css">
  <link rel="stylesheet" href="../../styles/sidebar.css">
  <link rel="stylesheet" href="../../styles/manage_review/manage_review.css">
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
            <a href="../home.html"><img src="../../../../assets/dashboard.svg"
                alt="dashboard" /><span class="sidebar-titles">Dashboard</span></a>
          </li>

          <li>
            <a href="../give_away/give_away_request.html"><img
                src="../../../../assets/give_away.svg" /><span class="sidebar-titles">Give Away</span></a>
          </li>
          <li>
            <a href="../returns/returns.html"><img
                src="../../../../assets/returns.svg" /><span class="sidebar-titles">Returns</span></a>
          </li>
          <li>
            <a href="../manage_orders/manage_order.html"><img
                src="../../../../assets/manage_order.svg" /><span class="sidebar-titles">Manage order</span></a>
          </li>
          <li>
            <a href="../manage_reviews/manage_reviews.php" class="sidebar-active"><img src="../../../../assets/reviews.svg" /><span class="sidebar-titles">Manage
                Reviews</span></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="content">
  <header class="header">
      <div class="logo">
        <img src="../../../../assets/Waste360.png" alt="logo" />
        <h1>Waste360</h1>
      </div>
      <h1 class="logo"></h1>
      <nav class="nav">
        <ul>
          <li><a href="#"><img src="../../../../assets/notifications.svg"></a></li>
          <li><a href="#">Profile</a></li>
          <li><a href="#">Logout</a></li>
        </ul>
      </nav>
    </header>

    <div class="rep-button">
      <button class="reply-button"> <a href="replied_table.php">View</a></button>
    </div>

    <div class="box">
      <div class="table-container">
        <table id="collectionTable">
            <thead>
                <tr>
                    <th>Review_ID</th>
                    <th>Customer_ID</th>
                    <th>Order_ID</th>
                    <th>Comment</th>
                    <th>Date</th>
                    <th>Reply</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT * FROM review";
            $result = mysqli_query($con, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["review_id"] . "</td>";
                    echo "<td>" . $row["customer_id"] . "</td>";
                    echo "<td>" . $row["order_id"] . "</td>";
                    echo "<td>" . $row["comment"] . "</td>";
                    echo "<td>" . $row["date"] . "</td>";
                    echo "<td>
                    <button><a href='reply.php?review_id=" . $row['review_id'] . "'>
                        Reply</button>
                    </a>
                    </td>";                    
                    
                    echo "</tr>";       
                }
            }
            else {
                echo "<tr><td colspan='6'>No data found</td></tr>";
            }
            ?>            
        </tbody>
        </table>
    </div>
  </div>
  <script src="../../javaScript/manage_reviews/manage_reviews.js"></script>
  <script src="../../javaScript/sidebar.js"></script>
</body>

</html>