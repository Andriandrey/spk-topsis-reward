<?php 

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tb_mutasi SET tipe_mutasi=%s, tgl_mutasi=%s, nomesin_mutasi=%s, helm_mutasi=%s, jaket_mutasi=%s, toolset_mutasi=%s, buser_mutasi=%s, buped_mutasi=%s, lainnya_mutasi=%s, idpos_mutasi=%s, active_mutasi=%s WHERE id_mutasi=%s",
                       GetSQLValueString($_POST['tipe_mutasi'], "text"),
                       GetSQLValueString($_POST['tgl_mutasi'], "date"),
                       GetSQLValueString($_POST['nomesin_mutasi'], "text"),
                       GetSQLValueString($_POST['helm_mutasi'], "int"),
                       GetSQLValueString($_POST['jaket_mutasi'], "int"),
                       GetSQLValueString($_POST['toolset_mutasi'], "int"),
                       GetSQLValueString($_POST['buser_mutasi'], "int"),
                       GetSQLValueString($_POST['buped_mutasi'], "int"),
                       GetSQLValueString($_POST['lainnya_mutasi'], "text"),
                       GetSQLValueString($_POST['idpos_mutasi'], "int"),
                       GetSQLValueString($_POST['active_mutasi'], "int"),
                       GetSQLValueString($_POST['id_mutasi'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
}

$colname_rs_mutasi = "-1";
if (isset($_GET['id_mutasi'])) {
  $colname_rs_mutasi = $_GET['id_mutasi'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_rs_mutasi = sprintf("SELECT * FROM tb_mutasi WHERE id_mutasi = %s", GetSQLValueString($colname_rs_mutasi, "int"));
$rs_mutasi = mysql_query($query_rs_mutasi, $koneksi) or die(mysql_error());
$row_rs_mutasi = mysql_fetch_assoc($rs_mutasi);
$totalRows_rs_mutasi = mysql_num_rows($rs_mutasi);
?>
<p><strong>UPDATE DATA MUTASI</strong> </p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="372" height="490">
    <tr valign="baseline">
      <td width="127" align="right" nowrap="nowrap"><strong>TIPE MUTASI</strong></td>
<td width="18">&nbsp;</td>
      <td width="211"><input type="text" name="tipe_mutasi" value="<?php echo htmlentities($row_rs_mutasi['tipe_mutasi'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>TANGGAL</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="tgl_mutasi" value="<?php echo htmlentities($row_rs_mutasi['tgl_mutasi'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>NO. MESIN</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="nomesin_mutasi" value="<?php echo htmlentities($row_rs_mutasi['nomesin_mutasi'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>HELM</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="helm_mutasi" value="<?php echo htmlentities($row_rs_mutasi['helm_mutasi'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>JAKET</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="jaket_mutasi" value="<?php echo htmlentities($row_rs_mutasi['jaket_mutasi'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>TOOLSET</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="toolset_mutasi" value="<?php echo htmlentities($row_rs_mutasi['toolset_mutasi'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>BUSER</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="buser_mutasi" value="<?php echo htmlentities($row_rs_mutasi['buser_mutasi'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>BUPED</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="buped_mutasi" value="<?php echo htmlentities($row_rs_mutasi['buped_mutasi'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>LAINNYA</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="lainnya_mutasi" value="<?php echo htmlentities($row_rs_mutasi['lainnya_mutasi'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>ID POS</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="idpos_mutasi" value="<?php echo htmlentities($row_rs_mutasi['idpos_mutasi'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>STATUS MUTASI</strong></td>
<td>&nbsp;</td>
      <td><select class="form-control input-sm" name="active_mutasi">
        <option value="Y" <?php if (!(strcmp("Y", htmlentities($row_rs_mutasi['active_mutasi'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>AKTIF</option>
        <option value="N" <?php if (!(strcmp("N", htmlentities($row_rs_mutasi['active_mutasi'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>BLOK</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><a href="?page=view/mutasi"><strong>Kembali</strong></a></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Simpan Perubahan" class="btn btn-warning btn-block"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_mutasi" value="<?php echo $row_rs_mutasi['id_mutasi']; ?>" />
</form>
 