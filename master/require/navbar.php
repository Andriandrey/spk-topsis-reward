 <!-- Logo -->
 <a href="?page=home" class="logo">
   <!-- mini logo for sidebar mini 50x50 pixels -->
   <span class="logo-mini"><b><?= $header; ?></b></span>
   <!-- logo for regular state and mobile devices -->
   <span class="logo-lg"><b><?= $header;  ?></b></span>
 </a>
 <!-- Header Navbar: style can be found in header.less -->
 <nav class="navbar navbar-static-top">
   <!-- Sidebar toggle button-->
   <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
     <span class="sr-only">Toggle navigation</span>
     <span class="icon-bar"></span>
     <span class="icon-bar"></span>
     <span class="icon-bar"></span>
   </a>

   <div class="navbar-custom-menu">
     <ul class="nav navbar-nav">


       <!-- User Account: style can be found in dropdown.less -->
       <li class="dropdown user user-menu">
         <a href="#" class="dropdown-toggle" data-toggle="dropdown">
           <img src="../photos/<?= $row_rs_profile['photo_master']; ?>" class="user-image" alt="User Image">
           <span class="hidden-xs"><?= $nama; ?></span>
         </a>
         <ul class="dropdown-menu">
           <!-- User image -->
           <li class="user-header">
             <img src="../photos/<?= $row_rs_profile['photo_master']; ?>" class="img-circle" alt="User Image">

             <p>
               <?= $nama; ?>
               <small>---</small>
             </p>
           </li>

           <!-- Menu Footer-->
           <li class="user-footer">

             <div class="pull-right">
               <a href="../<?php echo $logoutAction; ?>" class="btn btn-default btn-flat">LOGOUT</a>
             </div>
           </li>
         </ul>
       </li>
       <!-- Control Sidebar Toggle Button -->

     </ul>
   </div>
 </nav>