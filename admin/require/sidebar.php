<?php
//PENCARIAN
$colname_rs_search = "-1";
if (isset($_GET['Search'])) {
  $colname_rs_search = $_GET['Search'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_rs_search = sprintf("SELECT Login, nama_admin FROM tb_admin WHERE nama_admin OR Login LIKE %s", GetSQLValueString("%" . $colname_rs_search . "%", "text"));
$rs_search = mysql_query($query_rs_search, $koneksi) or die(mysql_error());
$row_rs_search = mysql_fetch_assoc($rs_search);
$totalRows_rs_search = mysql_num_rows($rs_search);

?>
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="../photos/<?= $row_rs_profile['photo_admin']; ?>" class="img-rounded" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?= $nama; ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <form action="" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="hidden" name="page" value="Search">
        <input type="text" name="Search" class="form-control" placeholder="Search...">

        <span class="input-group-btn">
          <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
          </button>
        </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li class="active">
        <a href="?page=home">
          <i class="fa fa-th"></i> <span>MENU UTAMA</span>
          <span class="pull-right-container">
            <small class="label pull-right bg-green">Home</small>
          </span>
        </a>
      </li>

      <li>
        <a href="?page=kelolaadmin/view">
          <i class="fa fa-book"></i> <span>KELOLA ADMIN</span>
          <span class="pull-right-container">
            <small class="label pull-right bg-green">New</small>
          </span>
        </a>
      </li>


      <li>
        <a href="?page=kriteria/view">
          <i class="fa fa-book"></i> <span>KRITERIA</span>
          <span class="pull-right-container">
            <small class="label pull-right bg-green">New</small>
          </span>
        </a>
      </li>
      <li>
        <a href="?page=alternatif/view">
          <i class="fa fa-users"></i> <span>ALTERNATIF</span>
          <span class="pull-right-container">
            <small class="label pull-right bg-green">New</small>
          </span>
        </a>
      </li>

      <li>
        <a href="?page=perhitungan/view">
          <i class="fa fa-users"></i> <span> PERHITUNGAN</span>
          <span class="pull-right-container">
            <small class="label pull-right bg-green">New</small>
          </span>
        </a>
      </li>

      <li>
        <a href="../<?php echo $logoutAction; ?>">
          <i class="fa fa-sign-out"></i> <span>LOGOUT</span>
        </a>
      </li>



    </ul>
  </section>
  <!-- /.sidebar -->
</aside>

<!-- =============================================== -->