<?php  

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO tb_kriteria (nama_kriteria, bobot_kriteria, keterangan) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['nama_kriteria'], "text"),
                       GetSQLValueString($_POST['bobot_kriteria'], "int"),
                       GetSQLValueString($_POST['keterangan'], "text"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
  
  pesan('success','Data berhasil disimpan');
}
?>


<p>INSERT DATA KRITERIA</p>
<p><a href="?page=kriteria/view" class="btn btn-xs btn-success"><span class="fa fa-eye"> </span> Lihat Data </a></p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="100%" height="188">
    <tr valign="baseline">
      <td><div align="left"><strong>Nama Kriteria</strong></div>
      <input type="text" name="nama_kriteria" value="" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td><div align="left"><strong>Nilai Bobot</strong></div>
      <input type="text" name="bobot_kriteria" value="" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td><div align="left"><strong>Keterangan</strong></div>
        <select name="keterangan" class="form-control input-sm">
        <option value="B" <?php if (!(strcmp("B", "C"))) {echo "SELECTED";} ?>>Benefit</option>
        <option value="C" <?php if (!(strcmp("C", "C"))) {echo "SELECTED";} ?>>Cost</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
      <td height="47" valign="bottom"><input type="submit" value="Simpan Data" class="btn btn-primary btn-block"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</body>
</html>
