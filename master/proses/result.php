<?php
$maxRows_rs_alternatif = 10;
$pageNum_rs_alternatif = 0;
if (isset($_GET['pageNum_rs_alternatif'])) {
  $pageNum_rs_alternatif = $_GET['pageNum_rs_alternatif'];
}
$startRow_rs_alternatif = $pageNum_rs_alternatif * $maxRows_rs_alternatif;

mysql_select_db($database_koneksi, $koneksi);
$query_rs_alternatif = "SELECT id_alternatif, nama_alternatif, preferentif  FROM tb_alternatif ORDER BY preferentif DESC";
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
?>
<style type="text/css">
  <!--
  .style1 {
    color: #FFFFFF
  }
  -->
</style>



<?php if ($row_rs_alternatif['preferentif'] > 0) { ?>
  <div class="table-responsive">
    <h3> <?php pesan('success', 'LAPORAN HASIL PERANGKINGAN'); ?>
      <table width="75%" class="table table-striped table-bordered">
        <thead>
          <tr bgcolor="#003366">
            <th width="3%">
              <div align="center"><span class="style1">RANGKING</span></div>
            </th>
            <th width="59%">
              <div align="center"><span class="style1">NAMA</span></div>
            </th>
            <th width="59%">
              <div align="center"><span class="style1">NILAI PREFERENTIF</span></div>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          do { ?>
            <tr>
              <td align="center"><a href="?page=alternatif/update&id_alternatif=<?php echo $row_rs_alternatif['id_alternatif']; ?>"><?php echo $no++; ?></a></td>
              <td><?php echo $row_rs_alternatif['nama_alternatif']; ?></td>
              <td align="center"><?php echo $row_rs_alternatif['preferentif']; ?></td>
            </tr>
          <?php } while ($row_rs_alternatif = mysql_fetch_assoc($rs_alternatif)); ?>
        </tbody>
      </table>
    </h3>
  </div>
<?php } else {
  pesan('danger', 'Oops! Nilai belum diproses');
}
?>
