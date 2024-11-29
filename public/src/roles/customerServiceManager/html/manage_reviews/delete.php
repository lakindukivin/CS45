<?php
include "../../../../connect.php";
if (isset($_GET['deleteid'])) {
    $reply_id = $_GET['deleteid'];
    $sql = "DELETE FROM reviewreply WHERE reply_id = $reply_id";
    $result = mysqli_query($con, $sql);
    if ($result) {
          echo "<script>alert('Reply deleted successfully');
          window.location.href='replied_table.php';
          </script>";
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }
}