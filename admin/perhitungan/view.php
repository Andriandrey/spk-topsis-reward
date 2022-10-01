<?php
$maxRows_rs_alternatif = 10;
$pageNum_rs_alternatif = 0;
if (isset($_GET['pageNum_rs_alternatif'])) {
    $pageNum_rs_alternatif = $_GET['pageNum_rs_alternatif'];
}
$startRow_rs_alternatif = $pageNum_rs_alternatif * $maxRows_rs_alternatif;

mysql_select_db($database_koneksi, $koneksi);
$query_rs_alternatif = "SELECT id_alternatif, nama_alternatif, Nik FROM tb_alternatif where 1 = 1 ORDER BY id_alternatif ASC ";
$query_limit_rs_alternatif = sprintf("%s LIMIT %d, %d", $query_rs_alternatif, $startRow_rs_alternatif, $maxRows_rs_alternatif);
$rs_alternatif = mysql_query($query_limit_rs_alternatif, $koneksi) or die(mysql_error());
$row_rs_alternatif = mysql_fetch_assoc($rs_alternatif);

if (isset($_GET['totalRows_rs_alternatif'])) {
    $totalRows_rs_alternatif = $_GET['totalRows_rs_alternatif'];
} else {
    $all_rs_alternatif = mysql_query($query_rs_alternatif);
    $totalRows_rs_alternatif = mysql_num_rows($all_rs_alternatif);
}
$totalPages_rs_alternatif = ceil($totalRows_rs_alternatif / $maxRows_rs_alternatif) - 1;

mysql_select_db($database_koneksi, $koneksi);
$query_rs_bobot = "SELECT id_bobot FROM tb_bobot WHERE 1 = 1";
$rs_bobot = mysql_query($query_rs_bobot, $koneksi) or die(mysql_error());
$row_rs_bobot = mysql_fetch_assoc($rs_bobot);
$totalRows_rs_bobot = mysql_num_rows($rs_bobot);
?>
<style type="text/css">
    <!--
    .style1 {
        color: #FFFFFF
    }
    -->
</style>


<?php require_once('data.php'); ?>
<!-- Small boxes (Stat box) -->
<div class="row">

    <div class="col-lg-6 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?= $row_rs_kriteria['jumlahKriteria']; ?> KRITERIA</h3>

                <p>KRITERIA</p>
            </div>
            <div class="icon">
                <i class="fa fa-book"></i>
            </div>
            <a href="?page=kriteria/view" class="small-box-footer">
                More Detail <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-6 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?= $row_rs_alternatif['jumlahAlternatif']; ?> ALTERNATIF</h3>

                <p>ALTERNATIF</p>
            </div>
            <div class="icon">
                <i class="fa fa-folder-o"></i>
            </div>
            <a href="?page=alternatif/view" class="small-box-footer">
                More Detail <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <p>
        <?php if ($totalRows_rs_bobot > 0) { ?>
    <div class="col-md-6">
        <div class="pull-right">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="?page=proses/view" class="btn btn-primary btn-block">PROSES HITUNG</a>
        </div>
    </div>
<?php } ?>
</p>
<!-- ./col -->


</div>
<!-- /.row -->
<p></p>
<p></p>