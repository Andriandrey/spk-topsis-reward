<?php 

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tb_posting SET title_posting=%s, kategori_posting=%s, konten_posting=%s, image_posting=%s, active_posting=%s, ut_posting=%s, ub_posting=%s WHERE id_posting=%s",
                       GetSQLValueString($_POST['title_posting'], "text"),
                       GetSQLValueString($_POST['kategori_posting'], "int"),
                       GetSQLValueString($_POST['konten_posting'], "text"),
                       GetSQLValueString($_POST['image_posting'], "text"),
                       GetSQLValueString($_POST['active_posting'], "text"),
                       GetSQLValueString($today, "date"),
                       GetSQLValueString($ID, "int"),
                       GetSQLValueString($_POST['id_posting'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
}

$colname_rs_posting = "-1";
if (isset($_GET['id_posting'])) {
  $colname_rs_posting = $_GET['id_posting'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_rs_posting = sprintf("SELECT * FROM tb_posting WHERE id_posting = %s", GetSQLValueString($colname_rs_posting, "int"));
$rs_posting = mysql_query($query_rs_posting, $koneksi) or die(mysql_error());
$row_rs_posting = mysql_fetch_assoc($rs_posting);
$totalRows_rs_posting = mysql_num_rows($rs_posting);
?>
<p><strong>UPDATE DATA POSTING</strong> </p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="354" height="286">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>TITLE</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="title_posting" value="<?php echo htmlentities($row_rs_posting['title_posting'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>KATEGORI</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="kategori_posting" value="<?php echo htmlentities($row_rs_posting['kategori_posting'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>KONTEN</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="konten_posting" value="<?php echo htmlentities($row_rs_posting['konten_posting'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>NAMA FILE PHOTO</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="image_posting" value="<?php echo htmlentities($row_rs_posting['image_posting'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>STATUS</strong></td>
<td>&nbsp;</td>
      <td><select class="form-control input-sm" name="active_posting">
        <option value="Y" <?php if (!(strcmp("Y", htmlentities($row_rs_posting['active_posting'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>AKTIF</option>
        <option value="N" <?php if (!(strcmp("N", htmlentities($row_rs_posting['active_posting'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>BLOK</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><a href="?page=view/posting"><strong>Kembali</strong></a></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Simpan Perubahan" class="btn btn-warning btn-block"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_posting" value="<?php echo $row_rs_posting['id_posting']; ?>" />
</form> 