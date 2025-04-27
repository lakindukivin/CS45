<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/collectionAgent/sidebar.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/collectionAgent/guest_collection.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/collectionAgent/common.css">
  <title>Waste360|Dashboard|CSM</title>
  <style>
    .success-popup {
      position: fixed;
      top: 20px;
      right: 20px;
      background-color: #4CAF50;
      color: white;
      padding: 15px 20px;
      border-radius: 4px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
      z-index: 1000;
      display: none;
      animation: fadeIn 0.5s, fadeOut 0.5s 2.5s forwards;
    }
    
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
    
    @keyframes fadeOut {
      from { opacity: 1; }
      to { opacity: 0; }
    }
  </style>
</head>

<body>
  <!-- Success popup element -->
  <div id="success-popup" class="success-popup">
    <span id="success-message">Successfully updated!</span>
  </div>
  
  <nav id="sidebar">
        <button id="toggle-btn" onclick="toggleSidebar()" class="toggle-btn">
            <img src="<?= ROOT ?>/assets/images/menu.svg" alt="menu" />
        </button>
        <div class="sidebar-container">
            <div class="prof-picture">
                <img src="<?= ROOT ?>/assets/images/user.svg" alt="profile" />
                <span class="user-title">Collection Agent</span>
            </div>

            <div>
                <ul>
                    <li>
                        <a href="<?=ROOT?>/CollectionAgentHome" ><img src="<?= ROOT ?>/assets/images/dashboard.svg" alt="dashboard" /><span
                                class="sidebar-titles">Dashboard</span></a>
                    </li>

                    <li>
                        <a href="<?= ROOT ?>/AcceptedGiveAwayRequest" ><img src="<?= ROOT ?>/assets/images/give_away.svg" /><span
                                class="sidebar-titles">Accepted Give Aways</span></a>
                    </li>
                    <li>
                        <a href="<?= ROOT ?>/GuestCollection" class="sidebar-active"><img src="<?= ROOT ?>/assets/images/returns.svg"/><span
                                class="sidebar-titles">Add Guest Collection</span></a>
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
      <h1 class="logo">Guest Collection</h1>
      <nav class="nav">
        <ul>
          <li><a href="#"><img src="<?= ROOT ?>/assets/images/notifications.svg"></a></li>
          <li><a href="<?=ROOT?>/CollectionAgent
          Profile">Profile</a></li>
          <li><a href="<?=ROOT?>/logout">Logout</a></li>
        </ul>
      </nav>
    </header>
    <div class="box">
     <form action="<?=ROOT?>/GuestCollection/save" method="POST">
        <div class="form-group">
          <label for="Guest Name" class="">Guest Name:</label>
          <input type="text" name="guest_name"/>
        </div>

        <div class="form-group">
          <label for="Phone" class="">Mobile No: </label>
          <input type="text" name="phone"/>
        </div>

        <div class="form-group">
          <label for="Amount" class="">Amount: </label>
          <input type="number" step="0.01" min=0 name="amount" required/>
        </div>

        <button type="submit">Submit</button>
     </form>
    </div>
    </div>
 

  <script src="<?= ROOT ?>/assets/js/customerServiceManager/sidebar.js"></script>
  <script src="<?= ROOT ?>/assets/js/collectionAgent/giveAwayRequest.js"></script>
  
  <script>
    // Check for success message
    document.addEventListener('DOMContentLoaded', function() {
      <?php if(isset($_SESSION['success_message'])): ?>
        // Show success popup
        const popup = document.getElementById('success-popup');
        const message = document.getElementById('success-message');
        message.textContent = "<?= $_SESSION['success_message'] ?>";
        popup.style.display = 'block';
        
        // Hide popup after 3 seconds
        setTimeout(function() {
          popup.style.display = 'none';
        }, 3000);
        
        <?php 
        // Clear the session message
        unset($_SESSION['success_message']);
        ?>
      <?php endif; ?>
    });
  </script>
</body>

</html>
