<?php  

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tb_kriteria SET nama_kriteria=%s, bobot_kriteria=%s, keterangan=%s WHERE id_kriteria=%s",
                       GetSQLValueString($_POST['nama_kriteria'], "text"),
                       GetSQLValueString($_POST['bobot_kriteria'], "int"),
                       GetSQLValueString($_POST['keterangan'], "text"),
                       GetSQLValueString($_POST['id_kriteria'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
  
  pesan('warning','Data berhasil diubah');
}

$colname_rs_kriteria = "-1";
if (isset($_GET['id_kriteria'])) {
  $colname_rs_kriteria = $_GET['id_kriteria'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_rs_kriteria = sprintf("SELECT * FROM tb_kriteria WHERE id_kriteria = %s", GetSQLValueString($colname_rs_kriteria, "int"));
$rs_kriteria = mysql_query($query_rs_kriteria, $koneksi) or die(mysql_error());
$row_rs_kriteria = mysql_fetch_assoc($rs_kriteria);
$totalRows_rs_kriteria = mysql_num_rows($rs_kriteria);
?>

<p>UPDATE DATA KRITERIA</p>
<p><a href="?page=kriteria/view" class="btn btn-xs btn-success"><span class="fa fa-eye"> </span> Lihat Data </a></p>

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
 <table width="100%" height="188">
    <tr valign="baseline">
      <td><div align="left"><strong>Nama Kriteria</strong></div>
      <input type="text" name="nama_kriteria" value="<?php echo htmlentities($row_rs_kriteria['nama_kriteria'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td><div align="left"><strong>Nilai Bobot</strong></div>
      <input type="text" name="bobot_kriteria" value="<?php echo htmlentities($row_rs_kriteria['bobot_kriteria'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td><div align="left"><strong>Keterangan</strong></div>
        <select name="keterangan" class="form-control input-sm">
        <option value="B" <?php if (!(strcmp("B", htmlentities($row_rs_kriteria['keterangan'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Benefit</option>
        <option value="C" <?php if (!(strcmp("C", htmlentities($row_rs_kriteria['keterangan'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Cost</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
      <td height="48" valign="bottom"><input type="submit" value="Simpan Perubahan" class="btn btn-block btn-warning" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_kriteria" value="<?php echo $row_rs_kriteria['id_kriteria']; ?>" />
</form> 