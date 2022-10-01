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


<p>DAFTAR ALTERNATIF</p>
<p><a href="?page=alternatif/insert" class="btn btn-xs btn-primary"><span class="fa fa-save"></span> Tambah Alternatif</a> </p>
<?php if ($totalRows_rs_alternatif > 0) { ?>
  <div class="table-responsive">
    <table width="100%" class="table table-striped table-bordered">
      <thead>
        <tr bgcolor="#003366">
          <th width="3%"><span class="style1">NO.</span></th>

          <th width="20%"><span class="style1">NAMA</span></th>

          <th width="10%"><span class="style1">NIK</span></th>

          <th width="3%"><span class="style1">AKSI</span></th>
          <th width="3%"><span class="style1">AKSI</span></th>
          <th width="3%"><span class="style1">AKSI</span></th>

        </tr>
      </thead>
      <tbody>
        <?php $no = 1;
        do { ?>
          <tr>
            <td align="center"><a href="?page=alternatif/update&id_alternatif=<?php echo $row_rs_alternatif['id_alternatif']; ?>"><?php echo $no++; ?></a></td>
            <td><?php echo $row_rs_alternatif['nama_alternatif']; ?></td>
            <td><?php echo $row_rs_alternatif['Nik']; ?></td>
            <td><a href="?page=bobot/insert&id_alternatif=<?php echo $row_rs_alternatif['id_alternatif']; ?>">Kelola Bobot Nilai</a></td>
            <td><a href="?page=alternatif/update&id_alternatif=<?php echo $row_rs_alternatif['id_alternatif']; ?>">Ubah Data</a></td>
            <td><a href="?page=alternatif/delete&id_alternatif=<?php echo $row_rs_alternatif['id_alternatif']; ?>">Hapus</a></td>
          </tr>
        <?php } while ($row_rs_alternatif = mysql_fetch_assoc($rs_alternatif)); ?>
      </tbody>
    </table>


    <!-- ./col -->

    <div class="col-md-6">
      <a href="?page=empty&reset=1" class="btn btn-warning btn-block">RESET ULANG SEMUA DATA</a>
    </div>
    <div class="col-md-6">
      <a href="?page=empty&kosongkan=1" class="btn btn-primary btn-block">KOSONGKAN NILAI SEMUA ALTERNATIF</a>
    </div>
  </div>


  </div>
<?php } else {
  pesan('danger', 'Oops! Alternatif belum ada. Silahkan Tambahkan');
}
?>