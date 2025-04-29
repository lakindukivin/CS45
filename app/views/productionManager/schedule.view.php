<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/productionManager/sidebar.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/productionManager/schedule.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/productionManager/common.css">
    <title>Waste360|Dashboard|PM</title>
</head>
<body>
    <nav id="sidebar">
      <button id="toggle-btn" onclick="toggleSidebar()" class="toggle-btn">
        <img src="<?=ROOT?>/assets/images/menu.svg" alt="menu" />
      </button>
      <div class="sidebar-container">
        <div class="prof-picture">
          <img src="<?=ROOT?>/assets/images/user.svg" alt="profile" />
          <span class="user-title">Production Manager</span>
        </div>

        <div>
          <ul>
            <li>
              <a href="<?=ROOT?>/productionManagerHome" 
                ><img src="<?=ROOT?>/assets/images/dashboard.svg" alt="dashboard" /><span
                  class="sidebar-titles"
                  >Dashboard</span
                ></a
              >
            </li>

            <li>
            <a href="<?= ROOT ?>/PendingCustomOrder"><img
                src="<?= ROOT ?>/assets/images/order.svg" /><span class="sidebar-titles">Custom Orders</span></a>
          </li>
          <li>
            <a href="<?=ROOT?>/RecycledPolythene"><img src="<?= ROOT ?>/assets/images/recycle.svg" /><span
                class="sidebar-titles">Recycled Polythene</span></a>
          </li>
          <li>
            <a href="#" class="sidebar-active"><img
                src="<?= ROOT ?>/assets/images/collection.svg" alt="site Performance" /><span class="sidebar-titles">Polythene
                Collection</span></a>
          </li>
          <li>
            <a href="<?=ROOT?>/SupplyRequest"><img
                src="<?= ROOT ?>/assets/images/supply.svg" alt="supply" /><span class="sidebar-titles">Supply Requests</span></a>
          </li>
          <li>
            <a href="<?=ROOT?>/PelletsRequests"><img
                src="<?= ROOT ?>/assets/images/order.svg" alt="supply" /><span class="sidebar-titles">Pellets Requests</span></a>
          </li>
          </ul>
        </div> 
      </div>
    </nav>

    
  <div class="content">
    <header>
      <div class="logo">
      <img src="<?=ROOT?>/assets/images/Waste360.png" alt="logo" />
      <h1>Waste360</h1>  
      </div> 
      <h1 class="logo">DashBoard</h1>
      <nav class="nav">
        <ul>
          <li><a href="<?= ROOT ?>/ProductionManagerProfile">Profile</a></li>
          <li><a href="<?= ROOT ?>/Logout">Logout</a></li>
        </ul>
      </nav>
    </header>
    <div class="box">
    <div class="container">
      <div class="header">
      <h1>Collection Schedule</h1>
      <button class="add-button" onclick="openModal()">Add Collection Schedule</button>
      </div>
      <div class="table-container">
          <table id="collectionTable">
              <thead>
                  <tr>
                      <th>Area</th>
                      <th>Date</th>
                      <th>Time</th>
                  </tr>
              </thead>
              <tbody>
              <?php if(!empty($schedules)): ?>
        <?php foreach($schedules as $schedule): ?>
            <tr>
                <td><?= htmlspecialchars($schedule->area) ?></td>
                <td><?= htmlspecialchars($schedule->collection_date) ?></td>
                <td><?= htmlspecialchars($schedule->collection_time) ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="3">No schedules found</td>
        </tr>
    <?php endif; ?>
              </tbody>
          </table>
      </div>
  </div>

  <div class="pagination">
    <?php if ($totalPages > 1): ?>
        <?php if ($currentPage > 1): ?>
            <a href="<?= ROOT ?>/schedule?page=<?= $currentPage - 1 ?>" class="page-link arrow">
                <img src="<?= ROOT ?>/assets/images/left-arrow.svg" alt="Previous" class="pagination-icon">
            </a>
        <?php endif; ?>
        
        <?php if ($totalPages <= 5): ?>
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="<?= ROOT ?>/schedule?page=<?= $i ?>" 
                   class="page-link <?= $i == $currentPage ? 'active' : '' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
        <?php else: ?>
            <!-- Show more complex pagination for many pages -->
            <?php if ($currentPage > 3): ?>
                <span class="page-link">...</span>
            <?php endif; ?>
            
            <?php 
            $start = max(1, $currentPage - 2);
            $end = min($totalPages, $currentPage + 2);
            
            for ($i = $start; $i <= $end; $i++): ?>
                <a href="<?= ROOT ?>/schedule?page=<?= $i ?>" 
                   class="page-link <?= $i == $currentPage ? 'active' : '' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
            
            <?php if ($currentPage < $totalPages - 2): ?>
                <span class="page-link">...</span>
            <?php endif; ?>
        <?php endif; ?>
        
        <?php if ($currentPage < $totalPages): ?>
            <a href="<?= ROOT ?>/schedule?page=<?= $currentPage + 1 ?>" class="page-link arrow">
                <img src="<?= ROOT ?>/assets/images/right-arrow.svg" alt="Next" class="pagination-icon">
            </a>
        <?php endif; ?>
    <?php endif; ?>
</div>

  <div id="modal" class="modal">
      <div class="modal-content">
          <span class="close-btn" onclick="closeModal()">&times;</span>
          <h2>Add Collection Schedule</h2></br>
          <form id="scheduleForm" action="<?=ROOT?>/Schedule/addSchedule" method="POST" novalidate>
          <div class="form-group">
    <label for="area">Area:</label>
    <select id="area" name="area" class="form-control" required>
    <option value="" disabled selected>-- Select Area --</option>
    <?php foreach ($validAreas as $area): ?>
        <option value="<?= htmlspecialchars($area) ?>"><?= htmlspecialchars($area) ?></option>
    <?php endforeach; ?>
    </select>
</div>
              <div class="form-group">
                  <label for="date">Date:</label>
                  <input type="date" id="date" name="date" min="<?= date('Y-m-d', strtotime('+1 day')) ?>" required>
              </div>
              <div class="form-group">
                  <label for="time">Time:</label>
                  <input type="time" id="time" name="time" required>
              </div>
              <input type="hidden" name="action" value="add">
              <button type="submit" class="save-btn">Save</button>
          </form>
      </div>
  </div>

  </div>
  <script src="<?=ROOT?>/assets/js/productionManager/schedule.js"></script>
  <script src="<?=ROOT?>/assets/js/productionManager/sidebar.js"></script>
</body>
</html>