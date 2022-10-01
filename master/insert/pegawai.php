<?php  
 
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO tb_pegawai (Login, Password, nama_pegawai, alamat_pegawai, telp_pegawai, email_pegawai, photo_pegawai, active_pegawai, posisi_pegawai, pos_pegawai, key_pegawai, cb_pegawai, ct_pegawai) VALUES (%s, PASSWORD(%s), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Login'], "text"),
                       GetSQLValueString($_POST['Password'], "text"),
                       GetSQLValueString($_POST['nama_pegawai'], "text"),
                       GetSQLValueString($_POST['alamat_pegawai'], "text"),
                       GetSQLValueString($_POST['telp_pegawai'], "text"),
                       GetSQLValueString($_POST['email_pegawai'], "text"),
                       GetSQLValueString($_POST['photo_pegawai'], "text"),
                       GetSQLValueString($_POST['active_pegawai'], "text"),
                       GetSQLValueString($_POST['posisi_pegawai'], "text"),
					   GetSQLValueString($_POST['pos_pegawai'], "int"),
                       GetSQLValueString($_POST['key_pegawai'], "text"),
                       GetSQLValueString($ID, "int"),
                       GetSQLValueString($today, "date"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
}

mysql_select_db($database_koneksi, $koneksi);
$query_rs_pos = "SELECT * FROM tb_pos";
$rs_pos = mysql_query($query_rs_pos, $koneksi) or die(mysql_error());
$row_rs_pos = mysql_fetch_assoc($rs_pos);
$totalRows_rs_pos = mysql_num_rows($rs_pos);
?>
<p><strong>INSERT DATA PEGAWAI</strong></p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="421" height="445">
    <tr valign="baseline">
      <td width="148" align="right" nowrap="nowrap"><strong>LOGIN</strong></td>
      <td width="16" align="right" nowrap="nowrap">&nbsp;</td>
      <td width="241"><input type="text" name="Login" value="" size="32" class="form-control input-sm" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>SANDI</strong></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="password" name="Password" value="" size="32" class="form-control input-sm" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>NAMA LENGKAP</strong></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="text" name="nama_pegawai" value="" size="32" class="form-control input-sm" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>ALAMAT</strong></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="text" name="alamat_pegawai" value="" size="32" class="form-control input-sm" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>NO. TELPON</strong></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="text" name="telp_pegawai" value="" size="32" class="form-control input-sm" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>EMAIL</strong></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="text" name="email_pegawai" value="" size="32" class="form-control input-sm" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>NAMA FILE PHOTO</strong></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="text" name="photo_pegawai" value="" size="32" class="form-control input-sm" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>STATUS PEGAWAI</strong></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><select class="form-control input-sm" name="active_pegawai" id="active_pegawai">
          <option value="Y">AKTIF</option>
          <option value="N">BLOK</option>
        </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>POSISI</strong></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="text" name="posisi_pegawai" value="" size="32" class="form-control input-sm" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>POS PEGAWAI</strong></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><select name="pos_pegawai" id="pos_pegawai" class="form-control input-sm">
        <?php
do {  
?>
        <option value="<?php echo $row_rs_pos['id_pos']?>"><?php echo $row_rs_pos['nama_pos']?></option>
        <?php
} while ($row_rs_pos = mysql_fetch_assoc($rs_pos));
  $rows = mysql_num_rows($rs_pos);
  if($rows > 0) {
      mysql_data_seek($rs_pos, 0);
	  $row_rs_pos = mysql_fetch_assoc($rs_pos);
  }
?>
      </select>
</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>KEY PEMULIHAN</strong></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="text" name="key_pegawai" value="" size="32" class="form-control input-sm" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><a href="?page=view/pegawai">Kembali</a></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Simpan Data" class="btn btn-success btn-block" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>