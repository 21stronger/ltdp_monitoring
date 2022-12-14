  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link <?= ($currentPage=="Dashboard")? "": "collapsed"; ?>" href="<?= base_url('home') ?>">
          <i class="bi bi-calendar-week"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <!-- <li class="nav-item">
        <a class="nav-link <?= ($currentPage=="Department")? "": "collapsed"; ?>" href="<?= base_url('department') ?>">
          <i class="bi bi-grid"></i>
          <span>Department</span>
        </a>
      </li> --><!-- End Department Nav -->

      <li class="nav-item">
        <a class="nav-link <?= ($currentPage=="Update")? "": "collapsed"; ?>" href="<?= base_url('update') ?>">
          <i class="bi bi-pencil-square"></i>
          <span>Update Projects</span>
        </a>
      </li><!-- End Update Project Page Nav -->

      <li class="nav-item">
        <a class="nav-link <?= ($currentPage=="Profile")? "": "collapsed"; ?>" href="<?= base_url('profile') ?>">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <?php if(session()->get('role')=="Admin"){ ?>
      <li class="nav-heading">Admin Menu</li>

      <li class="nav-item">
        <a class="nav-link <?= ($currentPage=="Project")? "": "collapsed"; ?>" href="<?= base_url('project') ?>">
          <i class="bi bi-card-list"></i>
          <span>Projects</span>
        </a>
      </li><!-- End Project Monitoring Page Nav -->

      <li class="nav-item">
        <a class="nav-link <?= ($currentPage=="Reminder")? "": "collapsed"; ?>" href="<?= base_url('reminder') ?>">
          <i class="bi bi-envelope-exclamation"></i>
          <span>Reminder</span>
        </a>
      </li><!-- End Reminder Page Nav -->

      <li class="nav-item">
        <a class="nav-link <?= ($currentPage=="PIC")? "": "collapsed"; ?>" href="<?= base_url('pic') ?>">
          <i class="bi bi-people"></i>
          <span>User PICs</span>
        </a>
      </li><!-- End PIC Page Nav -->

      <li class="nav-item">
        <a class="nav-link <?= ($currentPage=="Settings")? "": "collapsed"; ?>" href="<?= base_url('settings') ?>">
          <i class="bi bi-gear"></i>
          <span>App Settings</span>
        </a>
      </li><!-- End App Settings Page Nav -->
      <?php } ?>
      
    </ul>

  </aside><!-- End Sidebar-->

