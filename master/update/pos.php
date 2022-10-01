<?php 

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tb_pos SET kode_pos=%s, nama_pos=%s, alamat_pos=%s, telp_pos=%s, active_pos=%s, ub_pos=%s, ut_pos=%s WHERE id_pos=%s",
                       GetSQLValueString($_POST['kode_pos'], "text"),
                       GetSQLValueString($_POST['nama_pos'], "text"),
                       GetSQLValueString($_POST['alamat_pos'], "text"),
                       GetSQLValueString($_POST['telp_pos'], "text"),
                       GetSQLValueString($_POST['active_pos'], "text"),
                       GetSQLValueString($ID, "int"),
                       GetSQLValueString($today, "date"),
                       GetSQLValueString($_POST['id_pos'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
}

$colname_rs_pos = "-1";
if (isset($_GET['id_pos'])) {
  $colname_rs_pos = $_GET['id_pos'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_rs_pos = sprintf("SELECT * FROM tb_pos WHERE id_pos = %s", GetSQLValueString($colname_rs_pos, "int"));
$rs_pos = mysql_query($query_rs_pos, $koneksi) or die(mysql_error());
$row_rs_pos = mysql_fetch_assoc($rs_pos);
$totalRows_rs_pos = mysql_num_rows($rs_pos);
?>
<p><strong>UPDATE DATA POS</strong> </p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="319" height="273">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>KODE POS</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="kode_pos" value="<?php echo htmlentities($row_rs_pos['kode_pos'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>NAMA POS</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="nama_pos" value="<?php echo htmlentities($row_rs_pos['nama_pos'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>ALAMAT POS</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="alamat_pos" value="<?php echo htmlentities($row_rs_pos['alamat_pos'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>NO. TELP</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="telp_pos" value="<?php echo htmlentities($row_rs_pos['telp_pos'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>STATUS </strong></td>
<td>&nbsp;</td>
      <td><select class="form-control input-sm" name="active_pos">
        <option value="Y" <?php if (!(strcmp("Y", htmlentities($row_rs_pos['active_pos'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>AKTIF</option>
        <option value="N" <?php if (!(strcmp("N", htmlentities($row_rs_pos['active_pos'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>BLOK</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><a href="?page=view/pos"><strong>Kembali</strong></a></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Simpan Perubahan" class="btn btn-warning btn-block"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_pos" value="<?php echo $row_rs_pos['id_pos']; ?>" />
</form> 