<?php 

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tb_staff SET Login=%s, Password=%s, nama_staff=%s, gender_staff=%s, email_staff=%s, hp_staff=%s, `Level`=%s, active_staff=%s, ub_staff=%s, ut_staff=%s WHERE id_staff=%s",
                       GetSQLValueString($_POST['Login'], "text"),
                       GetSQLValueString($_POST['Password'], "text"),
                       GetSQLValueString($_POST['nama_staff'], "text"),
                       GetSQLValueString($_POST['gender_staff'], "text"),
                       GetSQLValueString($_POST['email_staff'], "text"),
                       GetSQLValueString($_POST['hp_staff'], "text"),
                       GetSQLValueString($_POST['Level'], "int"),
                       GetSQLValueString($_POST['active_staff'], "text"),
                       GetSQLValueString($ID, "int"),
                       GetSQLValueString($today, "date"),
                       GetSQLValueString($_POST['id_staff'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
}

$colname_rs_staff = "-1";
if (isset($_GET['id_staff'])) {
  $colname_rs_staff = $_GET['id_staff'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_rs_staff = sprintf("SELECT * FROM tb_staff WHERE id_staff = %s", GetSQLValueString($colname_rs_staff, "int"));
$rs_staff = mysql_query($query_rs_staff, $koneksi) or die(mysql_error());
$row_rs_staff = mysql_fetch_assoc($rs_staff);
$totalRows_rs_staff = mysql_num_rows($rs_staff);
?>
<p><strong>UPDATE DATA STAFF</strong> </p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="324" height="394">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>LOGIN</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="Login" value="<?php echo htmlentities($row_rs_staff['Login'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>SANDI</strong></td>
<td>&nbsp;</td>
      <td><input type="password" name="Password" value="" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>NAMA LENGKAP</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="nama_staff" value="<?php echo htmlentities($row_rs_staff['nama_staff'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>SAYA ADALAH</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="gender_staff" value="<?php echo htmlentities($row_rs_staff['gender_staff'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>EMAIL</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="email_staff" value="<?php echo htmlentities($row_rs_staff['email_staff'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>NO. HANDPHONE</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="hp_staff" value="<?php echo htmlentities($row_rs_staff['hp_staff'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>LEVEL</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="Level" value="<?php echo htmlentities($row_rs_staff['Level'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>STATUS</strong></td>
<td>&nbsp;</td>
      <td><select class="form-control input-sm" name="active_staff">
        <option value="Y" <?php if (!(strcmp("Y", htmlentities($row_rs_staff['active_staff'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>AKTIF</option>
        <option value="N" <?php if (!(strcmp("N", htmlentities($row_rs_staff['active_staff'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>BLOK</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><a href="?page=view/staff"><strong>Kembali</strong></a></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Simpan Perubahan" class="btn btn-warning btn-block"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_staff" value="<?php echo $row_rs_staff['id_staff']; ?>" />
</form>