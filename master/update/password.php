<?php  

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  if ($_POST['new'] != $_POST['konfirmasi']) {
	  pesan('danger','Oops! Password tidak sama!');
  }elseif (empty($_POST['new']) || empty($_POST['konfirmasi'])){
	  pesan('danger','Oops! Field tidak boleh kosong!');
  }else{
	  $updateSQL = sprintf("UPDATE tb_master SET Password=PASSWORD(%s)  WHERE id_master=%s",
						   GetSQLValueString($_POST['konfirmasi'], "text"),
						   GetSQLValueString($_POST['id_master'], "int"));
						   
	  mysql_select_db($database_koneksi, $koneksi);
	  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
	  pesan('success','Sukses!  Data Berhasil disimpan!');
  }
}

mysql_select_db($database_koneksi, $koneksi);
$query_rs_profile = "SELECT * FROM tb_master WHERE id_master = '".$ID."'";
$rs_profile = mysql_query($query_rs_profile, $koneksi) or die(mysql_error());
$row_rs_profile = mysql_fetch_assoc($rs_profile);
$totalRows_rs_profile = mysql_num_rows($rs_profile);
?> 

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="366" height="125">
    <tr valign="baseline">
      <td nowrap="nowrap">New Password</td>
      <td><input type="password" name="new" value="" size="32" class="form-control input-sm" required/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap">Konfirmasi Password</td>
      <td><input type="password" name="konfirmasi" value="" size="32" class="form-control input-sm" required/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap">&nbsp;</td>
      <td><input type="submit" value="Simpan Perubahan" class="btn btn-warning btn-block" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_master" value="<?php echo $row_rs_profile['id_master']; ?>" />
</form> 