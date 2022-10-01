<?php 
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO tb_staff (Login, Password, nama_staff, gender_staff, email_staff, hp_staff, active_staff, ct_staff, cb_staff) VALUES (%s, PASSWORD(%s), %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Login'], "text"),
                       GetSQLValueString($_POST['Password'], "text"),
                       GetSQLValueString($_POST['nama_staff'], "text"),
                       GetSQLValueString($_POST['gender_staff'], "text"),
                       GetSQLValueString($_POST['email_staff'], "text"),
                       GetSQLValueString($_POST['hp_staff'], "text"),
                       GetSQLValueString($_POST['active_staff'], "text"),
                       GetSQLValueString($today, "date"),
                       GetSQLValueString($ID, "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
}
?>
<p><strong>INSERT DATA STAFF</strong></p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="389" height="433">
    <tr valign="baseline">
      <td width="134" align="right" nowrap="nowrap"><strong>LOGIN</strong></td>
      <td width="13" align="right" nowrap="nowrap">&nbsp;</td>
      <td width="226"><input type="text" name="Login" value="" size="32" class="form-control input-sm" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>SANDI</strong></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="text" name="Password" value="" size="32" class="form-control input-sm" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>NAMA LENGKAP</strong></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="text" name="nama_staff" value="" size="32" class="form-control input-sm" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>SAYA ADALAH<br>
      (L/P)</strong></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="text" name="gender_staff" value="" size="32" class="form-control input-sm" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>EMAIL</strong></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="text" name="email_staff" value="" size="32" class="form-control input-sm" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>NO. HANDPHONE</strong></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="text" name="hp_staff" value="" size="32" class="form-control input-sm" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>LEVEL</strong></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="text" name="Level" value="" size="32" class="form-control input-sm" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>STATUS STAFF</strong></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><select class="form-control input-sm" name="active_staff" id="active_staff">
        <option value="Y">AKTIF</option>
        <option value="N">BLOK</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><a href="?page=view/staff">Kembali</a></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Simpan Data" class="btn btn-success btn-block" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
