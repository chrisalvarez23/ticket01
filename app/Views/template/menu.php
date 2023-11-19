<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url(); ?>" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a href="logout" class="nav-link">Logout</a>
        
      </li>


    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?php echo base_url() ?>public/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?php echo APP_NAME; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <!-- <div class="image">
          <img src="<?php echo base_url() ?>public/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div> -->
        <div class="info">
          <a href="#" class="d-block">Welcome <?php echo auth()->user()->username; ?> (<?php 
            $users = auth()->getProvider();

            $user = $users->findById(auth()->user()->id);
            echo $user->getGroups()[0] ? $user->getGroups()[0] : '' ;
          ?>)</a>
        </div>
      </div>

      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            
            <li class="nav-item">
                <a href="<?php echo base_url() ?>dashboard" class="nav-link">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url() ?>tickets" class="nav-link">
                    <i class="nav-icon fas fa-phone"></i>
                    <p>
                        Support Tickets
                    </p>
                </a>
            </li>
            <li class="nav-header">MASTERFILE</li>
            <li class="nav-item">
                <a href="<?php echo base_url() ?>offices" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Office  
                    </p>
                </a>
            </li>
            <li class="nav-header">ADMNISTRATOR</li>
            <li class="nav-item">
                <a href="<?php echo base_url() ?>users" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                        User Management
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url() ?>userroles" class="nav-link">
                    <i class="nav-icon fas fa-key"></i>
                    <p>
                        Role Management
                    </p>
                </a>
            </li>
        </ul>          
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>