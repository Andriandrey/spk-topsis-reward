<?php 

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tb_group SET nama_group=%s, alamat_group=%s, active_group=%s WHERE id_group=%s",
                       GetSQLValueString($_POST['nama_group'], "text"),
                       GetSQLValueString($_POST['alamat_group'], "text"),
                       GetSQLValueString($_POST['active_group'], "text"),
                       GetSQLValueString($_POST['id_group'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
}

$colname_rs_group = "-1";
if (isset($_GET['id_group'])) {
  $colname_rs_group = $_GET['id_group'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_rs_group = sprintf("SELECT * FROM tb_group WHERE id_group = %s", GetSQLValueString($colname_rs_group, "int"));
$rs_group = mysql_query($query_rs_group, $koneksi) or die(mysql_error());
$row_rs_group = mysql_fetch_assoc($rs_group);
$totalRows_rs_group = mysql_num_rows($rs_group);
?>
<p><strong>UPDATE DATE GROUP</strong> </p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="361" height="171">
    <tr valign="baseline">
      <td width="111" align="right" nowrap="nowrap"><strong>NAMA GROUP</strong></td>
<td width="10">&nbsp;</td>
      <td width="191"><input type="text" name="nama_group" value="<?php echo htmlentities($row_rs_group['nama_group'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>ALAMAT</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="alamat_group" value="<?php echo htmlentities($row_rs_group['alamat_group'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>STATUS</strong></td>
<td>&nbsp;</td>
      <td><select class="form-control input-sm" name="active_group">
        <option value="Y" <?php if (!(strcmp("Y", htmlentities($row_rs_group['active_group'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>AKTIF</option>
        <option value="N" <?php if (!(strcmp("N", htmlentities($row_rs_group['active_group'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>BLOK</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><a href="?page=view/group"><strong>Kembali</strong></a></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Simpan Perubahan" class="btn btn-warning btn-block"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_group" value="<?php echo $row_rs_group['id_group']; ?>" />
</form>
 