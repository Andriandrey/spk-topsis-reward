<?php  

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $file = feature_image('image_posting');
  if (empty($file)) {
  $insertSQL = sprintf("INSERT INTO tb_posting (title_posting, konten_posting, ct_posting, cb_posting, active_posting) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['title_posting'], "text"),
                       GetSQLValueString($_POST['konten_posting'], "text"),
                       //GetSQLValueString($file, "text"),
                       GetSQLValueString($today, "date"),
                       GetSQLValueString($ID, "int"),
					   GetSQLValueString($_POST['Status'], "text"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
  
  pesan('success','Informasi berhasil disimpan tanpa gambar utama');

  }else{
  	  
  $insertSQL = sprintf("INSERT INTO tb_posting (title_posting, konten_posting, image_posting, ct_posting, cb_posting, active_posting) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['title_posting'], "text"),
                       GetSQLValueString($_POST['konten_posting'], "text"),
                       GetSQLValueString($file, "text"),
                       GetSQLValueString($today, "date"),
                       GetSQLValueString($ID, "int"),
					   GetSQLValueString($_POST['Status'], "text"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
  
	  $insertSQL2 = sprintf("INSERT INTO tb_photoposting (images_photoposting, tanggal_photoposting, ct_photoposting,cb_photoposting,pemilik_photoposting) VALUES (%s,%s, %s, %s, %s)",
						   GetSQLValueString($file, "text"),
						   GetSQLValueString($tglsekarang, "date"),
						   GetSQLValueString($today, "date"),
						   GetSQLValueString($ID, "int"),
						   GetSQLValueString($ID, "int"));
						   
	
	  mysql_select_db($database_koneksi, $koneksi);
	  $Result2 = mysql_query($insertSQL2, $koneksi) or die(mysql_error());
	  
	  pesan('success','Informasi berhasil disimpan dengan gambar utama');
  } 
}
?> 


<?php title('success','Entry Posting','Silahkan masukan postingan terbaru di sini'); ?>

<form action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="100%" height="318">
    <tr valign="baseline">
      <td colspan="3"><div align="left">Judul Posting</div>
      <input type="text" name="title_posting" value="" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td colspan="3"><div align="left">Konten Posting</div>
      <textarea name="konten_posting" cols="50" rows="5" class="form-control input-sm" id="editor1"></textarea>      </td>
    </tr>
    <tr valign="baseline">
      <td width="40%" valign="top"><div align="left">Upload Gambar utama</div>
      <input name="image_posting" type="file" size="32" class="form-control input-sm"/></td>
      <td width="3%">&nbsp;</td>
      <td width="57%"><label>Status Posting
        <select name="Status" id="Status" class="form-control input-sm">
          <option value="Y">Posting</option>
          <option value="P">Daftar</option>
          
        </select>
      </label></td>
    </tr>
    <tr valign="baseline">
      <td colspan="3"><input type="submit" value="Posting" class="btn btn-success btn-block" />     </td>
    </tr>
  </table>
  <input type="hidden" name="ct_posting" value="<?= $today; ?>" />
  <input type="hidden" name="cb_posting" value="<?= $ID; ?>" />
  <input type="hidden" name="MM_insert" value="form1" />
</form> 