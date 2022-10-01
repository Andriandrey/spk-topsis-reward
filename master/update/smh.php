<?php 

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tb_smh SET segmen_smh=%s, kategori_smh=%s, kode_smh=%s, nama_smh=%s, cc_smh=%s, active_smh=%s, ut_smh=%s, ub_smh=%s, ket_smh=%s WHERE id_smh=%s",
                       GetSQLValueString($_POST['segmen_smh'], "int"),
                       GetSQLValueString($_POST['kategori_smh'], "int"),
                       GetSQLValueString($_POST['kode_smh'], "text"),
                       GetSQLValueString($_POST['nama_smh'], "text"),
                       GetSQLValueString($_POST['cc_smh'], "int"),
                       GetSQLValueString($_POST['active_smh'], "text"),
                       GetSQLValueString($today, "date"),
                       GetSQLValueString($ID, "int"),
                       GetSQLValueString($_POST['ket_smh'], "text"),
                       GetSQLValueString($_POST['id_smh'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
}

$colname_rs_smh = "-1";
if (isset($_GET['id_smh'])) {
  $colname_rs_smh = $_GET['id_smh'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_rs_smh = sprintf("SELECT * FROM tb_smh WHERE id_smh = %s", GetSQLValueString($colname_rs_smh, "int"));
$rs_smh = mysql_query($query_rs_smh, $koneksi) or die(mysql_error());
$row_rs_smh = mysql_fetch_assoc($rs_smh);
$totalRows_rs_smh = mysql_num_rows($rs_smh);
?> 
<p><strong>UPDATE DATA SMH</strong> </p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="347" height="398">
    <tr valign="baseline">
      <td width="112" align="right" nowrap="nowrap"><strong>ID SEGMEN</strong></td>
<td width="13">&nbsp;</td>
      <td width="206"><input type="text" name="segmen_smh" value="<?php echo htmlentities($row_rs_smh['segmen_smh'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>ID KATEGORI</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="kategori_smh" value="<?php echo htmlentities($row_rs_smh['kategori_smh'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>KODE SMH</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="kode_smh" value="<?php echo htmlentities($row_rs_smh['kode_smh'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>NAMA SMH</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="nama_smh" value="<?php echo htmlentities($row_rs_smh['nama_smh'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>CC</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="cc_smh" value="<?php echo htmlentities($row_rs_smh['cc_smh'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>STATUS</strong></td>
<td>&nbsp;</td>
      <td><select class="form-control input-sm" name="active_smh">
        <option value="Y" <?php if (!(strcmp("Y", htmlentities($row_rs_smh['active_smh'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>AKTIF</option>
        <option value="N" <?php if (!(strcmp("N", htmlentities($row_rs_smh['active_smh'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>BLOK</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>KETERANGAN</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="ket_smh" value="<?php echo htmlentities($row_rs_smh['ket_smh'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><a href="?page=view/smh"><strong>Kembali</strong></a></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Simpan Perubahan" class="btn btn-warning btn-block"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_smh" value="<?php echo $row_rs_smh['id_smh']; ?>" />
</form>