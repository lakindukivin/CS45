<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/collectionAgent/sidebar.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/collectionAgent/guest_collection.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/collectionAgent/common.css">
  <title>Waste360|Dashboard|CSM</title>
</head>

<body>
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
      <h1 class="logo">Pending Give Away Request</h1>
      <nav class="nav">
        <ul>
          <li><a href="#"><img src="<?= ROOT ?>/assets/images/notifications.svg"></a></li>
          <li><a href="<?=ROOT?>/profile">Profile</a></li>
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
          <input type="number" step="0.01" min=0 name="amount"/>
        </div>

        <button type="submit">Submit</button>
     </form>
    </div>
    </div>
 

  <script src="<?= ROOT ?>/assets/js/customerServiceManager/sidebar.js"></script>
  <script src="<?= ROOT ?>/assets/js/collectionAgent/giveAwayRequest.js"></script>
</body>

</html>
