<?php session_start();
$activePage = basename($_SERVER['PHP_SELF'], ".php"); ?>
<!-- **********************************
Sidebar start
*********************************** -->
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link" style="background: #fff;">
      <img src="images/cropped-Logo1.jpg" alt="Bugenaitech Logo" class="brand-image">
      <!-- <span class="brand-text font-weight-light">Bugenaitech</span> -->
    </a>
    
    <!-- Sidebar -->
    <?php if($_SESSION['role']=='admin'){ ?>
    <div class="sidebar">
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="dashboard.php" class="nav-link <?= ($activePage == 'dashboard') ? 'active':''; ?>">
                  <i class="nav-icon typcn typcn-device-desktop"></i>
                  <p> Dashboard </p>
                </a>
            </li>
          
          <li class="nav-item <?= ($activePage == 'add_user' || $activePage == 'manage_user' ) ? 'menu-open':''; ?>">
            <a href="#" class="nav-link <?= ($activePage == 'add_user' || $activePage == 'manage_user' ) ? 'active':''; ?>"><i class="nav-icon typcn typcn-group-outline"></i>
              <p>Admin User <i class="fas fa-angle-right right"></i> </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add_user.php" class="nav-link <?= ($activePage == 'add_user') ? 'active':''; ?>"><i class="far typcn typcn-user-add-outline"></i>
                  <p>Add User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="manage_user.php" class="nav-link <?= ($activePage == 'manage_user') ? 'active':''; ?>"><i class="far typcn typcn-user-add-outline"></i>
                  <p>Manage User</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item <?= ($activePage == 'manage_list' || $activePage == 'csv_upload' || $activePage == 'view_member' ) ? 'menu-open':''; ?>">
            <a href="#" class="nav-link <?= ($activePage == 'manage_list' || $activePage == 'csv_upload' || $activePage == 'view_member' ) ? 'active':''; ?>"><i class="nav-icon typcn typcn-th-list"></i>
              <p>Vendor List <i class="fas fa-angle-right right"></i> </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="manage_list.php" class="nav-link <?= ($activePage == 'manage_list' || $activePage == 'view_member') ? 'active':''; ?>"><i class="far fa-circle nav-icon"></i>
                  <p>Manage Vendor</p>
                </a>
              </li>
            </ul>
          </li>
          
          <!--<li class="nav-item <?= ($activePage == 'add_campaign' || $activePage == 'campaign_history' || $activePage ==='campaign_history_manual') ? 'menu-open':''; ?>">-->
          <!--  <a href="#" class="nav-link <?= ($activePage == 'add_campaign' || $activePage == 'campaign_history') ? 'active':''; ?>"><i class="nav-icon typcn typcn-th-list"></i>-->
          <!--    <p>Campaign <i class="fas fa-angle-right right"></i> </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
          <!--    <li class="nav-item">-->
          <!--      <a href="add_campaign.php" class="nav-link <?= ($activePage == 'add_campaign' || $activePage == 'add_campaign') ? 'active':''; ?>"><i class="far fa-circle nav-icon"></i>-->
          <!--        <p>Add Campaign</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--     <li class="nav-item">-->
          <!--      <a href="campaign_history.php" class="nav-link <?= ($activePage == 'campaign_history' || $activePage == 'campaign_history.') ? 'active':''; ?>"><i class="far fa-circle nav-icon"></i>-->
          <!--        <p>Campaign History</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="campaign_history_manual.php" class="nav-link <?= ($activePage == 'campaign_history_manual' || $activePage == 'campaign_history.') ? 'active':''; ?>"><i class="far fa-circle nav-icon"></i>-->
          <!--        <p>Manual Campaign History</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--  </ul>-->
          <!--</li>-->
          
            <!--<li class="nav-item">-->
            <!--    <a href="contact.php" class="nav-link <?= ($activePage == 'contact') ? 'active':''; ?>">-->
            <!--      <i class="nav-icon typcn typcn-contacts"></i>-->
            <!--      <p>Contact List</p>-->
            <!--    </a>-->
            <!--</li>-->
            <!--<li class="nav-item">-->
            <!--    <a href="subscribe-list.php" class="nav-link <?= ($activePage == 'subscribe-list') ? 'active':''; ?>">-->
            <!--      <i class="nav-icon typcn typcn-th-menu-outline"></i>-->
            <!--      <p>Subscribe List </p>-->
            <!--    </a>-->
            <!--</li>-->
            <!--<li class="nav-item">-->
            <!--    <a href="unsubscribe-list.php" class="nav-link <?= ($activePage == 'unsubscribe-list') ? 'active':''; ?>">-->
            <!--      <i class="nav-icon typcn typcn-th-list-outline"></i>-->
            <!--      <p>Unsubscribe List</p>-->
            <!--    </a>-->
            <!--</li>-->
            
            <li class="nav-item <?= ($activePage == 'template' || $activePage == 'email_template' || $activePage == 'manual_template' || $activePage =="manual_template_list" || $activePage==="add_signature" || $activePage=='campaign_history_manual') ? 'menu-open':''; ?>">
                <a href="#" class="nav-link <?= ($activePage == 'template' || $activePage == 'email_template' ) ? 'active':''; ?>"><i class="nav-icon typcn typcn-film"></i>
                  <p>Compose <i class="fas fa-angle-right right"></i> </p>
                </a>
                <ul class="nav nav-treeview">
                    <!--<li class="nav-item">-->
                    <!--    <a href="template.php" class="nav-link <?= ($activePage == 'template') ? 'active':''; ?>"><i class="far fa-circle nav-icon"></i>-->
                    <!--      <p>Template List</p>-->
                    <!--    </a>-->
                    <!--</li>-->
                    <li class="nav-item">
                        <a href="add_signature.php" class="nav-link <?= ($activePage == 'add_signature') ? 'active':''; ?>"><i class="far fa-circle nav-icon"></i>
                          <p>Add Signature</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="manual_template.php" class="nav-link <?= ($activePage == 'manual_template') ? 'active':''; ?>"><i class="far fa-circle nav-icon"></i>
                          <p>Compose Email</p>
                        </a>
                    </li>
                    <!--<li class="nav-item">-->
                    <!--    <a href="manual_template_list.php" class="nav-link <?= ($activePage == 'manual_template_list') ? 'active':''; ?>"><i class="far fa-circle nav-icon"></i>-->
                    <!--      <p>List Email Template</p>-->
                    <!--    </a>-->
                    <!--</li>-->
                    <li class="nav-item">
                <a href="campaign_history_manual.php" class="nav-link <?= ($activePage == 'campaign_history_manual' || $activePage == 'campaign_history.') ? 'active':''; ?>"><i class="far fa-circle nav-icon"></i>
                  <p>Email History</p>
                </a>
              </li>
                    <!--<li class="nav-item">-->
                    <!--    <a href="email_template.php" class="nav-link <?= ($activePage == 'email_template') ? 'active':''; ?>"><i class="far fa-circle nav-icon"></i>-->
                    <!--      <p>Send Email Template</p>-->
                    <!--    </a>-->
                    <!--</li>-->
                </ul>
            </li>
            
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <?php } ?>
    <?php if($_SESSION['role']=="manager"){ ?>
    <div class="sidebar">
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="dashboard.php" class="nav-link <?= ($activePage == 'dashboard') ? 'active':''; ?>">
                  <i class="nav-icon typcn typcn-device-desktop"></i>
                  <p> Dashboard </p>
                </a>
            </li>
          
          <!--<li class="nav-item <?= ($activePage == 'add_user' || $activePage == 'manage_user' ) ? 'menu-open':''; ?>">-->
          <!--  <a href="#" class="nav-link <?= ($activePage == 'add_user' || $activePage == 'manage_user' ) ? 'active':''; ?>"><i class="nav-icon typcn typcn-group-outline"></i>-->
          <!--    <p>Admin User <i class="fas fa-angle-right right"></i> </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
          <!--    <li class="nav-item">-->
          <!--      <a href="add_user.php" class="nav-link <?= ($activePage == 'add_user') ? 'active':''; ?>"><i class="far typcn typcn-user-add-outline"></i>-->
          <!--        <p>Add User</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="manage_user.php" class="nav-link <?= ($activePage == 'manage_user') ? 'active':''; ?>"><i class="far typcn typcn-user-add-outline"></i>-->
          <!--        <p>Manage User</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--  </ul>-->
          <!--</li>-->
          
           <li class="nav-item <?= ($activePage == 'manage_list' || $activePage == 'csv_upload' || $activePage == 'view_member' ) ? 'menu-open':''; ?>">
            <a href="#" class="nav-link <?= ($activePage == 'manage_list' || $activePage == 'csv_upload' || $activePage == 'view_member' ) ? 'active':''; ?>"><i class="nav-icon typcn typcn-th-list"></i>
              <p>Vendor List <i class="fas fa-angle-right right"></i> </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="manage_list.php" class="nav-link <?= ($activePage == 'manage_list' || $activePage == 'view_member') ? 'active':''; ?>"><i class="far fa-circle nav-icon"></i>
                  <p>Manage Vendor</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li  class="nav-item <?= ($activePage == 'template' || $activePage == 'email_template' || $activePage == 'manual_template' || $activePage =="manual_template_list" || $activePage==="add_signature" || $activePage=='campaign_history_manual') ? 'menu-open':''; ?>">
                <a href="#" class="nav-link <?= ($activePage == 'template' || $activePage == 'email_template' ) ? 'active':''; ?>"><i class="nav-icon typcn typcn-film"></i>
                  <p>Compose <i class="fas fa-angle-right right"></i> </p>
                </a>
                <ul class="nav nav-treeview">
                    <!--<li class="nav-item">-->
                    <!--    <a href="template.php" class="nav-link <?= ($activePage == 'template') ? 'active':''; ?>"><i class="far fa-circle nav-icon"></i>-->
                    <!--      <p>Template List</p>-->
                    <!--    </a>-->
                    <!--</li>-->
                    <li class="nav-item">
                        <a href="add_signature.php" class="nav-link <?= ($activePage == 'add_signature') ? 'active':''; ?>"><i class="far fa-circle nav-icon"></i>
                          <p>Add Signature</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="manual_template.php" class="nav-link <?= ($activePage == 'manual_template') ? 'active':''; ?>"><i class="far fa-circle nav-icon"></i>
                          <p>Compose Email</p>
                        </a>
                    </li>
                    <!--<li class="nav-item">-->
                    <!--    <a href="manual_template_list.php" class="nav-link <?= ($activePage == 'manual_template_list') ? 'active':''; ?>"><i class="far fa-circle nav-icon"></i>-->
                    <!--      <p>List Email Template</p>-->
                    <!--    </a>-->
                    <!--</li>-->
                    <li class="nav-item">
                <a href="campaign_history_manual.php" class="nav-link <?= ($activePage == 'campaign_history_manual' || $activePage == 'campaign_history.') ? 'active':''; ?>"><i class="far fa-circle nav-icon"></i>
                  <p>Email History</p>
                </a>
              </li>
                    <!--<li class="nav-item">-->
                    <!--    <a href="email_template.php" class="nav-link <?= ($activePage == 'email_template') ? 'active':''; ?>"><i class="far fa-circle nav-icon"></i>-->
                    <!--      <p>Send Email Template</p>-->
                    <!--    </a>-->
                    <!--</li>-->
                </ul>
            </li>
            
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <?php } ?>
    <!-- /.sidebar -->
</aside>

