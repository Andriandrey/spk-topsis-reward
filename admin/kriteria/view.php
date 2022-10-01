<?php
$maxRows_rs_kriteria = 10;
$pageNum_rs_kriteria = 0;
if (isset($_GET['pageNum_rs_kriteria'])) {
  $pageNum_rs_kriteria = $_GET['pageNum_rs_kriteria'];
}
$startRow_rs_kriteria = $pageNum_rs_kriteria * $maxRows_rs_kriteria;

mysql_select_db($database_koneksi, $koneksi);
$query_rs_kriteria = "SELECT id_kriteria, nama_kriteria, bobot_kriteria, keterangan FROM tb_kriteria ORDER BY id_kriteria DESC";
$query_limit_rs_kriteria = sprintf("%s LIMIT %d, %d", $query_rs_kriteria, $startRow_rs_kriteria, $maxRows_rs_kriteria);
$rs_kriteria = mysql_query($query_limit_rs_kriteria, $koneksi) or die(mysql_error());
$row_rs_kriteria = mysql_fetch_assoc($rs_kriteria);

if (isset($_GET['totalRows_rs_kriteria'])) {
  $totalRows_rs_kriteria = $_GET['totalRows_rs_kriteria'];
} else {
  $all_rs_kriteria = mysql_query($query_rs_kriteria);
  $totalRows_rs_kriteria = mysql_num_rows($all_rs_kriteria);
}
$totalPages_rs_kriteria = ceil($totalRows_rs_kriteria / $maxRows_rs_kriteria) - 1;
?>
<style type="text/css">
  <!--
  .style1 {
    color: #FFFFFF
  }
  -->
</style>



<p>Langkah 1 : MENENTUKAN BOBOT MASING2 KRITERIA</p>
<p><a href="?page=kriteria/insert" class="btn btn-xs btn-primary"><span class="fa fa-save"></span> Tambah Kriteria</a> </p>

<div class="table-responsive">
  <table width="100%" class="table table-striped table-bordered">
    <thead>
      <tr bgcolor="#003366">
        <th width="3%"><span class="style1">NO.</span></th>
        <th width="46%"><span class="style1">NAMA</span></th>
        <th width="16%"><span class="style1">BOBOT</span></th>
        <th width="27%"><span class="style1">KETERANGAN</span></th>
        <th width="8%"><span class="style1">AKSI</span></th>
        <th width="8%"><span class="style1">AKSI</span></th>
      </tr>
    </thead>
    <tbody>

      </tr>
      </thead>
    <tbody>
      <?php $no = 1;
      do { ?>
        <tr>
          <td align="center"><a href="?page=kriteria/update&id_kriteria=<?php echo $row_rs_kriteria['id_kriteria']; ?>"><?php echo $no++; ?></a></td>
          <td><?php echo $row_rs_kriteria['nama_kriteria']; ?></td>
          <td><?php echo $row_rs_kriteria['bobot_kriteria']; ?></td>
          <td><?php
              if ($row_rs_kriteria['keterangan'] == 'C') {
                echo "Cost";
              } else {
                echo "Benefit";
              };
              ?></td>
          <td><a href="?page=kriteria/update&id_kriteria=<?php echo $row_rs_kriteria['id_kriteria']; ?>">Ubah</a></td>
          <td><a href="?page=kriteria/delete&id_kriteria=<?php echo $row_rs_kriteria['id_kriteria']; ?>">Hapus</a></td>
        </tr>
      <?php } while ($row_rs_kriteria = mysql_fetch_assoc($rs_kriteria)); ?>
    </tbody>
  </table>

</div>