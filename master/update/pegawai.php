<?php 

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tb_pegawai SET Login=%s, Password=%s, nama_pegawai=%s, alamat_pegawai=%s, telp_pegawai=%s, email_pegawai=%s, photo_pegawai=%s, active_pegawai=%s, posisi_pegawai=%s, key_pegawai=%s WHERE id_pegawai=%s",
                       GetSQLValueString($_POST['Login'], "text"),
                       GetSQLValueString($_POST['Password'], "text"),
                       GetSQLValueString($_POST['nama_pegawai'], "text"),
                       GetSQLValueString($_POST['alamat_pegawai'], "text"),
                       GetSQLValueString($_POST['telp_pegawai'], "text"),
                       GetSQLValueString($_POST['email_pegawai'], "text"),
                       GetSQLValueString($_POST['photo_pegawai'], "text"),
                       GetSQLValueString($_POST['active_pegawai'], "text"),
                       GetSQLValueString($_POST['posisi_pegawai'], "text"),
                       GetSQLValueString($_POST['key_pegawai'], "text"),
                       GetSQLValueString($_POST['id_pegawai'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
}

$colname_rs_pegawai = "-1";
if (isset($_GET['id_pegawai'])) {
  $colname_rs_pegawai = $_GET['id_pegawai'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_rs_pegawai = sprintf("SELECT * FROM tb_pegawai WHERE id_pegawai = %s", GetSQLValueString($colname_rs_pegawai, "int"));
$rs_pegawai = mysql_query($query_rs_pegawai, $koneksi) or die(mysql_error());
$row_rs_pegawai = mysql_fetch_assoc($rs_pegawai);
$totalRows_rs_pegawai = mysql_num_rows($rs_pegawai);

mysql_select_db($database_koneksi, $koneksi);
$query_rs_pos = "SELECT * FROM tb_pos";
$rs_pos = mysql_query($query_rs_pos, $koneksi) or die(mysql_error());
$row_rs_pos = mysql_fetch_assoc($rs_pos);
$totalRows_rs_pos = mysql_num_rows($rs_pos);
?>
<p><strong>UPDATE DATA PEGAWAI</strong> </p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="377" height="449">
    <tr valign="baseline">
      <td width="136" align="right" nowrap="nowrap"><strong>LOGIN</strong></td>
<td width="16">&nbsp;</td>
      <td width="209"><input type="text" name="Login" value="<?php echo htmlentities($row_rs_pegawai['Login'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>SANDI</strong></td>
<td>&nbsp;</td>
      <td><input type="password" name="Password" value="" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>NAMA PEGAWAI</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="nama_pegawai" value="<?php echo htmlentities($row_rs_pegawai['nama_pegawai'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>ALAMAT</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="alamat_pegawai" value="<?php echo htmlentities($row_rs_pegawai['alamat_pegawai'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>NO. TELPON</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="telp_pegawai" value="<?php echo htmlentities($row_rs_pegawai['telp_pegawai'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>EMAIL</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="email_pegawai" value="<?php echo htmlentities($row_rs_pegawai['email_pegawai'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>NAMA FILE PHOTO</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="photo_pegawai" value="<?php echo htmlentities($row_rs_pegawai['photo_pegawai'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>STATUS </strong></td>
<td>&nbsp;</td>
      <td><select class="form-control input-sm" name="active_pegawai">
        <option value="Y" <?php if (!(strcmp("Y", htmlentities($row_rs_pegawai['active_pegawai'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>AKTIF</option>
        <option value="N" <?php if (!(strcmp("N", htmlentities($row_rs_pegawai['active_pegawai'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>BLOK</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>POSISI PEGAWAI</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="posisi_pegawai" value="<?php echo htmlentities($row_rs_pegawai['posisi_pegawai'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>POS PEGAWAI</strong></td>
      <td>&nbsp;</td>
      <td><select name="pos_pegawai" id="pos_pegawai" class="form-control input-sm">
        <?php
do {  
?>
        <option value="<?php echo $row_rs_pos['id_pos']?>"<?php if (!(strcmp($row_rs_pos['id_pos'], $row_rs_pegawai['pos_pegawai']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_pos['nama_pos']?></option>
        <?php
} while ($row_rs_pos = mysql_fetch_assoc($rs_pos));
  $rows = mysql_num_rows($rs_pos);
  if($rows > 0) {
      mysql_data_seek($rs_pos, 0);
	  $row_rs_pos = mysql_fetch_assoc($rs_pos);
  }
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>KEY PEMULIHAN</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="key_pegawai" value="<?php echo htmlentities($row_rs_pegawai['key_pegawai'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><a href="?page=view/pegawai"><strong>Kembali</strong></a></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Simpan Perubahan" class="btn btn-warning btn-block"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_pegawai" value="<?php echo $row_rs_pegawai['id_pegawai']; ?>" />
</form> 