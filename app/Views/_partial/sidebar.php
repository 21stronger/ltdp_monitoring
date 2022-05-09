  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link <?= ($currentPage=="Dashboard")? "": "collapsed"; ?>" href="<?= base_url('home') ?>">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link <?= ($currentPage=="Department")? "": "collapsed"; ?>" href="<?= base_url('department') ?>">
          <i class="bi bi-grid"></i>
          <span>Department</span>
        </a>
      </li><!-- End Department Nav -->

      <li class="nav-item">
        <a class="nav-link <?= ($currentPage=="Project")? "": "collapsed"; ?>" href="<?= base_url('project') ?>">
          <i class="bi bi-person"></i>
          <span>Project</span>
        </a>
      </li><!-- End Project Monitoring Page Nav -->

      <li class="nav-item">
        <a class="nav-link <?= ($currentPage=="Update")? "": "collapsed"; ?>" href="<?= base_url('update') ?>">
          <i class="bi bi-question-circle"></i>
          <span>Update Project</span>
        </a>
      </li><!-- End Update Project Page Nav -->

      <li class="nav-item">
        <a class="nav-link <?= ($currentPage=="Profile")? "": "collapsed"; ?>" href="<?= base_url('profile') ?>">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Project Monitoring Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

