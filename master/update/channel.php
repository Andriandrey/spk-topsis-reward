<?php 

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tb_channel SET kode_channel=%s, pemilik_channel=%s, pic_channel=%s, alamat_channel=%s, photo_channel=%s, ktp_channel=%s, active_channel=%s WHERE id_channel=%s",
                       GetSQLValueString($_POST['kode_channel'], "text"),
                       GetSQLValueString($_POST['pemilik_channel'], "text"),
                       GetSQLValueString($_POST['pic_channel'], "int"),
                       GetSQLValueString($_POST['alamat_channel'], "text"),
                       GetSQLValueString($_POST['photo_channel'], "text"),
                       GetSQLValueString($_POST['ktp_channel'], "text"),
                       GetSQLValueString($_POST['active_channel'], "text"),
                       GetSQLValueString($_POST['id_channel'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
}

$colname_rs_channel = "-1";
if (isset($_GET['id_channel'])) {
  $colname_rs_channel = $_GET['id_channel'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_rs_channel = sprintf("SELECT * FROM tb_channel WHERE id_channel = %s", GetSQLValueString($colname_rs_channel, "int"));
$rs_channel = mysql_query($query_rs_channel, $koneksi) or die(mysql_error());
$row_rs_channel = mysql_fetch_assoc($rs_channel);
$totalRows_rs_channel = mysql_num_rows($rs_channel);
?>
<p><strong>UPDATE DATA CHANNEL</strong> </p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="423" height="293">
    <tr valign="baseline">
      <td width="148" align="right" nowrap="nowrap"><strong>KODE CHANNEL</strong></td>
<td width="17">&nbsp;</td>
      <td width="242"><input type="text" name="kode_channel" value="<?php echo htmlentities($row_rs_channel['kode_channel'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>PEMILIK</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="pemilik_channel" value="<?php echo htmlentities($row_rs_channel['pemilik_channel'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>PIC CHANNEL</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="pic_channel" value="<?php echo htmlentities($row_rs_channel['pic_channel'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>ALAMAT</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="alamat_channel" value="<?php echo htmlentities($row_rs_channel['alamat_channel'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>NAMA FILE PHOTO</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="photo_channel" value="<?php echo htmlentities($row_rs_channel['photo_channel'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>KTP CHANNEL</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="ktp_channel" value="<?php echo htmlentities($row_rs_channel['ktp_channel'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>STATUS CHANNEL</strong></td>
<td>&nbsp;</td>
      <td><select class="form-control input-sm" name="active_channel">
        <option value="Y" <?php if (!(strcmp("Y", htmlentities($row_rs_channel['active_channel'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>AKTIF</option>
        <option value="N" <?php if (!(strcmp("N", htmlentities($row_rs_channel['active_channel'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>BLOK</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><a href="?page=view/channel"><strong>Kembali</strong></a></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Simpan Perubahan" class="btn btn-warning btn-block"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_channel" value="<?php echo $row_rs_channel['id_channel']; ?>" />
</form> 