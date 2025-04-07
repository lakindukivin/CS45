<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/customerServiceManager/sidebar.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/customerServiceManager/returns.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/customerServiceManager/common.css">
    <title>Waste360|Dashboard|CSM</title>
</head>
<body>
    <nav id="sidebar">
      <button id="toggle-btn" onclick="toggleSidebar()" class="toggle-btn">
        <img src="<?=ROOT?>/assets/images/menu.svg" alt="menu" />
      </button>
      <div class="sidebar-container">
        <div class="prof-picture">
          <img src="<?=ROOT?>/assets/images/user.svg" alt="profile" />
          <span class="user-title">Customer Service Manager</span>
        </div>

        <div>
          <ul>
            <li>
              <a href="<?=ROOT?>/CSManagerHome"
                ><img src="<?=ROOT?>/assets/images/dashboard.svg" alt="dashboard" /><span
                  class="sidebar-titles"
                  >Dashboard</span
                ></a
              >
            </li>

            <li>
              <a href="<?=ROOT?>/GiveAwayRequest"
                ><img src="<?=ROOT?>/assets/images/give_away.svg" /><span
                  class="sidebar-titles"
                  >Give Away</span
                ></a
              >
            </li>
            <li>
              <a href="#" class="sidebar-active"
                ><img src="<?=ROOT?>/assets/images/returns.svg" /><span
                  class="sidebar-titles"
                  >Returns</span
                ></a
              >
            </li>
            <li>
              <a href="<?=ROOT?>/ManageOrders"
                ><img
                  src="<?=ROOT?>/assets/images/manage_order.svg"
                /><span class="sidebar-titles">Manage Orders</span></a
              >
            </li>
            <li>
              <a href="<?=ROOT?>/ManageReviews"
                ><img src="<?=ROOT?>/assets/images/reviews.svg" /><span
                  class="sidebar-titles"
                  >Manage Reviews</span
                ></a
              >
            </li>
          </ul>
        </div> 
      </div>
    </nav>

  <div class="content">
  <div id="returnUpdatePopup">
      <div class="popup-content">
        <form action="" method="post" class="bg-white p-5 rounded-md w-full">
          <div class="popup-content">
            <h1>Return Update</h1>
            <button type="button" class="btn-secondary-color" id="closePopupBtn">Close</button>
          </div>

          <div class="popup-content">
            <label for="Order-id" class="">Order ID:</label>
            <input type="text" id="order_id" name="orderId" class="input-field" readonly>
          </div>

          <div class="popup-content">
            <label for="Name" class="">Name:</label>
            <input type="text" id="customerName" name="customerName" class="input-field" readonly>
          </div>

          <div class="popup-content">
            <label for="Product-name" class="">Product Name:</label>
            <input type="text" id="productName" name="productName" class="input-field" readonly>
          </div>

          <div class="popup-content">
            <label for="Quantity" class="">Quantity:</label>
            <input type="text" id="quantity" name="quantity" class="input-field" readonly>
          </div>

          <div class="popup-content">
            <label for="Total" class="">Total:</label>
            <input type="text" id="total" name="total" class="input-field" readonly>
          </div>

          <div class="popup-content">
            <label for="Order-date" class="">Order Date:</label>
            <input type="text" id="orderDate" name="orderDate" class="input-field" readonly>
          </div>

          <div class="popup-content">
            <label for="Return-Details" class="">Return Details:</label>
            <input type="text" id="returnDetails" name="returnDetails" class="input-field" readonly>
          </div>

  
        </form>
      </div>
    </div>
    <header class="header">
      <div class="logo">
      <img src="<?=ROOT?>/assets/images/Waste360.png" alt="logo" />
      <h1>Waste360</h1>  
      </div> 
      <h1 class="logo">DashBoard</h1>
      <nav class="nav">
        <ul>
          <li><a href="#"><img src="<?=ROOT?>/assets/images/notifications.svg"></a></li>
          <li><a href="#">Profile</a></li>
          <li><a href="#">Logout</a></li>
        </ul>
      </nav>
    </header>
    <div class="box">
      <div class="container">
        <div class="header">
        <h2>Pending Return Requests</h2>
        <button class="add-button">
                <a href="<?=ROOT?>/CompletedReturns">View Completed Returns</a>
            </button>
        </div>
        <table id="returnTable">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer ID</th>
                    <th>Customer Name</th>
                    <th>Quantity</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php if(isset($data['returns']) && is_array($data['returns'])): ?>
              <?php foreach ($data['returns'] as $return) : ?>
                <tr>
                  <td><?= $return->order_id ?></td>
                  <td><?= $return->customer_id ?></td>
                  <td><?= $return->customerName ?></td>
                  <td><?= $return->quantity ?></td>
                  <td><?= $return->phone ?></td>
                  <td>
                  <button class="view-btn" onclick="openReturnUpdatePopup(<?= htmlspecialchars(json_encode($return), ENT_QUOTES, 'UTF-8')?>)">View/Edit</button>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No give away requests found</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
      </div>
    </div>
  </div> 

  <script>
    function openReturnUpdatePopup(returnData) {
        document.getElementById('order_id').value = returnData.order_id;
        document.getElementById('customerName').value = returnData.customerName;
        document.getElementById('productName').value = returnData.productName;
        document.getElementById('quantity').value = returnData.quantity;
        document.getElementById('total').value = returnData.total;
        document.getElementById('orderDate').value = returnData.orderDate;
        document.getElementById('returnDetails').value = returnData.returnDetails;

        document.getElementById('returnUpdatePopup').style.display = 'flex';

        // Add event listener to close the popup
      document.getElementById('closePopupBtn').addEventListener('click', () => {
        document.getElementById('returnUpdatePopup').style.display = 'none';
      });
    }
  </script>
  <script src="<?=ROOT?>/assets/js/customerServiceManager/sidebar.js"></script>  
  <script src="<?=ROOT?>/assets/js/customerServiceManager/returns.js"></script>  
</body>
</html>