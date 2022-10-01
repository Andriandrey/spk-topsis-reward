<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf(
    "UPDATE tb_alternatif SET nama_alternatif=%s, Nik=%s WHERE id_alternatif=%s",
    GetSQLValueString($_POST['nama_alternatif'], "text"),
    GetSQLValueString($_POST['Nik'], "text"),
    GetSQLValueString($_POST['id_alternatif'], "int")
  );

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());

  pesan('warning', 'Data berhasil diubah');
}

$colname_rs_alternatif = "-1";
if (isset($_GET['id_alternatif'])) {
  $colname_rs_alternatif = $_GET['id_alternatif'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_rs_alternatif = sprintf("SELECT * FROM tb_alternatif WHERE id_alternatif = %s", GetSQLValueString($colname_rs_alternatif, "int"));
$rs_alternatif = mysql_query($query_rs_alternatif, $koneksi) or die(mysql_error());
$row_rs_alternatif = mysql_fetch_assoc($rs_alternatif);
$totalRows_rs_alternatif = mysql_num_rows($rs_alternatif);
?>

<p>UPDATE DATA ALTERNATIF</p>
<p><a href="?page=alternatif/view" class="btn btn-xs btn-success"><span class="fa fa-eye"> </span> Lihat Data </a></p>

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="100%" height="101">
    <tr valign="baseline">
      <td height="45">
        <div align="left"><strong>Nama alternatif</strong></div>
        <input type="text" name="nama_alternatif" value="<?php echo htmlentities($row_rs_alternatif['nama_alternatif'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm" />
      </td>
    </tr>

    <td height="45">
      <div align="left"><strong>Nik</strong></div>
      <input type="text" name="Nik" value="<?php echo htmlentities($row_rs_alternatif['Nik'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm" />
    </td>
    </tr>

    <tr valign="baseline">
      <td height="48" valign="bottom"><input type="submit" value="Simpan Perubahan" class="btn btn-block btn-warning" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_alternatif" value="<?php echo $row_rs_alternatif['id_alternatif']; ?>" />
</form>