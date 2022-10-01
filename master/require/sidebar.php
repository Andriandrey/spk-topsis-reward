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
        <img src="../photos/<?= $row_rs_profile['photo_master']; ?>" class="img-rounded" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?= $nama; ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->

    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>



      <li>
        <a href="?page=alternatif/view">
          <i class="fa fa-users"></i> <span>ALTERNATIF</span>

        </a>
      </li>


      <li>
        <a href="?page=proses/result">
          <i class="fa fa-users"></i> <span>HASIL PERANGKINGAN</span>

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