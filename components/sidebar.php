<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="./index.php">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <?php
    if ($user_type == 'admin') { ?>
      <li class="nav-item nav-category">Assignments</li>
      <li class="nav-item">
        <a href="create_assignments.php" class="nav-link">
          <i class="menu-icon mdi mdi-floor-plan"></i>
          <span class="menu-title">Create Test</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="./assignment_list.php" class="nav-link">
          <i class="menu-icon mdi mdi-floor-plan"></i>
          <span class="menu-title">List Test</span>
        </a>
      </li>
      <li class="nav-item nav-category">Students</li>
      <li class="nav-item">
        <a href="./user_list.php" class="nav-link">
          <i class="menu-icon mdi mdi-floor-plan"></i>
          <span class="menu-title">Student List</span>
        </a>
      </li>
      <li class="nav-item nav-category">Training Program Details</li>
      <li class="nav-item">
        <a href="./registration_details.php" class="nav-link">
          <i class="menu-icon mdi mdi-floor-plan"></i>
          <span class="menu-title">Training Program</span>
        </a>
      </li>
    <?php } else {    ?>
      <li class="nav-item nav-category">Tests</li>
      <li class="nav-item">
        <a href="assignments.php" class="nav-link">
          <i class="menu-icon mdi mdi-floor-plan"></i>
          <span class="menu-title">Tests</span>
        </a>
      </li>
    <?php } ?>
    <li class="nav-item nav-category">Settings</li>
    <li class="nav-item">
      <a class="nav-link" href="./profile.php">
        <i class="menu-icon mdi mdi-account-circle-outline"></i>
        <span class="menu-title">Profile</span>
      </a>
    </li>
  </ul>
</nav>