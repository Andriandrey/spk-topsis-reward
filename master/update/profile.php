<?php  

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  if (empty($_POST['Password'])) {
	  $updateSQL = sprintf("UPDATE tb_master SET Login=%s, nama_master=%s, key_master=%s WHERE id_master=%s",
						   GetSQLValueString($_POST['Login'], "text"),
						   GetSQLValueString($_POST['nama_master'], "text"),
						   GetSQLValueString($_POST['key_master'], "text"),
						   GetSQLValueString($_POST['id_master'], "int"));
	
	  mysql_select_db($database_koneksi, $koneksi);
	  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
	  
	  pesan('success','Sukses! Data Berhasil disimpan tanpa password');
  }else{
	  $updateSQL = sprintf("UPDATE tb_master SET Login=%s, Password=PASSWORD(%s), nama_master=%s, key_master=%s WHERE id_master=%s",
						   GetSQLValueString($_POST['Login'], "text"),
						   GetSQLValueString($_POST['Password'], "text"),
						   GetSQLValueString($_POST['nama_master'], "text"),
						   GetSQLValueString($_POST['key_master'], "text"),
						   GetSQLValueString($_POST['id_master'], "int"));
	
	  mysql_select_db($database_koneksi, $koneksi);
	  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
	  
	  pesan('success','Sukses! Data Berhasil disimpan beserta password');
  }
}

mysql_select_db($database_koneksi, $koneksi);
$query_rs_profile = "SELECT * FROM tb_master WHERE id_master = '".$ID."'";
$rs_profile = mysql_query($query_rs_profile, $koneksi) or die(mysql_error());
$row_rs_profile = mysql_fetch_assoc($rs_profile);
$totalRows_rs_profile = mysql_num_rows($rs_profile);
?> 

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="380" height="260">
    <tr valign="baseline">
      <td nowrap="nowrap"><strong>Username</strong></td>
      <td><input type="text" name="Login" value="<?php echo htmlentities($row_rs_profile['Login'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm" required/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap"><strong>Change Password</strong></td>
      <td><input type="password" name="Password" value="" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap">&nbsp;</td>
      <td valign="top"><h5>*) <em>Kosongkan jika tidak ingin ganti sandi</em></h5></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap"><strong>Nama Lengkap</strong></td>
      <td><input type="text" name="nama_master" value="<?php echo htmlentities($row_rs_profile['nama_master'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm" required/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap"><strong>Key Lupa Password</strong></td>
      <td><input type="text" name="key_master" value="<?php echo htmlentities($row_rs_profile['key_master'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm" required/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap">&nbsp;</td>
      <td><input type="submit" value="Simpan Perubahan" class="btn btn-warning btn-block" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_master" value="<?php echo $row_rs_profile['id_master']; ?>" />
</form> 