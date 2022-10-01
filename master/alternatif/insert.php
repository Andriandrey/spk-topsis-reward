<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf(
    "INSERT INTO tb_alternatif (nama_alternatif) VALUES (%s)",
    GetSQLValueString($_POST['nama_alternatif'], "text")
  );

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());

  pesan('success', 'Data berhasil disimpan');
}
?>

<p>INSERT DATA ALTERNATIF</p>
<p><a href="?page=alternatif/view" class="btn btn-xs btn-success"><span class="fa fa-eye"> </span> Lihat Data </a></p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="100%" height="98">
    <tr valign="baseline">



      <td height="43">
        <div align="left"><strong>Nama Alternatif</strong></div>
        <input type="text" name="nama_alternatif" value="" size="32" class="form-control input-sm" />
      </td>

    </tr>
    <tr valign="baseline">
      <td height="47" valign="bottom"><input type="submit" name="Simpan Data" value="Simpan Data" class="btn btn-primary btn-block" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</body>

</html>