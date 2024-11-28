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
  <link rel="stylesheet" href="../../styles/manage_review/manage_review.css?version=3">
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

    <div class="box">
      <div class="table-container">
        <table id="collectionTable">
            <thead>
                <tr>
                    <th scpoe= 'col' style="width: 5%;">reply_id</th>
                    <th scpoe= 'col' style="width: 5%;">review_id</th>
                    <th scpoe= 'col' style="width: 5%;">Customer_id</th>
                    <th scpoe= 'col' style="width: 5%;">Order_id</th>
                    <th scpoe= 'col' style="width: 20%;">comment</th>
                    <th scpoe= 'col' style="width: 15%;">date</th>
                    <th scpoe= 'col' style="width: 15%;">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $sql="Select * from reviewreply";
            $result=mysqli_query($con,$sql);
            if($result){
              while($row=mysqli_fetch_assoc($result)){
                $reply_id=$row['reply_id'];
                $review_id=$row['review_id'];
                $customer_id=$row['customer_id'];
                $order_id=$row['order_id'];
                $comment=$row['comment'];
                $date=$row['date'];
              echo '<tr>
                <th scope="row">'.$reply_id.'</th>
                <td>'.$review_id.'</td>
                <td>'.$customer_id.'</td>
                <td>'.$order_id.'</td>
                <td>'.$comment.'</td>
                <td>'.$date.'</td>
                <td>
                  <button><a href="replied_reply.php?updateid='.$reply_id.'">Update</a></button>
                  <button><a href="delete.php?deleteid='.$reply_id.'">Delete</a></button>  
                </td>
                </tr>';
              }
            }
            ?>
            </tbody>
        </table>
    </div>
  </div>
  <script src="../../javaScript/sidebar.js"></script>
</body>

</html>