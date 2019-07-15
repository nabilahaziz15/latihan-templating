 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
         <div class="sidebar-brand-icon rotate-n-15">
             <i class="fas fa-poo"></i>
         </div>
         <div class="sidebar-brand-text mx-3">Nabil Page</div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider">
     <!-- Query Menu -->
     <?php
        $CI = &get_instance();
        $data_menu = $CI->menu_model->queryMenu();
        /* echo "<pre>";
        print_r($data_menu);
        echo "</pre>";
        die(); */
        ?>

     <?php foreach ($data_menu as $m) : ?>
         <div class="sidebar-heading">
             <?= $m['menu']; ?>
         </div>

         <?php
            $CI = &get_instance();
            $data_submenu = $CI->menu_model->subMenu($m['menu_id']);
            /* echo "<pre>";
            print_r($data_submenu);
            echo "</pre>";
            die(); */
            foreach ($data_submenu as $sm) :
                ?>
             <?php if ($title == $sm['title']) : ?>
                 <li class="nav-item active ">
                 <?php else : ?>
                 <li class="nav-item">
                 <?php endif; ?>
                 <a class="nav-link" href="<?= base_url($sm['url']); ?>">
                     <i class="<?= $sm['icon']; ?>"></i>
                     <span><?= $sm['title']; ?></span></a>
             </li>
         <?php endforeach; ?>
         <hr class="sidebar-divider">
     <?php endforeach; ?>
     <!-- Nav Item - Dashboard -->


     <!-- Divider -->


     <!-- Heading -->

     <li class="nav-item">
         <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
             <i class="fas fa-sign-out-alt"></i>
             <span>Logout</span></a>
     </li>
     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>

 </ul>
 <!-- End of Sidebar -->